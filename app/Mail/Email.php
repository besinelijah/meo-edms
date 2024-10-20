<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Email extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    /**
     * Data
     *
     * @var array<mixed>|null
     */
    public $data;

    /**
     * Subject information
     *
     * @var string
     */
    public $subject;

    /**
     * Template to be used
     *
     * @var string
     */
    public $template;

    /**
     * Receiver's email address
     *
     * @var string
     */
    public $receiver;

    /**
     * Create a new message instance.
     * @param array<mixed> $mailInfo
     */
    public function __construct($mailInfo)
    {
        $this->data = $mailInfo['data'] ?? [];
        $this->subject = $mailInfo['subject'] ?? '';
        $this->template = $mailInfo['template'];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            text: $this->template,
            with: [
                'data' => $this->data,
            ],
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
