@extends('template.template')

@section('pagecontent')
    {{-- Page Banner --}}
    <div class="relative bg-gradient-to-r from-brand-dark via-brand-slate to-brand-blue overflow-hidden">
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute -top-10 -right-10 w-64 h-64 rounded-full bg-brand-blue/20 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 rounded-full bg-brand-maroon/20 blur-3xl"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 py-14">
            <div class="flex items-center gap-2 mb-3">
                <a href="{{ url('/') }}" class="text-white/50 text-xs hover:text-white/80 transition">Home</a>
                <i class="fas fa-chevron-right text-white/30 text-[9px]"></i>
                <span class="text-white/80 text-xs font-medium">Our Fleet</span>
            </div>
            <div class="inline-flex items-center gap-2 bg-white/10 text-white/80 text-xs font-medium px-3 py-1.5 rounded-full mb-4 backdrop-blur-sm">
                <i class="fas fa-van-shuttle text-brand-sky"></i>
                Rental Fleet
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Our Vehicles</h1>
            <p class="text-sm text-white/60 max-w-lg">Choose from our carefully maintained fleet for city commutes, mountain expeditions, and everything in between.</p>
        </div>
    </div>

    <div class="bg-brand-bg min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-10">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <p class="text-sm font-semibold text-brand-dark">{{ $vehicles->count() }} vehicle{{ $vehicles->count() !== 1 ? 's' : '' }} available</p>
                    <p class="text-xs text-gray-400 mt-0.5">Verified &amp; well-maintained fleet</p>
                </div>
                @auth
                    <a href="{{ route('admin.rental.vehicles.create') }}"
                       class="inline-flex items-center gap-2 bg-brand-blue text-white px-4 py-2 rounded-lg text-sm hover:bg-brand-slate transition shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Add Vehicle
                    </a>
                @endauth
            </div>

            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl flex items-center gap-2 text-sm">
                    <i class="fas fa-circle-check text-green-500"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if($vehicles->isEmpty())
                <div class="text-center py-24">
                    <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-van-shuttle text-gray-300 text-2xl"></i>
                    </div>
                    <p class="text-gray-500 text-sm font-medium">No vehicles available at the moment.</p>
                    <p class="text-gray-400 text-xs mt-1">Check back soon or contact us directly.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($vehicles as $vehicle)
                        @php
                            $conditionBadge = match($vehicle->condition) {
                                'new'     => 'bg-green-500 text-white',
                                'good'    => 'bg-brand-blue text-white',
                                'average' => 'bg-amber-500 text-white',
                                'old'     => 'bg-brand-maroon text-white',
                                default   => 'bg-gray-500 text-white',
                            };
                        @endphp
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group flex flex-col">

                            {{-- Image --}}
                            <div class="relative overflow-hidden h-52 bg-gray-100 flex-shrink-0">
                                <a href="{{ route('rental.vehicles.show', $vehicle) }}" class="block h-full">
                                    <img src="{{ Storage::url($vehicle->main_image) }}"
                                         alt="{{ $vehicle->vehicle_name }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                                </a>
                                {{-- Condition badge --}}
                                <span class="absolute top-3 right-3 text-xs font-semibold px-2.5 py-1 rounded-full shadow {{ $conditionBadge }}">
                                    {{ ucfirst($vehicle->condition) }}
                                </span>
                                {{-- Seats badge --}}
                                <span class="absolute bottom-3 left-3 inline-flex items-center gap-1.5 bg-white/90 backdrop-blur-sm text-brand-dark text-xs font-semibold px-2.5 py-1 rounded-full shadow-sm">
                                    <i class="fas fa-users text-brand-blue text-[10px]"></i>
                                    {{ $vehicle->number_of_seats }} Seats
                                </span>
                            </div>

                            {{-- Body --}}
                            <div class="p-5 flex flex-col flex-1">
                                <a href="{{ route('rental.vehicles.show', $vehicle) }}">
                                    <h2 class="text-base font-bold text-brand-dark group-hover:text-brand-blue transition leading-snug">{{ $vehicle->vehicle_name }}</h2>
                                </a>
                                <div class="flex items-center gap-3 mt-1.5 mb-4">
                                    <span class="text-xs text-gray-400 flex items-center gap-1">
                                        <i class="fas fa-hashtag text-[9px]"></i>
                                        {{ $vehicle->vehicle_number }}
                                    </span>
                                    <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                    <span class="text-xs text-gray-400">{{ $vehicle->color }}</span>
                                </div>

                                <div class="mt-auto pt-4 border-t border-gray-100 flex items-center gap-2">
                                    <a href="{{ route('rental.bookings.create', $vehicle) }}"
                                       class="flex-1 text-center bg-brand-maroon text-white text-sm font-semibold px-3 py-2.5 rounded-xl hover:bg-red-800 transition shadow-sm">
                                        Book Now
                                    </a>
                                    <a href="{{ route('rental.vehicles.show', $vehicle) }}"
                                       class="flex items-center justify-center w-10 h-10 rounded-xl border border-gray-200 text-gray-400 hover:border-brand-blue hover:text-brand-blue transition"
                                       title="View Details">
                                        <i class="fas fa-arrow-right text-sm"></i>
                                    </a>
                                    @auth
                                        <a href="{{ route('admin.rental.vehicles.edit', $vehicle) }}"
                                           class="flex items-center justify-center w-10 h-10 rounded-xl border border-gray-200 text-gray-400 hover:border-brand-blue hover:text-brand-blue transition"
                                           title="Edit">
                                            <i class="fas fa-pen text-xs"></i>
                                        </a>
                                        <form action="{{ route('admin.rental.vehicles.destroy', $vehicle) }}"
                                              method="POST"
                                              onsubmit="return confirm('Delete this vehicle?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="flex items-center justify-center w-10 h-10 rounded-xl border border-gray-200 text-gray-400 hover:border-brand-maroon hover:text-brand-maroon transition"
                                                    title="Delete">
                                                <i class="fas fa-trash text-xs"></i>
                                            </button>
                                        </form>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
