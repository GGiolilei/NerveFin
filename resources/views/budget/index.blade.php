<x-app-layout>
    <div class="py-6 md:py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-[#F3F1EA]">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-6">
            <h2 class="text-xl md:text-2xl font-bold text-gray-900">Category Budgets</h2>
            <a href="{{ route('budgets.create') }}"
               class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 bg-[#3E5C46] text-white rounded-full text-sm font-medium hover:bg-[#33502F] hover:scale-105 transition-all shadow-sm w-fit">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Set Budget
            </a>
        </div>

        @php
            $badgeColors = ['bg-emerald-50 text-emerald-700', 'bg-amber-50 text-amber-700', 'bg-sky-50 text-sky-700', 'bg-rose-50 text-rose-700', 'bg-violet-50 text-violet-700', 'bg-orange-50 text-orange-700'];
        @endphp

        <div class="bg-white shadow-sm rounded-3xl p-4 md:p-6">

            {{-- Desktop / tablet table --}}
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left divide-y divide-gray-100">
                    <thead>
                        <tr class="text-sm text-gray-400">
                            <th class="py-2 font-medium">Category</th>
                            <th class="py-2 font-medium">Period</th>
                            <th class="py-2 font-medium text-right">Budget Limit</th>
                            <th class="py-2 font-medium text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @forelse($budgets as $budget)
                            <tr class="group hover:bg-[#F3F1EA] transition-colors">
                                <td class="py-3">
                                    <div class="flex items-center gap-2.5">
                                        <span class="w-8 h-8 rounded-xl {{ $badgeColors[$loop->index % count($badgeColors)] }} flex items-center justify-center font-bold text-xs shrink-0">
                                            {{ strtoupper(substr($budget->category->name, 0, 1)) }}
                                        </span>
                                        <span class="font-semibold text-gray-800">{{ $budget->category->name }}</span>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <span class="bg-gray-100 text-gray-600 px-2.5 py-1 rounded-full text-xs font-medium">
                                        {{ DateTime::createFromFormat('!m', $budget->month)->format('F') }} {{ $budget->year }}
                                    </span>
                                </td>
                                <td class="py-3 text-right font-bold text-[#3E5C46]">
                                    Rp {{ number_format($budget->amount, 0, ',', '.') }}
                                </td>
                                <td class="py-3 text-right">
                                    <div class="flex justify-end items-center gap-3 opacity-70 group-hover:opacity-100 transition-opacity">
                                        <a href="{{ route('budgets.edit', $budget) }}" class="text-xs font-medium text-[#3E5C46] hover:underline">Edit</a>
                                        <form action="{{ route('budgets.destroy', $budget) }}" method="POST" class="inline" onsubmit="return confirm('Delete this budget setting?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs font-medium text-red-500 hover:text-red-700 hover:underline">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-6 text-center text-gray-500">
                                    No budgets assigned yet. Click "+ Set Budget" to specify target monthly limits per category.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Mobile card list --}}
            <div class="md:hidden space-y-3">
                @forelse($budgets as $budget)
                    <div class="bg-[#F3F1EA] rounded-2xl p-4 hover:shadow-sm transition-shadow">
                        <div class="flex items-center justify-between gap-2">
                            <div class="flex items-center gap-2.5 min-w-0">
                                <span class="w-9 h-9 rounded-xl {{ $badgeColors[$loop->index % count($badgeColors)] }} flex items-center justify-center font-bold text-xs shrink-0">
                                    {{ strtoupper(substr($budget->category->name, 0, 1)) }}
                                </span>
                                <div class="min-w-0">
                                    <p class="font-semibold text-gray-900 truncate">{{ $budget->category->name }}</p>
                                    <span class="text-xs text-gray-500">
                                        {{ DateTime::createFromFormat('!m', $budget->month)->format('F') }} {{ $budget->year }}
                                    </span>
                                </div>
                            </div>
                            <p class="font-bold text-[#3E5C46] whitespace-nowrap">Rp {{ number_format($budget->amount, 0, ',', '.') }}</p>
                        </div>
                        <div class="flex justify-end items-center gap-4 mt-3 pt-3 border-t border-white">
                            <a href="{{ route('budgets.edit', $budget) }}" class="text-xs font-medium text-[#3E5C46] hover:underline">Edit</a>
                            <form action="{{ route('budgets.destroy', $budget) }}" method="POST" onsubmit="return confirm('Delete this budget setting?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs font-medium text-red-500 hover:text-red-700 hover:underline">Delete</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="py-6 text-center text-gray-500 text-sm">
                        No budgets assigned yet. Tap "+ Set Budget" to specify target monthly limits per category.
                    </p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>