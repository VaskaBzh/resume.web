<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordChangeConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Password Change Confirmation',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.user.password-change-confirmation',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
