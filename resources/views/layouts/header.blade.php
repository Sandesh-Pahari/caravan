<nav x-data="{ open: false }" class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex items-center justify-between h-16">

            {{-- Brand Logo + Name --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 flex-shrink-0">
                <div class="w-9 h-9 bg-brand-blue rounded-lg flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-van-shuttle text-white" style="font-size: 16px;"></i>
                </div>
                <div class="leading-tight">
                    <span class="block text-base font-bold text-brand-dark tracking-tight">Caravan</span>
                    <span class="block text-[10px] text-gray-400 font-medium tracking-widest uppercase leading-none">Vehicle Rentals</span>
                </div>
            </a>

            {{-- Desktop Nav Links --}}
            <div class="hidden md:flex items-center gap-0.5">
                <a href="{{ route('home') }}"
                   class="px-3 py-2 rounded-lg text-sm font-medium transition
                       {{ request()->routeIs('home') ? 'text-brand-blue bg-brand-blue/5' : 'text-gray-600 hover:text-brand-dark hover:bg-gray-50' }}">
                    Home
                </a>
                <a href="{{ route('home') }}#about"
                   class="px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:text-brand-dark hover:bg-gray-50 transition">
                    About Us
                </a>
                <a href="{{ route('rental.vehicles.index') }}"
                   class="px-3 py-2 rounded-lg text-sm font-medium transition
                       {{ request()->routeIs('rental.vehicles.*') || request()->routeIs('rental.bookings.*') ? 'text-brand-blue bg-brand-blue/5' : 'text-gray-600 hover:text-brand-dark hover:bg-gray-50' }}">
                    Vehicles
                </a>
                <a href="{{ route('contact') }}"
                   class="px-3 py-2 rounded-lg text-sm font-medium transition
                       {{ request()->routeIs('contact') ? 'text-brand-blue bg-brand-blue/5' : 'text-gray-600 hover:text-brand-dark hover:bg-gray-50' }}">
                    Contact
                </a>
                <a href="{{ route('faqs') }}"
                   class="px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:text-brand-dark hover:bg-gray-50 transition">
                    FAQ
                </a>
                <a href="{{ route('policies') }}"
                   class="px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:text-brand-dark hover:bg-gray-50 transition">
                    Policies
                </a>
            </div>

            {{-- Right Side Actions --}}
            <div class="flex items-center gap-2">

                {{-- Admin Dashboard Icon --}}
                @auth
                    <a href="{{ route('admin.dashboard') }}"
                       title="Admin Dashboard"
                       class="w-9 h-9 rounded-lg bg-brand-blue/10 text-brand-blue flex items-center justify-center hover:bg-brand-blue hover:text-white transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       title="Admin Login"
                       class="w-9 h-9 rounded-lg bg-gray-100 text-gray-400 flex items-center justify-center hover:bg-brand-blue hover:text-white transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </a>
                @endauth

                {{-- Book Now CTA --}}
                <a href="{{ route('rental.vehicles.index') }}"
                   class="hidden sm:inline-flex items-center gap-1.5 bg-brand-maroon text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-red-800 transition">
                    Book Now
                </a>

                {{-- Mobile Hamburger --}}
                <button @click="open = !open"
                        class="md:hidden w-9 h-9 rounded-lg flex items-center justify-center text-brand-dark hover:bg-gray-100 transition">
                    <svg x-show="!open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Dropdown Menu --}}
    <div x-show="open"
         x-transition:enter="transition ease-out duration-150"
         x-transition:enter-start="opacity-0 -translate-y-1"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-1"
         class="md:hidden border-t border-gray-100 bg-white"
         style="display: none;">
        <div class="px-4 py-3 space-y-1">
            <a href="{{ route('home') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
                   {{ request()->routeIs('home') ? 'text-brand-blue bg-brand-blue/5' : 'text-gray-700 hover:bg-gray-50' }}">
                <i class="fas fa-house w-4 text-center text-xs opacity-60"></i>
                Home
            </a>
            <a href="{{ route('home') }}#about"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                <i class="fas fa-circle-info w-4 text-center text-xs opacity-60"></i>
                About Us
            </a>
            <a href="{{ route('rental.vehicles.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
                   {{ request()->routeIs('rental.vehicles.*') ? 'text-brand-blue bg-brand-blue/5' : 'text-gray-700 hover:bg-gray-50' }}">
                <i class="fas fa-van-shuttle w-4 text-center text-xs opacity-60"></i>
                Vehicles
            </a>
            <a href="{{ route('contact') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
                   {{ request()->routeIs('contact') ? 'text-brand-blue bg-brand-blue/5' : 'text-gray-700 hover:bg-gray-50' }}">
                <i class="fas fa-envelope w-4 text-center text-xs opacity-60"></i>
                Contact
            </a>
            <a href="{{ route('faqs') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                <i class="fas fa-circle-question w-4 text-center text-xs opacity-60"></i>
                FAQ
            </a>
            <a href="{{ route('policies') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                <i class="fas fa-file-lines w-4 text-center text-xs opacity-60"></i>
                Policies
            </a>

            <div class="pt-3 pb-1 border-t border-gray-100">
                <a href="{{ route('rental.vehicles.index') }}"
                   class="flex items-center justify-center w-full bg-brand-maroon text-white py-2.5 rounded-lg text-sm font-semibold hover:bg-red-800 transition">
                    Book Now
                </a>
            </div>
        </div>
    </div>
</nav>
