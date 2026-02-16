@extends('template.template')

@section('pagecontent')

{{-- Google Font for bold headings --}}
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@700;800&display=swap" rel="stylesheet">

<style>
    .sg { font-family: 'Space Grotesk', sans-serif; }

    /* Scroll reveal */
    .reveal {
        opacity: 0;
        transform: translateY(36px);
        transition: opacity 0.8s cubic-bezier(0.16,1,0.3,1), transform 0.8s cubic-bezier(0.16,1,0.3,1);
    }
    .reveal.visible { opacity: 1; transform: translateY(0); }

    /* Marquee */
    @keyframes marquee-scroll {
        0%   { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .marquee-track { animation: marquee-scroll 30s linear infinite; }

    /* Service cards */
    .svc-card {
        border: 1px solid rgba(255,255,255,0.07);
        transition: transform 0.35s ease, border-color 0.35s ease;
    }
    .svc-card:hover { transform: translateY(-6px); border-color: rgba(79,195,247,0.35); }
    .svc-icon { transition: background 0.3s ease, color 0.3s ease; }
    .svc-card:hover .svc-icon { background: #4FC3F7 !important; color: #111111 !important; }

    /* Vehicle cards */
    .veh-img { transition: transform 0.6s cubic-bezier(0.16,1,0.3,1); }
    .veh-card:hover .veh-img { transform: scale(1.07); }
    .veh-card { border: 1px solid rgba(255,255,255,0.07); transition: border-color 0.3s ease; }
    .veh-card:hover { border-color: rgba(255,255,255,0.18); }

    /* Step icons */
    .step-icon { transition: background 0.3s ease, transform 0.3s ease; }
    .step-wrap:hover .step-icon { background: rgba(79,195,247,0.12); transform: scale(1.05); }

    /* FAQ items */
    .faq-item { border: 1px solid rgba(255,255,255,0.07); transition: border-color 0.25s ease; }
    .faq-item:hover { border-color: rgba(255,255,255,0.15); }

    /* Hero grid overlay */
    .hero-grid {
        background-image: linear-gradient(rgba(255,255,255,0.04) 1px, transparent 1px),
                          linear-gradient(90deg, rgba(255,255,255,0.04) 1px, transparent 1px);
        background-size: 64px 64px;
    }
</style>

{{-- ── HERO ── --}}
<section class="relative min-h-screen bg-[#0b0b0b] flex flex-col justify-center overflow-hidden">
    <div class="absolute inset-0 hero-grid pointer-events-none"></div>
    <div class="absolute top-0 left-0 right-0 h-px bg-white/5"></div>
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <div class="absolute top-1/3 -left-40 w-[600px] h-[500px] rounded-full blur-[130px]" style="background:rgba(79,195,247,0.06)"></div>
        <div class="absolute bottom-10 right-0 w-[400px] h-[400px] rounded-full blur-[100px]" style="background:rgba(139,30,45,0.08)"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 pt-24 pb-28">
        {{-- Badge --}}
        <div class="inline-flex items-center gap-2 border border-brand-sky/25 text-brand-sky text-xs font-semibold px-4 py-2 rounded-full mb-8" style="background:rgba(79,195,247,0.06)">
            <span class="w-1.5 h-1.5 bg-brand-sky rounded-full animate-pulse"></span>
            Nepal's Trusted Vehicle Rental Service
        </div>

        {{-- Heading --}}
        <h1 class="sg font-extrabold text-white uppercase leading-[0.9] tracking-tight mb-8"
            style="font-size: clamp(3rem, 10vw, 7rem)">
            Explore<br>
            <span class="text-brand-sky">Nepal</span><br>
            Your Way.
        </h1>

        <p class="text-gray-400 text-base md:text-lg max-w-xl mb-10 leading-relaxed">
            From bustling city streets to remote mountain trails — rent a vehicle with an experienced driver or go self-drive. Professional, reliable, always on time.
        </p>

        {{-- CTAs --}}
        <div class="flex flex-wrap gap-4 mb-20">
            <a href="{{ route('rental.vehicles.index') }}"
               class="inline-flex items-center gap-2 bg-brand-sky hover:bg-white text-brand-dark font-bold px-8 py-4 rounded-xl text-sm transition shadow-lg shadow-brand-sky/20">
                <i class="fas fa-van-shuttle"></i>
                Browse Our Fleet
            </a>
            <a href="{{ route('contact') }}"
               class="inline-flex items-center gap-2 border border-white/15 text-white font-semibold px-8 py-4 rounded-xl text-sm transition"
               style="hover:background:rgba(255,255,255,0.06)"
               onmouseenter="this.style.background='rgba(255,255,255,0.06)'"
               onmouseleave="this.style.background='transparent'">
                <i class="fas fa-phone"></i>
                Talk to Us
            </a>
        </div>

        {{-- Stats --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 pt-10 border-t border-white/[0.07]">
            @foreach([['5+','Years of Service'],['50+','Happy Clients / Mo'],['10+','Fleet Vehicles'],['77','Districts Served']] as $stat)
                <div>
                    <div class="sg text-4xl font-extrabold text-white mb-1">{{ $stat[0] }}</div>
                    <div class="text-[11px] text-gray-600 uppercase tracking-widest">{{ $stat[1] }}</div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2">
        <span class="text-white/20 text-[10px] uppercase tracking-widest">Scroll</span>
        <div class="w-px h-8 bg-gradient-to-b from-white/20 to-transparent"></div>
    </div>
</section>

{{-- ── MARQUEE STRIP ── --}}
<div class="bg-brand-sky py-3.5 overflow-hidden">
    <div class="marquee-track flex whitespace-nowrap">
        @for($i = 0; $i < 2; $i++)
            <div class="flex items-center flex-shrink-0">
                @foreach(['Verified Drivers','Premium Fleet','24/7 Support','Secure Payments','Nepal-wide Service','Self Drive Available','Airport Transfers','Mountain Routes'] as $item)
                    <span class="text-brand-dark text-xs font-black uppercase tracking-widest px-6">{{ $item }}</span>
                    <span class="text-brand-dark/30 text-[10px]">◆</span>
                @endforeach
            </div>
        @endfor
    </div>
</div>

{{-- ── SERVICES ── --}}
<section class="bg-[#0f0f0f] py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-14 gap-6">
            <div class="reveal">
                <p class="text-brand-sky text-xs font-bold uppercase tracking-widest mb-3">What We Offer</p>
                <h2 class="sg text-4xl md:text-5xl font-extrabold text-white leading-tight">Our Services</h2>
            </div>
            <p class="text-gray-600 text-sm max-w-xs leading-relaxed reveal" style="transition-delay:0.1s">
                Tailored vehicle solutions for every kind of traveller in Nepal.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            {{-- With Driver --}}
            <div class="svc-card rounded-2xl p-7 reveal" style="background:rgba(255,255,255,0.03)">
                <div class="svc-icon w-12 h-12 rounded-xl flex items-center justify-center mb-5 text-white" style="background:rgba(255,255,255,0.08)">
                    <i class="fas fa-user-tie text-lg"></i>
                </div>
                <div class="sg text-6xl font-extrabold leading-none mb-4 select-none" style="color:rgba(255,255,255,0.06)">01</div>
                <h3 class="text-white font-bold text-xl mb-3">With Driver</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-6">
                    Sit back while our experienced, licensed drivers take you safely to your destination — anywhere in Nepal.
                </p>
                <ul class="space-y-2.5 mb-8">
                    @foreach(['Fare by distance & road difficulty','One-way or round-trip options','Payment via Khalti & eSewa'] as $feature)
                        <li class="flex items-center gap-2.5 text-xs text-gray-500">
                            <span class="w-1 h-1 bg-brand-sky rounded-full flex-shrink-0"></span>
                            {{ $feature }}
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('rental.vehicles.index') }}" class="inline-flex items-center gap-2 text-brand-sky text-xs font-semibold group">
                    Book a Driver <i class="fas fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            {{-- Self Drive — highlighted --}}
            <div class="svc-card rounded-2xl p-7 reveal relative overflow-hidden" style="background:rgba(79,195,247,0.08); border-color:rgba(79,195,247,0.2)!important; transition-delay:0.12s">
                <div class="absolute top-4 right-4 bg-brand-sky text-brand-dark text-[10px] font-black px-2.5 py-1 rounded-full uppercase tracking-wide">Popular</div>
                <div class="svc-icon w-12 h-12 rounded-xl flex items-center justify-center mb-5 text-brand-sky" style="background:rgba(79,195,247,0.2)">
                    <i class="fas fa-taxi text-lg"></i>
                </div>
                <div class="sg text-6xl font-extrabold leading-none mb-4 select-none" style="color:rgba(79,195,247,0.12)">02</div>
                <h3 class="text-white font-bold text-xl mb-3">Self Drive</h3>
                <p class="text-gray-400 text-sm leading-relaxed mb-6">
                    Take the wheel yourself. Enjoy the freedom of driving through Nepal's stunning landscapes at your own pace.
                </p>
                <ul class="space-y-2.5 mb-8">
                    @foreach(['Valid driving license required','Identity document on booking','Flexible pickup from our office'] as $feature)
                        <li class="flex items-center gap-2.5 text-xs text-gray-400">
                            <span class="w-1 h-1 bg-brand-sky rounded-full flex-shrink-0"></span>
                            {{ $feature }}
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('rental.vehicles.index') }}" class="inline-flex items-center gap-2 text-brand-sky text-xs font-semibold group">
                    Browse Self-Drive <i class="fas fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            {{-- Tours & Transfers --}}
            <div class="svc-card rounded-2xl p-7 reveal" style="background:rgba(255,255,255,0.03); transition-delay:0.24s">
                <div class="svc-icon w-12 h-12 rounded-xl flex items-center justify-center mb-5 text-white" style="background:rgba(255,255,255,0.08)">
                    <i class="fas fa-mountain-sun text-lg"></i>
                </div>
                <div class="sg text-6xl font-extrabold leading-none mb-4 select-none" style="color:rgba(255,255,255,0.06)">03</div>
                <h3 class="text-white font-bold text-xl mb-3">Tours & Transfers</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-6">
                    Airport pickups, hotel transfers, trekking base camp runs, and full-day sightseeing tours arranged on request.
                </p>
                <ul class="space-y-2.5 mb-8">
                    @foreach(['Airport & hotel transfers','Trekking access routes','Custom itineraries on request'] as $feature)
                        <li class="flex items-center gap-2.5 text-xs text-gray-500">
                            <span class="w-1 h-1 bg-brand-sky rounded-full flex-shrink-0"></span>
                            {{ $feature }}
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 text-brand-sky text-xs font-semibold group">
                    Enquire Now <i class="fas fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ── FEATURED VEHICLES ── --}}
@if($featuredVehicles->isNotEmpty())
<section class="bg-[#0b0b0b] py-24 border-t border-white/[0.04]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex items-end justify-between mb-14">
            <div class="reveal">
                <p class="text-brand-sky text-xs font-bold uppercase tracking-widest mb-3">Our Fleet</p>
                <h2 class="sg text-4xl md:text-5xl font-extrabold text-white">Featured Vehicles</h2>
            </div>
            <a href="{{ route('rental.vehicles.index') }}"
               class="hidden sm:inline-flex items-center gap-2 border border-white/15 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition reveal"
               style="transition-delay:0.1s"
               onmouseenter="this.style.background='rgba(255,255,255,0.06)'"
               onmouseleave="this.style.background='transparent'">
                View All <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($featuredVehicles as $i => $vehicle)
                <div class="veh-card group rounded-2xl overflow-hidden reveal"
                     style="background:rgba(255,255,255,0.03); transition-delay:{{ $i * 0.12 }}s">
                    <div class="relative overflow-hidden h-52">
                        <img src="{{ Storage::url($vehicle->main_image) }}"
                             alt="{{ $vehicle->vehicle_name }}"
                             class="veh-img w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <span class="absolute top-3 right-3 bg-brand-sky text-brand-dark text-[10px] font-black px-2.5 py-1 rounded-full uppercase">
                            {{ ucfirst($vehicle->condition) }}
                        </span>
                        <span class="absolute bottom-3 left-3 inline-flex items-center gap-1.5 text-white text-xs font-semibold px-2.5 py-1 rounded-full" style="background:rgba(0,0,0,0.6)">
                            <i class="fas fa-users text-brand-sky text-[10px]"></i>
                            {{ $vehicle->number_of_seats }} Seats
                        </span>
                    </div>
                    <div class="p-5">
                        <a href="{{ route('rental.vehicles.show', $vehicle) }}">
                            <h3 class="text-white font-bold text-base mb-1 group-hover:text-brand-sky transition">{{ $vehicle->vehicle_name }}</h3>
                        </a>
                        <p class="text-gray-600 text-xs mb-5">{{ $vehicle->vehicle_number }}</p>
                        <a href="{{ route('rental.bookings.create', $vehicle) }}"
                           class="block w-full text-center bg-brand-maroon hover:bg-red-700 text-white text-sm font-bold py-3 rounded-xl transition">
                            Book Now
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-8 sm:hidden">
            <a href="{{ route('rental.vehicles.index') }}"
               class="inline-flex items-center gap-2 text-brand-sky text-sm font-semibold">
                View All Vehicles <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>
    </div>
</section>
@endif

{{-- ── HOW IT WORKS ── --}}
<section class="bg-[#0f0f0f] py-24 border-t border-white/[0.04]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-16 reveal">
            <p class="text-brand-sky text-xs font-bold uppercase tracking-widest mb-3">Simple Process</p>
            <h2 class="sg text-4xl md:text-5xl font-extrabold text-white">How It Works</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                ['fa-magnifying-glass','Browse & Pick','Explore our fleet and choose the right vehicle — city car, 4WD jeep, or minibus.'],
                ['fa-file-pen','Fill Details','Enter your pickup date, destination, and contact info. Takes less than 2 minutes.'],
                ['fa-circle-check','Confirm & Go','We confirm your booking within hours. Show up and you\'re ready to go.'],
            ] as $idx => $step)
                <div class="step-wrap text-center reveal" style="transition-delay:{{ $idx * 0.13 }}s">
                    <div class="relative inline-flex mb-6">
                        <div class="step-icon w-20 h-20 border border-white/10 rounded-2xl flex items-center justify-center" style="background:rgba(255,255,255,0.04)">
                            <i class="fas {{ $step[0] }} text-brand-sky text-2xl"></i>
                        </div>
                        <span class="absolute -top-2 -right-2 bg-brand-sky text-brand-dark sg text-xs font-black w-6 h-6 rounded-full flex items-center justify-center">{{ $idx+1 }}</span>
                    </div>
                    <h3 class="text-white font-bold text-lg mb-3">{{ $step[1] }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed max-w-xs mx-auto">{{ $step[2] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── ABOUT ── --}}
<section id="about" class="bg-brand-dark py-24 border-t border-white/[0.04]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="reveal">
                <p class="text-brand-sky text-xs font-bold uppercase tracking-widest mb-3">About Caravan</p>
                <h2 class="sg text-4xl md:text-5xl font-extrabold text-white leading-tight mb-6">
                    Nepal's Roads,<br>Our Expertise.
                </h2>
                <p class="text-gray-500 text-sm leading-relaxed mb-4">
                    Caravan Vehicle Rentals has been serving locals, tourists, and businesses across Nepal for years. Based in Lalitpur, we operate a carefully maintained fleet suited for everything from Kathmandu valley commutes to remote mountain expeditions.
                </p>
                <p class="text-gray-500 text-sm leading-relaxed mb-8">
                    Our drivers know Nepal's roads intimately — from the flat Terai to the winding mountain passes — ensuring you arrive safely and on time, every time.
                </p>
                <a href="{{ route('contact') }}"
                   class="inline-flex items-center gap-2 bg-brand-sky hover:bg-white text-brand-dark font-bold px-6 py-3.5 rounded-xl text-sm transition">
                    <i class="fas fa-envelope text-xs"></i>
                    Get in Touch
                </a>
            </div>
            <div class="grid grid-cols-2 gap-4 reveal" style="transition-delay:0.15s">
                <div class="rounded-2xl p-7 text-center border border-white/[0.08]" style="background:rgba(255,255,255,0.04)">
                    <div class="sg text-5xl font-extrabold text-white mb-2">5+</div>
                    <p class="text-gray-600 text-xs uppercase tracking-widest">Years of Service</p>
                </div>
                <div class="bg-brand-sky rounded-2xl p-7 text-center">
                    <div class="sg text-5xl font-extrabold text-brand-dark mb-2">50+</div>
                    <p class="text-brand-dark/60 text-xs uppercase tracking-widest">Happy Clients / Mo</p>
                </div>
                <div class="bg-brand-maroon rounded-2xl p-7 text-center">
                    <div class="sg text-5xl font-extrabold text-white mb-2">10+</div>
                    <p class="text-white/60 text-xs uppercase tracking-widest">Fleet Vehicles</p>
                </div>
                <div class="rounded-2xl p-7 text-center border border-white/[0.08]" style="background:rgba(255,255,255,0.04)">
                    <div class="sg text-5xl font-extrabold text-white mb-2">77</div>
                    <p class="text-gray-600 text-xs uppercase tracking-widest">Districts Served</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── FAQ ── --}}
