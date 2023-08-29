<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Sector;
use App\Model\Employer;
use App\Mail\ConfirmEmployerAcount;
use Mail;
use Session;
use Illuminate\Support\Str;

class EmployerController extends Controller
{
    public function create(Request $request)
    {
        if ($request->ajax()) 
        {
            if( ! Session::has('temp_ruc') || Session::get('temp_ruc') != $request->ruc ){
                abort(500,'No se pudo verificar los datos del contribuyente');
            }   
            $this->validate($request, [    
                'ruc'                 => 'bail|required|digits:11|unique:employer,ruc',
                'name'                => 'bail|required:max:100',
                'tradename'           => 'bail|required:max:100',
                'address'             => 'bail|required|max:300',
                'economic_activity'   => 'bail|required',
                'email'               => 'bail|required|email|max:50|unique:employer,email',
                'sector_id'           => 'required|exists:sector,id',
                'description'         => 'bail|required|max:300',
                'logo'                => 'bail|sometimes|nullable|image|mimes:jpeg,png|max:1000',
                'web_page'            => 'bail|sometimes|nullable|max:200',
                'contact_name'        => 'bail|required:max:50',
                'contact_lastname'    => 'bail|required:max:50',
                'contact_role'        => 'bail|required:max:100',
                'contact_first_phone' => 'bail|required:max:15',
                'contact_second_phone' => 'bail|sometimes|nullable|max:15',
            ]);
           
            $password = Str::random(6);
            
            $data= array_merge($request->all(),['password'=>$password]);
            $data['name']      = Session::get('temp_razon_social');
            $data['tradename'] = Session::get('temp_nombre_comercial');  
            $economic_activity = Session::get('temp_act_economicas');  
            forget_session_sunat();
            if($request->hasFile('logo')){

               $extension_logo = $request->file('logo')->getClientOriginalExtension();
               $name_logo      = $request->ruc.'_'.date('is').'.'.$extension_logo;
              
               $data = array_merge($data,['path_logo'=>$name_logo]);
           
               \Storage::disk('employer_logo')->put($name_logo,\File::get($request->File('logo')));
             }

            $employer = Employer::create($data);
          
            Mail::to($employer)->send(new ConfirmEmployerAcount($employer,$password));

            return response()->json([
                "message" => "Datos registrados correctamente!, Su contraseña sera enviada a su email en unos instantes",
                "action" => "insercion"
            ],200);
        }

        $sectors = Sector::all();
        
        return view('web.login.register_employer',compact('sectors'));
    } 
    
    public function update(Request $request)
    {
        $id = Session::get('employer_id');
        if ($request->ajax()) 
        {
            $this->validate($request, [    
                // 'ruc'                 => 'bail|required|digits:11|unique:employer,ruc,'.$id.',id',
                // 'name'                => 'bail|required:max:100',
                // 'tradename'           => 'bail|required:max:100',
                'address'             => 'bail|required|max:300',
                'email'               => 'bail|required|email|max:50|unique:employer,email,'.$id.',id',
                'sector_id'           => 'required|exists:sector,id',
                'description'         => 'bail|required|max:500',
                'logo'                => 'bail|sometimes|nullable|image|mimes:jpeg,png|max:1000',
                'web_page'            => 'bail|sometimes|nullable|max:200',
                'contact_name'        => 'bail|required:max:50',
                'contact_lastname'    => 'bail|required:max:50',
                'contact_role'        => 'bail|required:max:100',
                'contact_first_phone' => 'bail|required:max:30',
                'contact_second_phone' => 'bail|sometimes|nullable|max:30',
            ]);
            $employer = Employer::findOrFail($id);
         
            $data= $request->all();
            if($request->hasFile('logo')){

               $extension_logo = $request->file('logo')->getClientOriginalExtension();
               $name_logo      = $employer->ruc.'_'.date('is').'.'.$extension_logo;
              
               $data = array_merge($data,['path_logo'=>$name_logo]);
    
               \Storage::disk('employer_logo')->put($name_logo,\File::get($request->File('logo')));
             }

            $employer->update($data);
            
            return response()->json([
                "message" => "Datos actualizados correctamente!",
                "action" => "update"
            ],200);

        }
        $sectors = Sector::all();
        
        return view('web.employer.update',compact('sectors'));
    }

}
