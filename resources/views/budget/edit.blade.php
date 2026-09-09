<x-app-layout>
    <div class="py-12 max-w-xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <h2 class="text-xl font-bold mb-6">Edit Budget: {{ $budget->category->name }}</h2>

            <form method="POST" action="{{ route('budgets.update', $budget) }}" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-500">Period</label>
                    <p class="text-base font-semibold text-gray-800 mt-1">
                        {{ DateTime::createFromFormat('!m', $budget->month)->format('F') }} {{ $budget->year }}
                    </p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Monthly Budget Limit (IDR)</label>
                    <input type="number" name="amount" value="{{ $budget->amount }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm" />
                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ route('budgets.index') }}" class="px-4 py-2 border rounded-md text-sm text-gray-700 hover:bg-gray-50">Cancel</a>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-medium hover:bg-indigo-700">Update Limit</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>