<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Client; // Import Client Model

class TemplateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $client;
    public $subjectLine;
    public $messageBody;

    /**
     * Create a new message instance.
     */
    public function __construct(Client $client, $subjectLine, $messageBody)
    {
        $this->client = $client;
        // Apply basic placeholder replacement
        $this->messageBody = str_replace('{{ $client->first_name }}', $client->first_name, $messageBody);
        $this->subjectLine = str_replace('{{ $client->first_name }}', $client->first_name, $subjectLine);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subjectLine,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.template-markdown', // We will create this view
            with: [
                'body' => $this->messageBody,
                'client' => $this->client,
            ]
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
