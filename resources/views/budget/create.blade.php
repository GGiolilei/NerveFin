<x-app-layout>
    <div class="py-6 md:py-12 max-w-xl mx-auto px-4 sm:px-6 lg:px-8 bg-[#F3F1EA]">
        <div class="bg-white shadow-sm rounded-3xl p-6 md:p-8">
            <div class="flex items-center gap-3 mb-6">
                <span class="w-10 h-10 rounded-2xl bg-emerald-50 flex items-center justify-center text-[#3E5C46] shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3v18h18M7 15l4-4 3 3 5-6"/></svg>
                </span>
                <div>
                    <h2 class="text-lg md:text-xl font-bold text-gray-900">Set Category Monthly Budget</h2>
                    <p class="text-xs text-gray-500 mt-0.5">Cap what you spend on a category each month</p>
                </div>
            </div>

            <form method="POST" action="{{ route('budgets.store') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700">Category</label>
                    <select name="category_id" required class="mt-1 block w-full rounded-xl border-gray-200 bg-[#F3F1EA] shadow-sm text-sm focus:border-[#3E5C46] focus:ring-[#3E5C46]">
                        <option value="">Select a Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Month</label>
                        <select name="month" required class="mt-1 block w-full rounded-xl border-gray-200 bg-[#F3F1EA] shadow-sm text-sm focus:border-[#3E5C46] focus:ring-[#3E5C46]">
                            @for($m = 1; $m <= 12; $m++)
                                <option value="{{ $m }}" {{ $m == date('n') ? 'selected' : '' }}>
                                    {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Year</label>
                        <input type="number" name="year" value="{{ date('Y') }}" required min="2020" class="mt-1 block w-full rounded-xl border-gray-200 bg-[#F3F1EA] shadow-sm text-sm focus:border-[#3E5C46] focus:ring-[#3E5C46]" />
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Monthly Budget Limit (IDR)</label>
                    <div class="relative mt-1">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-sm text-gray-400">Rp</span>
                        <input type="number" name="amount" required placeholder="1.500.000" class="block w-full rounded-xl border-gray-200 bg-[#F3F1EA] shadow-sm text-sm pl-9 focus:border-[#3E5C46] focus:ring-[#3E5C46]" />
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ route('budgets.index') }}" class="px-4 py-2.5 border border-gray-200 rounded-full text-sm font-medium text-gray-600 hover:bg-gray-50 transition-colors">Cancel</a>
                    <button type="submit" class="px-5 py-2.5 bg-[#3E5C46] text-white rounded-full text-sm font-medium hover:bg-[#33502F] hover:scale-105 transition-all shadow-sm">Save Budget</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>