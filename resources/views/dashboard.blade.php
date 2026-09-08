<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $household->name ?? 'Dashboard' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Financial Accounts Overview -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                @foreach($accounts as $account)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="text-sm font-medium text-gray-500">{{ $account->name }} ({{ strtoupper($account->type) }})</div>
                        <div class="text-2xl font-bold text-gray-900 mt-2">{{ $account->formatted_balance }}</div>
                    </div>
                @endforeach
            </div>

            <!-- Recent Expenses -->
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Recent Expenses</h3>
                    <a href="{{ route('expenses.create') }}" class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-md shadow-sm">+ Add Expense</a>
                </div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b text-sm text-gray-500">
                            <th class="pb-2">Date</th>
                            <th class="pb-2">Item</th>
                            <th class="pb-2">Category</th>
                            <th class="pb-2">Who Spent</th>
                            <th class="pb-2">Account</th>
                            <th class="pb-2 text-right">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y text-sm">
                        @forelse($recentExpenses as $expense)
                            <tr>
                                <td class="py-3">{{ $expense->spent_at->format('d M Y') }}</td>
                                <td class="py-3 font-medium text-gray-900">{{ $expense->name }}</td>
                                <td class="py-3">{{ $expense->category->name }}</td>
                                <td class="py-3">{{ $expense->user->name }}</td>
                                <td class="py-3">{{ $expense->financialAccount->name }}</td>
                                <td class="py-3 text-right font-bold text-red-600">-{{ $expense->formatted_amount }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-4 text-center text-gray-500">No expenses recorded yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>