<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Candidate;
use App\Model\CollegeCareer;
use App\Model\CandidateCollege;
use DB;
use App\Mail\ConfirmCandidateAcount;
use App\Imports\CandidateImport;
use Mail;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\CandidateCreateRequest; 
use App\Http\Requests\Admin\CandidateUpdateRequest; 

class CandidateController extends Controller
{
    public function index(Request $request)
    {
       //capturar datos del filtro
        $data['slc_search'] =  $request->slc_search;
        if(! empty($request->slc_search)){
            $data['parameter'] = $request->input($request->slc_search);
        }
      
        $candidates = Candidate::with('college_careers')
                                ->document($request->document)
                                ->name($request->name)
                                ->lastname($request->lastname)
                                ->orderBy('status','DESC')
                                ->orderBy('name','ASC')
                                ->paginate(15); 
                      
        $colleges = CollegeCareer::all();
     
        return view('admin.candidate.index', compact( 'candidates','colleges'))->with($data);
    }
  
    public function create(CandidateCreateRequest $request)
    {
        if ($request->ajax()) 
        {
            try 
            {
                DB::beginTransaction();
            
                $data = $request->all();
               
                if($request->hasFile('photo'))
                {
                    $extension_photo = $request->file('photo')->getClientOriginalExtension();
                    $name_photo      = $request->document.'_'.date('is').'.'.$extension_photo;
                    
                    $data = array_merge($data,['path_photo'=>$name_photo]);
                
                    \Storage::disk('candidate_photo')->put($name_photo,\File::get($request->File('photo')));
                }

                $candidate = Candidate::create($data);
                 //insertamos las escuelas
                    //eliminamos las escuelas duplicadas
                    $list_colleges = array_values(array_unique($request->item_carrera_id));

                   for ($i=0; $i < count( $list_colleges )-1 ; $i++) { 

                        $candidateCollege = new CandidateCollege();
                        $candidateCollege->candidate_id       = $candidate->id;
                        $candidateCollege->college_id         = $list_colleges[$i];
                        $candidateCollege->code               = $request->item_codigo[$i];
                        // $candidateCollege->admission_date     = $request->item_ingreso[$i];
                        // $candidateCollege->egress_date        = $request->item_egreso[$i];
                       // $candidateCollege->academic_situation = $request->item_situacion[$i];
                        $candidateCollege->save();
                   }   

                DB::commit();
                
                return response()->json([
                    "message" => "Datos registrados correctamente!",
                    "action" => "insercion"
                ],200);

            } catch (\Exception $e) {
                DB::rollback();
                abort(500,'Ocurrio un error al inetentar guardar el registro ');
            }
        }

    }

    public function find(Request $request,$candidate_id)
    {
        $candidate = Candidate::with('college_careers')->where('id',$candidate_id)->firstOrFail();

        return response()->json([
            "data" => $candidate
        ],200);
    }
  
    public function update(Request $request,$id)
    {
        if ($request->ajax()) 
        {  
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
                //actualizamos las escuelas
                    //eliminamos las escuelas duplicadas
                    $list_colleges = array_values(array_unique($request->item_carrera_id));
                 
                    //eliminamos los registro de la tabla intermedia
                    CandidateCollege::where('candidate_id',$id)->delete();

                   for ($i=0; $i < count( $list_colleges ) ; $i++) { 

                        $candidateCollege = new CandidateCollege();
                        $candidateCollege->candidate_id       = $id;
                        $candidateCollege->college_id         = $list_colleges[$i];
                        $candidateCollege->code               = $request->item_codigo[$i];
                        // $candidateCollege->admission_date     = $request->item_ingreso[$i];
                        // $candidateCollege->egress_date        = $request->item_egreso[$i];
                       // $candidateCollege->academic_situation = $request->item_situacion[$i];
                        $candidateCollege->save();
                   }     

                DB::commit();

                return response()->json([
                    "message" => "Datos actualizados correctamente!",
                    "action" => "update"
                ],200);

            } catch (Exception $e) {
                
                DB::rollback();
                
                abort(500,'Ocurrio un error en el servidor ');
            }
        }
    }

    public function delete(Request $request, $id)
    {
        
        $candidate = Candidate::findOrFail($id);
        $candidate_college = CandidateCollege::where('candidate_id',$candidate->id)->get();

        if(count($candidate_college) <= 0)
        {
            $candidate->delete();
            return response()->json([
                'message'  => 'Datos eliminados correctamente',
                'action'   => 'delete'
            ]);
        }

        else
        {
            return response()->json([
                'message'  => 'No se puede eliminar al candidato que posee una escuela',
                'action'   => 'not_delete'
            ]);

        }
        
    }
}
