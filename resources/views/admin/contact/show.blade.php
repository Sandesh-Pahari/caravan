@extends('admin.dashboard')

@section('content')
    <div class="max-w-2xl mx-auto">

        {{-- Back --}}
        <div class="flex items-center justify-between mb-6">
            <a href="{{ route('admin.contact.index') }}"
               class="inline-flex items-center gap-1 text-sm text-brand-blue hover:underline">
                ← Back to Messages
            </a>
            <form method="POST" action="{{ route('admin.contact.destroy', $contactMessage) }}"
                  onsubmit="return confirm('Delete this message permanently?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-red-600 border border-red-200 rounded-lg hover:bg-red-50 transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Delete Message
                </button>
            </form>
        </div>

        <div class="flex items-center gap-3 mb-6">
            <h1 class="text-xl font-bold text-brand-dark">Message #{{ $contactMessage->id }}</h1>
            @if($contactMessage->isUnread())
                <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-700">Unread</span>
            @else
                <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500">Read</span>
            @endif
        </div>

        <div class="space-y-5">

            {{-- Sender --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
                <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-3">Sender</h2>
                <div class="grid grid-cols-2 gap-3 text-sm">
                    <div>
                        <p class="text-gray-400 text-xs">Name</p>
                        <p class="font-medium text-brand-dark">{{ $contactMessage->name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs">Phone</p>
                        <p class="font-medium text-brand-dark">{{ $contactMessage->phone ?? '—' }}</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-gray-400 text-xs">Email</p>
                        <a href="mailto:{{ $contactMessage->email }}"
                           class="font-medium text-brand-blue hover:underline">
                            {{ $contactMessage->email }}
                        </a>
                    </div>
                </div>
            </div>

            {{-- Message --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
                <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-3">Message</h2>
                <p class="text-sm text-brand-dark leading-relaxed whitespace-pre-line">{{ $contactMessage->message }}</p>
            </div>

            {{-- Meta --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
                <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-3">Details</h2>
                <div class="grid grid-cols-2 gap-3 text-sm">
                    <div>
                        <p class="text-gray-400 text-xs">Received</p>
                        <p class="font-medium text-brand-dark">{{ $contactMessage->created_at->format('d M Y, h:i A') }}</p>
                    </div>
                    @if($contactMessage->read_at)
                        <div>
                            <p class="text-gray-400 text-xs">Read At</p>
                            <p class="font-medium text-brand-dark">{{ $contactMessage->read_at->format('d M Y, h:i A') }}</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Reply CTA --}}
            <div class="flex justify-end">
                <a href="mailto:{{ $contactMessage->email }}?subject=Re: Your message to {{ config('app.name') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-brand-blue text-white text-sm font-medium rounded-lg hover:bg-brand-slate transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Reply via Email
                </a>
            </div>

        </div>
    </div>
@endsection
