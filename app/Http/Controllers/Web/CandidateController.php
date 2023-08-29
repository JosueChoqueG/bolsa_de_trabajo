<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Candidate;
use App\Model\CurriculumVitae;
use App\Model\Postulation;
use App\Model\JobOffer;
use App\Mail\ConfirmCandidateAcount;
use Mail;
use DB;
use Session;
use Illuminate\Support\Str;
use App\Model\CollegeCareer;

class CandidateController extends Controller
{
    public function index(Request $request)
    {
        
    }

    //registro de estudiantes, graduados
    public function register(Request $request)
    {
        if ($request->ajax()) 
        {  
            $this->validate($request, [    
                'document'        => 'bail|required|digits:8|unique:candidate,document,'.$request->id.',id',
                'email'           => 'bail|required|email|max:50|unique:candidate,email,'.$request->id.',id'
            ]);

            try {
                DB::beginTransaction();

                $candidate = Candidate::findOrFail($request->id);
         
                $password  = Str::random(6);   
                $data      = array_merge($request->all(),['password'=>$password]);
                $candidate->update($data);
                
                $candidate = Candidate::find($request->id);
            
                Mail::to($candidate)->send(new ConfirmCandidateAcount($candidate,$password));

                DB::commit();

                return response()->json([
                    "message" => "Datos registrados correctamente!",
                    "action" => "update"
                ],200);

            } catch (\Exception $e) {
                
                DB::rollback();
                
                abort(500,'Ocurrio un error en el servidor ');
            }
        }

        return view('web.login.register_candidate');

    }

    public function update(Request $request)
    {
        $id= Session::get('candidate_id');
      
        if ($request->ajax()) 
        {  
            $this->validate($request, [    
                'document'        => 'bail|required|digits:8|unique:candidate,document,'.$id.',id',
                'name'            => 'bail|required:max:50',
                'first_lastname'  => 'bail|required:max:50',
                'second_lastname' => 'bail|required|max:50',
                'gender'          => 'bail|in:M,F',
                'birthdate'       => 'bail|required|date',
                'civil_status'    => 'bail|in:Soltero(a),Casado(a),Conviviente,Divorciado(a),Viudo(a)',
                'email'           => 'bail|required|email|max:50|unique:candidate,email,'.$id.',id',
                'disability'      => 'bail|in:Ninguno,Para ver,Para oír,Para hablar,Para usar extremidades,Otros',
                'status'          => 'bail|in:1,0',
                'photo'           => 'bail|sometimes|nullable|image|mimes:jpeg,png|max:1000',
                'first_phone'     => 'bail|required:max:15',
                'second_phone'    => 'bail|sometimes|nullable|max:15',
            ]);
            
            try {
                DB::beginTransaction();

                $candidate = Candidate::findOrFail($id);
         
                $data= $request->all();
                if($request->hasFile('photo')){

                $extension_photo = $request->file('photo')->getClientOriginalExtension();
                $name_photo      = $request->document.'_'.date('is').'.'.$extension_photo;
                
                $data = array_merge($data,['path_photo'=>$name_photo]);
        
                \Storage::disk('candidate_photo')->put($name_photo,\File::get($request->File('photo')));
                }

                $candidate->update($data);
                   
                DB::commit();
                return response()->json([
                    "message" => "Datos actualizados correctamente!",
                    "action" => "update"
                ],200);

            } catch (\Exception $e) {
                
                DB::rollback();
                
                abort(500,'Ocurrio un error en el servidor ');
            }
        }
        $colleges = CollegeCareer::all();
        return view('web.candidate.update',compact('colleges'));
    }

    public function confirmAcount(Request $request,$document)
    {
        $candidate = Candidate::where('document',$document)->whereNull('activity_date')->first();
        if($candidate)
        {
            $candidate->activity_date = date('Y-m-d');
            $candidate->status = 1;
            $candidate->save();
           
            //aqui debenos iniciar session
            Session::put('document',$candidate->document);
            Session::put('candidate_id',$candidate->id);
            Session::put('name',$candidate->name);
            Session::put('path_logo',$candidate->path_logo);
            Session::put('user_type','candidate');
            return redirect('/')->with('msg-success','Cuenta confirmada');
        }
        return redirect('/')->with('msg-info','El enlace de confirmación ya no esta disponible');
    }

    public function find(Request $request,$document)
    {
        $candidate = Candidate::with('college_careers')
                                ->where('document',$document)
                                ->first();

        return response()->json([
            'data' => $candidate,
        ],200);
    }

    public function curriculum(Request $request)
    {

        $candidate = Candidate::with(['curriculum_vitaes'=> function ($query) {
            $query->orderBy('created_at','desc');
        }])->where('id',Session::get('candidate_id'))->first();
       
        return view('web.candidate.curriculum',compact('candidate'));
    }

