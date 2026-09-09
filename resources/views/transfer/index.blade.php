<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Account Transfers</h2>
            <a href="{{ route('transfers.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md">+ New Transfer</a>
        </div>

        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <table class="w-full text-left divide-y">
                <thead>
                    <tr class="text-sm text-gray-500">
                        <th class="py-2">Date</th>
                        <th class="py-2">From Account</th>
                        <th class="py-2">To Account</th>
                        <th class="py-2">Transferred By</th>
                        <th class="py-2 text-right">Amount</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-sm">
                    @forelse($transfers as $transfer)
                        <tr>
                            <td class="py-3">{{ $transfer->transferred_at->format('d M Y') }}</td>
                            <td class="py-3 font-medium text-red-600">{{ $transfer->fromAccount->name }}</td>
                            <td class="py-3 font-medium text-green-600">{{ $transfer->toAccount->name }}</td>
                            <td class="py-3">{{ $transfer->user->name }}</td>
                            <td class="py-3 text-right font-bold">{{ $transfer->formatted_amount }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 text-center text-gray-500">No transfers recorded yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>