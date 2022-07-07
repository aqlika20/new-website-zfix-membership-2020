<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendRejectedMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $reason;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$reason)
    {
        $this->name = $name;
        $this->reason = $reason;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Informasi Pengajuan')->view('layout.back_web.mail.email_rejected');
    }
}
