<?php

namespace App\Http\Controllers\Web\Employer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Geolocation;
use App\Model\JobOffer;
use App\Model\Countrie;
use App\Model\OfferCollege;
use App\Model\Postulation;
use App\Model\Area;
use App\Model\CollegeCareer;
use Carbon\Carbon;
use Session;
use DB;

class JobOfferController extends Controller
{
    public function index(Request $request)
    {   
        $job_offers= JobOffer::withCount(['postulations'])->where('employer_id',Session::get('employer_id'))->orderBy('created_at', 'desc')->get();

        return view('web.employer.my_offers.index', compact('job_offers')); 
    }

    public function watch($id)
    {
        try{

            $employer = JobOffer::where('employer_id',Session::get('employer_id'))->where('id', $id)->first();

            if(isset($employer))
            {
                $job_offer          = JobOffer::with('college_careers')->where('id',$id)->first();
                $area               = Area::where('id',$job_offer->area_id)->first();
                $countrie           = Countrie::where('id',$job_offer->countrie_id)->first();
                $department_code    = substr($job_offer->geolocation_id, 0, -4);
                $province_code      = substr($job_offer->geolocation_id, 2, -2); 
                $district_code      = substr($job_offer->geolocation_id, 4); 
               
                if($district_code)
                {
                    $department         = Geolocation::where('department_code',$department_code)->select('name')->first();
                    $province           = Geolocation::where('province_code',$province_code)->select('name')->first();
                    $district           = Geolocation::where('district_code',$district_code)->select('name')->first();
                }
                else
                {
                    $department         = '';
                    $province           = '';
                    $district           = '';

                }
                
                return view('web.employer.my_offers.watch', compact('job_offer','department','province','district','area','countrie')); 
            }
            else
            {
                abort(403);
            }
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('msg-error','Se produjo un error al enviar los datos intentalo otra vez');
        }
    }

