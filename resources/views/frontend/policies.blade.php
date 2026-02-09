@extends('template.template')

@section('pagecontent')

    {{-- Page Banner --}}
    <div class="bg-gradient-to-r from-brand-dark to-brand-slate py-10 px-4">
        <div class="max-w-7xl mx-auto">
            <nav class="flex items-center gap-2 text-xs text-white/50 mb-3">
                <a href="{{ route('home') }}" class="hover:text-white transition">Home</a>
                <i class="fas fa-chevron-right text-[10px]"></i>
                <span class="text-white/80">Policies</span>
            </nav>
            <p class="text-xs font-semibold text-brand-sky uppercase tracking-widest mb-1">Terms &amp; Conditions</p>
            <h1 class="text-3xl font-bold text-white mb-1">Our Policies</h1>
            <p class="text-sm text-white/55">Please read our rental policies before making a booking.</p>
        </div>
    </div>

    {{-- Policies Content --}}
    <div class="bg-brand-bg py-16 md:py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6">

            @if($policies->isNotEmpty())
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
            @else
                <div class="text-center py-16">
                    <div class="w-14 h-14 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-file-lines text-gray-400 text-xl"></i>
                    </div>
                    <p class="text-sm text-gray-400">No policies published yet. Check back soon.</p>
                </div>
            @endif

            <div class="mt-12 pt-8 border-t border-gray-200 text-center">
                <p class="text-sm text-gray-500 mb-4">Have questions about our policies? Reach out to us.</p>
                <a href="{{ route('contact') }}"
                   class="inline-flex items-center gap-2 bg-brand-blue hover:bg-brand-slate text-white font-semibold px-5 py-2.5 rounded-xl text-sm transition">
                    <i class="fas fa-envelope text-xs"></i>
                    Contact Us
                </a>
            </div>
        </div>
    </div>

@endsection