@if($faqs->isNotEmpty())
<section id="faq" class="bg-[#0b0b0b] py-24 border-t border-white/[0.04]">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-14 reveal">
            <p class="text-brand-sky text-xs font-bold uppercase tracking-widest mb-3">Questions</p>
            <h2 class="sg text-4xl md:text-5xl font-extrabold text-white">Frequently Asked</h2>
        </div>

        <div x-data="{ active: null }" class="space-y-2">
            @foreach($faqs as $i => $faq)
                <div class="faq-item rounded-xl overflow-hidden reveal" style="transition-delay:{{ $i * 0.07 }}s">
                    <button @click="active = active === {{ $i }} ? null : {{ $i }}"
                            class="w-full flex items-center justify-between px-6 py-5 text-left">
                        <span class="text-sm font-semibold text-white pr-4">{{ $faq->question }}</span>
                        <div class="w-7 h-7 rounded-lg flex items-center justify-center flex-shrink-0 transition"
                             :class="active === {{ $i }} ? 'bg-brand-sky text-brand-dark' : 'text-gray-500'"
                             :style="active === {{ $i }} ? '' : 'background:rgba(255,255,255,0.08)'">
                            <i class="fas text-xs" :class="active === {{ $i }} ? 'fa-minus' : 'fa-plus'"></i>
                        </div>
                    </button>
                    <div x-show="active === {{ $i }}"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="px-6 pb-5 text-sm text-gray-500 leading-relaxed pt-4"
                         style="display:none; border-top:1px solid rgba(255,255,255,0.05)">
                        {{ $faq->answer }}
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('faqs') }}"
               class="inline-flex items-center gap-2 border border-white/15 text-white text-sm font-semibold px-6 py-3 rounded-xl transition"
               onmouseenter="this.style.background='rgba(255,255,255,0.05)'"
               onmouseleave="this.style.background='transparent'">
                View All FAQs <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>
    </div>
