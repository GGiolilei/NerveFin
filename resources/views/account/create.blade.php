<x-app-layout>
    <div class="py-12 max-w-xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <h2 class="text-xl font-bold mb-6">Create Financial Account</h2>

            <form method="POST" action="{{ route('accounts.store') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700">Account Name</label>
                    <input type="text" name="name" required placeholder="e.g. BCA, Mandiri, GoPay" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Account Type</label>
                    <select name="type" required class="mt-1 block w-full rounded-md border-gray-300">
                        <option value="bank">Bank</option>
                        <option value="ewallet">E-Wallet</option>
                        <option value="cash">Cash</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Initial Balance (IDR)</label>
                    <input type="number" name="balance" required value="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ route('accounts.index') }}" class="px-4 py-2 border rounded-md text-sm">Cancel</a>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm">Save Account</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>