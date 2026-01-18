<?php

namespace App\Mail;

use App\Models\RentalBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EnquiryAcknowledgementMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public readonly RentalBooking $booking) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Rental Enquiry Has Been Received – '.config('app.name'),
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.rental.enquiry-acknowledgement',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
