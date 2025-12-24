@extends('template.template')

@section('pagecontent')
    <div class="bg-brand-bg min-h-screen py-10">
        <div class="max-w-xl mx-auto px-4">

            {{-- Header --}}
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-brand-blue/10 rounded-full mb-4">
                    <svg class="w-8 h-8 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-brand-dark">Complete Payment</h1>
                <p class="text-sm text-gray-500 mt-1">Choose your preferred payment method to confirm the booking.</p>
            </div>

            @if(session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 text-sm">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Booking Summary --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 mb-6">
                <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-3">Booking Summary</h2>
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ Storage::url($booking->vehicle->main_image) }}"
                         alt="{{ $booking->vehicle->vehicle_name }}"
                         class="w-14 h-12 object-cover rounded-lg flex-shrink-0">
                    <div>
                        <p class="font-semibold text-brand-dark text-sm">{{ $booking->vehicle->vehicle_name }}</p>
                        <p class="text-xs text-gray-400">{{ $booking->vehicle->vehicle_number }}</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2 text-sm">
                    <div>
                        <p class="text-gray-400 text-xs">Customer</p>
                        <p class="font-medium text-brand-dark">{{ $booking->name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs">Pickup Date</p>
                        <p class="font-medium text-brand-dark">{{ $booking->date->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs">Pickup Time</p>
                        <p class="font-medium text-brand-dark">{{ \Carbon\Carbon::parse($booking->pickup_time)->format('h:i A') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs">Duration</p>
                        <p class="font-medium text-brand-dark">{{ $booking->days_taken }} Day(s)</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs">Pickup Address</p>
                        <p class="font-medium text-brand-dark text-xs">{{ $booking->pickup_address }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs">Drop Address</p>
                        <p class="font-medium text-brand-dark text-xs">{{ $booking->drop_address }}</p>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100 flex justify-between items-center">
                    <span class="text-sm font-semibold text-brand-dark">Total Amount</span>
                    <span class="text-lg font-bold text-brand-blue">NPR {{ number_format($booking->total_amount, 2) }}</span>
                </div>
            </div>

            {{-- Payment Methods --}}
            <div class="space-y-3">

                {{-- Stripe --}}
                <form action="{{ route('rental.bookings.pay.stripe', $booking) }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="w-full bg-white border-2 border-gray-200 hover:border-brand-blue rounded-xl px-5 py-4
                                   flex items-center justify-between group transition">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-indigo-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M13.976 9.15c-2.172-.806-3.356-1.426-3.356-2.409 0-.831.683-1.305 1.901-1.305 2.227 0 4.515.858 6.09 1.631l.89-5.494C18.252.975 15.697 0 12.165 0 9.667 0 7.589.654 6.104 1.872 4.56 3.147 3.757 4.992 3.757 7.218c0 4.039 2.467 5.76 6.476 7.219 2.585.92 3.445 1.574 3.445 2.583 0 .98-.84 1.545-2.354 1.545-1.875 0-4.965-.921-6.99-2.109l-.9 5.555C5.175 22.99 8.385 24 11.714 24c2.641 0 4.843-.624 6.328-1.813 1.664-1.305 2.525-3.236 2.525-5.732 0-4.128-2.524-5.851-6.591-7.305z"/>
                                </svg>
                            </div>
                            <div class="text-left">
                                <p class="font-semibold text-brand-dark text-sm">Pay with Stripe</p>
                                <p class="text-xs text-gray-400">Credit / Debit Card</p>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-gray-300 group-hover:text-brand-blue transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </form>

                {{-- Khalti --}}
                <form action="{{ route('rental.bookings.pay.khalti', $booking) }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="w-full bg-white border-2 border-gray-200 hover:border-purple-500 rounded-xl px-5 py-4
                                   flex items-center justify-between group transition">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-purple-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-purple-600" viewBox="0 0 24 24" fill="currentColor">
                                    <circle cx="12" cy="12" r="10"/>
                                    <path fill="white" d="M8 12l3 3 5-5"/>
                                </svg>
                            </div>
                            <div class="text-left">
                                <p class="font-semibold text-brand-dark text-sm">Pay with Khalti</p>
                                <p class="text-xs text-gray-400">Khalti Digital Wallet</p>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-gray-300 group-hover:text-purple-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </form>

                {{-- eSewa --}}
                <form action="{{ route('rental.bookings.pay.esewa', $booking) }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="w-full bg-white border-2 border-gray-200 hover:border-green-500 rounded-xl px-5 py-4
                                   flex items-center justify-between group transition">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-green-600" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z"/>
                                </svg>
                            </div>
                            <div class="text-left">
                                <p class="font-semibold text-brand-dark text-sm">Pay with eSewa</p>
                                <p class="text-xs text-gray-400">eSewa Digital Wallet</p>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-gray-300 group-hover:text-green-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </form>
            </div>

            <p class="text-center text-xs text-gray-400 mt-6">
                Your booking ID is <span class="font-semibold text-brand-dark">#{{ $booking->id }}</span>.
                All payments are secured and encrypted.
            </p>
        </div>
    </div>
@endsection
