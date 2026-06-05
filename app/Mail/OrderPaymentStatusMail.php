<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

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

    public function attachments(): array
    {
        // Try to generate a PDF receipt when dompdf is available.
        try {
            if (class_exists(\Barryvdh\DomPDF\Facade\Pdf::class)) {
                $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('emails.order-payment-receipt-pdf', [
                    'order' => $this->order,
                    'paymentStatus' => $this->paymentStatus,
                ])->setPaper('a4', 'portrait');

                return [
                    [
                        'data' => $pdf->output(),
                        'name' => 'receipt-' . $this->order->order_number . '.pdf',
                        'options' => [
                            'mime' => 'application/pdf',
                        ],
                    ],
                ];
            }
        } catch (\Throwable $e) {
            Log::error('Failed to generate PDF receipt: ' . $e->getMessage(), ['order' => $this->order->order_number]);
        }

        return [];
    }
}
