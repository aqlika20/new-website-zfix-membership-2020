<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendVoucherCreateMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $name, $type, $voucher_key;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $type, $voucher_key)
    {
        $this->name = $name;
        $this->type = $type;
        $this->voucher_key = $voucher_key;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Voucher Dari ZFix')->view('layout.api.mail.email_voucher_create');
    }
}
