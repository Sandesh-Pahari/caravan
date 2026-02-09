@extends('template.template')

@section('pagecontent')

    {{-- ── Hero Section ── --}}
    <section class="relative bg-brand-dark overflow-hidden">
        {{-- Background gradient + decorative shapes --}}
        <div class="absolute inset-0 bg-gradient-to-br from-brand-dark via-brand-slate to-brand-blue opacity-90"></div>
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-brand-blue/20 blur-3xl"></div>
            <div class="absolute bottom-0 -left-20 w-80 h-80 rounded-full bg-brand-maroon/20 blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 py-20 md:py-28">
            <div class="max-w-3xl">
                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 bg-white/10 text-white/80 text-xs font-medium px-3 py-1.5 rounded-full mb-6 backdrop-blur-sm">
                    <i class="fas fa-mountain-sun text-brand-sky"></i>
                    Nepal's Trusted Vehicle Rental Service
                </div>

                {{-- Heading --}}
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-5">
                    Explore Nepal<br>
                    <span class="text-brand-sky">Your Way</span>
                </h1>
                <p class="text-base md:text-lg text-white/65 leading-relaxed mb-8 max-w-2xl">
                    From bustling city streets to remote mountain trails — rent a vehicle with an experienced driver or go self-drive. Professional, reliable, and always on time.
                </p>

                {{-- CTAs --}}
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('rental.vehicles.index') }}"
                       class="inline-flex items-center gap-2 bg-brand-maroon hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-xl transition text-sm shadow-lg shadow-brand-maroon/30">
                        <i class="fas fa-van-shuttle"></i>
                        Browse Vehicles
                    </a>
                    <a href="{{ route('contact') }}"
                       class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white font-semibold px-6 py-3 rounded-xl transition text-sm backdrop-blur-sm border border-white/20">
                        <i class="fas fa-phone"></i>
                        Talk to Us
                    </a>
                </div>

                {{-- Trust badges --}}
                <div class="flex flex-wrap gap-6 mt-10 pt-8 border-t border-white/10">
                    <div class="flex items-center gap-2 text-white/60 text-sm">
                        <i class="fas fa-shield-halved text-brand-sky"></i>
                        Verified Drivers
                    </div>
                    <div class="flex items-center gap-2 text-white/60 text-sm">
                        <i class="fas fa-clock text-brand-sky"></i>
                        24/7 Support
                    </div>
                    <div class="flex items-center gap-2 text-white/60 text-sm">
                        <i class="fas fa-star text-brand-sky"></i>
                        Premium Fleet
                    </div>
                    <div class="flex items-center gap-2 text-white/60 text-sm">
                        <i class="fas fa-lock text-brand-sky"></i>
                        Secure Payments
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── Services Section ── --}}
    <section class="bg-brand-bg py-16 md:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-12">
                <p class="text-xs font-semibold text-brand-maroon uppercase tracking-widest mb-2">What We Offer</p>
                <h2 class="text-3xl font-bold text-brand-dark">Our Services</h2>
                <div class="w-12 h-0.5 bg-brand-blue mx-auto mt-3 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- With Driver --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition group">
                    <div class="w-12 h-12 bg-brand-blue/10 rounded-xl flex items-center justify-center mb-5 group-hover:bg-brand-blue group-hover:text-white transition">
                        <i class="fas fa-user-tie text-brand-blue group-hover:text-white text-lg transition"></i>
                    </div>
                    <h3 class="text-lg font-bold text-brand-dark mb-2">With Driver</h3>
                    <p class="text-sm text-gray-500 leading-relaxed mb-4">
                        Sit back and relax while our experienced, licensed drivers take you safely to your destination — anywhere in Nepal.
                    </p>
                    <ul class="space-y-2">
                        <li class="flex items-center gap-2 text-xs text-gray-500">
                            <i class="fas fa-check text-brand-forest text-xs"></i>
                            Fare calculated by distance &amp; road difficulty
                        </li>
                        <li class="flex items-center gap-2 text-xs text-gray-500">
                            <i class="fas fa-check text-brand-forest text-xs"></i>
                            One-way or round-trip options
                        </li>
                        <li class="flex items-center gap-2 text-xs text-gray-500">
                            <i class="fas fa-check text-brand-forest text-xs"></i>
                            Online payment via Stripe, Khalti &amp; eSewa
                        </li>
                    </ul>
                </div>

                {{-- Self Drive --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition group">
                    <div class="w-12 h-12 bg-brand-maroon/10 rounded-xl flex items-center justify-center mb-5 group-hover:bg-brand-maroon group-hover:text-white transition">
                        <i class="fas fa-steering-wheel text-brand-maroon group-hover:text-white text-lg transition"></i>
                    </div>
                    <h3 class="text-lg font-bold text-brand-dark mb-2">Self Drive</h3>
                    <p class="text-sm text-gray-500 leading-relaxed mb-4">
                        Take the wheel yourself. Enjoy the freedom of driving through Nepal's stunning landscapes at your own pace.
                    </p>
                    <ul class="space-y-2">
                        <li class="flex items-center gap-2 text-xs text-gray-500">
                            <i class="fas fa-check text-brand-forest text-xs"></i>
                            Valid driving license required
                        </li>
                        <li class="flex items-center gap-2 text-xs text-gray-500">
                            <i class="fas fa-check text-brand-forest text-xs"></i>
                            Identity document upload on booking
                        </li>
                        <li class="flex items-center gap-2 text-xs text-gray-500">
                            <i class="fas fa-check text-brand-forest text-xs"></i>
                            Flexible pickup from our office
                        </li>
                    </ul>
                </div>

                {{-- Tours & Transfers --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition group">
                    <div class="w-12 h-12 bg-brand-slate/10 rounded-xl flex items-center justify-center mb-5 group-hover:bg-brand-slate group-hover:text-white transition">
                        <i class="fas fa-mountain-sun text-brand-slate group-hover:text-white text-lg transition"></i>
                    </div>
                    <h3 class="text-lg font-bold text-brand-dark mb-2">Tours &amp; Transfers</h3>
                    <p class="text-sm text-gray-500 leading-relaxed mb-4">
                        Airport pickups, hotel transfers, trekking base camp runs, and full-day sightseeing tours arranged on request.
                    </p>
                    <ul class="space-y-2">
                        <li class="flex items-center gap-2 text-xs text-gray-500">
                            <i class="fas fa-check text-brand-forest text-xs"></i>
                            Airport &amp; hotel transfers
                        </li>
                        <li class="flex items-center gap-2 text-xs text-gray-500">
                            <i class="fas fa-check text-brand-forest text-xs"></i>
                            Trekking access routes
                        </li>
                        <li class="flex items-center gap-2 text-xs text-gray-500">
                            <i class="fas fa-check text-brand-forest text-xs"></i>
                            Custom itineraries on request
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- ── Featured Vehicles ── --}}
    @if($featuredVehicles->isNotEmpty())
        <section class="bg-white py-16 md:py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">
                <div class="flex items-end justify-between mb-10">
                    <div>
                        <p class="text-xs font-semibold text-brand-maroon uppercase tracking-widest mb-2">Our Fleet</p>
                        <h2 class="text-3xl font-bold text-brand-dark">Featured Vehicles</h2>
                    </div>
                    <a href="{{ route('rental.vehicles.index') }}"
                       class="hidden sm:inline-flex items-center gap-1.5 text-sm font-medium text-brand-blue hover:text-brand-slate transition">
                        View All
                        <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($featuredVehicles as $vehicle)
                        <div class="bg-brand-bg rounded-2xl overflow-hidden hover:shadow-lg transition group border border-gray-100">
                            <a href="{{ route('rental.vehicles.show', $vehicle) }}" class="block overflow-hidden h-48">
                                <img src="{{ Storage::url($vehicle->main_image) }}"
                                     alt="{{ $vehicle->vehicle_name }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            </a>
                            <div class="p-5">
                                <a href="{{ route('rental.vehicles.show', $vehicle) }}">
                                    <h3 class="text-base font-bold text-brand-dark hover:text-brand-blue transition mb-1">
                                        {{ $vehicle->vehicle_name }}
                                    </h3>
                                </a>
                                <p class="text-xs text-gray-400 mb-3">{{ $vehicle->vehicle_number }}</p>
                                <div class="flex items-center gap-2 flex-wrap mb-4">
                                    <span class="inline-flex items-center gap-1 text-xs bg-brand-blue/10 text-brand-blue px-2.5 py-1 rounded-full font-medium">
                                        <i class="fas fa-users text-[10px]"></i>
                                        {{ $vehicle->number_of_seats }} Seats
                                    </span>
                                    <span class="inline-flex items-center gap-1 text-xs bg-gray-100 text-gray-600 px-2.5 py-1 rounded-full font-medium">
                                        {{ ucfirst($vehicle->condition) }}
                                    </span>
                                </div>
                                <a href="{{ route('rental.bookings.create', $vehicle) }}"
                                   class="block w-full text-center bg-brand-maroon hover:bg-red-800 text-white text-sm font-semibold py-2.5 rounded-xl transition">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-8 sm:hidden">
                    <a href="{{ route('rental.vehicles.index') }}"
                       class="inline-flex items-center gap-2 text-sm font-medium text-brand-blue hover:text-brand-slate transition">
                        View All Vehicles
                        <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
        </section>
    @endif

    {{-- ── About Section ── --}}
    <section id="about" class="bg-brand-bg py-16 md:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <p class="text-xs font-semibold text-brand-maroon uppercase tracking-widest mb-2">About Caravan</p>
                    <h2 class="text-3xl font-bold text-brand-dark mb-5">Nepal's Roads, <br>Our Expertise</h2>
                    <p class="text-sm text-gray-500 leading-relaxed mb-4">
                        Caravan Vehicle Rentals has been serving locals, tourists, and businesses across Nepal for years. Based in Lalitpur, we operate a carefully maintained fleet of vehicles suited for everything from Kathmandu valley commutes to remote mountain expeditions.
                    </p>
                    <p class="text-sm text-gray-500 leading-relaxed mb-6">
                        Our drivers know Nepal's roads intimately — from the flat Terai to the winding mountain passes — ensuring you arrive safely and on time, every time.
                    </p>
                    <a href="{{ route('contact') }}"
                       class="inline-flex items-center gap-2 bg-brand-blue hover:bg-brand-slate text-white font-semibold px-5 py-2.5 rounded-xl text-sm transition">
                        <i class="fas fa-envelope text-xs"></i>
                        Get in Touch
                    </a>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white rounded-2xl border border-gray-100 p-6 text-center shadow-sm">
                        <div class="text-3xl font-bold text-brand-blue mb-1">5+</div>
                        <p class="text-xs text-gray-500 font-medium">Years of Service</p>
                    </div>
                    <div class="bg-brand-blue rounded-2xl p-6 text-center">
                        <div class="text-3xl font-bold text-white mb-1">50+</div>
                        <p class="text-xs text-white/70 font-medium">Happy Clients Monthly</p>
                    </div>
                    <div class="bg-brand-maroon rounded-2xl p-6 text-center">
                        <div class="text-3xl font-bold text-white mb-1">10+</div>
                        <p class="text-xs text-white/70 font-medium">Vehicles in Fleet</p>
                    </div>
                    <div class="bg-white rounded-2xl border border-gray-100 p-6 text-center shadow-sm">
                        <div class="text-3xl font-bold text-brand-slate mb-1">77</div>
                        <p class="text-xs text-gray-500 font-medium">Districts Served</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── FAQ Section ── --}}
    @if($faqs->isNotEmpty())
    <section id="faq" class="bg-white py-16 md:py-20">
        <div class="max-w-3xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-12">
                <p class="text-xs font-semibold text-brand-maroon uppercase tracking-widest mb-2">Questions</p>
                <h2 class="text-3xl font-bold text-brand-dark">Frequently Asked</h2>
                <div class="w-12 h-0.5 bg-brand-blue mx-auto mt-3 rounded-full"></div>
            </div>

            <div x-data="{ active: null }" class="space-y-3">
                @foreach($faqs as $i => $faq)
                    <div class="rounded-xl border border-gray-200 overflow-hidden">
                        <button @click="active = active === {{ $i }} ? null : {{ $i }}"
                                class="w-full flex items-center justify-between px-5 py-4 text-left hover:bg-gray-50 transition">
                            <span class="text-sm font-semibold text-brand-dark">{{ $faq->question }}</span>
                            <i class="fas text-gray-400 text-xs flex-shrink-0 ml-3"
                               :class="active === {{ $i }} ? 'fa-chevron-up text-brand-blue' : 'fa-chevron-down'"></i>
                        </button>
                        <div x-show="active === {{ $i }}"
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0"
                             x-transition:enter-end="opacity-100"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"
                             class="px-5 pb-4 text-sm text-gray-500 leading-relaxed border-t border-gray-100 pt-3"
                             style="display:none;">
                            {{ $faq->answer }}
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('faqs') }}"
                   class="inline-flex items-center gap-2 text-sm font-semibold text-brand-blue hover:text-brand-slate transition">
                    View All FAQs
                    <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- ── Policies Section ── --}}
    @if($policies->isNotEmpty())
    <section id="policies" class="bg-brand-bg py-16 md:py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-12">
                <p class="text-xs font-semibold text-brand-maroon uppercase tracking-widest mb-2">Terms</p>
                <h2 class="text-3xl font-bold text-brand-dark">Our Policies</h2>
                <div class="w-12 h-0.5 bg-brand-blue mx-auto mt-3 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                @foreach($policies as $policy)
                    @php $colors = $policy->colorClasses(); @endphp
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-9 h-9 rounded-lg {{ $colors['bg'] }} flex items-center justify-center flex-shrink-0">
                                <i class="fas {{ $policy->icon }} {{ $colors['icon'] }} text-sm"></i>
                            </div>
                            <h3 class="font-bold text-brand-dark text-sm">{{ $policy->title }}</h3>
                        </div>
                        <ul class="space-y-2">
                            @foreach($policy->items as $item)
                                <li class="flex items-start gap-2 text-xs text-gray-500">
                                    <i class="fas fa-circle {{ $colors['dot'] }} mt-1.5" style="font-size: 4px;"></i>
                                    {{ $item }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('policies') }}"
                   class="inline-flex items-center gap-2 text-sm font-semibold text-brand-blue hover:text-brand-slate transition">
                    View All Policies
                    <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- ── CTA Banner ── --}}
    <section class="bg-brand-blue py-14">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center">
            <h2 class="text-2xl md:text-3xl font-bold text-white mb-3">Ready to Start Your Journey?</h2>
            <p class="text-sm text-white/65 mb-8 max-w-lg mx-auto">
                Browse our fleet, pick your vehicle, and book online in minutes. Or send us a message — we're happy to help plan your trip.
            </p>
            <div class="flex flex-wrap justify-center gap-3">
                <a href="{{ route('rental.vehicles.index') }}"
                   class="inline-flex items-center gap-2 bg-white text-brand-blue font-bold px-6 py-3 rounded-xl hover:bg-brand-bg transition text-sm shadow-lg">
                    <i class="fas fa-van-shuttle"></i>
                    View All Vehicles
                </a>
                <a href="{{ route('contact') }}"
                   class="inline-flex items-center gap-2 bg-brand-maroon text-white font-semibold px-6 py-3 rounded-xl hover:bg-red-700 transition text-sm">
                    <i class="fas fa-envelope"></i>
                    Contact Us
                </a>
            </div>
        </div>
    </section>

@endsection
