@extends('template.template')

@section('pagecontent')
<div class="bg-brand-bg min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">

        {{-- Header --}}
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-brand-dark mb-3">Get In Touch</h1>
            <div class="w-16 h-1 bg-brand-maroon mx-auto rounded-full mb-4"></div>
            <p class="text-gray-500 max-w-xl mx-auto text-sm leading-relaxed">
                Have a question about our rental vehicles or services? Fill out the form and our team will get back to you as soon as possible.
            </p>
        </div>

        {{-- Flash --}}
        <div id="flashMessage" class="hidden mb-6 px-4 py-3 rounded-lg text-sm text-center font-medium"></div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">

            {{-- Left: Info --}}
            <div class="lg:col-span-2 space-y-5">

                {{-- Contact Details --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-brand-blue px-6 py-4">
                        <h2 class="text-white font-semibold text-base">Contact Information</h2>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-brand-blue/10 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-0.5">Address</p>
                                <p class="text-sm font-medium text-brand-dark">Kumaripati, Lalitpur, Nepal</p>
                                <p class="text-xs text-gray-400 mt-0.5">Open Sunday–Friday, 9AM–5PM</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-brand-blue/10 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-0.5">Phone</p>
                                <p class="text-sm font-medium text-brand-dark">+015592370</p>
                                <a href="tel:+015592370" class="text-xs text-brand-blue hover:underline mt-0.5 inline-block">Click to call →</a>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-brand-blue/10 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-0.5">Email</p>
                                <p class="text-sm font-medium text-brand-dark">sudanshah.chef@gmail.com</p>
                                <a href="mailto:sudanshah.chef@gmail.com" class="text-xs text-brand-blue hover:underline mt-0.5 inline-block">Send email →</a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Social --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-4">Follow Us</p>
                    <div class="flex flex-wrap gap-3">
                        <a href="#" target="_blank" rel="noopener noreferrer"
                           class="w-9 h-9 rounded-full bg-brand-blue flex items-center justify-center text-white hover:bg-brand-slate transition"
                           title="Facebook">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z" />
                            </svg>
                        </a>
                        <a href="#" target="_blank" rel="noopener noreferrer"
                           class="w-9 h-9 rounded-full bg-brand-maroon flex items-center justify-center text-white hover:opacity-80 transition"
                           title="Instagram">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5" stroke-width="2"/>
                                <circle cx="12" cy="12" r="4" stroke-width="2"/>
                                <circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/>
                            </svg>
                        </a>
                        <a href="#" target="_blank" rel="noopener noreferrer"
                           class="w-9 h-9 rounded-full bg-brand-forest flex items-center justify-center text-white hover:opacity-80 transition"
                           title="WhatsApp">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                                <path d="M12 2C6.477 2 2 6.477 2 12c0 1.89.525 3.66 1.438 5.168L2 22l4.978-1.394A9.96 9.96 0 0012 22c5.523 0 10-4.477 10-10S17.523 2 12 2z"/>
                            </svg>
                        </a>
                        <a href="#" target="_blank" rel="noopener noreferrer"
                           class="w-9 h-9 rounded-full bg-brand-dark flex items-center justify-center text-white hover:opacity-80 transition"
                           title="YouTube">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.54 6.42a2.78 2.78 0 00-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 00-1.95 1.96A29 29 0 001 12a29 29 0 00.46 5.58A2.78 2.78 0 003.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 001.95-1.95A29 29 0 0023 12a29 29 0 00-.46-5.58z"/>
                                <polygon fill="white" points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Right: Form --}}
            <div class="lg:col-span-3 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-brand-maroon px-6 py-4">
                    <h2 class="text-white font-semibold text-base">Send Us a Message</h2>
                    <p class="text-white/70 text-xs mt-0.5">We'll respond within 24 hours</p>
                </div>

                <form id="contactForm" class="p-6 space-y-5">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-1">
                                Full Name <span class="text-brand-maroon">*</span>
                            </label>
                            <input type="text" name="name" required placeholder="Your full name"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue">
                            <p class="text-brand-maroon text-xs mt-1 hidden error-name"></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-1">
                                Email Address <span class="text-brand-maroon">*</span>
                            </label>
                            <input type="email" name="email" required placeholder="you@example.com"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue">
                            <p class="text-brand-maroon text-xs mt-1 hidden error-email"></p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-brand-dark mb-1">Phone Number</label>
                        <input type="tel" name="phone" placeholder="+977 98XXXXXXXX"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue">
                        <p class="text-brand-maroon text-xs mt-1 hidden error-phone"></p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-brand-dark mb-1">
                            Message <span class="text-brand-maroon">*</span>
                        </label>
                        <textarea name="message" rows="5" required
                                  placeholder="Tell us about your enquiry — vehicle type, dates, destination…"
                                  class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue resize-none"></textarea>
                        <p class="text-brand-maroon text-xs mt-1 hidden error-message"></p>
                    </div>

                    <div class="pt-2">
                        <button type="submit" id="submitBtn"
                                class="w-full bg-brand-maroon hover:bg-red-800 text-white py-3 rounded-lg text-sm font-semibold transition flex items-center justify-center gap-2">
                            <svg id="sendIcon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
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

        {{-- Map --}}
        <div class="mt-12">
            <h2 class="text-xl font-bold text-brand-dark mb-1">Our Location</h2>
            <p class="text-sm text-gray-400 mb-4">Come visit us at our office in Lalitpur.</p>
            <div class="rounded-xl overflow-hidden border border-gray-200 shadow-sm" style="height: 360px;">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d883.3696810031988!2d85.31735856960282!3d27.67159518622741!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19e7772d9b01%3A0x66f41c4b105765e2!2sSchool%20Of%20Baking%20And%20Pastry%20Technology!5e0!3m2!1sen!2snp!4v1751420178573!5m2!1sen!2snp"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>

    </div>
</div>

<script>
(function () {
    'use strict';

    const form       = document.getElementById('contactForm');
    const submitBtn  = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const sendIcon   = document.getElementById('sendIcon');
    const spinner    = document.getElementById('spinnerIcon');
    const flash      = document.getElementById('flashMessage');

    function showFlash(message, isSuccess) {
        flash.textContent = message;
        flash.className = 'mb-6 px-4 py-3 rounded-lg text-sm text-center font-medium '
            + (isSuccess ? 'bg-green-50 border border-green-200 text-green-700' : 'bg-red-50 border border-red-200 text-red-700');
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
            if (el) {
                el.textContent = messages[0];
                el.classList.remove('hidden');
            }
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
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: new FormData(form),
        })
        .then(function (r) {
            return r.json().then(function (data) { return { ok: r.ok, data }; });
        })
        .then(function ({ ok, data }) {
            if (!ok) {
                if (data.errors) { showErrors(data.errors); }
                showFlash(data.message || 'Please check your input and try again.', false);
                return;
            }
            form.reset();
            showFlash(data.message, true);
        })
        .catch(function () {
            showFlash('Something went wrong. Please try again.', false);
        })
        .finally(function () {
            setLoading(false);
        });
    });
}());
</script>
@endsection
