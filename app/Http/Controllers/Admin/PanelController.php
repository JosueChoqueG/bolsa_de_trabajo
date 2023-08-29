<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Candidate;
use App\Model\CollegeCareer;
use App\Model\Employer;
use App\Model\Sector;
use App\Model\JobOffer;
use Session;
use Carbon\Carbon;
use App\Model\Sessions;

class PanelController extends Controller
{
    public function index()
    {
        if(Session::has('user_id')){
            $data['count_job_offer']            = JobOffer::count();
            $data['count_job_offer_publish']    = JobOffer::where('status',2)->count();
            $data['count_job_offer_revision']   = JobOffer::where('status',1)->count();
            $data['count_job_offer_closed']     = JobOffer::where('status',3)->count();
            $data['count_employer']             = Employer::count();
            $data['count_employer_active']      = Employer::where('status','Activo')->count();
            $data['count_employer_revision']    = Employer::where('status','En Revisión')->count();
            $data['count_employer_inactive']    = Employer::where('status','Inactivo')->count();
            $data['count_candidate']            = Candidate::where('status',1)->count();
            $data['colleges']                   = CollegeCareer::withCount(['candidates as count_femenino'=> function ($query) {
                $query->where('status', 1)->where('gender', 'F');
            }])->withCount(['candidates as count_masculino'=> function ($query) {
                $query->where('status', 1)->where('gender', 'M');
            }])->withCount(['job_offers as count_jobOffer'])->where('visibility',1)->get();
            
            return view('admin.panel.index',$data);
        }

        return view('admin.login');
    }

    public function authentication(Request $request)
    {
        if($request->isMethod('get'))
        {
            return redirect('/panel');
        }
        else
        {
            $user = User::where('email',$request->email)->where('status',1)->first();

            if ($user && \Hash::check(trim($request->password),$user->password)) 
            {
                Session::put('user_name',$user->name);
                Session::put('user_id',$user->id);
                Session::put('role_id',$user->role->id);
                Session::put('role_name',$user->role->name);
                //registramos el inicio de session
                Sessions::create([
                    'user_id' => $user->id,
                    'document' => $user->id,
                    'user_type' => 'admin',
                    'created' => Carbon::now()
                ]);

                return redirect('/admin/internalJobOffers')->with('msg-info','Bienvenido(a) '.$user->name);
            }

            return redirect('panel')->with('msg-error','Usuario y/o contraseña incorrectos');
        }
    }

    public function logout(Request $request)
    {
        Session::flush();
        return redirect('/panel');  
    }

    public function changePassword(Request $request)
    {
        if($request->isMethod('get'))
        {
            return view('admin.panel.change_password');
        }

        $this->validate($request, [  
            'current_password' => 'required',  
            'password'        => 'bail|required|max:50',
            'repeat_password' => 'bail|required|same:password',
        ],['repeat_password.same'=>'Las contraseñas nueva y repita nueva  no coinciden.']);

        $user = User::find(Session::get('user_id'));
        if ($user && \Hash::check(trim($request->current_password),$user->password)) 
        {
          
            $user->password = $request->password;
            $user->save();

            return redirect()->back()->with('msg-success','Su contraseña ha sido actualizada.');
        }

        return redirect()->back()->with('msg-error','Contraseña actual incorrecta');

    }
    public function loginNumber()
    {
        $candidates = Candidate::join('sessions','candidate.id','sessions.user_id')->withCount('sessions')->with('college_careers')->groupBy('sessions.user_id')->where('candidate.status',1)->get();
        return view('admin.panel.loginNumber', compact('candidates')); 
    }
}
