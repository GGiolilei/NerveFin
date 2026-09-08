<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Expenses</h2>
            <a href="{{ route('expenses.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md">+ Add Expense</a>
        </div>

        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <table class="w-full text-left divide-y">
                <thead>
                    <tr class="text-sm text-gray-500">
                        <th class="py-2">Date</th>
                        <th class="py-2">Title</th>
                        <th class="py-2">Category</th>
                        <th class="py-2">Paid By</th>
                        <th class="py-2">Method</th>
                        <th class="py-2">Account</th>
                        <th class="py-2 text-right">Amount</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-sm">
                    @foreach($expenses as $expense)
                        <tr>
                            <td class="py-3">{{ $expense->spent_at->format('d M Y') }}</td>
                            <td class="py-3 font-medium">{{ $expense->name }}</td>
                            <td class="py-3">{{ $expense->category->name }}</td>
                            <td class="py-3">{{ $expense->user->name }}</td>
                            <td class="py-3">{{ $expense->paymentMethod->name }}</td>
                            <td class="py-3">{{ $expense->financialAccount->name }}</td>
                            <td class="py-3 text-right font-semibold text-red-600">-{{ $expense->formatted_amount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>