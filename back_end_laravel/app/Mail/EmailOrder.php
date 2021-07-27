<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailOrder extends Mailable
{
    use Queueable, SerializesModels;
    public $mailOrder;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailOrder)
    {
        $this->mailOrder = $mailOrder;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Nuovo Ordine")->markdown('Email.orderEmail')->with('mailOrder', $this->mailOrder);
    }
}