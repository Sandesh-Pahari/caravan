@extends('admin.dashboard')

@section('content')
    <div class="max-w-6xl mx-auto">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-xl font-bold text-brand-dark">Enquiries & Bookings</h1>
                <p class="text-sm text-gray-400 mt-0.5">
                    Rental Department &rsaquo; Enquiries
                    @if($unreadCount > 0)
                        &nbsp;·&nbsp;
                        <span class="text-brand-maroon font-medium">{{ $unreadCount }} unread</span>
                    @endif
                </p>
            </div>
            <a href="{{ route('admin.rental.index') }}"
               class="text-sm text-brand-blue hover:underline">← Back</a>
        </div>

        {{-- Filter Tabs --}}
        <div class="flex gap-2 mb-6 border-b border-gray-200">
            @foreach(['all' => 'All', 'unread' => 'Unread', 'enquiries' => 'Enquiries Only', 'paid' => 'Paid Bookings'] as $key => $label)
                <a href="{{ request()->fullUrlWithQuery(['filter' => $key]) }}"
                   class="px-4 py-2 text-sm font-medium border-b-2 transition -mb-px
                       {{ $filter === $key
                           ? 'border-brand-blue text-brand-blue'
                           : 'border-transparent text-gray-500 hover:text-brand-dark' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        {{-- Table --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            @if($records->isEmpty())
                <div class="py-16 text-center text-gray-400 text-sm">No records found.</div>
            @else
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wide">
                        <tr>
                            <th class="px-4 py-3 text-left">#</th>
                            <th class="px-4 py-3 text-left">Customer</th>
                            <th class="px-4 py-3 text-left">Vehicle</th>
                            <th class="px-4 py-3 text-left">Type</th>
                            <th class="px-4 py-3 text-left">Date</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-left">Payment</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($records as $record)
                            <tr class="hover:bg-gray-50 transition {{ ! $record->admin_read_at ? 'bg-blue-50/30' : '' }}">
                                <td class="px-4 py-3 text-gray-400 font-mono text-xs">
                                    #{{ $record->id }}
                                    @if(! $record->admin_read_at)
                                        <span class="inline-block w-2 h-2 rounded-full bg-brand-blue ml-1 align-middle"></span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <p class="font-medium text-brand-dark">{{ $record->name }}</p>
                                    <p class="text-xs text-gray-400">{{ $record->phone_number }}</p>
                                </td>
                                <td class="px-4 py-3 text-gray-600">{{ $record->vehicle->vehicle_name }}</td>
                                <td class="px-4 py-3">
                                    @if($record->is_enquiry)
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-700">
                                            Enquiry
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                            Booking
                                        </span>
                                    @endif
                                    <span class="ml-1 text-xs text-gray-400">
                                        {{ $record->booking_type === 'with_driver' ? 'With Driver' : 'Self Drive' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-gray-600 text-xs">
                                    {{ $record->date->format('d M Y') }}
                                </td>
                                <td class="px-4 py-3">
                                    @php
                                        $statusColors = [
                                            'pending'   => 'bg-gray-100 text-gray-600',
                                            'confirmed' => 'bg-green-100 text-green-700',
                                            'cancelled' => 'bg-red-100 text-red-600',
                                        ];
                                    @endphp
                                    <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$record->status] ?? 'bg-gray-100 text-gray-600' }}">
                                        {{ ucfirst($record->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-xs text-gray-500">
                                    @if($record->payment_status === 'paid')
                                        <span class="text-green-600 font-medium">Paid</span>
                                        <span class="text-gray-400 ml-1">({{ ucfirst($record->payment_method) }})</span>
                                    @elseif($record->is_enquiry)
                                        <span class="text-gray-400">—</span>
                                    @else
                                        <span class="text-amber-600">Pending</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('admin.rental.enquiries.show', $record) }}"
                                           class="text-brand-blue hover:underline text-xs font-medium">View</a>
                                        <form method="POST" action="{{ route('admin.rental.enquiries.destroy', $record) }}"
                                              onsubmit="return confirm('Delete this record permanently?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-red-500 hover:text-red-700 text-xs font-medium">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Pagination --}}
                @if($records->hasPages())
                    <div class="px-4 py-3 border-t border-gray-100">
                        {{ $records->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection
