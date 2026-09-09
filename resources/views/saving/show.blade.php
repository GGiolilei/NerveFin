<x-app-layout>
    <div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="bg-white p-6 rounded-lg shadow-sm flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold">{{ $goal->name }}</h2>
                <p class="text-sm text-gray-500">Target: Rp {{ number_format($goal->target_amount, 0, ',', '.') }}</p>
            </div>
            <a href="{{ route('savings.index') }}" class="text-sm border px-3 py-1.5 rounded-md text-gray-600 hover:bg-gray-50">&larr; Back to Goals</a>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-lg font-bold mb-4">Add Contribution</h3>
            <form method="POST" action="{{ route('savings.contribute', $goal) }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @csrf
                <div>
                    <label class="block text-xs font-medium text-gray-700">Deduct From Account</label>
                    <select name="financial_account_id" required class="mt-1 block w-full rounded-md border-gray-300 text-sm">
                        @foreach($accounts as $account)
                            <option value="{{ $account->id }}">{{ $account->name }} ({{ $account->formatted_balance }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-700">Amount (IDR)</label>
                    <input type="number" name="amount" required placeholder="500000" class="mt-1 block w-full rounded-md border-gray-300 text-sm" />
                </div>

                <div class="flex items-end">
                    <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-medium hover:bg-indigo-700">Contribute</button>
                </div>
            </form>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-lg font-bold mb-4">Contribution History</h3>
            <table class="w-full text-left divide-y text-sm">
                <thead>
                    <tr class="text-gray-500">
                        <th class="py-2">Date</th>
                        <th class="py-2">Member</th>
                        <th class="py-2 text-right">Amount</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($goal->contributions as $contribution)
                        <tr>
                            <td class="py-2.5">{{ \Carbon\Carbon::parse($contribution->contributed_at)->format('d M Y') }}</td>
                            <td class="py-2.5">{{ $contribution->user->name }}</td>
                            <td class="py-2.5 text-right font-semibold text-green-600">+Rp {{ number_format($contribution->amount, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-4 text-center text-gray-500">No contributions made yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>