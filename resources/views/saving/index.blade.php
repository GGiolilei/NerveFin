<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Monthly Budgets ({{ date('F Y') }})</h2>
            <a href="{{ route('budgets.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md">+ Set Budget</a>
        </div>

        <div class="bg-white shadow-sm rounded-lg p-6">
            <table class="w-full text-left divide-y">
                <thead>
                    <tr class="text-sm text-gray-500">
                        <th class="py-2">Category</th>
                        <th class="py-2">Period</th>
                        <th class="py-2 text-right">Budgeted Amount</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-sm">
                    @foreach($budgets as $budget)
                        <tr>
                            <td class="py-3 font-medium">{{ $budget->category->name }}</td>
                            <td class="py-3">{{ DateTime::createFromFormat('!m', $budget->month)->format('F') }} {{ $budget->year }}</td>
                            <td class="py-3 text-right font-bold text-indigo-600">{{ $budget->formatted_amount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>