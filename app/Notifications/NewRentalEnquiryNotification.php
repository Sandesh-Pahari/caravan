<?php

namespace App\Notifications;

use App\Models\RentalBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;

class NewRentalEnquiryNotification extends Notification implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public readonly RentalBooking $booking) {}

    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'type' => 'rental_enquiry',
            'booking_id' => $this->booking->id,
            'booking_type' => $this->booking->booking_type,
            'customer_name' => $this->booking->name,
            'vehicle' => $this->booking->vehicle->vehicle_name,
            'url' => route('admin.rental.enquiries.show', $this->booking),
            'message' => "New {$this->booking->booking_type} enquiry from {$this->booking->name}.",
        ];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $bookingType = $this->booking->booking_type === 'with_driver' ? 'With Driver' : 'Self Drive';

        return (new MailMessage)
            ->subject("New Rental Enquiry – {$this->booking->name}")
            ->greeting('New Rental Enquiry Received')
            ->line("**Customer:** {$this->booking->name} ({$this->booking->email})")
            ->line("**Vehicle:** {$this->booking->vehicle->vehicle_name}")
            ->line("**Type:** {$bookingType}")
            ->line("**Date:** {$this->booking->date->format('d M Y')} at ".
                \Carbon\Carbon::parse($this->booking->pickup_time)->format('h:i A'))
            ->action('View Enquiry', route('admin.rental.enquiries.show', $this->booking))
            ->line('Log in to the admin dashboard to respond.');
    }
}
