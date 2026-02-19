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
    .dark-input {
        width: 100%;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: 0.75rem;
        padding: 0.75rem 1rem;
        font-size: 0.875rem;
        color: white;
        outline: none;
        transition: border-color 0.2s ease;
    }
    .dark-input::placeholder { color: rgba(255,255,255,0.25); }
    .dark-input:focus { border-color: #4FC3F7; }
    .dark-input:focus-visible { box-shadow: 0 0 0 3px rgba(79,195,247,0.15); }
</style>

{{-- ── HERO ── --}}
<section class="relative bg-[#0b0b0b] overflow-hidden">
    <div class="absolute inset-0 hero-grid pointer-events-none"></div>
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 right-0 w-[400px] h-[400px] rounded-full blur-[120px]" style="background:rgba(79,195,247,0.05)"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 pt-16 pb-14">
        <nav class="flex items-center gap-2 text-xs text-white/40 mb-6">
            <a href="{{ route('home') }}" class="hover:text-white/70 transition">Home</a>
            <i class="fas fa-chevron-right text-[9px]"></i>
            <span class="text-white/70">Contact</span>
        </nav>
        <div class="inline-flex items-center gap-2 border border-brand-sky/25 text-brand-sky text-xs font-semibold px-4 py-2 rounded-full mb-5" style="background:rgba(79,195,247,0.06)">
            <i class="fas fa-envelope text-xs"></i>
            Get In Touch
        </div>
        <h1 class="sg font-extrabold text-white leading-tight mb-3" style="font-size:clamp(2.5rem,6vw,4.5rem)">Let's Talk.</h1>
        <p class="text-gray-500 text-sm max-w-md leading-relaxed">Have a question about our vehicles or services? Fill out the form and we'll get back to you within 24 hours.</p>
    </div>
</section>

{{-- ── CONTENT ── --}}
<div class="bg-[#0f0f0f] min-h-screen">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 py-14">

        {{-- Flash --}}
        <div id="flashMessage" class="hidden mb-8 px-5 py-4 rounded-xl text-sm text-center font-medium"></div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">

            {{-- Left: Info --}}
            <div class="lg:col-span-2 space-y-5 reveal">

                {{-- Contact Details --}}
                <div class="rounded-2xl overflow-hidden" style="background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.08)">
                    <div class="px-6 py-4 border-b" style="background:rgba(79,195,247,0.08); border-color:rgba(79,195,247,0.15)">
                        <p class="text-brand-sky text-xs font-bold uppercase tracking-widest">Contact Information</p>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background:rgba(79,195,247,0.1)">
                                <i class="fas fa-location-dot text-brand-sky"></i>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-gray-600 uppercase tracking-widest mb-0.5">Address</p>
                                <p class="text-sm font-semibold text-white">Kumaripati, Lalitpur, Nepal</p>
                                <p class="text-xs text-gray-600 mt-0.5">Open Sunday–Friday, 9AM–5PM</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background:rgba(79,195,247,0.1)">
                                <i class="fas fa-phone text-brand-sky"></i>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-gray-600 uppercase tracking-widest mb-0.5">Phone</p>
                                <p class="text-sm font-semibold text-white">+015592370</p>
                                <a href="tel:+015592370" class="text-xs text-brand-sky hover:text-white transition mt-0.5 inline-block">Click to call →</a>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background:rgba(79,195,247,0.1)">
                                <i class="fas fa-envelope text-brand-sky"></i>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-gray-600 uppercase tracking-widest mb-0.5">Email</p>
                                <p class="text-sm font-semibold text-white">sudanshah.chef@gmail.com</p>
                                <a href="mailto:sudanshah.chef@gmail.com" class="text-xs text-brand-sky hover:text-white transition mt-0.5 inline-block">Send email →</a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Social --}}
                <div class="rounded-2xl p-6" style="background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.08)">
                    <p class="text-[11px] font-bold text-gray-600 uppercase tracking-widest mb-4">Follow Us</p>
                    <div class="flex flex-wrap gap-3">
                        <a href="#" target="_blank" rel="noopener noreferrer" title="Facebook"
                           class="w-10 h-10 rounded-xl flex items-center justify-center text-white transition"
                           style="background:rgba(255,255,255,0.08)"
                           onmouseenter="this.style.background='#1F3C88'" onmouseleave="this.style.background='rgba(255,255,255,0.08)'">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                        </a>
                        <a href="#" target="_blank" rel="noopener noreferrer" title="Instagram"
                           class="w-10 h-10 rounded-xl flex items-center justify-center text-white transition"
                           style="background:rgba(255,255,255,0.08)"
                           onmouseenter="this.style.background='#8B1E2D'" onmouseleave="this.style.background='rgba(255,255,255,0.08)'">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5" stroke-width="2"/><circle cx="12" cy="12" r="4" stroke-width="2"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>
                        </a>
                        <a href="#" target="_blank" rel="noopener noreferrer" title="WhatsApp"
                           class="w-10 h-10 rounded-xl flex items-center justify-center text-white transition"
                           style="background:rgba(255,255,255,0.08)"
                           onmouseenter="this.style.background='#2E7D32'" onmouseleave="this.style.background='rgba(255,255,255,0.08)'">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 2C6.477 2 2 6.477 2 12c0 1.89.525 3.66 1.438 5.168L2 22l4.978-1.394A9.96 9.96 0 0012 22c5.523 0 10-4.477 10-10S17.523 2 12 2z"/></svg>
                        </a>
                        <a href="#" target="_blank" rel="noopener noreferrer" title="YouTube"
                           class="w-10 h-10 rounded-xl flex items-center justify-center text-white transition"
                           style="background:rgba(255,255,255,0.08)"
                           onmouseenter="this.style.background='#dc2626'" onmouseleave="this.style.background='rgba(255,255,255,0.08)'">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M22.54 6.42a2.78 2.78 0 00-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 00-1.95 1.96A29 29 0 001 12a29 29 0 00.46 5.58A2.78 2.78 0 003.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 001.95-1.95A29 29 0 0023 12a29 29 0 00-.46-5.58z"/><polygon fill="white" points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"/></svg>
                        </a>
                    </div>
                </div>

                {{-- Trust badges --}}
                <div class="rounded-2xl p-6 space-y-3" style="background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.08)">
                    @foreach(['We respond within 24 hours','Available Sun–Fri, 9AM–5PM','Serving all 77 districts of Nepal'] as $badge)
                        <div class="flex items-center gap-3 text-xs text-gray-500">
                            <span class="w-5 h-5 rounded-lg flex items-center justify-center flex-shrink-0" style="background:rgba(79,195,247,0.1)">
                                <i class="fas fa-check text-brand-sky" style="font-size:9px"></i>
                            </span>
                            {{ $badge }}
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Right: Form --}}
            <div class="lg:col-span-3 reveal" style="transition-delay:0.12s">
                <div class="rounded-2xl overflow-hidden" style="background:rgba(252, 0, 0, 0.03); border:1px solid rgba(255,255,255,0.08)">
                    <div class="px-6 py-5 border-b" style="background:rgba(63, 176, 202, 0.15); border-color:rgba(139,30,45,0.25)">
                        <h2 class="text-white font-bold text-base">Send Us a Message</h2>
                        <p class="text-gray-500 text-xs mt-0.5">We'll respond within 24 hours</p>
                    </div>
                    <form id="contactForm" class="p-6 space-y-5">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Full Name <span class="text-brand-maroon">*</span></label>
                                <input type="text" name="name" required placeholder="Your full name" class="dark-input">
                                <p class="text-brand-maroon text-xs mt-1.5 hidden error-name"></p>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Email Address <span class="text-brand-maroon">*</span></label>
                                <input type="email" name="email" required placeholder="you@example.com" class="dark-input">
                                <p class="text-brand-maroon text-xs mt-1.5 hidden error-email"></p>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Phone Number</label>
                            <input type="tel" name="phone" placeholder="+977 98XXXXXXXX" class="dark-input">
                            <p class="text-brand-maroon text-xs mt-1.5 hidden error-phone"></p>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Message <span class="text-brand-maroon">*</span></label>
                            <textarea name="message" rows="5" required
                                      placeholder="Tell us about your enquiry — vehicle type, dates, destination…"
                                      class="dark-input resize-none" style="height:auto"></textarea>
                            <p class="text-brand-maroon text-xs mt-1.5 hidden error-message"></p>
                        </div>
                        <div class="pt-1">
                            <button type="submit" id="submitBtn"
                                    class="w-full bg-brand-sky hover:bg-white text-brand-dark font-bold py-3.5 rounded-xl text-sm transition flex items-center justify-center gap-2 shadow-lg shadow-brand-sky/20">
                                <svg id="sendIcon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                </svg>
                                <svg id="spinnerIcon" class="w-4 h-4 animate-spin hidden" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                </svg>
                                <span id="submitText">Send Message</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Map --}}
        <div class="mt-12 reveal" style="transition-delay:0.2s">
            <h2 class="sg text-xl font-extrabold text-white mb-1">Our Location</h2>
            <p class="text-sm text-gray-600 mb-5">Come visit us at our office in Lalitpur.</p>
            <div class="rounded-2xl overflow-hidden" style="height:360px; border:1px solid rgba(255,255,255,0.08)">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d883.3696810031988!2d85.31735856960282!3d27.67159518622741!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19e7772d9b01%3A0x66f41c4b105765e2!2sSchool%20Of%20Baking%20And%20Pastry%20Technology!5e0!3m2!1sen!2snp!4v1751420178573!5m2!1sen!2snp"
                        width="100%" height="100%" style="border:0; filter:grayscale(40%) invert(5%)" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
