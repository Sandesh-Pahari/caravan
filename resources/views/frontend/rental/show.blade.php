@extends('template.template')

@section('pagecontent')
    {{-- Breadcrumb --}}
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-3 flex items-center gap-2 text-xs text-gray-400">
            <a href="{{ url('/') }}" class="hover:text-brand-blue transition">Home</a>
            <i class="fas fa-chevron-right text-[9px]"></i>
            <a href="{{ route('rental.vehicles.index') }}" class="hover:text-brand-blue transition">Vehicles</a>
            <i class="fas fa-chevron-right text-[9px]"></i>
            <span class="text-brand-dark font-medium">{{ $vehicle->vehicle_name }}</span>
        </div>
    </div>

    {{-- Hero Image --}}
    <div class="relative w-full h-72 md:h-96 bg-gray-900 overflow-hidden">
        <img src="{{ Storage::url($vehicle->main_image) }}"
             alt="{{ $vehicle->vehicle_name }}"
             class="w-full h-full object-cover opacity-85">
        <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/20 to-transparent"></div>
        <div class="absolute bottom-0 left-0 right-0 max-w-7xl mx-auto px-4 sm:px-6 pb-8">
            <a href="{{ route('rental.vehicles.index') }}"
               class="inline-flex items-center gap-1.5 text-white/65 hover:text-white text-xs font-medium mb-3 transition">
                <i class="fas fa-chevron-left text-[10px]"></i>
                Back to Fleet
            </a>
            <h1 class="text-3xl md:text-4xl font-bold text-white drop-shadow-md">{{ $vehicle->vehicle_name }}</h1>
            <p class="text-white/55 text-sm mt-1">{{ $vehicle->vehicle_number }}</p>
        </div>
    </div>

    <div class="bg-brand-bg min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-10 pb-28 lg:pb-10">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Left / Main Content --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- Specs Grid --}}
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                        <h2 class="text-xs font-bold text-brand-dark uppercase tracking-widest mb-5 flex items-center gap-2">
                            <i class="fas fa-sliders text-brand-blue"></i>
                            Specifications
                        </h2>
                        @php
                            $conditionColors = [
                                'new'     => 'bg-green-100 text-green-700',
                                'good'    => 'bg-brand-blue/10 text-brand-blue',
                                'average' => 'bg-amber-100 text-amber-700',
                                'old'     => 'bg-brand-maroon/10 text-brand-maroon',
                            ];
                            $luggageLabels = [
                                'boot'    => 'Boot Storage',
                                'head'    => 'Head Storage',
                                'both'    => 'Boot & Head',
                                'neither' => 'None',
                            ];
                        @endphp
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="bg-brand-bg rounded-xl p-4 text-center">
                                <div class="w-9 h-9 bg-white rounded-xl flex items-center justify-center mx-auto mb-2.5 shadow-sm border border-gray-100">
                                    <i class="fas fa-palette text-brand-blue text-sm"></i>
                                </div>
                                <p class="text-[11px] text-gray-400 mb-1">Color</p>
                                <p class="text-sm font-bold text-brand-dark">{{ $vehicle->color }}</p>
                            </div>
                            <div class="bg-brand-bg rounded-xl p-4 text-center">
                                <div class="w-9 h-9 bg-white rounded-xl flex items-center justify-center mx-auto mb-2.5 shadow-sm border border-gray-100">
                                    <i class="fas fa-users text-brand-blue text-sm"></i>
                                </div>
                                <p class="text-[11px] text-gray-400 mb-1">Seats</p>
                                <p class="text-sm font-bold text-brand-dark">{{ $vehicle->number_of_seats }}</p>
                            </div>
                            <div class="bg-brand-bg rounded-xl p-4 text-center">
                                <div class="w-9 h-9 bg-white rounded-xl flex items-center justify-center mx-auto mb-2.5 shadow-sm border border-gray-100">
                                    <i class="fas fa-star text-brand-blue text-sm"></i>
                                </div>
                                <p class="text-[11px] text-gray-400 mb-1">Condition</p>
                                <span class="inline-block px-2.5 py-1 rounded-full text-xs font-semibold {{ $conditionColors[$vehicle->condition] ?? 'bg-gray-100 text-gray-600' }}">
                                    {{ ucfirst($vehicle->condition) }}
                                </span>
                            </div>
                            <div class="bg-brand-bg rounded-xl p-4 text-center">
                                <div class="w-9 h-9 bg-white rounded-xl flex items-center justify-center mx-auto mb-2.5 shadow-sm border border-gray-100">
                                    <i class="fas fa-suitcase-rolling text-brand-blue text-sm"></i>
                                </div>
                                <p class="text-[11px] text-gray-400 mb-1">Luggage</p>
                                <p class="text-sm font-bold text-brand-dark">{{ $luggageLabels[$vehicle->luggage_storage] ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Additional Images --}}
                    @if($vehicle->images->isNotEmpty())
                        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                            <h2 class="text-xs font-bold text-brand-dark uppercase tracking-widest mb-5 flex items-center gap-2">
                                <i class="fas fa-images text-brand-blue"></i>
                                Gallery
                            </h2>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                @foreach($vehicle->images as $image)
                                    <div class="rounded-xl overflow-hidden aspect-video bg-gray-100 group cursor-pointer">
                                        <img src="{{ Storage::url($image->image_path) }}"
                                             alt="Vehicle photo"
                                             class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Right / Booking Sidebar --}}
                <div class="lg:col-span-1 hidden lg:block">
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sticky top-6">
                        <h2 class="text-base font-bold text-brand-dark mb-1">Ready to Book?</h2>
                        <p class="text-xs text-gray-400 mb-6 leading-relaxed">Secure your booking online. Pickup from our Lalitpur office or arrange a drop-off.</p>

                        <a href="{{ route('rental.bookings.create', $vehicle) }}"
                           class="flex items-center justify-center gap-2 w-full bg-brand-maroon hover:bg-red-800 text-white font-bold py-3.5 rounded-xl transition text-sm shadow-md shadow-brand-maroon/25 mb-3">
                            <i class="fas fa-calendar-check"></i>
                            Book This Vehicle
                        </a>
                        <a href="{{ route('contact') }}"
                           class="flex items-center justify-center gap-2 w-full bg-brand-bg hover:bg-gray-100 text-brand-dark font-semibold py-3 rounded-xl transition text-sm border border-gray-200 mb-6">
                            <i class="fas fa-phone text-brand-blue text-xs"></i>
                            Enquire First
                        </a>

                        <div class="space-y-3 pt-5 border-t border-gray-100">
                            <div class="flex items-center gap-3 text-xs text-gray-500">
                                <div class="w-8 h-8 bg-brand-blue/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-shield-halved text-brand-blue text-xs"></i>
                                </div>
                                Verified &amp; well-maintained vehicle
                            </div>
                            <div class="flex items-center gap-3 text-xs text-gray-500">
                                <div class="w-8 h-8 bg-brand-blue/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-clock text-brand-blue text-xs"></i>
                                </div>
                                Flexible booking times
                            </div>
                            <div class="flex items-center gap-3 text-xs text-gray-500">
                                <div class="w-8 h-8 bg-brand-blue/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-headset text-brand-blue text-xs"></i>
                                </div>
                                24/7 customer support
                            </div>
                        </div>

                        @auth
                            <div class="mt-6 pt-5 border-t border-gray-100">
                                <a href="{{ route('admin.rental.vehicles.edit', $vehicle) }}"
                                   class="flex items-center justify-center gap-2 w-full bg-brand-blue hover:bg-brand-slate text-white text-xs font-semibold py-2.5 rounded-lg transition">
                                    <i class="fas fa-pen text-[10px]"></i>
                                    Edit Vehicle
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Mobile Sticky CTA --}}
    <div class="lg:hidden fixed bottom-0 left-0 right-0 z-40 bg-white border-t border-gray-100 px-4 py-3 shadow-lg">
        <a href="{{ route('rental.bookings.create', $vehicle) }}"
           class="flex items-center justify-center gap-2 w-full bg-brand-maroon hover:bg-red-800 text-white font-bold py-3.5 rounded-xl text-sm transition">
            <i class="fas fa-calendar-check"></i>
            Book This Vehicle
        </a>
    </div>
@endsection
