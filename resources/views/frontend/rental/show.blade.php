@extends('template.template')

@section('pagecontent')
    <div class="bg-brand-bg min-h-screen">
        <div class="max-w-5xl mx-auto px-4 py-10">
            <a href="{{ route('rental.vehicles.index') }}"
               class="inline-flex items-center gap-1 text-sm text-brand-blue hover:text-brand-slate font-medium mb-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Vehicles
            </a>

            <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                {{-- Main Image --}}
                <div class="h-80 bg-gray-100">
                    <img src="{{ Storage::url($vehicle->main_image) }}"
                         alt="{{ $vehicle->vehicle_name }}"
                         class="w-full h-full object-cover">
                </div>

                <div class="p-6 md:p-8">
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            <h1 class="text-2xl font-bold text-brand-dark">{{ $vehicle->vehicle_name }}</h1>
                            <p class="text-sm text-gray-400 mt-1">{{ $vehicle->vehicle_number }}</p>
                        </div>
                        <div class="flex items-center gap-2 flex-shrink-0">
                            <a href="{{ route('rental.bookings.create', $vehicle) }}"
                               class="inline-flex items-center gap-2 bg-brand-maroon text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-red-800 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Book Now
                            </a>
                            @auth
                                <a href="{{ route('admin.rental.vehicles.edit', $vehicle) }}"
                                   class="inline-flex items-center gap-1 bg-brand-blue text-white px-4 py-2 rounded-lg text-sm hover:bg-brand-slate transition">
                                    Edit
                                </a>
                            @endauth
                        </div>
                    </div>

                    {{-- @if($vehicle->fare_per_day)
                        <div class="bg-brand-maroon/5 border border-brand-maroon/20 rounded-xl px-5 py-4 mb-6 flex items-center justify-between">
                            <div>
                                <p class="text-xs font-medium text-brand-maroon uppercase tracking-wide">Fare</p>
                                <p class="text-2xl font-bold text-brand-maroon mt-0.5">
                                    NPR {{ number_format($vehicle->fare_per_day, 0) }}
                                    <span class="text-sm font-normal text-gray-500">/ day</span>
                                </p>
                            </div>
                            <svg class="w-8 h-8 text-brand-maroon/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    @endif --}}

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-5 mb-8">
                        <div class="bg-brand-bg rounded-lg p-3">
                            <p class="text-xs font-medium text-gray-400 uppercase tracking-wide">Color</p>
                            <p class="mt-1 text-sm font-semibold text-brand-dark">{{ $vehicle->color }}</p>
                        </div>
                        <div class="bg-brand-bg rounded-lg p-3">
                            <p class="text-xs font-medium text-gray-400 uppercase tracking-wide">Seats</p>
                            <p class="mt-1 text-sm font-semibold text-brand-dark">{{ $vehicle->number_of_seats }}</p>
                        </div>
                        <div class="bg-brand-bg rounded-lg p-3">
                            <p class="text-xs font-medium text-gray-400 uppercase tracking-wide">Condition</p>
                            @php
                                $conditionColors = [
                                    'new'     => 'bg-green-100 text-green-700',
                                    'good'    => 'bg-brand-blue/10 text-brand-blue',
                                    'average' => 'bg-yellow-100 text-yellow-700',
                                    'old'     => 'bg-brand-maroon/10 text-brand-maroon',
                                ];
                            @endphp
                            <span class="mt-1 inline-block px-2 py-1 rounded-full text-xs font-semibold {{ $conditionColors[$vehicle->condition] ?? 'bg-gray-100 text-gray-600' }}">
                                {{ ucfirst($vehicle->condition) }}
                            </span>
                        </div>
                        <div class="bg-brand-bg rounded-lg p-3">
                            <p class="text-xs font-medium text-gray-400 uppercase tracking-wide">Luggage Storage</p>
                            @php
                                $luggageLabels = [
                                    'boot'    => 'Boot Storage',
                                    'head'    => 'Head Storage',
                                    'both'    => 'Boot & Head',
                                    'neither' => 'None',
                                ];
                            @endphp
                            <p class="mt-1 text-sm font-semibold text-brand-dark">{{ $luggageLabels[$vehicle->luggage_storage] ?? '-' }}</p>
                        </div>
                    </div>

                    {{-- Additional Images --}}
                    @if($vehicle->images->isNotEmpty())
                        <div>
                            <h3 class="text-sm font-semibold text-brand-dark mb-3 border-l-4 border-brand-blue pl-3">More Photos</h3>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                @foreach($vehicle->images as $image)
                                    <div class="rounded-xl overflow-hidden aspect-video bg-gray-100">
                                        <img src="{{ Storage::url($image->image_path) }}"
                                             alt="Vehicle photo"
                                             class="w-full h-full object-cover">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
