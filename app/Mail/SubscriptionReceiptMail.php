<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriptionReceiptMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $pdf;

    /**
     * Create a new message instance.
     *
     * @param array $data
     * @param string $pdf
     */
    public function __construct($data, $pdf)
    {
        $this->data = $data;
        $this->pdf = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.subscription_receipt')
                    ->with('data', $this->data) 
                    ->subject('Your Subscription Receipt')
                    ->attachData($this->pdf, 'subscription_receipt.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}