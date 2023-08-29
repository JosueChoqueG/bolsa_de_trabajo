<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RecoverPassword extends Mailable
{
    use Queueable, SerializesModels;
    protected $acount;
    protected $token;  
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$token)
    {
        $this->name = $name;
        $this->token  = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.recover_password',['name'=>$this->name,'url'=>url('resetPassword/'.$this->token)])->subject('Restablecer contraseña');
    }
}
