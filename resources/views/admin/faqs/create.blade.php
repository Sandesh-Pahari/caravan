@extends('admin.dashboard')

@section('content')
    <div class="max-w-2xl mx-auto">

        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('admin.faqs.index') }}"
               class="text-sm text-brand-blue hover:underline">← Back to FAQs</a>
        </div>

        <h1 class="text-xl font-bold text-brand-dark mb-6">Add FAQ</h1>

        <form method="POST" action="{{ route('admin.faqs.store') }}">
            @csrf

            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 space-y-5">

                <div>
                    <label class="block text-sm font-medium text-brand-dark mb-1">
                        Question <span class="text-brand-maroon">*</span>
                    </label>
                    <input type="text" name="question" value="{{ old('question') }}"
                           placeholder="e.g. How is the fare calculated?"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue @error('question') border-brand-maroon @enderror">
                    @error('question')<p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-brand-dark mb-1">
                        Answer <span class="text-brand-maroon">*</span>
                    </label>
                    <textarea name="answer" rows="5"
                              placeholder="Provide a clear, helpful answer…"
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue resize-none @error('answer') border-brand-maroon @enderror">{{ old('answer') }}</textarea>
                    @error('answer')<p class="text-brand-maroon text-xs mt-1">{{ $message }}</p>@enderror
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
                <a href="{{ route('admin.faqs.index') }}"
                   class="px-5 py-2 text-sm border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    Cancel
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-brand-blue text-white text-sm font-semibold rounded-lg hover:bg-brand-slate transition">
                    Save FAQ
                </button>
            </div>
        </form>
    </div>
@endsection
