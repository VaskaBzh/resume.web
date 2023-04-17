<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $messageContent;
    public $contacts;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($messageContent, $contacts = null)
    {
        $this->messageContent = $messageContent;
        $this->contacts = $contacts;
    }

    /**
     * Построить сообщение.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.message')
            ->with([
                'messageContent' => $this->messageContent,
                'contacts' => $this->contacts,
            ]);
    }
}