</section>
@endif

{{-- ── POLICIES ── --}}
@if($policies->isNotEmpty())
<section id="policies" class="bg-[#0f0f0f] py-24 border-t border-white/[0.04]">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-14 reveal">
            <p class="text-brand-sky text-xs font-bold uppercase tracking-widest mb-3">Terms</p>
            <h2 class="sg text-4xl md:text-5xl font-extrabold text-white">Our Policies</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($policies as $idx => $policy)
                @php $colors = $policy->colorClasses(); @endphp
                <div class="rounded-2xl p-6 transition-colors reveal"
                     style="background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.07); transition-delay:{{ ($idx % 2) * 0.12 }}s"
                     onmouseenter="this.style.borderColor='rgba(255,255,255,0.15)'"
                     onmouseleave="this.style.borderColor='rgba(255,255,255,0.07)'">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-10 h-10 rounded-xl {{ $colors['bg'] }} flex items-center justify-center flex-shrink-0">
                            <i class="fas {{ $policy->icon }} {{ $colors['icon'] }} text-sm"></i>
                        </div>
                        <h3 class="font-bold text-white text-sm">{{ $policy->title }}</h3>
                    </div>
                    <ul class="space-y-2">
                        @foreach($policy->items as $item)
                            <li class="flex items-start gap-2.5 text-xs text-gray-500">
                                <span class="w-1 h-1 rounded-full mt-1.5 flex-shrink-0" style="background:rgba(79,195,247,0.5)"></span>
                                {{ $item }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('policies') }}"
               class="inline-flex items-center gap-2 border border-white/15 text-white text-sm font-semibold px-6 py-3 rounded-xl transition"
               onmouseenter="this.style.background='rgba(255,255,255,0.05)'"
               onmouseleave="this.style.background='transparent'">
                View All Policies <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>
    </div>
