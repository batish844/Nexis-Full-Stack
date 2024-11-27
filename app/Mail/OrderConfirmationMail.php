<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order; // The Order model instance
    public $user;  // The User model instance, or null for guests

    /**
     * Create a new message instance.
     *
     * @param $order
     * @param $user
     */
    public function __construct($order, $user = null)
    {
        $this->order = $order;
        $this->user = $user;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Your Order Confirmation')
                    ->view('emails.order_confirmation');
    }
}
