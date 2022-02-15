<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCompleteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $maildata;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($maildata)
    {
           $this->maildata = $maildata;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.OrderCompleteMail')
        ->subject('Order Complete')
        ->from("bhorerkagoj@mail.com", "Bhorer Kagoj Prokashan")
        ->attach($this->maildata['file'], [
            'mime' => 'application/pdf',
        ]);
    }
}
