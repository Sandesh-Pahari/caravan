@extends('template.template')

@section('pagecontent')
    <div class="bg-brand-bg min-h-screen py-10">
        <div class="max-w-3xl mx-auto px-4">

            {{-- Back --}}
            <a href="{{ route('rental.vehicles.show', $vehicle) }}"
               class="inline-flex items-center gap-1 text-sm text-brand-blue hover:text-brand-slate font-medium mb-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Vehicle
            </a>

            <h1 class="text-2xl font-bold text-brand-dark mb-6">Book a Vehicle</h1>

            {{-- Vehicle Preview Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 p-4 mb-8">
                <img src="{{ Storage::url($vehicle->main_image) }}"
                     alt="{{ $vehicle->vehicle_name }}"
                     class="w-20 h-16 object-cover rounded-lg flex-shrink-0">
                <div>
                    <p class="font-semibold text-brand-dark">{{ $vehicle->vehicle_name }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $vehicle->vehicle_number }} &middot; {{ $vehicle->number_of_seats }} Seats &middot; {{ ucfirst($vehicle->condition) }}</p>
                </div>
            </div>

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 text-sm">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Booking Type Toggle + Form --}}
            <div x-data="{ type: '{{ old('booking_type', 'with_driver') }}' }">

                {{-- Toggle --}}
                <div class="flex rounded-xl overflow-hidden border border-brand-blue mb-8">
                    <button type="button"
                            @click="type = 'with_driver'"
                            :class="type === 'with_driver'
                                ? 'bg-brand-blue text-white'
                                : 'bg-white text-brand-blue hover:bg-brand-blue/5'"
                            class="flex-1 py-3 text-sm font-semibold transition flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        With Driver
                    </button>
                    <button type="button"
                            @click="type = 'self_drive'"
                            :class="type === 'self_drive'
                                ? 'bg-brand-blue text-white'
                                : 'bg-white text-brand-blue hover:bg-brand-blue/5'"
                            class="flex-1 py-3 text-sm font-semibold transition flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        Self Drive
                    </button>
                </div>

                <form action="{{ route('rental.bookings.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
                    <input type="hidden" name="booking_type" :value="type">

                    <div class="bg-white rounded-xl shadow-md p-6 space-y-6">

                        {{-- ── Personal Info (Shared) ── --}}
                        <div>
                            <h2 class="text-sm font-semibold text-brand-blue pb-2 border-b-2 border-brand-blue/20 mb-4">
                                Personal Information
                            </h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-brand-dark mb-1">
                                        Full Name <span class="text-brand-maroon">*</span>
                                    </label>
                                    <input type="text" name="name" value="{{ old('name') }}"
                                           placeholder="Your full name"
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue @error('name') border-brand-maroon @enderror">
                                    @error('name')
                                        <p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-brand-dark mb-1">
                                        Phone Number <span class="text-brand-maroon">*</span>
                                    </label>
                                    <input type="tel" name="phone_number" value="{{ old('phone_number') }}"
                                           placeholder="+977 98XXXXXXXX"
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue @error('phone_number') border-brand-maroon @enderror">
                                    @error('phone_number')
                                        <p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block text-sm font-medium text-brand-dark mb-1">
                                        Email Address <span class="text-brand-maroon">*</span>
                                    </label>
                                    <input type="email" name="email" value="{{ old('email') }}"
                                           placeholder="you@example.com"
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue @error('email') border-brand-maroon @enderror">
                                    @error('email')
                                        <p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- ── Trip Details (Shared) ── --}}
                        <div>
                            <h2 class="text-sm font-semibold text-brand-blue pb-2 border-b-2 border-brand-blue/20 mb-4">
                                Trip Details
                            </h2>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-brand-dark mb-1">
                                        Vehicle <span class="text-brand-maroon">*</span>
                                    </label>
                                    <select name="vehicle_id" onchange="this.form.action = '{{ url('rental/bookings/create') }}/' + this.value; this.form.method = 'GET'; this.form.submit();"
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue">
                                        @foreach($vehicles as $v)
                                            <option value="{{ $v->id }}" {{ $v->id === $vehicle->id ? 'selected' : '' }}>
                                                {{ $v->vehicle_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-brand-dark mb-1">
                                        Pickup Date <span class="text-brand-maroon">*</span>
                                    </label>
                                    <input type="date" name="date" value="{{ old('date') }}"
                                           min="{{ now()->toDateString() }}"
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue @error('date') border-brand-maroon @enderror">
                                    @error('date')
                                        <p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-brand-dark mb-1">
                                        Pickup Time <span class="text-brand-maroon">*</span>
                                    </label>
                                    <input type="time" name="pickup_time" value="{{ old('pickup_time') }}"
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue @error('pickup_time') border-brand-maroon @enderror">
                                    @error('pickup_time')
                                        <p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-brand-dark mb-1">
                                        Number of Days <span class="text-brand-maroon">*</span>
                                    </label>
                                    <input type="number" name="days_taken" value="{{ old('days_taken', 1) }}" min="1"
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue @error('days_taken') border-brand-maroon @enderror">
                                    @error('days_taken')
                                        <p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- ── With Driver Fields ── --}}
                        <div x-show="type === 'with_driver'" x-transition>
                            <h2 class="text-sm font-semibold text-brand-blue pb-2 border-b-2 border-brand-blue/20 mb-4">
                                Route Information
                            </h2>
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-brand-dark mb-1">
                                        Pickup Address <span class="text-brand-maroon">*</span>
                                    </label>
                                    <input type="text" name="pickup_address" value="{{ old('pickup_address') }}"
                                           placeholder="Where should we pick you up?"
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue @error('pickup_address') border-brand-maroon @enderror">
                                    @error('pickup_address')
                                        <p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-brand-dark mb-1">
                                        Drop Address <span class="text-brand-maroon">*</span>
                                    </label>
                                    <input type="text" name="drop_address" value="{{ old('drop_address') }}"
                                           placeholder="Where is your destination?"
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue @error('drop_address') border-brand-maroon @enderror">
                                    @error('drop_address')
                                        <p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- ── Self Drive Fields ── --}}
                        <div x-show="type === 'self_drive'" x-transition>
                            <h2 class="text-sm font-semibold text-brand-blue pb-2 border-b-2 border-brand-blue/20 mb-4">
                                Self Drive Details
                            </h2>

                            {{-- Identity Warning --}}
                            <div class="bg-amber-50 border border-amber-300 rounded-lg px-4 py-3 mb-4 flex gap-3">
                                <svg class="w-5 h-5 text-amber-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                                </svg>
                                <div class="text-sm text-amber-800">
                                    <p class="font-semibold mb-0.5">Identity Verification Required</p>
                                    <p>A valid government-issued identity document and a driver's license are mandatory for self drive bookings. Uploads must be clear and legible (JPG, PNG or PDF).</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-brand-dark mb-1">
                                        Pickup Location <span class="text-brand-maroon">*</span>
                                    </label>
                                    <input type="text" name="pickup_location"
                                           value="{{ old('pickup_location', 'Company Office, Kathmandu') }}"
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue @error('pickup_location') border-brand-maroon @enderror">
                                    <p class="text-xs text-gray-400 mt-1">Default is our office. You may edit if pre-arranged.</p>
                                    @error('pickup_location')
                                        <p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-brand-dark mb-1">
                                            Identity Document <span class="text-brand-maroon">*</span>
                                        </label>
                                        <input type="file" name="identity_document" accept=".jpg,.jpeg,.png,.pdf"
                                               class="w-full text-sm text-gray-600 border border-gray-300 rounded-lg px-3 py-2
                                                      file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:text-sm
                                                      file:bg-brand-blue file:text-white hover:file:bg-brand-slate
                                                      @error('identity_document') border-brand-maroon @enderror">
                                        <p class="text-xs text-gray-400 mt-1">Citizenship / Passport · max 2MB</p>
                                        @error('identity_document')
                                            <p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-brand-dark mb-1">
                                            Driver's License <span class="text-brand-maroon">*</span>
                                        </label>
                                        <input type="file" name="drivers_license" accept=".jpg,.jpeg,.png,.pdf"
                                               class="w-full text-sm text-gray-600 border border-gray-300 rounded-lg px-3 py-2
                                                      file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:text-sm
                                                      file:bg-brand-bg file:text-brand-slate hover:file:bg-gray-200
                                                      @error('drivers_license') border-brand-maroon @enderror">
                                        <p class="text-xs text-gray-400 mt-1">Valid license · max 2MB</p>
                                        @error('drivers_license')
                                            <p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
                            <a href="{{ route('rental.vehicles.show', $vehicle) }}"
                               class="px-5 py-2 text-sm border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="px-6 py-2 text-sm bg-brand-maroon text-white rounded-lg hover:bg-red-800 transition font-semibold">
                                Confirm Booking
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
