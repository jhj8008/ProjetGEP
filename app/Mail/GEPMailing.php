<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GEPMailing extends Mailable
{
    use Queueable, SerializesModels;

    public $email_detail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email_detail)
    {
        $this->email_detail = $email_detail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //$message = $this->message;
        return $this->view('Auth\employe\admin\mail_page');
    }
}