</section>
@endif

{{-- ── CTA BANNER ── --}}
<section class="relative bg-[#0b0b0b] py-28 border-t border-white/[0.04] overflow-hidden">
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none overflow-hidden">
        <div class="sg font-extrabold text-white leading-none select-none whitespace-nowrap" style="font-size:22vw; color:rgba(255,255,255,0.025)">CARAVAN</div>
    </div>
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[300px] rounded-full blur-[100px]" style="background:rgba(79,195,247,0.04)"></div>
    </div>

    <div class="relative max-w-3xl mx-auto px-4 sm:px-6 text-center">
        <p class="text-brand-sky text-xs font-bold uppercase tracking-widest mb-4 reveal">Ready?</p>
        <h2 class="sg text-4xl md:text-6xl font-extrabold text-white mb-6 leading-tight reveal" style="transition-delay:0.1s">
            Start Your<br>Journey Today.
        </h2>
        <p class="text-gray-500 text-sm mb-10 max-w-md mx-auto leading-relaxed reveal" style="transition-delay:0.2s">
            Browse our fleet, pick your vehicle, and book online in minutes. Or contact us — we're happy to help plan your trip.
        </p>
        <div class="flex flex-wrap justify-center gap-4 reveal" style="transition-delay:0.3s">
            <a href="{{ route('rental.vehicles.index') }}"
               class="inline-flex items-center gap-2 bg-brand-sky hover:bg-white text-brand-dark font-bold px-8 py-4 rounded-xl text-sm transition shadow-lg shadow-brand-sky/15">
                <i class="fas fa-van-shuttle"></i>
                View All Vehicles
            </a>
            <a href="{{ route('contact') }}"
               class="inline-flex items-center gap-2 bg-brand-maroon hover:bg-red-700 text-white font-bold px-8 py-4 rounded-xl text-sm transition">
                <i class="fas fa-envelope"></i>
                Contact Us
            </a>
        </div>
    </div>
</section>

{{-- Scroll reveal observer --}}
<script>
    (function () {
        var els = document.querySelectorAll('.reveal');
        var obs = new IntersectionObserver(function (entries) {
            entries.forEach(function (e) {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                    obs.unobserve(e.target);
                }
            });
        }, { threshold: 0.1 });
        els.forEach(function (el) { obs.observe(el); });
    })();
</script>

@endsection
