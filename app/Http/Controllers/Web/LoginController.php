<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Model\Employer;
use App\Model\User;
use App\Model\Candidate;
use App\Model\CollegeCareer;
use App\Model\CandidateCollege;
use App\Mail\RecoverPassword;
use App\Model\PasswordReset;
use App\Model\Sessions;
use Session;
use Mail;
use Illuminate\Support\Str;
use DB;
use Carbon\Carbon;


class LoginController extends Controller
{
    public function authenticateCandidate(Request $request)
    {
        addStartSessionCounter();
        if($request->ajax()){
            try
            {
                $status  = "error";
                $message = "Email y/o contraseña incorrecto";
                $route   = url('');

                $candidate = Candidate::where('email',$request->email)->first();
                
                if ($candidate && Hash::check(trim($request->password),$candidate->password)) 
                {
                    if($candidate->status == 1)
                    {
                        Session::put('document',$candidate->document);
                        Session::put('candidate_id',$candidate->id);
                        Session::put('name',$candidate->name);
                        Session::put('path_logo',$candidate->path_logo);
                        Session::put('user_type','candidate');

                        $status = "success";
                        $message = "Bienvedido(a) ".$candidate->name;
                        $route   = url('/jobOffers');

                        //insertamos un registro en la tabla sessions
                        Sessions::create([
                            'user_id' => $candidate->id,
                            'document' => $candidate->document,
                            'user_type' => 'candidate',
                            'created_at' => Carbon::now()
                        ]);

                    }else{
                        $status  = "error";
                        $message = "Su cuenta se encuentra inactiva";   
                    }
                }

                return response()->json([
                    "status"  => $status,
                    "message" => $message,
                    "route"   => $route
                ],200);
            }
            catch (Exception $e)
            {
                abort(500,'Se produjo un error al intentar verificar la cuenta');
            }
        }
    }
    public function authenticateEmployer(Request $request)
    {
       
        if($request->ajax()){
            try
            {
                $status  = "error";
                $message = "Email y/o contraseña incorrecto";
                $route   = url('');

                $employer = Employer::where('email',$request->email)->first();
                if ($employer && Hash::check(trim($request->password),$employer->password)) 
                {
                    if($employer->status == 'Activo')
                    {
                        Session::put('ruc',$employer->ruc);
                        Session::put('employer_id',$employer->id);
                        Session::put('name',$employer->name);
                        Session::put('path_logo',$employer->path_logo);
                        Session::put('user_type','employer');

                        $status = "success";
                        $message = "Bienvenido ".$employer->name;
                        $route   = url('/employers');
                        //registramos el inicio de session 

                        Sessions::create([
                            'user_id' => $employer->id,
                            'document' => $employer->ruc,
                            'user_type' => 'employer',
                            'created_at' => Carbon::now()
                        ]);

                    }else{
                        $status  = "error";
                        $message = "Su cuenta se encuentra inactiva";   
                    }
                }

                return response()->json([
                    "status"  => $status,
                    "message" => $message,
                    "route" => $route
                ],200);
            }
            catch (Exception $e)
            {
                abort(500,'Se produjo un error al intentar verificar la cuenta');
            }
        }
    }

    public function logout(Request $request)
    {
        Session::flush();//eliminamis todas las variables de sesión
        return redirect('/');  
    }

    //autentificacion para ver una oferta laboral (candidato)
    public function authenticateJobOffer(Request $request)
    {
        addStartSessionCounter();
        if ($request->ajax()) 
        {
           
            try
            {
                $candidate = Candidate::where('document',$request->document)->first();
            if ($candidate && Hash::check(trim($request->password),$candidate->password)) 
            {
                if($candidate->status == '1')
                {
                    Session::put('document',$candidate->document);
                    Session::put('candidate_id',$candidate->id);
                    Session::put('name',$candidate->name);
                    Session::put('user_type','candidate');

                    return response()->json([
                        "message" => "Bienvenido ".$candidate->name
                    ],200);
                }
                else
                {
                    abort(500,'No tiene perimiso para ingresar al sistema, contacte con el administrador');

                }
                
            }
            else
            {
                abort(500,'Los datos que ha ingresado son incorrectos');
            }
        }
        catch (\Exception $e)
        {
            abort(500,'Se produjo un error al enviar los datos intentalo otra vez ');
        }
        }
    }

