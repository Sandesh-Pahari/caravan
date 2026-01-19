<?php

namespace App\Notifications;

use App\Models\RentalBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;

class RentalPaymentCompletedNotification extends Notification implements ShouldQueue
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
            'type' => 'rental_payment',
            'booking_id' => $this->booking->id,
            'customer_name' => $this->booking->name,
            'vehicle' => $this->booking->vehicle->vehicle_name,
            'amount' => $this->booking->total_amount,
            'payment_method' => $this->booking->payment_method,
            'url' => route('admin.rental.enquiries.show', $this->booking),
            'message' => 'Payment of NPR '.number_format((float) $this->booking->total_amount, 2)." received from {$this->booking->name}.",
        ];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("Payment Received – {$this->booking->name}")
            ->greeting('Rental Payment Confirmed')
            ->line("**Customer:** {$this->booking->name} ({$this->booking->email})")
            ->line("**Vehicle:** {$this->booking->vehicle->vehicle_name}")
            ->line('**Amount:** NPR '.number_format((float) $this->booking->total_amount, 2))
            ->line('**Method:** '.ucfirst($this->booking->payment_method ?? ''))
            ->line("**Reference:** {$this->booking->payment_reference}")
            ->action('View Booking', route('admin.rental.enquiries.show', $this->booking));
    }
}
