<?php

namespace App\Mail;

use App\Models\FurnitureRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FurnitureRequestResolution extends Mailable
{
    use Queueable, SerializesModels;

    public $furnitureRequest;

    /**
     * Create a new message instance.
     */
    public function __construct(FurnitureRequest $furnitureRequest)
    {
        $this->furnitureRequest = $furnitureRequest;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Furniture Request Resolution',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.furniture-request',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
