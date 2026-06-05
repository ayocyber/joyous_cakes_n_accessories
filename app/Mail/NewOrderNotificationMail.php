<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use App\Models\Customer;

class NewOrderNotificationMail extends Mailable
{
    use SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct( public Order $order,
    public Customer $customer)
    {
        //
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this
            ->subject('New Order Received - ' . $this->order->order_number)
            ->view('emails.orders.new-order');
    }

}
