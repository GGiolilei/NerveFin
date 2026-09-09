<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Monthly Financial Reviews</h2>
        </div>

        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <table class="w-full text-left divide-y">
                <thead>
                    <tr class="text-sm text-gray-500">
                        <th class="py-2">Period</th>
                        <th class="py-2 text-right">Total Income</th>
                        <th class="py-2 text-right">Total Expenses</th>
                        <th class="py-2 text-right">Net Savings</th>
                        <th class="py-2 text-center">Overspent Categories</th>
                        <th class="py-2 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-sm">
                    @forelse($reviews as $review)
                        <tr>
                            <td class="py-3 font-semibold">
                                {{ DateTime::createFromFormat('!m', $review->month)->format('F') }} {{ $review->year }}
                            </td>
                            <td class="py-3 text-right text-green-600 font-medium">
                                Rp {{ number_format($review->total_income, 0, ',', '.') }}
                            </td>
                            <td class="py-3 text-right text-red-600 font-medium">
                                Rp {{ number_format($review->total_expenses, 0, ',', '.') }}
                            </td>
                            <td class="py-3 text-right font-bold {{ $review->net_savings >= 0 ? 'text-indigo-600' : 'text-red-500' }}">
                                Rp {{ number_format($review->net_savings, 0, ',', '.') }}
                            </td>
                            <td class="py-3 text-center">
                                @if($review->overspent_categories_count > 0)
                                    <span class="bg-red-100 text-red-700 text-xs px-2 py-1 rounded-full font-bold">
                                        {{ $review->overspent_categories_count }} Categories
                                    </span>
                                @else
                                    <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full font-bold">
                                        On Budget
                                    </span>
                                @endif
                            </td>
                            <td class="py-3 text-right">
                                <a href="{{ route('reviews.show', $review) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">
                                    View Breakdown &rarr;
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-4 text-center text-gray-500">
                                No monthly review reports compiled yet. Run <code class="text-xs bg-gray-100 p-1 rounded">php artisan financial:process-monthly-review</code> to generate one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>