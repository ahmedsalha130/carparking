<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChatCustomer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $customer, $message_replay)
    {
        $this->customer = $customer ;
        $this->message_replay = $message_replay ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Support Team')->view('emails.send_email')

            ->with(['customer'=>$this->customer,'message_replay'=>$this->message_replay]);
    }
}
