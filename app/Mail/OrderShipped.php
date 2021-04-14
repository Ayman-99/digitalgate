<?php

namespace App\Mail;

use App\Models\Item;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $codes;
    public $dis;
    /**
     * Create a new message instance.
     *
     * @param Order $order
     */
    public function __construct(Order $order, $codes, $discount)
    {
        $this->order = $order;
        $this->codes = $codes;
        $this->dis = $discount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.shipped');
    }
}
