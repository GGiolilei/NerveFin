<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="bg-white p-6 rounded-lg shadow-sm flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold">{{ DateTime::createFromFormat('!m', $review->month)->format('F') }} {{ $review->year }} Report</h2>
                <p class="text-sm text-gray-500">Automatic End-of-Month Calculation</p>
            </div>
            <div class="text-right">
                <span class="text-sm text-gray-500">Total Minus (Overspent)</span>
                <div class="text-2xl font-bold text-red-600">{{ $review->formatted_total_minus }}</div>
            </div>
        </div>

        <div class="bg-white shadow-sm rounded-lg p-6">
            <h3 class="font-bold text-lg mb-4">Category Breakdown</h3>
            <table class="w-full text-left divide-y">
                <thead>
                    <tr class="text-sm text-gray-500">
                        <th class="py-2">Category</th>
                        <th class="py-2">Budget</th>
                        <th class="py-2">Actual Spent</th>
                        <th class="py-2 text-right">Difference</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-sm">
                    @foreach($review->reviewCategories as $row)
                        <tr>
                            <td class="py-3 font-medium">{{ $row->category->name }}</td>
                            <td class="py-3">Rp {{ number_format($row->budget, 0, ',', '.') }}</td>
                            <td class="py-3">Rp {{ number_format($row->spending, 0, ',', '.') }}</td>
                            <td class="py-3 text-right font-bold {{ $row->overspent ? 'text-red-600' : 'text-green-600' }}">
                                {{ $row->formatted_difference }} {{ $row->overspent ? '🔴' : '🟢' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>