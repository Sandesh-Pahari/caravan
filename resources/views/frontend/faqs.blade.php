@extends('template.template')

@section('pagecontent')

    {{-- Page Banner --}}
    <div class="bg-gradient-to-r from-brand-dark to-brand-slate py-10 px-4">
        <div class="max-w-7xl mx-auto">
            <nav class="flex items-center gap-2 text-xs text-white/50 mb-3">
                <a href="{{ route('home') }}" class="hover:text-white transition">Home</a>
                <i class="fas fa-chevron-right text-[10px]"></i>
                <span class="text-white/80">FAQs</span>
            </nav>
            <p class="text-xs font-semibold text-brand-sky uppercase tracking-widest mb-1">Questions &amp; Answers</p>
            <h1 class="text-3xl font-bold text-white mb-1">Frequently Asked Questions</h1>
            <p class="text-sm text-white/55">Everything you need to know about renting with Caravan.</p>
        </div>
    </div>

    {{-- FAQ Content --}}
    <div class="bg-white py-16 md:py-20">
        <div class="max-w-3xl mx-auto px-4 sm:px-6">

            @if($faqs->isNotEmpty())
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
            @else
                <div class="text-center py-16">
                    <div class="w-14 h-14 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-circle-question text-gray-400 text-xl"></i>
                    </div>
                    <p class="text-sm text-gray-400">No FAQs available yet. Check back soon.</p>
                </div>
            @endif

            <div class="mt-12 pt-8 border-t border-gray-100 text-center">
                <p class="text-sm text-gray-500 mb-4">Still have questions? We're happy to help.</p>
                <a href="{{ route('contact') }}"
                   class="inline-flex items-center gap-2 bg-brand-blue hover:bg-brand-slate text-white font-semibold px-5 py-2.5 rounded-xl text-sm transition">
                    <i class="fas fa-envelope text-xs"></i>
                    Contact Us
                </a>
            </div>
        </div>
    </div>

@endsection
