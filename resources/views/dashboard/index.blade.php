<x-app-layout>
    <div class="py-6 md:py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5 bg-[#F3F1EA]">

        {{-- Greeting --}}
        <div class="px-1">
            <h2 class="text-xl md:text-2xl font-bold text-gray-900">Hello, {{ Auth::user()->name }}! 👋</h2>
            <p class="text-sm text-gray-500 mt-0.5">Here's what's happening with your finances</p>
        </div>

        {{-- Stat Cards Header --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4">
            {{-- Total Incomes --}}
            <div class="bg-white p-4 md:p-5 rounded-3xl shadow-sm hover:shadow-md transition-shadow">
                <span class="w-9 h-9 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8l-8 8-8-8"/></svg>
                </span>
                <p class="text-xs font-medium text-gray-400">Total Incomes</p>
                <p class="text-lg md:text-2xl font-bold text-gray-900 mt-0.5 truncate">
                    Rp {{ number_format($totalIncome ?? 0, 0, ',', '.') }}
                </p>
            </div>

            {{-- Total Expenses --}}
            <div class="bg-white p-4 md:p-5 rounded-3xl shadow-sm hover:shadow-md transition-shadow">
                <span class="w-9 h-9 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 20V4m-8 8l8 8 8-8"/></svg>
                </span>
                <p class="text-xs font-medium text-gray-400">Total Expenses</p>
                <p class="text-lg md:text-2xl font-bold text-gray-900 mt-0.5 truncate">
                    Rp {{ number_format($totalExpenses ?? 0, 0, ',', '.') }}
                </p>
            </div>

            {{-- Remaining Budget Pool --}}
            <div class="bg-white p-4 md:p-5 rounded-3xl shadow-sm hover:shadow-md transition-shadow">
                <span class="w-9 h-9 rounded-full bg-amber-100 flex items-center justify-center text-amber-700 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3v18h18M7 15l4-4 3 3 5-6"/></svg>
                </span>
                <p class="text-xs font-medium text-gray-400">Remaining Budget</p>
                <p class="text-lg md:text-2xl font-bold {{ ($remainingBudgetPool ?? 0) >= 0 ? 'text-gray-900' : 'text-red-600' }} mt-0.5 truncate">
                    Rp {{ number_format($remainingBudgetPool ?? 0, 0, ',', '.') }}
                </p>
                <p class="text-[10px] text-gray-400 mt-0.5 truncate">
                    of Rp {{ number_format($totalBudgeted ?? 0, 0, ',', '.') }} cap
                </p>
            </div>

            {{-- Net Savings Balance — hero card --}}
            <div class="relative overflow-hidden bg-[#3E5C46] p-4 md:p-5 rounded-3xl shadow-sm text-white">
                <svg class="absolute right-0 bottom-0 w-24 h-16 opacity-30" viewBox="0 0 100 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 35 Q 15 10, 30 30 T 60 25 T 100 15" stroke="white" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                </svg>
                <span class="w-9 h-9 rounded-full bg-white/15 flex items-center justify-center text-white mb-3 relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18M3 6h18M3 18h18"/></svg>
                </span>
                <p class="text-xs font-medium text-white/70 relative">Net Balance</p>
                <p class="text-lg md:text-2xl font-bold mt-0.5 truncate relative">
                    Rp {{ number_format($netSavings ?? 0, 0, ',', '.') }}
                </p>
            </div>
        </div>

        {{-- Household Accounts Summary --}}
        @if(isset($accounts) && count($accounts) > 0)
            <div class="bg-white shadow-sm rounded-3xl p-4 md:p-6">
                <h3 class="text-base md:text-lg font-bold text-gray-900 mb-4">Financial Accounts</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-4">
                    @foreach($accounts as $account)
                        <div class="bg-[#F3F1EA] p-4 rounded-2xl hover:bg-emerald-50 transition-colors">
                            <p class="text-xs font-medium text-gray-400 truncate">{{ $account->name }}</p>
                            <p class="text-base md:text-lg font-bold text-gray-900 mt-1 truncate">
                                {{ $account->formatted_balance ?? ('Rp ' . number_format($account->balance ?? 0, 0, ',', '.')) }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Monthly Budget Progress Section --}}
        <div class="bg-white shadow-sm rounded-3xl p-4 md:p-6">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2 mb-4">
                <h3 class="text-base md:text-lg font-bold text-gray-900">Budget Usage ({{ now()->format('F Y') }})</h3>
                <a href="{{ route('budgets.index') }}" class="text-sm font-medium text-emerald-700 hover:underline w-fit">Manage Budgets &rarr;</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                @forelse($budgets ?? [] as $budget)
                    @php
                        $spent = $budget->expenses_sum_amount ?? 0;
                        $limit = $budget->amount ?? 1;
                        $remaining = $limit - $spent;
                        $percentage = min(100, round(($spent / $limit) * 100));
                        $isOverBudget = $spent > $limit;
                    @endphp
                    <div class="bg-[#F3F1EA] rounded-2xl p-4 space-y-2 hover:shadow-sm transition-shadow">
                        <div class="flex justify-between items-center text-sm gap-2">
                            <span class="font-semibold text-gray-800 truncate">{{ $budget->category?->name ?? 'General' }}</span>
                            <span class="text-xs font-bold {{ $remaining >= 0 ? 'text-emerald-700' : 'text-red-600' }} whitespace-nowrap">
                                @if($isOverBudget)
                                    Over by Rp {{ number_format($spent - $limit, 0, ',', '.') }}
                                @else
                                    Rp {{ number_format($remaining, 0, ',', '.') }} left
                                @endif
                            </span>
                        </div>
                        <div class="w-full bg-white rounded-full h-2.5 overflow-hidden">
                            <div class="h-2.5 rounded-full transition-all duration-500 {{ $isOverBudget ? 'bg-red-500' : ($percentage > 85 ? 'bg-amber-500' : 'bg-[#3E5C46]') }}"
                                 style="width: {{ $percentage }}%"></div>
                        </div>
                        <div class="flex justify-between items-center text-xs text-gray-500 gap-2">
                            <span>Spent: Rp {{ number_format($spent, 0, ',', '.') }}</span>
                            <span>Cap: Rp {{ number_format($limit, 0, ',', '.') }}</span>
                        </div>
                    </div>
                @empty
                    <p class="col-span-1 md:col-span-2 text-sm text-gray-500 text-center py-2">No active budgets created for this month.</p>
                @endforelse
            </div>
        </div>

        {{-- Recent Expenses Section --}}
        <div class="bg-white shadow-sm rounded-3xl p-4 md:p-6">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2 mb-4">
                <h3 class="text-base md:text-lg font-bold text-gray-900">Recent Household Expenses</h3>
                <a href="{{ route('expenses.index') }}" class="text-sm font-medium text-emerald-700 hover:underline w-fit">View All &rarr;</a>
            </div>

            {{-- Desktop / tablet table --}}
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left divide-y divide-gray-100 text-sm">
                    <thead>
                        <tr class="text-gray-400">
                            <th class="py-2 font-medium">Date</th>
                            <th class="py-2 font-medium">Title</th>
                            <th class="py-2 font-medium">Category</th>
                            <th class="py-2 font-medium">Logged By</th>
                            <th class="py-2 font-medium">Account</th>
                            <th class="py-2 font-medium text-right">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($recentExpenses ?? [] as $expense)
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
                                <td class="py-3 text-gray-500">{{ $expense->user?->name ?? 'System' }}</td>
                                <td class="py-3 text-gray-500">{{ $expense->financialAccount?->name ?? '-' }}</td>
                                <td class="py-3 text-right font-bold text-orange-600">-{{ $expense->formatted_amount }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-4 text-center text-gray-500">No expenses recorded yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Mobile card list --}}
            <div class="md:hidden space-y-3">
                @forelse($recentExpenses ?? [] as $expense)
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