    public function recoverPassword(Request $request,$user_type)
    {
        
        if($request->isMethod('get'))
        {
            if($user_type == 'candidate' || $user_type == 'employer' || $user_type == 'admin')
            {
                return view('web.login.recover_password')->with('user_type',$user_type);
            }
            else {
                abort(404);
            }           
        }

        try {
            $acount = null;
            $message = 'Hemos enviado un enlace de restablecimiento de contraseña a tu corrreo electrónico.';
            $status = 'success';

            switch ($user_type) {
                case 'candidate':
                    $acount = Candidate::where('email',$request->email)->where('status',1)->first();
                  
                    break;
                case 'employer':
                    $acount = Employer::where('email',$request->email)->where('status','Activo')->first();
                    break;
                case 'admin':
                    $acount = User::where('email',$request->email)->where('status',1)->first();
                    break;
            }

            if(is_null($acount)){
                $message = 'Correo electrónico incorrecto o bloqueado';
                $status = 'danger';
            }
            else
            {
                $token = $acount->id.'id'.Str::random(40);
                
                PasswordReset::where('email',$request->email)->where('user_type',$user_type)->delete();

                $password_reset            = new PasswordReset();
                $password_reset->email     = $acount->email;
                $password_reset->user_type = $user_type;
                $password_reset->token     = $token;
                $password_reset->save();
                
                Mail::to($acount)->send(new RecoverPassword($acount->name,$token));
            }

            return redirect()->back()->with(['message'=>$message,'status'=>$status]);

        } catch (\Exception $th) {
            
            return redirect()->back()->withInput()->with('msg-error','Ocurrio un error');
        }
    }

    public function resetPassword(Request $request,$token)
    {

        $password_reset = PasswordReset::where('token',$token)->first();

        if($request->isMethod('get'))
        {
            $password_reset = PasswordReset::where('token',$token)->first();
            
            if($password_reset)
            {
                return view('web.login.reset_password')->with('data',$password_reset);
            }
            else{
                return redirect('/')->with('msg-info','El enlace de restableciemiento ya no esta disponible.');
            }
        }

        try {
            
            DB::beginTransaction();
            
            if($password_reset)
            {
                switch ($password_reset->user_type) {
                    case 'candidate':
                        $candidate = Candidate::where('email',$password_reset->email)->first();
                        $candidate->password = $request->password;
                        $candidate->save();

                        $password_reset->delete();
                        DB::commit();
                            //iniciar sesion
                            Session::put('document',$candidate->document);
                            Session::put('candidate_id',$candidate->id);
                            Session::put('name',$candidate->name);
                            Session::put('path_logo',$candidate->path_logo);
                            Session::put('user_type','candidate');

                            return \redirect('/updateCandidate')->with('msg-success','Contraseña restablecida correctamente');

                        break;

                    case 'employer':
                        $employer = Employer::where('email',$password_reset->email)->first();
                        $employer->password = $request->password;
                        $employer->save();

                        $password_reset->delete();
                        DB::commit();
                            //iniciamos session
                            Session::put('ruc',$employer->ruc);
                            Session::put('employer_id',$employer->id);
                            Session::put('name',$employer->name);
                            Session::put('path_logo',$employer->path_logo);
                            Session::put('user_type','employer');

                            return \redirect('/updateEmployer')->with('msg-success','Contraseña restablecida correctamente');

                        break;

                    case 'admin':
                        $user    = User::where('email',$password_reset->email)->first();
                        $user->password = $request->password;
                        $user->save();

                        $password_reset->delete();
                        DB::commit();
                        //iniciamos sesion
                            Session::put('user_name',$user->name);
                            Session::put('user_id',$user->id);
                            Session::put('role_id',$user->role->id);
                            Session::put('role_name',$user->role->name);
            
                            return redirect('/panel')->with('msg-success','Bienvenido(a) '.$user->name);
                        break;
                }
            }
            else{
                return redirect('/')->with('msg-info','El enlace de restableciemiento ya no esta disponible.');
            }
            
        } catch (\Exception $th) 
        {
            DB::rollback();
            return redirect()->back()->withInput()->with('msg-warning','Ocurrio un error');
        }

    }

    public function changePassword(Request $request)
    {
        if($request->isMethod('get'))
        {
            return view('web.login.change_password');
        }

        $this->validate($request, [  
            'current_password' => 'required',  
            'password'        => 'bail|required|max:50',
            'repeat_password' => 'bail|required|same:password',
        ],['repeat_password.same'=>'Las contraseñas nueva y repita nueva  no coinciden.']);

        if( Session::has('user_type') && Session::get('user_type')=='employer')
            $acount = Employer::find(Session::get('employer_id'));
        elseif(Session::has('user_type') && Session::get('user_type')=='candidate'){
            $acount = Candidate::find(Session::get('candidate_id'));
        }

        if ($acount && \Hash::check(trim($request->current_password),$acount->password)) 
        {
            $acount->password = $request->password;
            $acount->save();

            return redirect()->back()->with('msg-success','Su contraseña ha sido actualizada.');
        }

        return redirect()->back()->with('msg-error','Contraseña actual incorrecta');
    }
}
