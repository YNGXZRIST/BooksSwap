<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendAuthCode extends Mailable
{
    use Queueable, SerializesModels;


    protected $code;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($code)
    {
        $this->code=$code;
        $this->markdown('mail.register_code');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): SendAuthCode
    {
        $code=$this->code;
        return $this->view('mail.register_code')->subject("Подтверждение регистрации")->with(compact('code'));
    }
}
