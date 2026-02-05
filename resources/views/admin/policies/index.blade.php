@extends('admin.dashboard')

@section('content')
    <div class="max-w-4xl mx-auto">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-xl font-bold text-brand-dark">Policies</h1>
                <p class="text-sm text-gray-400 mt-0.5">{{ $policies->count() }} polic{{ $policies->count() !== 1 ? 'ies' : 'y' }}</p>
            </div>
            <a href="{{ route('admin.policies.create') }}"
               class="inline-flex items-center gap-2 bg-brand-blue text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-brand-slate transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Policy
            </a>
        </div>

        @if(session('success'))
            <div class="mb-5 bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-3 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            @if($policies->isEmpty())
                <div class="py-16 text-center text-gray-400 text-sm">
                    No policies yet. <a href="{{ route('admin.policies.create') }}" class="text-brand-blue hover:underline">Add the first one.</a>
                </div>
            @else
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wide">
                        <tr>
                            <th class="px-4 py-3 text-left">Policy</th>
                            <th class="px-4 py-3 text-left w-20">Color</th>
                            <th class="px-4 py-3 text-left w-16">Order</th>
                            <th class="px-4 py-3 text-left w-24">Status</th>
                            <th class="px-4 py-3 w-24"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($policies as $policy)
                            @php $colors = $policy->colorClasses(); @endphp
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg {{ $colors['bg'] }} flex items-center justify-center flex-shrink-0">
                                            <i class="fas {{ $policy->icon }} {{ $colors['icon'] }} text-xs"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-brand-dark">{{ $policy->title }}</p>
                                            <p class="text-xs text-gray-400">{{ count($policy->items) }} item{{ count($policy->items) !== 1 ? 's' : '' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="text-xs capitalize text-gray-500">{{ $policy->color }}</span>
                                </td>
                                <td class="px-4 py-3 text-gray-500 font-mono text-xs">{{ $policy->sort_order }}</td>
                                <td class="px-4 py-3">
                                    @if($policy->is_active)
                                        <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">Active</span>
                                    @else
                                        <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500">Hidden</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('admin.policies.edit', $policy) }}"
                                           class="text-brand-blue hover:underline text-xs font-medium">Edit</a>
                                        <form method="POST" action="{{ route('admin.policies.destroy', $policy) }}"
                                              onsubmit="return confirm('Delete this policy?')">
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
            @endif
        </div>
    </div>
@endsection
