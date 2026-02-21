<footer class="bg-brand-dark text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 pt-12 pb-8">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8">

            {{-- Company Info --}}
            <div class="md:col-span-5">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 mb-4">
                    <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0">
                        <img src="{{ asset('car/logo.png') }}" alt="Caravan Logo" class="w-16 h-16">
                    </div>
                    <div class="leading-tight">
                        <span class="block text-base font-bold text-white tracking-tight">Caravan</span>
                        <span class="block text-[10px] text-white/40 font-medium tracking-widest uppercase leading-none">Vehicle Rentals</span>
                    </div>
                </a>
                <p class="text-sm text-white/55 leading-relaxed mb-6 max-w-sm">
                    Your trusted vehicle rental partner in Nepal. We offer premium vehicles with experienced drivers for all types of journeys — from city transfers to Himalayan adventures.
                </p>
                {{-- Social Links --}}
                <div class="flex items-center gap-3">
                    <a href="#" target="_blank" rel="noopener noreferrer"
                       title="Facebook"
                       class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center text-white/60 hover:bg-brand-blue hover:text-white transition">
                        <i class="fab fa-facebook-f text-xs"></i>
                    </a>
                    <a href="#" target="_blank" rel="noopener noreferrer"
                       title="Instagram"
                       class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center text-white/60 hover:bg-brand-maroon hover:text-white transition">
                        <i class="fab fa-instagram text-xs"></i>
                    </a>
                    <a href="#" target="_blank" rel="noopener noreferrer"
                       title="WhatsApp"
                       class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center text-white/60 hover:bg-brand-forest hover:text-white transition">
                        <i class="fab fa-whatsapp text-xs"></i>
                    </a>
                    <a href="#" target="_blank" rel="noopener noreferrer"
                       title="YouTube"
                       class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center text-white/60 hover:bg-red-600 hover:text-white transition">
                        <i class="fab fa-youtube text-xs"></i>
                    </a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="md:col-span-3">
                <h3 class="text-xs font-semibold text-white uppercase tracking-wider mb-4">Quick Links</h3>
                <ul class="space-y-2.5">
                    <li>
                        <a href="{{ route('home') }}"
                           class="text-sm text-white/55 hover:text-white transition flex items-center gap-2">
                            <span class="w-1 h-1 rounded-full bg-brand-blue flex-shrink-0"></span>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('rental.vehicles.index') }}"
                           class="text-sm text-white/55 hover:text-white transition flex items-center gap-2">
                            <span class="w-1 h-1 rounded-full bg-brand-blue flex-shrink-0"></span>
                            Our Vehicles
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}"
                           class="text-sm text-white/55 hover:text-white transition flex items-center gap-2">
                            <span class="w-1 h-1 rounded-full bg-brand-blue flex-shrink-0"></span>
                            Contact Us
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('home') }}#about"
                           class="text-sm text-white/55 hover:text-white transition flex items-center gap-2">
                            <span class="w-1 h-1 rounded-full bg-brand-blue flex-shrink-0"></span>
                            About Us
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('faqs') }}"
                           class="text-sm text-white/55 hover:text-white transition flex items-center gap-2">
                            <span class="w-1 h-1 rounded-full bg-brand-blue flex-shrink-0"></span>
                            FAQ
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('policies') }}"
                           class="text-sm text-white/55 hover:text-white transition flex items-center gap-2">
                            <span class="w-1 h-1 rounded-full bg-brand-blue flex-shrink-0"></span>
                            Policies
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Contact Info --}}
            <div class="md:col-span-4">
                <h3 class="text-xs font-semibold text-white uppercase tracking-wider mb-4">Get In Touch</h3>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <div class="w-7 h-7 rounded-md bg-white/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-location-dot text-brand-sky text-xs"></i>
                        </div>
                        <div>
                            <p class="text-sm text-white/80">Kumaripati, Lalitpur</p>
                            <p class="text-xs text-white/40 mt-0.5">Nepal</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="w-7 h-7 rounded-md bg-white/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-phone text-brand-sky text-xs"></i>
                        </div>
                        <div>
                            <a href="tel:+015592370" class="text-sm text-white/80 hover:text-white transition">+015592370</a>
                            <p class="text-xs text-white/40 mt-0.5">Sun–Fri, 9 AM – 5 PM</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="w-7 h-7 rounded-md bg-white/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-envelope text-brand-sky text-xs"></i>
                        </div>
                        <div>
                            <a href="mailto:sudanshah.chef@gmail.com"
                               class="text-sm text-white/80 hover:text-white transition break-all">
                                sudanshah.chef@gmail.com
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Bottom Bar --}}
    <div class="border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-2">
            <p class="text-xs text-white/35">
                &copy; {{ date('Y') }} Caravan Vehicle Rentals. All rights reserved.
            </p>
            <p class="text-xs text-white/35">
                Made with <span class="text-brand-maroon">&#9829;</span> in Nepal
            </p>
        </div>
    </div>
</footer>
