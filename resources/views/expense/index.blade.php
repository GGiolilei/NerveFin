<x-app-layout>
    <div class="py-6 md:py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-[#F3F1EA]">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-6">
            <h2 class="text-xl md:text-2xl font-bold text-gray-900">Expenses</h2>
            <a href="{{ route('expenses.create') }}"
               class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 bg-[#3E5C46] text-white rounded-full text-sm font-medium hover:bg-[#33502F] hover:scale-105 transition-all shadow-sm w-fit">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Log Expense
            </a>
        </div>

        <div class="bg-white shadow-sm rounded-3xl p-4 md:p-6">

            {{-- Desktop / tablet table --}}
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left divide-y divide-gray-100">
                    <thead>
                        <tr class="text-sm text-gray-400">
                            <th class="py-2 font-medium">Date</th>
                            <th class="py-2 font-medium">Title</th>
                            <th class="py-2 font-medium">Category</th>
                            <th class="py-2 font-medium">Payment Method</th>
                            <th class="py-2 font-medium">Logged By</th>
                            <th class="py-2 font-medium text-right">Amount</th>
                            <th class="py-2 font-medium text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @forelse($expenses as $expense)
                            <tr class="hover:bg-[#F3F1EA] transition-colors">
                                <td class="py-3 text-gray-500">
                                    {{ $expense->spent_at ? $expense->spent_at->format('d M Y') : '-' }}
                                </td>
                                <td class="py-3 font-medium text-gray-900">{{ $expense->name }}</td>
                                <td class="py-3">
                                    <span class="bg-emerald-50 text-emerald-700 px-2 py-0.5 rounded-full text-xs font-semibold">
                                        {{ $expense->category?->name ?? $expense->budget?->category?->name ?? 'Uncategorized' }}
                                    </span>
                                </td>
                                <td class="py-3 text-gray-500">{{ $expense->paymentMethod?->name ?? '-' }}</td>
                                <td class="py-3 text-gray-500">{{ $expense->user?->name ?? 'System' }}</td>
                                <td class="py-3 text-right font-bold text-orange-600">-{{ $expense->formatted_amount }}</td>
                                <td class="py-3 text-right">
                                    <form action="{{ route('expenses.destroy', $expense) }}" method="POST" class="inline" onsubmit="return confirm('Delete this expense?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs font-medium text-red-500 hover:text-red-700 hover:underline">Delete</button>
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

            {{-- Mobile card list --}}
            <div class="md:hidden space-y-3">
                @forelse($expenses as $expense)
                    <div class="bg-[#F3F1EA] rounded-2xl p-3">
                        <div class="flex justify-between items-start gap-2">
                            <div class="min-w-0">
                                <p class="font-semibold text-gray-900 truncate">{{ $expense->name }}</p>
                                <p class="text-xs text-gray-500 mt-0.5">
                                    {{ $expense->spent_at ? $expense->spent_at->format('d M Y') : '-' }}
                                    &middot; {{ $expense->user?->name ?? 'System' }}
                                </p>
                            </div>
                            <p class="font-bold text-orange-600 whitespace-nowrap">-{{ $expense->formatted_amount }}</p>
                        </div>
                        <div class="flex items-center gap-2 mt-2 flex-wrap">
                            <span class="bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded-full text-xs font-semibold">
                                {{ $expense->category?->name ?? $expense->budget?->category?->name ?? 'Uncategorized' }}
                            </span>
                            @if($expense->paymentMethod?->name)
                                <span class="text-xs text-gray-400">{{ $expense->paymentMethod?->name }}</span>
                            @endif
                        </div>
                        <div class="flex justify-end mt-2">
                            <form action="{{ route('expenses.destroy', $expense) }}" method="POST" onsubmit="return confirm('Delete this expense?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs font-medium text-red-500 hover:text-red-700 hover:underline">Delete</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="py-4 text-center text-gray-500 text-sm">No expenses logged yet.</p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>