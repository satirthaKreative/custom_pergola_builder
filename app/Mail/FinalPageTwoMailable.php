<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FinalPageTwoMailable extends Mailable
{
     use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        
        $from_name = "Custom Pergola Builder";
        $from_email = "noreply@outdoorlivingtoday.com";
        $subject = "Pergola Details";
        return $this->from($from_email, $from_name)
            ->view('emails.final-page-two')
            ->subject($subject)
            ->with('data', $this->data);
    }
}
