@extends('template.template')

@section('pagecontent')
    <div class="bg-brand-bg min-h-screen py-8">
        <div class="max-w-4xl mx-auto px-4">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-brand-dark">Add New Vehicle</h1>
                <a href="{{ route('rental.vehicles.index') }}"
                   class="text-sm text-brand-blue hover:text-brand-slate flex items-center gap-1 font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to Vehicles
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6">
                <form action="{{ route('admin.rental.vehicles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- ── Basic Info ── --}}
                    <h2 class="text-base font-semibold text-brand-blue mb-4 pb-2 border-b-2 border-brand-blue/20">Vehicle Details</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">

                        {{-- Vehicle Name --}}
                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-1">Vehicle Name <span class="text-brand-maroon">*</span></label>
                            <input type="text" name="vehicle_name" value="{{ old('vehicle_name') }}"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue @error('vehicle_name') border-brand-maroon @enderror">
                            @error('vehicle_name')
                                <p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Vehicle Number --}}
                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-1">Vehicle Number <span class="text-brand-maroon">*</span></label>
                            <input type="text" name="vehicle_number" value="{{ old('vehicle_number') }}"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue @error('vehicle_number') border-brand-maroon @enderror">
                            @error('vehicle_number')
                                <p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Color --}}
                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-1">Color <span class="text-brand-maroon">*</span></label>
                            <input type="text" name="color" value="{{ old('color') }}"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue @error('color') border-brand-maroon @enderror">
                            @error('color')
                                <p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Number of Seats --}}
                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-1">Number of Seats <span class="text-brand-maroon">*</span></label>
                            <input type="number" name="number_of_seats" value="{{ old('number_of_seats') }}" min="1"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue @error('number_of_seats') border-brand-maroon @enderror">
                            @error('number_of_seats')
                                <p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Condition --}}
                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-1">Condition <span class="text-brand-maroon">*</span></label>
                            <select name="condition"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue @error('condition') border-brand-maroon @enderror">
                                <option value="">-- Select Condition --</option>
                                @foreach(['new' => 'New', 'good' => 'Good', 'average' => 'Average', 'old' => 'Old'] as $val => $label)
                                    <option value="{{ $val }}" {{ old('condition') === $val ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('condition')
                                <p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Luggage Storage --}}
                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-2">Luggage Storage <span class="text-brand-maroon">*</span></label>
                            <div class="grid grid-cols-2 gap-2">
                                @foreach(['boot' => 'Boot Storage', 'head' => 'Head Storage', 'both' => 'Both', 'neither' => 'Neither'] as $val => $label)
                                    <label class="flex items-center gap-2 text-sm cursor-pointer">
                                        <input type="radio" name="luggage_storage" value="{{ $val }}"
                                               {{ old('luggage_storage') === $val ? 'checked' : '' }}
                                               class="accent-brand-blue">
                                        {{ $label }}
                                    </label>
                                @endforeach
                            </div>
                            @error('luggage_storage')
                                <p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- ── Images ── --}}
                    <h2 class="text-base font-semibold text-brand-blue mb-4 pb-2 border-b-2 border-brand-blue/20">Images</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">

                        {{-- Main Image --}}
                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-1">Main Image <span class="text-brand-maroon">*</span></label>
                            <input type="file" name="main_image" accept="image/*"
                                   class="w-full text-sm text-gray-600 border border-gray-300 rounded-lg px-3 py-2 file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:text-sm file:bg-brand-blue file:text-white hover:file:bg-brand-slate @error('main_image') border-brand-maroon @enderror">
                            <p class="text-xs text-gray-400 mt-1">JPG, PNG or WEBP · max 2MB · shown on vehicle list</p>
                            @error('main_image')
                                <p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Additional Images --}}
                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-1">Additional Images <span class="text-gray-400 font-normal">(max 3, optional)</span></label>
                            <input type="file" name="additional_images[]" accept="image/*" multiple
                                   class="w-full text-sm text-gray-600 border border-gray-300 rounded-lg px-3 py-2 file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:text-sm file:bg-brand-bg file:text-brand-slate hover:file:bg-gray-200 @error('additional_images') border-brand-maroon @enderror">
                            <p class="text-xs text-gray-400 mt-1">Shown on vehicle detail page only</p>
                            @error('additional_images')
                                <p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>
                            @enderror
                            @error('additional_images.*')
                                <p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- ── Public Fare ── --}}
                    <h2 class="text-base font-semibold text-brand-blue mb-1 pb-2 border-b-2 border-brand-blue/20">
                        Public Fare
                        <span class="text-xs font-normal text-green-600 ml-2">(shown publicly)</span>
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-1">Hold Fare Per Day (NPR) <span class="text-brand-maroon">*</span></label>
                            <input type="number" name="fare_per_day" value="{{ old('fare_per_day') }}" step="0.01" min="0"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue @error('fare_per_day') border-brand-maroon @enderror">
                            <p class="text-xs text-gray-400 mt-1">Only When vehicle is holded than a day</p>
                            @error('fare_per_day')
                                <p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- ── Pricing (Backend Only) ── --}}
                    <h2 class="text-base font-semibold text-brand-blue mb-1 pb-2 border-b-2 border-brand-blue/20">
                        Internal Pricing
                        <span class="text-xs font-normal text-gray-400 ml-2">(not shown publicly)</span>
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6 mt-4">

                        {{-- Mileage --}}
                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-1">Mileage (km/l) <span class="text-brand-maroon">*</span></label>
                            <input type="number" name="mileage" value="{{ old('mileage') }}" step="0.01" min="0"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue @error('mileage') border-brand-maroon @enderror">
                            @error('mileage')
                                <p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Oil Price --}}
                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-1">Oil Price (NPR) <span class="text-brand-maroon">*</span></label>
                            <input type="number" name="oil_price" value="{{ old('oil_price') }}" step="0.01" min="0"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue @error('oil_price') border-brand-maroon @enderror">
                            @error('oil_price')
                                <p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Driver Allowance --}}
                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-1">Driver Allowance (NPR) <span class="text-brand-maroon">*</span></label>
                            <input type="number" name="driver_allowance" value="{{ old('driver_allowance') }}" step="0.01" min="0"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue @error('driver_allowance') border-brand-maroon @enderror">
                            @error('driver_allowance')
                                <p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Profit Margin --}}
                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-1">Profit Margin (%) <span class="text-brand-maroon">*</span></label>
                            <input type="number" name="profit_margin" value="{{ old('profit_margin') }}" step="0.01" min="0"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue @error('profit_margin') border-brand-maroon @enderror">
                            @error('profit_margin')
                                <p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                        <a href="{{ route('rental.vehicles.index') }}"
                           class="px-5 py-2 text-sm border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                            Cancel
                        </a>
                        <button type="submit"
                                class="px-6 py-2 text-sm bg-brand-blue text-white rounded-lg hover:bg-brand-slate transition font-medium">
                            Save Vehicle
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
