<?php

namespace App\Mail;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LeadReceived extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Lead $lead;

    /**
     * The number of times the job may be attempted.
     */
    public int $tries = 3;

    /**
     * The number of seconds to wait before retrying the job.
     */
    public array $backoff = [10, 60, 300];

    /**
     * Create a new message instance.
     */
    public function __construct(Lead $lead)
    {
        $this->lead = $lead;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $business = $this->lead->business ?: 'New Prospect';
        $type = ucwords(str_replace('_', ' ', $this->lead->event_type));

        return new Envelope(
            subject: "🔔 {$type} — {$business} ({$this->lead->ref})",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.lead-received',
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
