<x-app-layout>
    <div class="py-12 max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <h2 class="text-xl font-bold mb-6">Add New Income</h2>

            <form method="POST" action="{{ route('incomes.store') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700">Income Name</label>
                    <input type="text" name="name" required placeholder="e.g. Giovani Salary" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Amount (IDR)</label>
                    <input type="number" name="amount" required placeholder="7000000" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Financial Account</label>
                        <select name="financial_account_id" required class="mt-1 block w-full rounded-md border-gray-300">
                            @foreach($accounts as $account)
                                <option value="{{ $account->id }}">{{ $account->name }} ({{ $account->formatted_balance }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Date Received</label>
                        <input type="datetime-local" name="received_at" value="{{ now()->format('Y-m-d\TH:i') }}" class="mt-1 block w-full rounded-md border-gray-300" />
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" rows="2" placeholder="Monthly salary bonus" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ route('incomes.index') }}" class="px-4 py-2 border rounded-md text-sm">Cancel</a>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm">Save Income</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>