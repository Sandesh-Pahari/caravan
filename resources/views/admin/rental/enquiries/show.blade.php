@extends('admin.dashboard')

@section('content')
    <div class="max-w-3xl mx-auto">

        {{-- Back --}}
        <a href="{{ route('admin.rental.enquiries.index') }}"
           class="inline-flex items-center gap-1 text-sm text-brand-blue hover:underline mb-6">
            ← Back to Enquiries
        </a>

        {{-- Type badge --}}
        <div class="flex items-center gap-3 mb-4">
            <h1 class="text-xl font-bold text-brand-dark">
                {{ $rentalBooking->is_enquiry ? 'Enquiry' : 'Paid Booking' }} #{{ $rentalBooking->id }}
            </h1>
            @if($rentalBooking->is_enquiry)
                <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-700">Enquiry</span>
            @else
                <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">Paid Booking</span>
            @endif
            <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                {{ $rentalBooking->booking_type === 'with_driver' ? 'With Driver' : 'Self Drive' }}
            </span>
        </div>

        <div class="space-y-5">

            {{-- Customer --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
                <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-3">Customer</h2>
                <div class="grid grid-cols-2 gap-3 text-sm">
                    <div>
                        <p class="text-gray-400 text-xs">Name</p>
                        <p class="font-medium text-brand-dark">{{ $rentalBooking->name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs">Phone</p>
                        <p class="font-medium text-brand-dark">{{ $rentalBooking->phone_number }}</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-gray-400 text-xs">Email</p>
                        <p class="font-medium text-brand-dark">{{ $rentalBooking->email }}</p>
                    </div>
                </div>
            </div>

            {{-- Vehicle & Trip --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
                <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-3">Vehicle & Trip</h2>
                <div class="flex items-center gap-4 mb-4">
                    <img src="{{ Storage::url($rentalBooking->vehicle->main_image) }}"
                         alt="{{ $rentalBooking->vehicle->vehicle_name }}"
                         class="w-16 h-12 object-cover rounded-lg flex-shrink-0">
                    <div>
                        <p class="font-semibold text-brand-dark">{{ $rentalBooking->vehicle->vehicle_name }}</p>
                        <p class="text-xs text-gray-400">{{ $rentalBooking->vehicle->vehicle_number }}</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3 text-sm">
                    <div>
                        <p class="text-gray-400 text-xs">Pickup Date</p>
                        <p class="font-medium text-brand-dark">{{ $rentalBooking->date->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs">Pickup Time</p>
                        <p class="font-medium text-brand-dark">
                            {{ \Carbon\Carbon::parse($rentalBooking->pickup_time)->format('h:i A') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs">Duration</p>
                        <p class="font-medium text-brand-dark">{{ $rentalBooking->days_taken }} Day(s)</p>
                    </div>
                    @if($rentalBooking->trip_type)
                        <div>
                            <p class="text-gray-400 text-xs">Trip Type</p>
                            <p class="font-medium text-brand-dark">
                                {{ $rentalBooking->trip_type === 'one_way' ? 'One Way' : 'Round Trip' }}
                            </p>
                        </div>
                    @endif
                    @if($rentalBooking->pickup_address)
                        <div>
                            <p class="text-gray-400 text-xs">Pickup Address</p>
                            <p class="font-medium text-brand-dark text-xs">{{ $rentalBooking->pickup_address }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs">Drop Address</p>
                            <p class="font-medium text-brand-dark text-xs">{{ $rentalBooking->drop_address }}</p>
                        </div>
                    @endif
                    @if($rentalBooking->pickup_location)
                        <div class="col-span-2">
                            <p class="text-gray-400 text-xs">Pickup Location</p>
                            <p class="font-medium text-brand-dark">{{ $rentalBooking->pickup_location }}</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Fare breakdown (with_driver only) --}}
            @if($rentalBooking->fare_breakdown)
                @php $b = $rentalBooking->fare_breakdown; @endphp
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
                    <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-3">Fare Breakdown</h2>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between text-gray-500 items-start">
                            <span>Distance ({{ $b['actual_distance_km'] }} km
                                @if($rentalBooking->trip_type === 'one_way')
                                    × 2 = {{ $b['chargeable_distance_km'] }} km charged
                                @endif
                            )</span>
                            @if(!empty($b['road_difficulty']) && !empty($b['avg_speed_kmh']))
                                @php
                                    $difficultyColor = match($b['road_difficulty']) {
                                        'Highway'       => 'bg-green-100 text-green-700',
                                        'Hilly Roads'   => 'bg-amber-100 text-amber-700',
                                        default         => 'bg-red-100 text-red-700',
                                    };
                                @endphp
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $difficultyColor }}">
                                    {{ $b['road_difficulty'] }} · {{ $b['avg_speed_kmh'] }} km/h avg
                                </span>
                            @endif
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">
                                Fuel Cost
                                @if(!empty($b['road_multiplier']) && $b['road_multiplier'] > 1.0)
                                    <span class="text-xs text-gray-400">(×{{ $b['road_multiplier'] }} road factor)</span>
                                @endif
                            </span>
                            <span class="font-medium">NPR {{ number_format($b['fuel_cost'], 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Driver Cost</span>
                            <span class="font-medium">NPR {{ number_format($b['driver_cost'], 2) }}</span>
                        </div>
                        @if($b['hold_cost'] > 0)
                            <div class="flex justify-between">
                                <span class="text-gray-500">Hold Fare</span>
                                <span class="font-medium">NPR {{ number_format($b['hold_cost'], 2) }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between text-gray-400 text-xs">
                            <span>Service Charge</span>
                            <span>NPR {{ number_format($b['profit_amount'], 2) }}</span>
                        </div>
                        <div class="flex justify-between font-bold text-brand-dark border-t border-gray-100 pt-2">
                            <span>Total</span>
                            <span>NPR {{ number_format($rentalBooking->total_amount, 2) }}</span>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Payment (paid bookings) --}}
            @if($rentalBooking->payment_status === 'paid')
                <div class="bg-green-50 border border-green-200 rounded-xl p-5">
                    <h2 class="text-xs font-semibold text-green-600 uppercase tracking-wide mb-3">Payment Confirmed</h2>
                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <div>
                            <p class="text-gray-400 text-xs">Method</p>
                            <p class="font-medium text-brand-dark">{{ ucfirst($rentalBooking->payment_method) }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs">Reference</p>
                            <p class="font-medium text-brand-dark font-mono text-xs">{{ $rentalBooking->payment_reference ?? '—' }}</p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Documents (self_drive) --}}
            @if($rentalBooking->identity_document || $rentalBooking->drivers_license)
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
                    <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-3">Documents</h2>
                    <div class="flex gap-4">
                        @if($rentalBooking->identity_document)
                            <a href="{{ Storage::url($rentalBooking->identity_document) }}"
                               target="_blank"
                               class="inline-flex items-center gap-2 px-4 py-2 text-sm bg-brand-blue text-white rounded-lg hover:bg-brand-slate transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2" />
                                </svg>
                                Identity Document
                            </a>
                        @endif
                        @if($rentalBooking->drivers_license)
                            <a href="{{ Storage::url($rentalBooking->drivers_license) }}"
                               target="_blank"
                               class="inline-flex items-center gap-2 px-4 py-2 text-sm bg-gray-100 text-brand-dark rounded-lg hover:bg-gray-200 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 9a2 2 0 10-4 0v5a2 2 0 01-2 2h6m-6-4h4m8 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Driver's License
                            </a>
                        @endif
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
