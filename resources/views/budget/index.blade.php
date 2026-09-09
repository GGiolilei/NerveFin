<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Category Budgets</h2>
            <a href="{{ route('budgets.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-medium hover:bg-indigo-700">+ Set Budget</a>
        </div>

        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <table class="w-full text-left divide-y">
                <thead>
                    <tr class="text-sm text-gray-500">
                        <th class="py-2">Category</th>
                        <th class="py-2">Period</th>
                        <th class="py-2 text-right">Budget Limit</th>
                        <th class="py-2 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-sm">
                    @forelse($budgets as $budget)
                        <tr>
                            <td class="py-3 font-semibold text-gray-800">{{ $budget->category->name }}</td>
                            <td class="py-3 text-gray-600">
                                {{ DateTime::createFromFormat('!m', $budget->month)->format('F') }} {{ $budget->year }}
                            </td>
                            <td class="py-3 text-right font-bold text-indigo-600">
                                Rp {{ number_format($budget->amount, 0, ',', '.') }}
                            </td>
                            <td class="py-3 text-right space-x-2">
                                <a href="{{ route('budgets.edit', $budget) }}" class="text-xs text-indigo-600 hover:underline">Edit</a>
                                <form action="{{ route('budgets.destroy', $budget) }}" method="POST" class="inline" onsubmit="return confirm('Delete this budget setting?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-gray-500">
                                No budgets assigned yet. Click "+ Set Budget" to specify target monthly limits per category.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>