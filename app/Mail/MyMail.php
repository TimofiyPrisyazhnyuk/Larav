<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MyMail extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * @var
     */
    public $name;
    public $subject;
    public $mess;

    /**
     * MyMail constructor.
     * @param $request
     */
    public function __construct($request)
    {
        $this->name = $request->name;
        $this->subject = $request->subject;
        $this->mess = $request->mess;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('myApp@laravel56.dev')
            ->view('email.mymail')
            ->subject('New message:');
    }
}
