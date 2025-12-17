@extends('template.template')

@section('pagecontent')
    <div class="bg-brand-bg min-h-screen">
        <div class="max-w-7xl mx-auto px-4 py-10">
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-3xl font-bold text-brand-dark">Our Vehicles</h1>
                @auth
                    <a href="{{ route('admin.rental.vehicles.create') }}"
                       class="inline-flex items-center gap-2 bg-brand-blue text-white px-4 py-2 rounded-lg text-sm hover:bg-brand-slate transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Add Vehicle
                    </a>
                @endauth
            </div>

            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-300 text-green-800 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if($vehicles->isEmpty())
                <div class="text-center text-gray-500 py-20">
                    No vehicles available at the moment.
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($vehicles as $vehicle)
                        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition group">
                            <a href="{{ route('rental.vehicles.show', $vehicle) }}" class="block overflow-hidden h-48">
                                <img src="{{ Storage::url($vehicle->main_image) }}"
                                     alt="{{ $vehicle->vehicle_name }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            </a>
                            <div class="p-4">
                                <a href="{{ route('rental.vehicles.show', $vehicle) }}">
                                    <h2 class="text-lg font-semibold text-brand-dark hover:text-brand-blue transition">{{ $vehicle->vehicle_name }}</h2>
                                </a>
                                <p class="text-sm text-gray-500 mt-1">{{ $vehicle->vehicle_number }}</p>
                                <div class="flex items-center gap-2 mt-3 flex-wrap">
                                    <span class="text-xs bg-brand-blue/10 text-brand-blue px-2 py-1 rounded-full font-medium">
                                        {{ ucfirst($vehicle->condition) }}
                                    </span>
                                    <span class="text-xs bg-brand-slate/10 text-brand-slate px-2 py-1 rounded-full font-medium">
                                        {{ $vehicle->number_of_seats }} Seats
                                    </span>
                                    <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-full">
                                        {{ $vehicle->color }}
                                    </span>
                                </div>
                                @auth
                                    <div class="flex gap-3 mt-3 pt-3 border-t border-gray-100">
                                        <a href="{{ route('admin.rental.vehicles.edit', $vehicle) }}"
                                           class="text-sm text-brand-blue hover:text-brand-slate font-medium">Edit</a>
                                        <form action="{{ route('admin.rental.vehicles.destroy', $vehicle) }}"
                                              method="POST"
                                              onsubmit="return confirm('Delete this vehicle?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-sm text-brand-maroon hover:text-red-800 font-medium">Delete</button>
                                        </form>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
