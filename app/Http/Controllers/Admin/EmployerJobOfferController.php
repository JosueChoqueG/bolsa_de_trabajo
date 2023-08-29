<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\JobOffer;
use App\Model\Countrie;
use App\Model\CollegeCareer;
use App\Model\Area;
use App\Model\Geolocation;
use App\Model\Employer;
use App\Model\Candidate;
use App\Model\EmailJobOffer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use App\Mail\NewJobOffer;
use Mail;
use DB;
use Session;
use App\Http\Requests\Admin\EmployerJobOfferCreateRequest; 
use App\Http\Requests\Admin\EmployerJobOfferUpdateRequest; 

class EmployerJobOfferController extends Controller
{
    public function index(Request $request)
    {   
       
        $data['search_title']       = $request->input('search_title','');
        $data['search_employer_id'] = $request->input('search_employer_id','');

        $data['countries']   = Countrie::all();
        $data['colleges']    = CollegeCareer::where('visibility',1)->get();
        $data['areas']       = Area::all();
        $data['departments'] = Geolocation::where('province_code','00')->where('district_code','00')->get();
        $data['employers']   = Employer::all();
        $data['job_offers']  = JobOffer::with('employer')->withCount(['postulations','emails'])
                                    ->where('type','externa')
                                    ->title($request->search_title)
                                    ->employer($request->search_employer_id)
                                    ->orderBy('created_at', 'desc')->paginate(10);
       
        return view('admin.employer_job_offer.index')->with($data); 
    }

    public function find($id)
    {
        $job_offer = JobOffer::with(['college_careers','area','countrie','geolocation','emails.user','employer'])
                                ->where('id',$id)->firstOrFail();

        return response()->json([
            'data'   => $job_offer,
        ]);
        
    }

    public function create(EmployerJobOfferCreateRequest $request)
    {
        if ($request->ajax())
        {
            try
            {  
                DB::beginTransaction();

                $geolocation_id = NULL;
                if(! is_null($request->department_code))
                    $geolocation_id = $request->department_code;
                if(! is_null($request->province_code))
                    $geolocation_id = $request->province_code;
                if(! is_null($request->district_code))
                    $geolocation_id = $request->district_code;
            
                $array  = [
                    'type'             => 'interna',
                    'status'           => 1,
                    // 'academic_level'   => $academic_level,
                    'geolocation_id'   => $geolocation_id,
                    'path_logo'        => NULL,
                ];
                
                $job_offer = JobOffer::create(array_merge($request->all(), $array));

                $job_offer->college_careers()->sync($request->college_id);

                DB::commit();    

                return response()->json([
                    'action'   => 'insert',
                    'message'  => 'Datos registrados correctamente',
                ]);
            }
            
            catch (Exception $e)
            {
                DB::rollback();

                abort(500,'Se produjo un error al enviar los datos, intentalo otra vez');
            }
        }
        
    }

    public function update(EmployerJobOfferUpdateRequest $request, $id)
    {
       
        if($request->ajax())
        {
            try
            {  
                DB::beginTransaction();
                $geolocation_id = NULL;
                if(! is_null($request->department_code))
                    $geolocation_id = $request->department_code;
                if(! is_null($request->province_code))
                    $geolocation_id = $request->province_code;
                if(! is_null($request->district_code))
                    $geolocation_id = $request->district_code;

                $publication_date = Null;
    
                if($request->status == 2 || $request->status == 3 )
                $publication_date = $request->publication_date;
    
                $array  = [
                    'geolocation_id'   =>  $geolocation_id,
                    'publication_date' => $publication_date,
                ];
                $job_offer = JobOffer::where('id',$id)->first();
                $job_offer->update(array_merge($request->all(),$array));
               
                $job_offer->college_careers()->sync($request->college_id);
    
                DB::commit();//confirmamos la transaccion
    
                return response()->json([
                    'message'  => 'Datos actualizados correctamente',
                ]);
               
            }
            catch (\Exception $e)
            {
                DB::rollback();//si se produce algun error al insertar, restablecemos la bd a como estaba antes
                abort(500,'Ocurrio un error');
            }
        }
    }

    public function delete(Request $request, $id)
    {
        
        $job_offer = JobOffer::findOrFail($id);
        if($job_offer->status != '2')
            {
                $job_offer->delete();

                return response()->json([
                    'message' => 'Registro eliminado correctamente',
                    'action'  => 'delete'
                ]);
            }
            else
            {
                return response()->json([
                    'message'  => 'No se puede eliminar una oferta laboral publicada',
                    'action'   => 'not_delete'
                ]);

            }

    }

    public function sendEmails(Request $request,$id)
    {
        
            try 
            {
                DB::beginTransaction();
                $job_offer = JobOffer::with(['college_careers','countrie','geolocation'])->where('id',$id)->firstOrFail();
        
                $array_colleges = [];//array con las carreras del empleo
            
                $colleges = $job_offer->college_careers;
                
                foreach ($colleges as $key => $college) {
                    $array_colleges[$key] = $college->id; 
                }
        
                $candidates = Candidate::whereHas('college_careers', function (Builder $query) use($array_colleges) {
                                            $query->whereIn('college_id',$array_colleges);
                                        })->whereNotNull('email')->where('email','!=','') ->get();  
                // enviamos el email a cada candidato
                $status  = 'error';
                $message = 'No hay candidatos disponibles para el envio de correos';   
        
                if(! is_null($candidates))
                { 
                    foreach ($candidates as $key => $candidate) 
                    {
                        Mail::to($candidate)->queue(new NewJobOffer($candidate,$job_offer));
                    }  
                    $status = 'success';
                    $message = 'Los correos esta siendo enviados.';
        
                    //guardamos los datos del envio
                    $email_job_offer = new EmailJobOffer();
                    $email_job_offer->create([
                        'job_offer_id' => $job_offer->id,
                        'quantity'     => count($candidates),
                        'user_id'      => Session::get('user_id'),
                        'created_at'   => Carbon::now(),
                    ]);
                } 
                DB::commit();

               return redirect()->back()->with('msg-success','Los emails estan siendo enviados.');  

            } catch (\Exception $th) {
               
               DB::rollback();
               return redirect()->back()->with('msg-warning','.No se pudo realizar el envio, intentelo otra vez.');  

            }                                         
        
    }
}
