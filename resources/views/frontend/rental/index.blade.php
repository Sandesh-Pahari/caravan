@extends('template.template')

@section('pagecontent')

<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@700;800&display=swap" rel="stylesheet">

<style>
    .sg { font-family: 'Space Grotesk', sans-serif; }
    .reveal {
        opacity: 0;
        transform: translateY(36px);
        transition: opacity 0.8s cubic-bezier(0.16,1,0.3,1), transform 0.8s cubic-bezier(0.16,1,0.3,1);
    }
    .reveal.visible { opacity: 1; transform: translateY(0); }
    .hero-grid {
        background-image: linear-gradient(rgba(255,255,255,0.04) 1px, transparent 1px),
                          linear-gradient(90deg, rgba(255,255,255,0.04) 1px, transparent 1px);
        background-size: 64px 64px;
    }
    .veh-img { transition: transform 0.6s cubic-bezier(0.16,1,0.3,1); }
    .veh-card:hover .veh-img { transform: scale(1.07); }
    .veh-card { border: 1px solid rgba(255,255,255,0.07); transition: border-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease; }
    .veh-card:hover { border-color: rgba(255,255,255,0.18); transform: translateY(-4px); box-shadow: 0 20px 40px rgba(0,0,0,0.4); }
</style>

{{-- ── HERO ── --}}
<section class="relative bg-[#0b0b0b] overflow-hidden">
    <div class="absolute inset-0 hero-grid pointer-events-none"></div>
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 right-0 w-[500px] h-[400px] rounded-full blur-[130px]" style="background:rgba(79,195,247,0.05)"></div>
        <div class="absolute bottom-0 left-0 w-[300px] h-[300px] rounded-full blur-[100px]" style="background:rgba(139,30,45,0.06)"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 pt-16 pb-14">
        <nav class="flex items-center gap-2 text-xs text-white/40 mb-6">
            <a href="{{ route('home') }}" class="hover:text-white/70 transition">Home</a>
            <i class="fas fa-chevron-right text-[9px]"></i>
            <span class="text-white/70">Vehicles</span>
        </nav>
        <div class="inline-flex items-center gap-2 border border-brand-sky/25 text-brand-sky text-xs font-semibold px-4 py-2 rounded-full mb-5" style="background:rgba(79,195,247,0.06)">
            <i class="fas fa-van-shuttle text-xs"></i>
            Rental Fleet
        </div>
        <h1 class="sg font-extrabold text-white leading-tight mb-3" style="font-size:clamp(2.5rem,6vw,4.5rem)">
            Our Vehicles.
        </h1>
        <p class="text-gray-500 text-sm max-w-md leading-relaxed">Choose from our carefully maintained fleet for city commutes, mountain expeditions, and everything in between.</p>
    </div>
</section>

