@extends('admin.dashboard')

@section('content')
    <div class="max-w-4xl mx-auto">
        <h1 class="text-xl font-bold text-brand-dark mb-6">Rental Department</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            {{-- Manage Vehicles --}}
            <a href="{{ route('rental.vehicles.index') }}"
               class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center gap-4 hover:shadow-md transition group">
                <div class="w-12 h-12 rounded-full bg-brand-blue/10 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 7h4l2 5h6l2-5h4M5 17a2 2 0 104 0 2 2 0 00-4 0zm10 0a2 2 0 104 0 2 2 0 00-4 0z" />
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-brand-dark group-hover:text-brand-blue transition">Manage Vehicles</p>
                    <p class="text-xs text-gray-400 mt-0.5">Add, edit, and remove rental vehicles</p>
                </div>
            </a>

            {{-- Enquiries & Bookings --}}
            <a href="{{ route('admin.rental.enquiries.index') }}"
               class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center gap-4 hover:shadow-md transition group relative">
                <div class="w-12 h-12 rounded-full bg-brand-maroon/10 flex items-center justify-center flex-shrink-0 relative">
                    <svg class="w-6 h-6 text-brand-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-4 4v-4z" />
                    </svg>
                    @php
                        $unread = \App\Models\RentalBooking::query()
                            ->where(fn($q) => $q->where('is_enquiry', true)->orWhere('payment_status', 'paid'))
                            ->whereNull('admin_read_at')->count();
                    @endphp
                    @if($unread > 0)
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center animate-pulse">
                            {{ $unread }}
                        </span>
                    @endif
                </div>
                <div>
                    <p class="font-semibold text-brand-dark group-hover:text-brand-maroon transition">Enquiries & Bookings</p>
                    <p class="text-xs text-gray-400 mt-0.5">View enquiries and completed payments</p>
                </div>
            </a>
        </div>
    </div>
@endsection
