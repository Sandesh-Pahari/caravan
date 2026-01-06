<x-mail::message>
# Enquiry Received

Dear {{ $booking->name }},

Thank you for reaching out to **{{ config('app.name') }}**. We have received your rental enquiry and our team will contact you shortly to confirm the details.

<x-mail::panel>
**Vehicle:** {{ $booking->vehicle->vehicle_name }}
**Date:** {{ $booking->date->format('d M Y') }} at {{ \Carbon\Carbon::parse($booking->pickup_time)->format('h:i A') }}
**Duration:** {{ $booking->days_taken }} Day(s)
**Type:** {{ $booking->booking_type === 'with_driver' ? 'With Driver' : 'Self Drive' }}
@if($booking->pickup_address)
**From:** {{ $booking->pickup_address }}
**To:** {{ $booking->drop_address }}
@else
**Pickup Location:** {{ $booking->pickup_location }}
@endif
</x-mail::panel>

We typically respond within **24 hours**. If you need urgent assistance, please contact us directly.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
