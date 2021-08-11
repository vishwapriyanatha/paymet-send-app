<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserCreateEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $details;

    /**
     * UserCreateEmail constructor.
     * @param $details
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('User create email')
            ->with($this->details)
            ->view('emails.userCreate');
    }
}