</div>

<script>
(function () {
    'use strict';

    var els = document.querySelectorAll('.reveal');
    var obs = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) {
            if (e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); }
        });
    }, { threshold: 0.1 });
    els.forEach(function (el) { obs.observe(el); });

    const form       = document.getElementById('contactForm');
    const submitBtn  = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const sendIcon   = document.getElementById('sendIcon');
    const spinner    = document.getElementById('spinnerIcon');
    const flash      = document.getElementById('flashMessage');

    function showFlash(message, isSuccess) {
        flash.textContent = message;
        flash.className = 'mb-8 px-5 py-4 rounded-xl text-sm text-center font-medium '
            + (isSuccess
                ? 'text-green-400 border border-green-500/30'
                : 'text-red-400 border border-red-500/30');
        flash.style.background = isSuccess ? 'rgba(34,197,94,0.08)' : 'rgba(239,68,68,0.08)';
        flash.classList.remove('hidden');
        setTimeout(() => flash.classList.add('hidden'), 5000);
    }

    function clearErrors() {
        form.querySelectorAll('[class*="error-"]').forEach(el => {
            el.textContent = '';
            el.classList.add('hidden');
        });
    }

    function showErrors(errors) {
        Object.entries(errors).forEach(([field, messages]) => {
            const el = form.querySelector('.error-' + field);
            if (el) { el.textContent = messages[0]; el.classList.remove('hidden'); }
        });
    }

    function setLoading(loading) {
        submitBtn.disabled = loading;
        submitText.textContent = loading ? 'Sending…' : 'Send Message';
        sendIcon.classList.toggle('hidden', loading);
        spinner.classList.toggle('hidden', !loading);
    }

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        clearErrors();
        setLoading(true);

        fetch('{{ route('contact.send') }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
            body: new FormData(form),
        })
        .then(function (r) { return r.json().then(function (data) { return { ok: r.ok, data }; }); })
        .then(function ({ ok, data }) {
            if (!ok) { if (data.errors) { showErrors(data.errors); } showFlash(data.message || 'Please check your input and try again.', false); return; }
            form.reset();
            showFlash(data.message, true);
        })
        .catch(function () { showFlash('Something went wrong. Please try again.', false); })
        .finally(function () { setLoading(false); });
    });
}());
</script>
@endsection