    public function create(Request $request)
    {
        if ($request->isMethod('get'))
        {
            $countries          = Countrie::get();
            $colleges           = CollegeCareer::where('visibility',1)->get();
            $areas              = Area::get();
            $departments        = Geolocation::where('province_code','00')->where('district_code','00')->get();
            $today              = Carbon::now();
            $today              = $today->toDateString();
            return view('web.employer.my_offers.create',compact('countries','departments','colleges','areas','today'));
        }
        else
        {
            if ($request->ajax())
            {
                $this->validate($request,[
                    'category'          => 'bail|required|in:Prácticas,Empleo,Becas/Pasantías',
                    'title'             => 'bail|required|max:100',
                    'title_complement'  => 'max:100',
                    'description'       => 'required|max:10000',
                    'introduction'      => 'required|max:500',
                    'workday'           => 'bail|required|in:Medio tiempo,Tiempo completo,Por horas',
                    'area_id'           => 'required',
                    'type_salary'       => 'bail|required|in:A tratar,Fijo,Rango',
                    'salary_min'        => 'bail|sometimes|nullable|required_if:type_salary,fijo,Rango|numeric',
                    'salary_max'        => 'bail|sometimes|nullable|numeric|gt:salary_min',
                    'type_validity'     => 'bail|required|in:Por definir,Definido,Indefinido',
                    'countrie_id'       => 'bail|required|exists:countrie,id',
                    //'district_code'     => 'bail|sometimes|nullable|required_if:countrie_id,173|exists:geolocation,id',
                   // 'college_id'        => 'required|array|min:1',
                    'college_id.*'      => 'exists:college_career,id',
                    'vacancies'         => 'bail|required|numeric'  ,
                    'finish_date'       => 'bail|required|after:today|date',
                    'is_postulable'     => 'required|in:0,1'
                ],
                    $messages = [
                        'salary_max.gt'         => ' el campo Monto Max. no puede ser menor a Monto Min',
                        'finish_date.after'     => ' La fecha de cierre debe se mayor a la fecha de hoy ',
                    ]
                );

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
                        'type'             => 'externa',
                        'employer_id'      => Session::get('employer_id'),
                        'status'           => '1',
                        'geolocation_id'   =>  $geolocation_id,
                        'path_logo'        => Session::get('path_logo'),
                        'slug'             => generateSlug($request->title)
                    ];
                    
                    $job_offer = JobOffer::create(array_merge($request->all(), $array));

                    $job_offer->college_careers()->sync($request->college_id);

                    DB::commit();    

                    return response()->json([
                        'action'   => 'insert',
                        'message'  => 'Datos registrados correctamente',
                    ]);
                }
                
                catch (\Exception $e)
                {
                    DB::rollback();
                    abort(500,'Se produjo un error al enviar los datos intentalo otra vez');
                }
            }
        }
    }

    public function edit(Request $request, $id)
    {
        
        if ($request->isMethod('get'))
        {
            try{
                $employer = JobOffer::where('employer_id',Session::get('employer_id'))->where('id', $id)->first();
                if(isset($employer))
                {
                    if($employer->status == '1')
                    {
                        $job_offer          = JobOffer::with('college_careers')->where('id',$id)->first();
                        $department_code    = substr($job_offer->geolocation_id, 0, -4);
                        $province_code      = substr($job_offer->geolocation_id, 2, -2); 
                        $district_code      = substr($job_offer->geolocation_id, 4); 
                        $countries          = Countrie::get();
                        $colleges           = CollegeCareer::where('visibility',1)->get();
                        $areas              = Area::get();
                        $departments        = Geolocation::where('province_code','00')->where('district_code','00')->get();
                        $provinces          = Geolocation::where('department_code',$department_code)
                                            ->where('district_code','=','00')
                                            ->where('province_code','<>','00')->get();
                                            
                        $districts          = Geolocation::where('department_code',$department_code)
                                            ->where('province_code',$province_code)
                                            ->where('district_code','<>','00')->get();
                        $today              = Carbon::now();
                        $today              = $today->toDateString();
                    
                        return view('web.employer.my_offers.edit', compact('job_offer','areas','department_code','province_code','district_code','countries','colleges','departments','provinces','districts','today')); 

                    }

                    else
                    {
                        return redirect()->back()->with('msg-warning','Sólo se puede editar las publicaciones que se encuentran en Revisión');
                    }
                    
                }
                else
                {
                    abort(403);
                }
            }
            catch (\Exception $e)
            {
                Session::flash('msg-error','Se produjo un error al enviar los datos intentalo otra vez');
    
                return redirect()->back();
            }
        }
        else
        {
            $this->validate($request,[
                'category'          => 'bail|required|in:Practicas,Empleo,Becas/Pasantías',
                'title'             => 'bail|required|max:100',
                'title_complement'  => 'max:100',
                'description'       => 'required|max:10000',
                'introduction'      => 'required|max:500',
                'workday'           => 'bail|required|in:Medio tiempo,Tiempo completo,Por horas',
                'area_id'           => 'required',
                'type_salary'       => 'bail|required|in:A tratar,Fijo,Rango',
                'salary_min'        => 'bail|sometimes|nullable|required_if:type_salary,fijo,Rango|numeric',
                'salary_max'        => 'bail|sometimes|nullable|numeric|gt:salary_min',
                'type_validity'     => 'bail|required|in:Por definir,Definido,Indefinido',
                'countrie_id'       => 'bail|required|exists:countrie,id',
                //'district_code'     => 'bail|sometimes|nullable|required_if:countrie_id,173|exists:geolocation,id',
                //'college_id'        => 'bail|required|array|min:1',
                'college_id.*'      => 'exists:college_career,id',
                'vacancies'         => 'bail|required|numeric'  ,
                'finish_date'       => 'bail|required|after:today|date',
                'is_postulable'     => 'required|in:0,1'
            ],
            $messages = [
                'salary_max.gt'         => ' el campo Monto Max. no puede ser menor a Monto Min',
                'finish_date.after'     => ' La fecha de cierre debe se mayor a la fecha de hoy ',
            ]
            );
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
                    'type'              => 'externa',
                    'category'          => $request->category,
                    'title'             => $request->title,
                    'title_complement'  => $request->title_complement,
                    'description'       => $request->description,
                    'countrie_id'       => $request->countrie_id,
                    'geolocation_id'    => $geolocation_id,
                    'workday'           => $request->workday,
                    'area_id'           => $request->area_id,
                    'type_salary'       => $request->type_salary,
                    'type_validity'     => $request->type_validity,
                    'validity_time'     => $request->validity_time,
                    'vacancies'         => $request->vacancies,
                    'finish_date'       => $request->finish_date,
                    'salary_min'        => $request->salary_min,
                    'salary_max'        => $request->salary_max,
                    'is_postulable'     => $request->is_postulable,
                    'employer_id'       => Session::get('employer_id'),
                    'status'            => '1',
                    'path_logo'         => Session::get('path_logo')    
                ];
               
                $job_offer = JobOffer::where('id',$id)->update($array);

                $offer_college = OfferCollege::where('job_offer_id', $id)->delete();

                foreach ($request->college_id as  $college) 
                {
                    $offer_college                  = new OfferCollege();
                    $offer_college->college_id      = $college;
                    $offer_college->job_offer_id    = $id;
                    $offer_college->save();
                }

                DB::commit();//confirmamos la transaccion
               
                return redirect('/employers')->with('msg-success','Información actualizada correctamente!!');
            }
            catch (Exception $e)
            {
                DB::rollback();//si se produce algun error al insertar, restablecemos la bd a como estaba antes
                Session::flash('msg-error', ' Se produjo un error al enviar los datos intentalo otra vez');

                return redirect()->back()->withInput();
            }

        }
    }

    public function delete(Request $request, $id)
    {
        try
        {
            $employer = JobOffer::where('employer_id',Session::get('employer_id'))->where('id', $id)->first();

            if(isset($employer))
            {
                $job_offer = JobOffer::where('id', $id)->delete();
                return redirect('/employers')->with('msg-success','La Oferta se eliminó correctamente!!');
            }
            else
            {
                abort(403);
            }
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('msg-error','Se produjo un error al enviar los datos intentalo otra vez');
        }
    }

    public function postulations(Request $request,$slug)
    {
       
        if($request->isMethod('get'))
        {
            $job_offer = JobOffer::where('slug',$slug)->firstOrFail();

            $postulations = Postulation::with(['candidate.college_careers','candidate.curriculum_vitaes'])
                                        ->where('job_offer_id',$job_offer->id)
                                        ->orderBy('created_at','DESC')
                                        ->get();
            //dd($postulations);
            return view('web.employer.my_offers.postulations',compact('postulations','job_offer'));
        }
    }
    //cambiar estado de stado finalista
    public function finalistPostulation(Request $request,$job_offer_id,$candidate_id,$status)
    {
        $postulation = Postulation::where('job_offer_id',$job_offer_id)->where('candidate_id',$candidate_id)->firstOrFail();

        if($status!= 'Finalista'){
            $new_status = 'Visto';
        }else{
            $new_status = 'Finalista';
        }

        $postulation->status = $new_status;
        $postulation->save();

        return response()->json([
            'message' => 'estado actualizado correctamente',
        ],200);
    }
    //cambiar el stado de visto cv
    public function viewCvPostulation(Request $request,$job_offer_id,$candidate_id)
    {
        $postulation = Postulation::where('job_offer_id',$job_offer_id)->where('candidate_id',$candidate_id)->firstOrFail();

        if($postulation->status == 'Enviado')
        {
            $postulation->status = 'Visto';
            $postulation->save();
        }
        
        return response()->json([
            'message' => 'estado actualizado correctamente',
        ],200);
    }
}
