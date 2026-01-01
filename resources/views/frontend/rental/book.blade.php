@extends('template.template')

@section('pagecontent')
    {{-- Leaflet CSS (loaded here as template has no @stack mechanism) --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
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
                    <p class="text-xs text-gray-400 mt-0.5">
                        {{ $vehicle->vehicle_number }} &middot; {{ $vehicle->number_of_seats }} Seats &middot; {{ ucfirst($vehicle->condition) }}
                    </p>
                    @if($vehicle->fare_per_day)
                        <p class="text-xs text-brand-maroon font-medium mt-1">
                            Hold Fare: NPR {{ number_format($vehicle->fare_per_day, 0) }} / day (after 1st day)
                        </p>
                    @endif
                </div>
            </div>

            {{-- Error Flash --}}
            @if(session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 text-sm flex gap-2">
                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 text-sm">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Booking Type + Form --}}
            <div
                x-data="{
                    type: '{{ old('booking_type', 'with_driver') }}',
                    distanceReady: {{ old('distance_km') ? 'true' : 'false' }}
                }"
                @distance-calculated.window="distanceReady = true"
                @distance-failed.window="distanceReady = false"
            >
                {{-- Toggle --}}
                <div class="flex rounded-xl overflow-hidden border border-brand-blue mb-8">
                    <button type="button"
                            @click="type = 'with_driver'"
                            :class="type === 'with_driver' ? 'bg-brand-blue text-white' : 'bg-white text-brand-blue hover:bg-brand-blue/5'"
                            class="flex-1 py-3 text-sm font-semibold transition flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        With Driver
                    </button>
                    <button type="button"
                            @click="type = 'self_drive'"
                            :class="type === 'self_drive' ? 'bg-brand-blue text-white' : 'bg-white text-brand-blue hover:bg-brand-blue/5'"
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

                        {{-- ── Personal Info ── --}}
                        <div>
                            <h2 class="text-sm font-semibold text-brand-blue pb-2 border-b-2 border-brand-blue/20 mb-4">
                                Personal Information
                            </h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-brand-dark mb-1">
                                        Full Name <span class="text-brand-maroon">*</span>
                                    </label>
                                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Your full name"
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue @error('name') border-brand-maroon @enderror">
                                    @error('name')<p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-brand-dark mb-1">
                                        Phone Number <span class="text-brand-maroon">*</span>
                                    </label>
                                    <input type="tel" name="phone_number" value="{{ old('phone_number') }}" placeholder="+977 98XXXXXXXX"
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue @error('phone_number') border-brand-maroon @enderror">
                                    @error('phone_number')<p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block text-sm font-medium text-brand-dark mb-1">
                                        Email Address <span class="text-brand-maroon">*</span>
                                    </label>
                                    <input type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com"
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue @error('email') border-brand-maroon @enderror">
                                    @error('email')<p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>
                        </div>

                        {{-- ── Trip Details (shared) ── --}}
                        <div>
                            <h2 class="text-sm font-semibold text-brand-blue pb-2 border-b-2 border-brand-blue/20 mb-4">
                                Trip Details
                            </h2>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-brand-dark mb-1">
                                        Vehicle <span class="text-brand-maroon">*</span>
                                    </label>
                                    <select name="vehicle_id"
                                            onchange="this.form.action='{{ url('rental/bookings/create') }}/'+this.value; this.form.method='GET'; this.form.submit();"
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
                                    <input type="date" name="date" value="{{ old('date') }}" min="{{ now()->toDateString() }}"
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue @error('date') border-brand-maroon @enderror">
                                    @error('date')<p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-brand-dark mb-1">
                                        Pickup Time <span class="text-brand-maroon">*</span>
                                    </label>
                                    <input type="time" name="pickup_time" value="{{ old('pickup_time') }}"
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue @error('pickup_time') border-brand-maroon @enderror">
                                    @error('pickup_time')<p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-brand-dark mb-1">
                                        Number of Days <span class="text-brand-maroon">*</span>
                                    </label>
                                    <input type="number" name="days_taken" value="{{ old('days_taken', 1) }}" min="1"
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue @error('days_taken') border-brand-maroon @enderror">
                                    @error('days_taken')<p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>
                        </div>

                        {{-- ── With Driver: Route & Trip Type ── --}}
                        <div x-show="type === 'with_driver'" x-transition>
                            <h2 class="text-sm font-semibold text-brand-blue pb-2 border-b-2 border-brand-blue/20 mb-4">
                                Route & Trip Type
                            </h2>

                            {{-- Trip Type --}}
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-brand-dark mb-2">
                                    Trip Type <span class="text-brand-maroon">*</span>
                                </label>
                                <div class="grid grid-cols-2 gap-3">
                                    <label class="relative flex items-start gap-3 border-2 rounded-xl p-4 cursor-pointer transition has-[:checked]:border-brand-blue has-[:checked]:bg-brand-blue/5 border-gray-200">
                                        <input type="radio" name="trip_type" value="one_way"
                                               {{ old('trip_type', 'one_way') === 'one_way' ? 'checked' : '' }}
                                               class="mt-0.5 accent-brand-blue">
                                        <div>
                                            <p class="text-sm font-semibold text-brand-dark">One Way</p>
                                            <p class="text-xs text-gray-400 mt-0.5">Driver returns after drop — return distance charged</p>
                                        </div>
                                    </label>
                                    <label class="relative flex items-start gap-3 border-2 rounded-xl p-4 cursor-pointer transition has-[:checked]:border-brand-blue has-[:checked]:bg-brand-blue/5 border-gray-200">
                                        <input type="radio" name="trip_type" value="round_trip"
                                               {{ old('trip_type') === 'round_trip' ? 'checked' : '' }}
                                               class="mt-0.5 accent-brand-blue">
                                        <div>
                                            <p class="text-sm font-semibold text-brand-dark">Round Trip</p>
                                            <p class="text-xs text-gray-400 mt-0.5">Driver stays with you — only actual distance charged</p>
                                        </div>
                                    </label>
                                </div>
                                @error('trip_type')<p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            {{-- Pickup Address (Places autocomplete) --}}
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-brand-dark mb-1">
                                        Pickup Address <span class="text-brand-maroon">*</span>
                                    </label>
                                    <input type="text"
                                           id="pickup_address"
                                           name="pickup_address"
                                           value="{{ old('pickup_address') }}"
                                           placeholder="Search and select pickup location…"
                                           autocomplete="off"
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue @error('pickup_address') border-brand-maroon @enderror">
                                    @error('pickup_address')<p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>@enderror
                                    <input type="hidden" name="pickup_lat" id="pickup_lat" value="{{ old('pickup_lat') }}">
                                    <input type="hidden" name="pickup_lng" id="pickup_lng" value="{{ old('pickup_lng') }}">
                                </div>

                                {{-- Drop Address (Places autocomplete) --}}
                                <div>
                                    <label class="block text-sm font-medium text-brand-dark mb-1">
                                        Drop Address <span class="text-brand-maroon">*</span>
                                    </label>
                                    <input type="text"
                                           id="drop_address"
                                           name="drop_address"
                                           value="{{ old('drop_address') }}"
                                           placeholder="Search and select drop location…"
                                           autocomplete="off"
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue @error('drop_address') border-brand-maroon @enderror">
                                    @error('drop_address')<p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>@enderror
                                    <input type="hidden" name="drop_lat" id="drop_lat" value="{{ old('drop_lat') }}">
                                    <input type="hidden" name="drop_lng" id="drop_lng" value="{{ old('drop_lng') }}">
                                </div>

                                {{-- Hidden distance field --}}
                                <input type="hidden" name="distance_km" id="distance_km" value="{{ old('distance_km') }}">

                                {{-- Distance Result Display --}}
                                <div id="distance_display" class="{{ old('distance_km') ? '' : 'hidden' }}">
                                    <div class="bg-brand-blue/5 border border-brand-blue/20 rounded-lg px-4 py-3 flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-5 h-5 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            <span class="text-sm text-brand-dark font-medium">Calculated Distance</span>
                                        </div>
                                        <span id="distance_text" class="text-sm font-bold text-brand-blue">
                                            {{ old('distance_km', '—') }} km
                                        </span>
                                    </div>
                                    <p class="text-xs text-gray-400 mt-1">
                                        One-way bookings are charged for both directions (vehicle must return). Round-trip uses actual distance only.
                                    </p>
                                </div>

                                {{-- Calculating spinner --}}
                                <div id="distance_loading" class="hidden">
                                    <div class="bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 flex items-center gap-2 text-sm text-gray-500">
                                        <svg class="w-4 h-4 animate-spin text-brand-blue" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                        </svg>
                                        Calculating distance…
                                    </div>
                                </div>

                                {{-- Reminder when no distance yet --}}
                                <div x-show="!distanceReady" class="flex items-center gap-2 text-sm text-amber-600">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Select both pickup and drop from the suggestions to calculate distance and fare.
                                </div>

                                {{-- Leaflet route map (shown after both locations selected) --}}
                                <div id="route_map"
                                     class="hidden rounded-xl overflow-hidden border border-brand-blue/20"
                                     style="height: 260px;"></div>
                            </div>
                        </div>

                        {{-- ── Self Drive Fields ── --}}
                        <div x-show="type === 'self_drive'" x-transition>
                            <h2 class="text-sm font-semibold text-brand-blue pb-2 border-b-2 border-brand-blue/20 mb-4">
                                Self Drive Details
                            </h2>

                            <div class="bg-amber-50 border border-amber-300 rounded-lg px-4 py-3 mb-4 flex gap-3">
                                <svg class="w-5 h-5 text-amber-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                                </svg>
                                <div class="text-sm text-amber-800">
                                    <p class="font-semibold mb-0.5">Identity Verification Required</p>
                                    <p>A valid government-issued identity document and a driver's license are mandatory for self drive bookings. Uploads must be clear and legible (JPG, PNG, or PDF).</p>
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
                                    @error('pickup_location')<p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>@enderror
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
                                        @error('identity_document')<p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>@enderror
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
                                        @error('drivers_license')<p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>@enderror
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
                                    :disabled="type === 'with_driver' && !distanceReady"
                                    :class="(type === 'with_driver' && !distanceReady)
                                        ? 'bg-gray-300 text-gray-500 cursor-not-allowed'
                                        : 'bg-brand-maroon hover:bg-red-800 text-white'"
                                    class="px-6 py-2 text-sm rounded-lg transition font-semibold">
                                Confirm Booking
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Leaflet JS + OpenStreetMap / Nominatim / OSRM booking map --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
    (function () {
        'use strict';

        const pickupInput = document.getElementById('pickup_address');
        const dropInput   = document.getElementById('drop_address');
        if (!pickupInput || !dropInput) return;

        // Restore coordinates from server-side old() values when validation fails
        let pickupCoords = @json(old('pickup_lat') && old('pickup_lng')
            ? ['lat' => (float) old('pickup_lat'), 'lng' => (float) old('pickup_lng')]
            : null);
        let dropCoords = @json(old('drop_lat') && old('drop_lng')
            ? ['lat' => (float) old('drop_lat'), 'lng' => (float) old('drop_lng')]
            : null);

        let map = null, pickupMarker = null, dropMarker = null, routeLine = null;

        // ── UI helpers ────────────────────────────────────────────────────────

        function showLoading() {
            document.getElementById('distance_display').classList.add('hidden');
            document.getElementById('distance_loading').classList.remove('hidden');
        }

        function showDistance(km) {
            document.getElementById('distance_loading').classList.add('hidden');
            document.getElementById('distance_display').classList.remove('hidden');
            document.getElementById('distance_text').textContent = km + ' km';
            document.getElementById('distance_km').value = km;
            window.dispatchEvent(new CustomEvent('distance-calculated'));
        }

        function showError() {
            document.getElementById('distance_loading').classList.add('hidden');
            document.getElementById('distance_display').classList.add('hidden');
            document.getElementById('distance_km').value = '';
            window.dispatchEvent(new CustomEvent('distance-failed'));
        }

        // ── Leaflet map ───────────────────────────────────────────────────────

        function makeMarkerIcon(color) {
            return L.divIcon({
                className: '',
                html: '<div style="width:14px;height:14px;background:' + color + ';border:2px solid white;border-radius:50%;box-shadow:0 1px 4px rgba(0,0,0,0.35)"></div>',
                iconSize: [14, 14],
                iconAnchor: [7, 7],
            });
        }

        function initMap() {
            if (map) return;
            document.getElementById('route_map').classList.remove('hidden');
            map = L.map('route_map').setView([28.3949, 84.1240], 7);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 18,
            }).addTo(map);
        }

        function updateMap(routeGeometry) {
            initMap();

            if (pickupMarker) { map.removeLayer(pickupMarker); }
            if (dropMarker)   { map.removeLayer(dropMarker); }
            if (routeLine)    { map.removeLayer(routeLine); }

            pickupMarker = L.marker([pickupCoords.lat, pickupCoords.lng], { icon: makeMarkerIcon('#1d4ed8') }).addTo(map);
            dropMarker   = L.marker([dropCoords.lat,   dropCoords.lng],   { icon: makeMarkerIcon('#be123c') }).addTo(map);

            if (routeGeometry) {
                routeLine = L.geoJSON(routeGeometry, {
                    style: { color: '#1d4ed8', weight: 4, opacity: 0.7 },
                }).addTo(map);
                map.fitBounds(routeLine.getBounds(), { padding: [30, 30] });
            } else {
                map.fitBounds(
                    L.latLngBounds(
                        [pickupCoords.lat, pickupCoords.lng],
                        [dropCoords.lat, dropCoords.lng]
                    ),
                    { padding: [40, 40] }
                );
            }

            setTimeout(function () { map.invalidateSize(); }, 120);
        }

        // ── OSRM distance + route geometry ────────────────────────────────────

        function calculateDistance() {
            if (!pickupCoords || !dropCoords) return;

            showLoading();

            // OSRM expects coordinates as longitude,latitude
            var url = 'https://router.project-osrm.org/route/v1/driving/'
                + pickupCoords.lng + ',' + pickupCoords.lat + ';'
                + dropCoords.lng  + ',' + dropCoords.lat
                + '?overview=full&geometries=geojson';

            fetch(url)
                .then(function (r) { return r.json(); })
                .then(function (data) {
                    if (data.code !== 'Ok' || !data.routes || !data.routes.length) {
                        showError();
                        return;
                    }
                    var km = (data.routes[0].distance / 1000).toFixed(2);
                    showDistance(km);
                    updateMap(data.routes[0].geometry);
                })
                .catch(function () { showError(); });
        }

        // ── Nominatim address autocomplete ────────────────────────────────────

        function buildAutocomplete(input, onSelect) {
            var timer = null;
            var dropdown = null;

            function closeDropdown() {
                if (dropdown) { dropdown.remove(); dropdown = null; }
            }

            function openDropdown(results) {
                closeDropdown();
                if (!results.length) return;

                dropdown = document.createElement('ul');
                dropdown.setAttribute('style',
                    'position:absolute;z-index:9999;width:100%;background:#fff;'
                    + 'border:1px solid #e5e7eb;border-radius:8px;box-shadow:0 4px 12px rgba(0,0,0,.1);'
                    + 'margin-top:4px;max-height:208px;overflow-y:auto;list-style:none;padding:0;'
                );

                results.forEach(function (r) {
                    var li = document.createElement('li');
                    li.setAttribute('style', 'padding:8px 12px;cursor:pointer;font-size:.875rem;line-height:1.4;color:#1e293b;');
                    li.textContent = r.display_name;
                    li.addEventListener('mouseover', function () { li.style.background = '#eff6ff'; });
                    li.addEventListener('mouseout',  function () { li.style.background = ''; });
                    li.addEventListener('mousedown', function (e) {
                        e.preventDefault();
                        input.value = r.display_name;
                        closeDropdown();
                        onSelect({ lat: parseFloat(r.lat), lng: parseFloat(r.lon) });
                    });
                    dropdown.appendChild(li);
                });

                var wrapper = input.parentElement;
                if (getComputedStyle(wrapper).position === 'static') {
                    wrapper.style.position = 'relative';
                }
                wrapper.appendChild(dropdown);
            }

            input.addEventListener('input', function () {
                clearTimeout(timer);
                var q = input.value.trim();
                if (q.length < 3) { closeDropdown(); return; }

                timer = setTimeout(function () {
                    fetch(
                        'https://nominatim.openstreetmap.org/search?q=' + encodeURIComponent(q)
                        + '&format=json&limit=5&addressdetails=0&countrycodes=np',
                        { headers: { 'Accept-Language': 'en' } }
                    )
                        .then(function (r) { return r.json(); })
                        .then(openDropdown)
                        .catch(closeDropdown);
                }, 400);
            });

            input.addEventListener('blur', function () {
                setTimeout(closeDropdown, 200);
            });
        }

        // ── Wire up ───────────────────────────────────────────────────────────

        buildAutocomplete(pickupInput, function (coords) {
            pickupCoords = coords;
            document.getElementById('pickup_lat').value = coords.lat;
            document.getElementById('pickup_lng').value = coords.lng;
            calculateDistance();
        });

        buildAutocomplete(dropInput, function (coords) {
            dropCoords = coords;
            document.getElementById('drop_lat').value = coords.lat;
            document.getElementById('drop_lng').value = coords.lng;
            calculateDistance();
        });

        // Recalculate if returning from validation failure with stored coordinates
        if (pickupCoords && dropCoords) {
            calculateDistance();
        }
    }());
    </script>
@endsection