{{-- ── VEHICLES GRID ── --}}
<div class="bg-[#0f0f0f] min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-12">

        {{-- Top bar --}}
        <div class="flex items-center justify-between mb-10 reveal">
            <div>
                <p class="text-white text-sm font-semibold">{{ $vehicles->count() }} vehicle{{ $vehicles->count() !== 1 ? 's' : '' }} available</p>
                <p class="text-gray-600 text-xs mt-0.5">Verified &amp; well-maintained fleet</p>
            </div>
            @auth
                <a href="{{ route('admin.rental.vehicles.create') }}"
                   class="inline-flex items-center gap-2 bg-brand-sky hover:bg-white text-brand-dark font-bold px-4 py-2.5 rounded-xl text-sm transition shadow-lg shadow-brand-sky/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Vehicle
                </a>
            @endauth
        </div>

        @if(session('success'))
            <div class="mb-8 px-5 py-4 rounded-xl text-sm font-medium text-green-400 reveal"
                 style="background:rgba(34,197,94,0.08); border:1px solid rgba(34,197,94,0.2)">
                <i class="fas fa-circle-check mr-2"></i>{{ session('success') }}
            </div>
        @endif

        @if($vehicles->isEmpty())
            <div class="text-center py-28 reveal">
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4" style="background:rgba(255,255,255,0.04)">
                    <i class="fas fa-van-shuttle text-gray-600 text-2xl"></i>
                </div>
                <p class="text-gray-500 text-sm font-medium">No vehicles available at the moment.</p>
                <p class="text-gray-600 text-xs mt-1">Check back soon or contact us directly.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($vehicles as $i => $vehicle)
                    @php
                        $conditionBadge = match($vehicle->condition) {
                            'new'     => 'bg-green-500 text-white',
                            'good'    => 'bg-brand-blue text-white',
                            'average' => 'bg-amber-500 text-white',
                            'old'     => 'bg-brand-maroon text-white',
                            default   => 'bg-gray-500 text-white',
                        };
                    @endphp
                    <div class="veh-card group rounded-2xl overflow-hidden flex flex-col reveal"
                         style="background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.08); transition-delay:{{ ($i % 3) * 0.1 }}s">

                        {{-- Image --}}
                        <div class="relative overflow-hidden">
                            <a href="{{ route('rental.vehicles.show', $vehicle) }}">
                                <img src="{{ Storage::url($vehicle->main_image) }}"
                                     alt="{{ $vehicle->vehicle_name }}"
                                     class="veh-img w-full h-56 object-cover">
                            </a>
                            <span class="absolute top-3 right-3 text-xs font-black px-2.5 py-1 rounded-full shadow {{ $conditionBadge }}">
                                {{ ucfirst($vehicle->condition) }}
                            </span>
                        </div>

                        {{-- Body --}}
                        <div class="p-6 flex flex-col flex-1">

                            {{-- Title --}}
                            <div class="flex items-center justify-between">
                                <a href="{{ route('rental.vehicles.show', $vehicle) }}">
                                    <h2 class="text-lg font-semibold text-white group-hover:text-brand-sky transition capitalize">{{ $vehicle->vehicle_name }}</h2>
                                </a>
                                @auth
                                    <div class="flex items-center gap-1.5">
                                        <a href="{{ route('admin.rental.vehicles.edit', $vehicle) }}"
                                           class="w-7 h-7 rounded-lg flex items-center justify-center text-gray-600 hover:text-brand-sky transition"
                                           style="background:rgba(255,255,255,0.06)">
                                            <i class="fas fa-pen text-[10px]"></i>
                                        </a>
                                        <form action="{{ route('admin.rental.vehicles.destroy', $vehicle) }}"
                                              method="POST" onsubmit="return confirm('Delete this vehicle?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="w-7 h-7 rounded-lg flex items-center justify-center text-gray-600 hover:text-brand-maroon transition"
                                                    style="background:rgba(255,255,255,0.06)">
                                                <i class="fas fa-trash text-[10px]"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endauth
                            </div>

                            {{-- Divider --}}
                            <div class="my-4" style="border-top:1px solid rgba(255,255,255,0.08)"></div>

                            {{-- Meta grid --}}
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div class="flex items-center gap-3">
                                    <div class="p-2 rounded-lg flex-shrink-0" style="background:rgba(255,255,255,0.08)">
                                        <i class="fas fa-users text-gray-400 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Seats</p>
                                        <p class="text-sm font-semibold text-white">{{ $vehicle->number_of_seats }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="p-2 rounded-lg flex-shrink-0" style="background:rgba(255,255,255,0.08)">
                                        <i class="fas fa-palette text-gray-400 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Color</p>
                                        <p class="text-sm font-semibold text-white">{{ $vehicle->color }}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Buttons --}}
                            <div class="mt-auto space-y-2">
                                <a href="{{ route('rental.vehicles.show', $vehicle) }}"
                                   class="block w-full text-center text-white text-sm font-medium py-3 rounded-xl transition"
                                   style="background:rgba(255,255,255,0.08)"
                                   onmouseenter="this.style.background='rgba(255,255,255,0.14)'"
                                   onmouseleave="this.style.background='rgba(255,255,255,0.08)'">
                                    View Details
                                </a>
                                <a href="{{ route('rental.bookings.create', $vehicle) }}"
                                   class="block w-full text-center bg-brand-maroon hover:bg-red-700 text-white text-sm font-bold py-3 rounded-xl transition">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<script>
    (function () {
        var els = document.querySelectorAll('.reveal');
        var obs = new IntersectionObserver(function (entries) {
            entries.forEach(function (e) {
                if (e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); }
            });
        }, { threshold: 0.1 });
        els.forEach(function (el) { obs.observe(el); });
    })();
</script>

@endsection
