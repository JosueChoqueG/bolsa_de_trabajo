<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\JobOffer;
use App\Model\Publication;
use App\Model\Employer;
use App\Model\Candidate;
use App\Model\SystemParameter;
use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{
    public function index()
    {   
        
        //agregamos el contador en uno
        addVisitsCounter();
        //fin contador
        $data['job_offers']        =  JobOffer::with(['college_careers','area','countrie','geolocation','employer'])
                                        ->where('status',2)
                                        ->orderBy('publication_date','desc')
                                        ->limit(4)->get();
        
        $data['events']            = Publication::where('type','Evento')->where('status',1)->orderBy('created_at', 'desc')->limit(4)->get();
        $data['articles_interest'] = Publication::where('type','Artículo de Interés')->where('status',1)->orderBy('created_at', 'desc')->limit(4)->get();
        $data['orientation']       = Publication::where('type','Orientación')->where('status',1)->orderBy('created_at', 'desc')->limit(4)->get();
        $data['count_job_offer']   = JobOffer::where('status',2)->orwhere('status',3)->count();
        $data['count_employer']    = Employer::where('status','Activo')->count();
        $data['count_candidate']   = Candidate::where('status',1)->count();

        return view('web.home.index',$data); 
    }

    public function institution()
    {
        return view('web.home.institution');
    }

}
