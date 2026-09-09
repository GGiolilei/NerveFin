<x-app-layout>
    <div class="py-12 max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-2xl p-6 border border-gray-100">
            <h2 class="text-xl font-bold mb-6 text-gray-900">Record New Expense</h2>

            <form method="POST" action="{{ route('expenses.store') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700">Expense Title</label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="e.g. McDonald's" 
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" />
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Amount (IDR)</label>
                    <input type="number" name="amount" value="{{ old('amount') }}" required placeholder="85000" 
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" />
                    @error('amount') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Target Budget Pool</label>
                        <select name="budget_id" required class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            <option value="">-- Select Budget --</option>
                            @forelse($budgets as $budget)
                                <option value="{{ $budget->id }}" {{ old('budget_id') == $budget->id ? 'selected' : '' }}>
                                    {{ $budget->category?->name ?? 'Uncategorized' }} (Cap: Rp {{ number_format($budget->amount, 0, ',', '.') }})
                                </option>
                            @empty
                                <option value="" disabled>No active budgets found for {{ now()->format('F Y') }}</option>
                            @endforelse
                        </select>
                        @error('budget_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Payment Method</label>
                        <select name="payment_method_id" required class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            <option value="">-- Select Method --</option>
                            @foreach($paymentMethods as $method)
                                <option value="{{ $method->id }}" {{ old('payment_method_id') == $method->id ? 'selected' : '' }}>
                                    {{ $method->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('payment_method_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Financial Account (Optional)</label>
                    <select name="financial_account_id" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        <option value="">-- None / Cash --</option>
                        @foreach($financialAccounts ?? [] as $account)
                            <option value="{{ $account->id }}" {{ old('financial_account_id') == $account->id ? 'selected' : '' }}>
                                {{ $account->name }} (Rp {{ number_format($account->balance ?? 0, 0, ',', '.') }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Date Spent</label>
                    <input type="datetime-local" name="spent_at" value="{{ old('spent_at', now()->format('Y-m-d\TH:i')) }}" 
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" />
                    @error('spent_at') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Description / Note</label>
                    <textarea name="description" rows="2" placeholder="Dinner after work" 
                              class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">{{ old('description') }}</textarea>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('expenses.index') }}" class="px-4 py-2 border rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg text-sm shadow-sm">Save Expense</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>