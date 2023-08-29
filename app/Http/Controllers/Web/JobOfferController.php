<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Employer;
use App\Model\Geolocation;
use App\Model\JobOffer;
use App\Model\Countrie;
use App\Model\OfferCollege;
use App\Model\Area;
use App\Model\CollegeCareer;
use App\Model\Candidate;
use Carbon\Carbon;
use Session;
use DB;
use Illuminate\Database\Eloquent\Builder;

class JobOfferController extends Controller
{
    public function index(Request $request)
    {   
        $filter = null;
        $filter = $request->input();

        try {
            $job_offers  = JobOffer::with(['college_careers','area','countrie','geolocation','employer'])
                                    ->withCount(['postulations'])
                                    ->title($request->title)
                                    ->whereHas('college_careers',function($query) use ($request){
                                        if(! empty($request->college_id)){
                                            $query->whereIn('offer_college.college_id',$request->college_id);
                                        }
                                    })
                                    ->geolocations($request->location_id)
                                    ->areas($request->area_id)
                                    ->countries($request->countrie_id)
                                    ->workday($request->workday)
                                    ->category($request->category)
                                    ->where('status','!=','1')
                                    ->orderBy('status','asc') 
                                    ->order($request->order) 
                                    ->paginate(10);
                   
            $colleges   = CollegeCareer::select(DB::raw('count(*) as job_offers_count, college_career.name,college_career.id'))
                                            ->join('offer_college','college_career.id','=','offer_college.college_id')
                                            ->join('job_offer','offer_college.job_offer_id','=','job_offer.id')
                                            ->where('job_offer.status',2)
                                            ->groupBy('offer_college.college_id')
                                            ->where('visibility',1)
                                            ->get();
                                   
            $areas      = Area::whereHas('job_offers', function($q){
                                            $q->where('status', 2);
                                        })->withCount('job_offers')->get();

            $locations  = Geolocation::whereHas('job_offers', function($q){
                                            $q->where('status', 2);
                                        })->withCount('job_offers')->get();

            $countries  = Countrie::whereHas('job_offers', function($q){
                                        $q->where('status', 2);
                                    })->withCount('job_offers')->get();                            

            return view('web.job_offer.index', compact('job_offers','colleges','areas','locations','countries'))->with($filter); 

        } catch (\Exception $th) 
        {
            //dd
           //return redirect('jobOffers');
        }
    }
    //verifica si se ha iniciado session
    public function find(Request $request,$slug)
    {
        if ($request->ajax()) 
        {
            $action = 'error';
            if( Session::has('candidate_id'))
                $action = 'show';
            
            return response()->json([
                "action" => $action,
                "slug"     => $slug
            ],200);
        }
    }


    public function show(Request $request,$slug)
    {
        
            $job_offer  = JobOffer::with(['college_careers','area','countrie','geolocation','employer'])
                                    ->withCount(['postulations'])
                                    ->where('slug',$slug)
                                    ->firstOrFail();
            //actualizar contador de vistas
            $job_offer->view_counter = $job_offer->view_counter + 1;
            $job_offer->save();     
            //fin contador de vistas

            // $related_jobs       = JobOffer::with(['college_careers','area','countrie','geolocation','employer'])
            //                         ->withCount(['postulations'])
            //                         ->where('id','!=',$job_offer->id)
            //                         ->where('status',2)
            //                         ->where('title', 'like', '%'.$job_offer->title.'%')
            //                         ->get();       

            $candidate = Candidate::with(['curriculum_vitaes'=> function ($query) {
                $query->orderBy('created_at','desc');
            }])->where('id',Session::get('candidate_id'))->first();

            return view('web.job_offer.show', compact('job_offer','candidate')); 
      
    }

}
