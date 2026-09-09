<x-app-layout>
    <div class="py-12 max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <h2 class="text-xl font-bold mb-6">Record New Expense</h2>

            <form method="POST" action="{{ route('expenses.store') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700">Expense Title</label>
                    <input type="text" name="name" required placeholder="e.g. McDonald's" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Amount (IDR)</label>
                    <input type="number" name="amount" required placeholder="85000" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Target Budget Pool</label>
                        <select name="budget_id" required class="mt-1 block w-full rounded-md border-gray-300">
                            <option value="">-- Select Budget --</option>
                            @foreach($budgets as $budget)
                                <option value="{{ $budget->id }}">
                                    {{ $budget->category?->name ?? 'Uncategorized' }} (Limit: Rp {{ number_format($budget->amount, 0, ',', '.') }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Payment Method</label>
                        <select name="payment_method_id" required class="mt-1 block w-full rounded-md border-gray-300">
                            @foreach($paymentMethods as $method)
                                <option value="{{ $method->id }}">{{ $method->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Date Spent</label>
                    <input type="datetime-local" name="spent_at" value="{{ now()->format('Y-m-d\TH:i') }}" class="mt-1 block w-full rounded-md border-gray-300" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Description / Note</label>
                    <textarea name="description" rows="2" placeholder="Dinner after work" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ route('expenses.index') }}" class="px-4 py-2 border rounded-md text-sm">Cancel</a>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm">Save Expense</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>