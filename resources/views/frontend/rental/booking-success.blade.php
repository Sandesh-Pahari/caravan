@extends('template.template')

@section('pagecontent')
    <div class="bg-brand-bg min-h-screen flex items-center py-10">
        <div class="max-w-lg mx-auto px-4 w-full text-center">

            {{-- Success Icon --}}
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full mb-6
                        {{ $booking->payment_status === 'paid' ? 'bg-green-100' : 'bg-brand-blue/10' }}">
                <svg class="w-10 h-10 {{ $booking->payment_status === 'paid' ? 'text-green-500' : 'text-brand-blue' }}"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <h1 class="text-2xl font-bold text-brand-dark mb-2">
                @if($booking->payment_status === 'paid')
                    Booking Confirmed & Paid!
                @else
                    Booking Submitted!
                @endif
            </h1>
            <p class="text-sm text-gray-500 mb-8">
                @if($booking->payment_status === 'paid')
                    Your payment was successful. We will contact you shortly with further details.
                @else
                    Your self drive booking has been submitted. Our team will review your documents and contact you to confirm.
                @endif
            </p>

            {{-- Summary Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 text-left mb-8">
                <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-4">Booking Details</h2>
                <dl class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <dt class="text-gray-400">Booking ID</dt>
                        <dd class="font-semibold text-brand-dark">#{{ $booking->id }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-400">Vehicle</dt>
                        <dd class="font-semibold text-brand-dark">{{ $booking->vehicle->vehicle_name }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-400">Type</dt>
                        <dd class="font-semibold text-brand-dark">
                            {{ $booking->booking_type === 'with_driver' ? 'With Driver' : 'Self Drive' }}
                        </dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-400">Date</dt>
                        <dd class="font-semibold text-brand-dark">{{ $booking->date->format('d M Y') }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-400">Pickup Time</dt>
                        <dd class="font-semibold text-brand-dark">
                            {{ \Carbon\Carbon::parse($booking->pickup_time)->format('h:i A') }}
                        </dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-400">Duration</dt>
                        <dd class="font-semibold text-brand-dark">{{ $booking->days_taken }} Day(s)</dd>
                    </div>
                    @if($booking->payment_status === 'paid')
                        <div class="flex justify-between pt-3 border-t border-gray-100">
                            <dt class="text-gray-400">Amount Paid</dt>
                            <dd class="font-bold text-green-600">NPR {{ number_format($booking->total_amount, 2) }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-400">Payment Method</dt>
                            <dd class="font-semibold text-brand-dark capitalize">{{ $booking->payment_method }}</dd>
                        </div>
                    @endif
                    <div class="flex justify-between">
                        <dt class="text-gray-400">Status</dt>
                        <dd>
                            <span class="inline-block px-2 py-0.5 rounded-full text-xs font-semibold
                                {{ $booking->status === 'confirmed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </dd>
                    </div>
                </dl>
            </div>

            <a href="{{ route('rental.vehicles.index') }}"
               class="inline-flex items-center gap-2 bg-brand-blue text-white px-6 py-3 rounded-xl text-sm font-semibold hover:bg-brand-slate transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Vehicles
            </a>
        </div>
    </div>
@endsection
