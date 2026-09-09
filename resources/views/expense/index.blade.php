<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Expenses</h2>
            <a href="{{ route('expenses.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-medium hover:bg-indigo-700">+ Log Expense</a>
        </div>

        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <table class="w-full text-left divide-y">
                <thead>
                    <tr class="text-sm text-gray-500">
                        <th class="py-2">Date</th>
                        <th class="py-2">Title</th>
                        <th class="py-2">Category</th>
                        <th class="py-2">Payment Method</th>
                        <th class="py-2">Logged By</th>
                        <th class="py-2 text-right">Amount</th>
                        <th class="py-2 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-sm">
                    @forelse($expenses as $expense)
                        <tr>
                            <td class="py-3 text-gray-600">
                                {{ $expense->spent_at ? $expense->spent_at->format('d M Y') : '-' }}
                            </td>
                            <td class="py-3 font-medium text-gray-900">{{ $expense->name }}</td>
                            <td class="py-3">
                                <span class="bg-gray-100 text-gray-700 px-2 py-0.5 rounded text-xs font-semibold">
                                    {{ $expense->category?->name ?? $expense->budget?->category?->name ?? 'Uncategorized' }}
                                </span>
                            </td>
                            <td class="py-3 text-gray-600">{{ $expense->paymentMethod?->name ?? '-' }}</td>
                            <td class="py-3 text-gray-600">{{ $expense->user?->name ?? 'System' }}</td>
                            <td class="py-3 text-right font-bold text-red-600">-{{ $expense->formatted_amount }}</td>
                            <td class="py-3 text-right">
                                <form action="{{ route('expenses.destroy', $expense) }}" method="POST" class="inline" onsubmit="return confirm('Delete this expense?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-4 text-center text-gray-500">No expenses logged yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>