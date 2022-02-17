<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCompleteMail extends Mailable {
    use Queueable, SerializesModels;

    public $appInfo;
    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($appInfo, $order) {
        $this->order   = $order;
        $this->appInfo = $appInfo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->markdown('admin.orders.order_invoice')
            ->subject('Order Complete')
            ->from("bhorerkagoj@mail.com", "Bhorer Kagoj Prokashan")
            ->with('appInfo', $this->appInfo)
            ->with('order', $this->order);
    }
}
