<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Model\Candidate;
use App\Model\JobOffer;

class NewJobOffer extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $candidate;
    protected $job_offer;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Candidate $candidate,JobOffer $job_offer)
    {
        $this->candidate = $candidate;
        $this->job_offer = $job_offer;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.new_job_offer',['candidate'=>$this->candidate,'job_offer'=>$this->job_offer,'url'=> url('/jobOffers')])->subject($this->job_offer->title);
    }
}
