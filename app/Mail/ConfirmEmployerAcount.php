<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Model\Employer;

// class ConfirmEmployerAcount extends Mailable  implements ShouldQueue
class ConfirmEmployerAcount extends Mailable
{
    use Queueable, SerializesModels;

    protected $employer;    
    protected $password;  
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Employer $employer,$password)
    {
        $this->employer = $employer;
        $this->password = $password;
    }


    public function build()
    {
        return $this->markdown('emails.confirm_employer_acount',['employer'=>$this->employer,'url'=>url(''),'password'=>$this->password])->subject('Confirmacion de cuenta Bolsa de trabajo Unamba');
    }
}
