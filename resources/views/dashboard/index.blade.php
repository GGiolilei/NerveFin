<x-app-layout>
    <div class="py-6 md:py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        {{-- Stat Cards Header --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4">
            <div class="bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                <div class="flex items-center gap-2 mb-1">
                    <span class="w-7 h-7 rounded-lg bg-green-50 flex items-center justify-center text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8l-8 8-8-8"/></svg>
                    </span>
                    <p class="text-[11px] md:text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Incomes</p>
                </div>
                <p class="text-lg md:text-2xl font-bold text-green-600 mt-1 truncate">
                    Rp {{ number_format($totalIncome ?? 0, 0, ',', '.') }}
                </p>
            </div>

            <div class="bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                <div class="flex items-center gap-2 mb-1">
                    <span class="w-7 h-7 rounded-lg bg-red-50 flex items-center justify-center text-red-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 20V4m-8 8l8 8 8-8"/></svg>
                    </span>
                    <p class="text-[11px] md:text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Expenses</p>
                </div>
                <p class="text-lg md:text-2xl font-bold text-red-600 mt-1 truncate">
                    Rp {{ number_format($totalExpenses ?? 0, 0, ',', '.') }}
                </p>
            </div>

            <div class="bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                <div class="flex items-center gap-2 mb-1">
                    <span class="w-7 h-7 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3v18h18M7 15l4-4 3 3 5-6"/></svg>
                    </span>
                    <p class="text-[11px] md:text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Budgeted Pool</p>
                </div>
                <p class="text-lg md:text-2xl font-bold text-indigo-600 mt-1 truncate">
                    Rp {{ number_format($totalBudgeted ?? 0, 0, ',', '.') }}
                </p>
            </div>

            <div class="bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                <div class="flex items-center gap-2 mb-1">
                    <span class="w-7 h-7 rounded-lg {{ ($netSavings ?? 0) >= 0 ? 'bg-gray-100 text-gray-700' : 'bg-red-50 text-red-500' }} flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18M3 6h18M3 18h18"/></svg>
                    </span>
                    <p class="text-[11px] md:text-xs font-semibold text-gray-500 uppercase tracking-wider">Net Balance</p>
                </div>
                <p class="text-lg md:text-2xl font-bold {{ ($netSavings ?? 0) >= 0 ? 'text-gray-900' : 'text-red-500' }} mt-1 truncate">
                    Rp {{ number_format($netSavings ?? 0, 0, ',', '.') }}
                </p>
            </div>
        </div>

        {{-- Household Accounts Summary --}}
        @if(isset($accounts) && count($accounts) > 0)
            <div class="bg-white shadow-sm sm:rounded-2xl rounded-2xl p-4 md:p-6 border border-gray-100">
                <h3 class="text-base md:text-lg font-bold text-gray-900 mb-4">Financial Accounts</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-4">
                    @foreach($accounts as $account)
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 hover:border-indigo-200 hover:bg-indigo-50/30 transition-colors">
                            <p class="text-xs font-semibold text-gray-500 uppercase truncate">{{ $account->name }}</p>
                            <p class="text-base md:text-lg font-bold text-gray-900 mt-1 truncate">
                                {{ $account->formatted_balance ?? ('Rp ' . number_format($account->balance ?? 0, 0, ',', '.')) }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Monthly Budget Progress Section --}}
        <div class="bg-white shadow-sm sm:rounded-2xl rounded-2xl p-4 md:p-6 border border-gray-100">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2 mb-4">
                <h3 class="text-base md:text-lg font-bold text-gray-900">Budget Usage ({{ now()->format('F Y') }})</h3>
                <a href="{{ route('budgets.index') }}" class="text-sm font-medium text-indigo-600 hover:underline w-fit">Manage Budgets &rarr;</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                @forelse($budgets ?? [] as $budget)
                    @php
                        $spent = $budget->expenses_sum_amount ?? 0;
                        $limit = $budget->amount ?? 1;
                        $percentage = min(100, round(($spent / $limit) * 100));
                        $isOverBudget = $spent > $limit;
                    @endphp
                    <div class="border border-gray-100 rounded-xl p-4 space-y-2 hover:shadow-sm transition-shadow">
                        <div class="flex justify-between items-center text-sm gap-2">
                            <span class="font-semibold text-gray-800 truncate">{{ $budget->category?->name ?? 'General' }}</span>
                            <span class="text-xs text-gray-500 whitespace-nowrap">
                                Rp {{ number_format($spent, 0, ',', '.') }} / Rp {{ number_format($limit, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 overflow-hidden">
                            <div class="h-2.5 rounded-full transition-all duration-500 {{ $isOverBudget ? 'bg-red-600' : ($percentage > 85 ? 'bg-amber-500' : 'bg-indigo-600') }}"
                                 style="width: {{ $percentage }}%"></div>
                        </div>
                        <div class="flex justify-between items-center text-xs text-gray-500 gap-2">
                            <span>{{ $percentage }}% spent</span>
                            @if($isOverBudget)
                                <span class="text-red-600 font-bold whitespace-nowrap">Over by Rp {{ number_format($spent - $limit, 0, ',', '.') }}</span>
                            @else
                                <span class="whitespace-nowrap">Rp {{ number_format($limit - $spent, 0, ',', '.') }} left</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="col-span-1 md:col-span-2 text-sm text-gray-500 text-center py-2">No active budgets created for this month.</p>
                @endforelse
            </div>
        </div>

        {{-- Recent Expenses Section --}}
        <div class="bg-white shadow-sm sm:rounded-2xl rounded-2xl p-4 md:p-6 border border-gray-100">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2 mb-4">
                <h3 class="text-base md:text-lg font-bold text-gray-900">Recent Household Expenses</h3>
                <a href="{{ route('expenses.index') }}" class="text-sm font-medium text-indigo-600 hover:underline w-fit">View All &rarr;</a>
            </div>

            {{-- Desktop / tablet: table --}}
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left divide-y text-sm">
                    <thead>
                        <tr class="text-gray-500">
                            <th class="py-2">Date</th>
                            <th class="py-2">Title</th>
                            <th class="py-2">Category</th>
                            <th class="py-2">Logged By</th>
                            <th class="py-2">Account</th>
                            <th class="py-2 text-right">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($recentExpenses ?? [] as $expense)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-3 text-gray-600">
                                    {{ $expense->spent_at ? $expense->spent_at->format('d M Y') : '-' }}
                                </td>
                                <td class="py-3 font-medium text-gray-900">{{ $expense->name }}</td>
                                <td class="py-3">
                                    <span class="bg-gray-100 text-gray-700 px-2 py-0.5 rounded text-xs font-semibold">
                                        {{ $expense->category?->name ?? $expense->budget?->category?->name ?? 'Uncategorized' }}
                                    </span>
                                </td>
                                <td class="py-3 text-gray-600">{{ $expense->user?->name ?? 'System' }}</td>
                                <td class="py-3 text-gray-600">{{ $expense->financialAccount?->name ?? '-' }}</td>
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

            {{-- Mobile: card list (same data, same @forelse) --}}
            <div class="md:hidden space-y-3">
                @forelse($recentExpenses ?? [] as $expense)
                    <div class="border border-gray-100 rounded-xl p-3">
                        <div class="flex justify-between items-start gap-2">
                            <div class="min-w-0">
                                <p class="font-semibold text-gray-900 truncate">{{ $expense->name }}</p>
                                <p class="text-xs text-gray-500 mt-0.5">
                                    {{ $expense->spent_at ? $expense->spent_at->format('d M Y') : '-' }}
                                    &middot; {{ $expense->user?->name ?? 'System' }}
                                </p>
                            </div>
                            <p class="font-bold text-red-600 whitespace-nowrap">-{{ $expense->formatted_amount }}</p>
                        </div>
                        <div class="flex items-center gap-2 mt-2 flex-wrap">
                            <span class="bg-gray-100 text-gray-700 px-2 py-0.5 rounded text-xs font-semibold">
                                {{ $expense->category?->name ?? $expense->budget?->category?->name ?? 'Uncategorized' }}
                            </span>
                            @if($expense->financialAccount?->name)
                                <span class="text-xs text-gray-400">{{ $expense->financialAccount?->name }}</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="py-4 text-center text-gray-500 text-sm">No expenses recorded yet.</p>
                @endforelse
            </div>
        </div>

    </div>
</x-app-layout>