    public function curriculumCreate(Request $request)
    {
        $this->validate($request,[
        'archive'   => 'bail|required|max:200',
        'name'      => 'bail|required|max:200'
        ]);
        try
        {
            // if($request->hasFile('archive')){
            //     $name              = $request->file('archive')->getClientOriginalName();
            //     $extension_archive = $request->file('archive')->getClientOriginalExtension();
            //     $name_archive      = Session::get('document').'_'.date('is').'.'.$extension_archive;
            //     $data = ['path'=>$name_archive];
            
            //     \Storage::disk('curriculum')->put($name_archive,\File::get($request->File('archive')));
            // }
            $curriculum                 = new CurriculumVitae();
            $curriculum->candidate_id   = Session::get('candidate_id');
            $curriculum->status         = 0;
            $curriculum->name           = $request->name;
            // $curriculum->path           = $data['path'];
            $curriculum->path           = $request->archive;
            $curriculum->save();

            return redirect('/candidate/curriculum')->with('msg-success','Su curriculum se guardo correctamente!!');

        }
        catch (\Exception $e)
        {
            Session::flash('msg-error', ' Se produjo un error al enviar los datos intentalo otra vez');
            return redirect()->back()->withInput();
        } 
    }

    public function curriculumUpdate(Request $request,$id)
    {
        try
        {
            $candidate = Candidate::with('curriculum_vitaes')->where('id',Session::get('candidate_id'))->first();
            foreach ($candidate->curriculum_vitaes as $curriculum_vitae) 
            {
                $curriculum = CurriculumVitae::findOrFail($curriculum_vitae->id);
                $curriculum->status = '0';
                $curriculum->save();
                
            }

            $cv             = CurriculumVitae::findOrFail($id);
            $cv->status     = 1;
            $cv->save();


            return response()->json([
                'action'   => 'update',
                'message'  => 'Curriculum por defecto, modificado correctamente!!',
            ]);

        }

        catch (\Exception $e)
        {
            abort(500,'Se produjo un error al enviar los datos intentalo otra vez');
        }

        
    }

    public function curriculumDelete($id)
    {
        try
        {
            $cv = CurriculumVitae::where('id', $id)->where('status',0)->first();
            
            if($cv != null)
            {
                $curriculum = CurriculumVitae::where('id', $id)->delete();
                return response()->json([
                    'action'   => 'delete',
                    'message'  => 'Su curriculum se elminó correctamente!!',
                    'id'       => $id
                ]);
            }
            else
            {
                return response()->json([
                    'action'   => 'no_delete',
                    'message'  => 'No puede eliminar este curriculum, ya que se encuentra marcado como: CV para enviar',
                ]);
            }

            
        }
        catch (\Exception $e)
        {
            abort(500,'Se produjo un error al enviar los datos intentalo otra vez');
        }
    }

    public function postulation()
    {
        $postulations = Postulation::with('job_offer.employer')
                                    ->where('candidate_id',Session('candidate_id'))
                                    ->orderBy('created_at','desc')
                                    ->paginate(10);
                                    
        return view('web.candidate.postulation',compact('postulations'));

    }
    public function postulationSearch(Request $request, $id)
    {
        $postulations = Postulation::where('job_offer_id',$id)->where('candidate_id',Session::get('candidate_id'))->first();
        if($postulations)
        {
            return response()->json([
                'action'   => 'exists',
                'message'  => 'Usted ya postuló a esta oferta laboral, consulte en sus postulaciones',
            ]);
        }
        else
        {
            return response()->json([
                'action'   => 'not_exists'
            ]);
        }
    }

    public function postulationCreate(Request $request, $id)
    {
        $this->validate($request,[
            'curriculum_id'  => 'bail|required|exists:curriculum_vitae,id'
            ]);
        try
        { 
            $postulation                = new Postulation();
            $postulation->job_offer_id  = $id;
            $postulation->candidate_id  = Session::get('candidate_id');
            $postulation->curriculum_id = $request->curriculum_id;
            $postulation->status        = 'Enviado';
            $postulation->save();

            $job_offer = JobOffer::where('id',$id)->first();

            return response()->json([
                "message" => "Usted ha postulado a la oferta laboral: ".$job_offer->title,
                "action" => "insercion"
            ],200);

        }

        catch (\Exception $e)
        {
            abort(500,'Ocurrio un error');
        }
    }

    public function postulationDelete($id)
    {
        try
        {
            $postulation = Postulation::where('id', $id)->where('status','visto')->orWhere('status','Finalista')->first();
            
            if($postulation == null)
            {
                $postulation = Postulation::where('id', $id)->delete();
                return response()->json([
                    'action'   => 'delete',
                    'message'  => 'Su postulación se eliminó correctamente!!',
                    'id'       => $id
                ]);
            }
            else
            {
                return response()->json([
                    'action'   => 'no_delete',
                    'message'  => 'No puede eliminar su postulación ya que se encuentra en estado Visto o finalista',
                ]);
            }

            
        }
        catch (\Exception $e)
        {
            abort(500,'Se produjo un error al enviar los datos intentalo otra vez');
        }
    }
    
    
}