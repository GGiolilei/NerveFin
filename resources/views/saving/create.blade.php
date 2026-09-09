<x-app-layout>
    <div class="py-12 max-w-xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <h2 class="text-xl font-bold mb-6">Create Saving Goal</h2>

            <form method="POST" action="{{ route('savings.store') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700">Goal Name</label>
                    <input type="text" name="name" required placeholder="e.g. Emergency Fund, New Laptop" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Target Amount (IDR)</label>
                    <input type="number" name="target_amount" required placeholder="10000000" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Deadline (Optional)</label>
                    <input type="date" name="deadline" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" rows="2" placeholder="Details about this financial goal..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ route('savings.index') }}" class="px-4 py-2 border rounded-md text-sm">Cancel</a>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm">Create Goal</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>