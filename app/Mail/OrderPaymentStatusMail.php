<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderPaymentStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Order $order,
        public string $paymentStatus
    ) {
        $this->order->loadMissing('items.product');
    }

    public function envelope(): Envelope
    {
        $label = $this->paymentStatus === 'success' ? 'Payment Successful' : 'Payment Failed';

        return new Envelope(
            subject: $label . ' - Order ' . $this->order->order_number,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.order-payment-status',
        );
    }
}
