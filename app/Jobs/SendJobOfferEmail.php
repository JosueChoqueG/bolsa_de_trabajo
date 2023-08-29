<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Model\Candidate;
use App\Model\JobOffer;

class SendJobOfferEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $jobOffers = JobOffer::with('college_careers')->whereDate('updated_date',date('Y-m-d'))->get();
        
        foreach ($jobOffers as $key => $jobOffer) 
        { 
            $array_colleges = [];//array con las carreras del empleo
           
            $colleges=$job_offers[3]->college_careers;
            
            foreach ($colleges as $key => $college) {
                $array_colleges[$key] = $college->id; 
            }

            $candidates = Candidate::whereHas('college_careers', function (Builder $query)use($array_colleges) {
                                            $query->whereIn('college_id',$array_colleges);
                                        })->where('status',1)->get();  
            // enviamos el email a cada candidato                             
            foreach ($candidates as $key => $candidate) {
                Mail::to($candidate)->send(new NewJobOffer($candidate,$jobOffer));
            }  
        }
    }
}
