<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class welcomecoach extends Mailable
{
    use Queueable, SerializesModels;

    public $coach; // تعريف المتغير كخاصية عامة

    /**
     * Create a new message instance.
     */
    public function __construct($coach)
    {
        $this->coach = $coach; // تعيين المتغير
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome to our team',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.welcomecoach', // التأكد من اسم العرض
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
