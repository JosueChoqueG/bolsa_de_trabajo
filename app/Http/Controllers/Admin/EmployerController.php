<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Employer;
use App\Model\Sector;
use App\Mail\ConfirmEmployerAcount;
use Mail;
use Session;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\EmployerCreateRequest; 
use App\Http\Requests\Admin\EmployerUpdateRequest; 

class EmployerController extends Controller
{
    public function index(Request $request)
    {
        $data['slc_search'] =  $request->slc_search;
        if(! empty($request->slc_search)){
            $data['parameter'] = $request->input($request->slc_search);
        }
        
        $employers = Employer::with(['sector'])
                                ->ruc($request->ruc)
                                ->name($request->name)
                                ->orderBy('status','ASC')
                                ->orderBy('created_at','DESC')
                                ->paginate(10); 
        $sectors = Sector::all();

        return view('admin.employer.index', compact( 'sectors','employers'))->with($data);
    }
  
    public function create(EmployerCreateRequest $request)
    {
        if ($request->ajax()) 
        {

            $password = Str::random(6);
            
            $data= array_merge($request->all(),['password'=>$password]);
            
            if($request->hasFile('logo')){

               $extension_logo = $request->file('logo')->getClientOriginalExtension();
               $name_logo      = $request->ruc.'_'.date('is').'.'.$extension_logo;
              
               $data = array_merge($data,['path_logo'=>$name_logo]);
           
               \Storage::disk('employer_logo')->put($name_logo,\File::get($request->File('logo')));
             }

            $employer = Employer::create($data);
          
            Mail::to($employer)->send(new ConfirmEmployerAcount($employer,$password));

            return response()->json([
                "message" => "Datos registrados correctamente!",
                "action" => "insercion"
            ],200);
        }
    }

    public function find(Request $request,$employer_id)
    {
        $employer = Employer::with('sector')->where('id',$employer_id)->firstOrFail();

        return response()->json([
            "data" => $employer
        ],200);
    }
     public function queryRuc(Request $request)
    {
        $this->validate($request, [
            'search_ruc'         => 'bail|required|min:11,max:11',   
        ]);
        try {
            $query = queryRuc($request->search_ruc);
            
            if($query['status']== 200){
                if($query['getBody'])
                {    
                    $data = [
                        'ruc'                   => $query['getBody']->ruc,
                        'razonSocial'           => $query['getBody']->razonSocial,
                        'direccion'             => $query['getBody']->direccion,
                        'nombreComercial'       => $query['getBody']->nombreComercial,
                        'actEconomicas'    => $query['getBody']->actEconomicas
                    ];
   
                    put_session_sunat($data);

                    return response()->json([
                        "message" => "conexion exitosa",
                        "data" => $data
                    ],200);
                }
            }
        } catch (\Exception $e) {
            abort(500,'error '.$e->getmessage());
        }
       
    }
    
    public function update(EmployerUpdateRequest $request,$id)
    {
        if ($request->ajax()) 
        {
            $employer = Employer::findOrFail($id);
         
            $data= $request->all();
            if($request->hasFile('logo')){

               $extension_logo = $request->file('logo')->getClientOriginalExtension();
               $name_logo      = $request->ruc.'_'.date('is').'.'.$extension_logo;
              
               $data = array_merge($data,['path_logo'=>$name_logo]);
    
               \Storage::disk('employer_logo')->put($name_logo,\File::get($request->File('logo')));
             }

            $employer->update($data);
            
            return response()->json([
                "message" => "Datos actualizados correctamente!",
                "action" => "update"
            ],200);

        }
    }

    public function delete(Request $request, $id)
    {
        
        $employer = Employer::findOrFail($id);
        if( $employer->status != 'Activo')
        {
            $employer->delete();
            return response()->json([
                'message'  => 'Datos eliminados correctamente',
                'action'   => 'delete'
            ]);
        }

        else
        {
            return response()->json([
                'message'  => 'No se puede eliminar a un empleador con estado activo',
                'action'   => 'not_delete'
            ]);

        }
        
    }
   
}
