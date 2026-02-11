@extends('admin.dashboard')

@section('content')
    <div class="max-w-2xl mx-auto">

        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('admin.policies.index') }}"
               class="text-sm text-brand-blue hover:underline">← Back to Policies</a>
        </div>

        <h1 class="text-xl font-bold text-brand-dark mb-6">Add Policy</h1>

        <form method="POST" action="{{ route('admin.policies.store') }}">
            @csrf

            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 space-y-5">

                <div>
                    <label class="block text-sm font-medium text-brand-dark mb-1">
                        Title <span class="text-brand-maroon">*</span>
                    </label>
                    <input type="text" name="title" value="{{ old('title') }}"
                           placeholder="e.g. Driver Requirements"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue @error('title') border-brand-maroon @enderror">
                    @error('title')<p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-brand-dark mb-1">
                            Icon (Font Awesome) <span class="text-brand-maroon">*</span>
                        </label>
                        <input type="text" name="icon" value="{{ old('icon', 'fa-file-lines') }}"
                               placeholder="fa-id-card"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-brand-blue @error('icon') border-brand-maroon @enderror">
                        <p class="text-xs text-gray-400 mt-1">Use FA6 class names, e.g. <code class="bg-gray-100 px-1 rounded">fa-shield-halved</code></p>
                        @error('icon')<p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-brand-dark mb-1">
                            Color <span class="text-brand-maroon">*</span>
                        </label>
                        <select name="color"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue @error('color') border-brand-maroon @enderror">
                            @foreach(['blue' => 'Blue', 'maroon' => 'Maroon', 'forest' => 'Forest Green', 'slate' => 'Slate'] as $val => $label)
                                <option value="{{ $val }}" {{ old('color', 'blue') === $val ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('color')<p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-brand-dark mb-1">
                        Bullet Points <span class="text-brand-maroon">*</span>
                    </label>
                    <textarea name="items" rows="5"
                              placeholder="Enter one bullet point per line:&#10;Minimum age of 21 years&#10;Valid driving license required&#10;National ID at pickup"
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue resize-none @error('items') border-brand-maroon @enderror">{{ old('items') }}</textarea>
                    <p class="text-xs text-gray-400 mt-1">One bullet point per line.</p>
                    @error('items')<p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-brand-dark mb-1">Sort Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue">
                        <p class="text-xs text-gray-400 mt-1">Lower numbers appear first.</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-brand-dark mb-1">Status</label>
                        <label class="flex items-center gap-2 mt-2 cursor-pointer">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1"
                                   {{ old('is_active', '1') == '1' ? 'checked' : '' }}
                                   class="w-4 h-4 accent-brand-blue">
                            <span class="text-sm text-brand-dark">Visible on homepage</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-5">
                <a href="{{ route('admin.policies.index') }}"
                   class="px-5 py-2 text-sm border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    Cancel
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-brand-blue text-white text-sm font-semibold rounded-lg hover:bg-brand-slate transition">
                    Save Policy
                </button>
            </div>
        </form>
    </div>
@endsection
