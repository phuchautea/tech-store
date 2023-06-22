<?php

namespace App\Mail;

use App\Interfaces\OrderDetail\IOrderDetailService;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class OrderSuccessMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $order;
    protected $orderDetailService;

    /**
     * Create a new message instance.
     * @param $order
     */
    public function __construct($order, IOrderDetailService $orderDetailService)
    {
        $this->order = $order;
        $this->orderDetailService = $orderDetailService;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Thông tin đơn hàng #'.$this->order['code'].'',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        Log::info($this->order);
        $orderDetails = $this->orderDetailService->getByOrderId($this->order['id']);
        Log::info($orderDetails);
        return new Content(
            view: 'mail.OrderSuccessMail',
            with: [
                'orderName' => $this->order['name'],
                'orderCode' => $this->order['code'],
                'orderDetails' => $orderDetails,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
