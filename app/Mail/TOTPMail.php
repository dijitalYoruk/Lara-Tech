<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TOTPMail extends Mailable
{
    use Queueable, SerializesModels;

    public $TOTP;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($TOTP) {
        $this->TOTP =$TOTP;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->markdown('mail/TOTP');
    }
}
