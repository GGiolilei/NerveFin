<x-app-layout>
    <div class="py-12 max-w-xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <h2 class="text-xl font-bold mb-6">Set Category Monthly Budget</h2>

            <form method="POST" action="{{ route('budgets.store') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700">Category</label>
                    <select name="category_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                        <option value="">Select a Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Month</label>
                        <select name="month" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                            @for($m = 1; $m <= 12; $m++)
                                <option value="{{ $m }}" {{ $m == date('n') ? 'selected' : '' }}>
                                    {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Year</label>
                        <input type="number" name="year" value="{{ date('Y') }}" required min="2020" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm" />
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Monthly Budget Limit (IDR)</label>
                    <input type="number" name="amount" required placeholder="1500000" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm" />
                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ route('budgets.index') }}" class="px-4 py-2 border rounded-md text-sm text-gray-700 hover:bg-gray-50">Cancel</a>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-medium hover:bg-indigo-700">Save Budget</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>