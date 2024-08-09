<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class CandidatMail extends Mailable
{
    use Queueable, SerializesModels;

    public $body;
    public $title;
    public $email;

    /**
     * Create a new message instance.
     */
    public function __construct($body, $title, $email)
    {
        $this->body = $body;
        $this->title = $title;
        $this->email = $email;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->title,
            from: new Address('nawarni@gmail.com', 'Nawarni'),
        );
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->title)
            ->view('candidat_mail');
    }
}
