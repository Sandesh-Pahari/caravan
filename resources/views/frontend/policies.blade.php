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
    .policy-card { border: 1px solid rgba(255,255,255,0.07); transition: border-color 0.25s ease, transform 0.3s ease; }
    .policy-card:hover { border-color: rgba(255,255,255,0.18); transform: translateY(-4px); }
</style>

{{-- ── HERO ── --}}
<section class="relative bg-[#0b0b0b] overflow-hidden">
    <div class="absolute inset-0 hero-grid pointer-events-none"></div>
    <div class="absolute top-0 right-0 w-[400px] h-[400px] rounded-full blur-[120px] pointer-events-none" style="background:rgba(79,195,247,0.05)"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 pt-16 pb-14">
        <nav class="flex items-center gap-2 text-xs text-white/40 mb-6">
            <a href="{{ route('home') }}" class="hover:text-white/70 transition">Home</a>
            <i class="fas fa-chevron-right text-[9px]"></i>
            <span class="text-white/70">Policies</span>
        </nav>
        <div class="inline-flex items-center gap-2 border border-brand-sky/25 text-brand-sky text-xs font-semibold px-4 py-2 rounded-full mb-5" style="background:rgba(79,195,247,0.06)">
            <i class="fas fa-file-lines text-xs"></i>
            Terms & Conditions
        </div>
        <h1 class="sg font-extrabold text-white leading-tight mb-3" style="font-size:clamp(2.5rem,6vw,4.5rem)">
            Our<br>Policies.
        </h1>
        <p class="text-gray-500 text-sm max-w-md leading-relaxed">Please read our rental policies carefully before making a booking.</p>
    </div>
</section>

{{-- ── POLICIES ── --}}
<div class="bg-[#0f0f0f] min-h-screen">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 py-16">

        @if($policies->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                @foreach($policies as $idx => $policy)
                    @php $colors = $policy->colorClasses(); @endphp
                    <div class="policy-card rounded-2xl p-6 reveal"
                         style="background:rgba(255,255,255,0.03); transition-delay:{{ ($idx % 2) * 0.12 }}s">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-10 h-10 rounded-xl {{ $colors['bg'] }} flex items-center justify-center flex-shrink-0">
                                <i class="fas {{ $policy->icon }} {{ $colors['icon'] }} text-sm"></i>
                            </div>
                            <h3 class="font-bold text-white text-sm">{{ $policy->title }}</h3>
                        </div>
                        <ul class="space-y-2.5">
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
        @else
            <div class="text-center py-24 reveal">
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4" style="background:rgba(255,255,255,0.04)">
                    <i class="fas fa-file-lines text-gray-600 text-2xl"></i>
                </div>
                <p class="text-gray-500 text-sm font-medium">No policies published yet.</p>
                <p class="text-gray-600 text-xs mt-1">Check back soon.</p>
            </div>
        @endif

        {{-- CTA --}}
        <div class="mt-14 pt-10 text-center reveal" style="border-top:1px solid rgba(255,255,255,0.06)">
            <p class="text-gray-500 text-sm mb-5">Have questions about our policies? Reach out to us.</p>
            <a href="{{ route('contact') }}"
               class="inline-flex items-center gap-2 bg-brand-sky hover:bg-white text-brand-dark font-bold px-6 py-3.5 rounded-xl text-sm transition shadow-lg shadow-brand-sky/15">
                <i class="fas fa-envelope text-xs"></i>
                Contact Us
            </a>
        </div>
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
