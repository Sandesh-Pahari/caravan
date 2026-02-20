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
    .gallery-img { transition: transform 0.5s cubic-bezier(0.16,1,0.3,1); }
    .gallery-item:hover .gallery-img { transform: scale(1.06); }
</style>

{{-- ── BREADCRUMB ── --}}
<div class="bg-[#0b0b0b]" style="border-bottom:1px solid rgba(255,255,255,0.06)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-3 flex items-center gap-2 text-xs text-white/35">
        <a href="{{ url('/') }}" class="hover:text-white/70 transition">Home</a>
        <i class="fas fa-chevron-right text-[9px]"></i>
        <a href="{{ route('rental.vehicles.index') }}" class="hover:text-white/70 transition">Vehicles</a>
        <i class="fas fa-chevron-right text-[9px]"></i>
        <span class="text-white/60 font-medium">{{ $vehicle->vehicle_name }}</span>
    </div>
</div>

{{-- ── HERO IMAGE ── --}}
<div class="relative w-full bg-gray-900 overflow-hidden" style="height:clamp(260px,40vw,480px)">
    <img src="{{ Storage::url($vehicle->main_image) }}"
         alt="{{ $vehicle->vehicle_name }}"
         class="w-full h-full object-cover opacity-80">
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
    <div class="absolute bottom-0 left-0 right-0 max-w-7xl mx-auto px-4 sm:px-6 pb-8">
        <a href="{{ route('rental.vehicles.index') }}"
           class="inline-flex items-center gap-1.5 text-white/50 hover:text-white text-xs font-medium mb-3 transition">
            <i class="fas fa-chevron-left text-[10px]"></i>
            Back to Fleet
        </a>
        <h1 class="sg font-extrabold text-white drop-shadow-lg" style="font-size:clamp(1.8rem,5vw,3.5rem)">{{ $vehicle->vehicle_name }}</h1>
        <p class="text-white/45 text-sm mt-1">{{ $vehicle->vehicle_number }}</p>
    </div>
</div>

{{-- ── CONTENT ── --}}
<div class="bg-[#0f0f0f] min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-10 pb-28 lg:pb-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Left / Main --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Specs --}}
                <div class="rounded-2xl p-6 reveal" style="background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.08)">
                    <h2 class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-5 flex items-center gap-2">
                        <i class="fas fa-sliders text-brand-sky"></i>
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
                        @foreach([
                            ['fa-palette','Color',$vehicle->color,false],
                            ['fa-users','Seats',$vehicle->number_of_seats,false],
                            ['fa-star','Condition',null,true],
                            ['fa-suitcase-rolling','Luggage',$luggageLabels[$vehicle->luggage_storage] ?? '-',false],
                        ] as $spec)
                            <div class="rounded-xl p-4 text-center" style="background:rgba(255,255,255,0.04)">
                                <div class="w-9 h-9 rounded-xl flex items-center justify-center mx-auto mb-2.5" style="background:rgba(79,195,247,0.1)">
                                    <i class="fas {{ $spec[0] }} text-brand-sky text-sm"></i>
                                </div>
                                <p class="text-[11px] text-gray-600 mb-1">{{ $spec[1] }}</p>
                                @if($spec[3])
                                    <span class="inline-block px-2.5 py-1 rounded-full text-xs font-semibold {{ $conditionColors[$vehicle->condition] ?? 'bg-gray-100 text-gray-600' }}">
                                        {{ ucfirst($vehicle->condition) }}
                                    </span>
                                @else
                                    <p class="text-sm font-bold text-white">{{ $spec[2] }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Gallery --}}
                @if($vehicle->images->isNotEmpty())
                    <div class="rounded-2xl p-6 reveal" style="background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.08); transition-delay:0.1s">
                        <h2 class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-5 flex items-center gap-2">
                            <i class="fas fa-images text-brand-sky"></i>
                            Gallery
                        </h2>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                            @foreach($vehicle->images as $image)
                                <div class="gallery-item rounded-xl overflow-hidden aspect-video bg-gray-900 cursor-pointer">
                                    <img src="{{ Storage::url($image->image_path) }}"
                                         alt="Vehicle photo"
                                         class="gallery-img w-full h-full object-cover">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            {{-- Right / Sidebar (desktop) --}}
            <div class="lg:col-span-1 hidden lg:block">
                <div class="rounded-2xl p-6 sticky top-6 reveal" style="background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.08)">
                    <h2 class="text-base font-bold text-white mb-1">Ready to Book?</h2>
                    <p class="text-xs text-gray-600 mb-6 leading-relaxed">Secure your booking online. Pickup from our Lalitpur office or arrange a drop-off.</p>

                    <a href="{{ route('rental.bookings.create', $vehicle) }}"
                       class="flex items-center justify-center gap-2 w-full bg-brand-maroon hover:bg-red-700 text-white font-bold py-3.5 rounded-xl transition text-sm shadow-lg shadow-brand-maroon/20 mb-3">
                        <i class="fas fa-calendar-check"></i>
                        Book This Vehicle
                    </a>
                    <a href="{{ route('contact') }}"
                       class="flex items-center justify-center gap-2 w-full font-semibold py-3 rounded-xl transition text-sm text-white mb-6"
                       style="background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.1)"
                       onmouseenter="this.style.background='rgba(255,255,255,0.1)'"
                       onmouseleave="this.style.background='rgba(255,255,255,0.06)'">
                        <i class="fas fa-phone text-brand-sky text-xs"></i>
                        Enquire First
                    </a>

                    <div class="space-y-3 pt-5" style="border-top:1px solid rgba(255,255,255,0.07)">
                        @foreach([
                            ['fa-shield-halved','Verified & well-maintained'],
                            ['fa-clock','Flexible booking times'],
                            ['fa-headset','24/7 customer support'],
                        ] as $badge)
                            <div class="flex items-center gap-3 text-xs text-gray-500">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0" style="background:rgba(79,195,247,0.1)">
                                    <i class="fas {{ $badge[0] }} text-brand-sky text-xs"></i>
                                </div>
                                {{ $badge[1] }}
                            </div>
                        @endforeach
                    </div>

                    @auth
                        <div class="mt-6 pt-5" style="border-top:1px solid rgba(255,255,255,0.07)">
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
<div class="lg:hidden fixed bottom-0 left-0 right-0 z-40 px-4 py-3 shadow-xl" style="background:#0f0f0f; border-top:1px solid rgba(255,255,255,0.08)">
    <a href="{{ route('rental.bookings.create', $vehicle) }}"
       class="flex items-center justify-center gap-2 w-full bg-brand-maroon hover:bg-red-700 text-white font-bold py-3.5 rounded-xl text-sm transition">
        <i class="fas fa-calendar-check"></i>
        Book This Vehicle
    </a>
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
