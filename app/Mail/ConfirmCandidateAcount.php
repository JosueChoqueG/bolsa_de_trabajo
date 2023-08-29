<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Model\Candidate;

// class ConfirmCandidateAcount extends Mailable  implements ShouldQueue
class ConfirmCandidateAcount extends Mailable  
{
    use Queueable, SerializesModels;

    protected $candidate;
    protected $password;  
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Candidate $candidate,$password)
    {
        $this->candidate = $candidate;
        $this->password  = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.confirm_candidate_acount',['candidate'=>$this->candidate,'url'=>url(''),'password'=>$this->password])->subject('Confirmacion de cuenta Bolsa de trabajo Unamba');

    }
}
