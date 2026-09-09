<nav x-data="{ open: false }" class="sticky top-0 z-50 backdrop-blur-md bg-white/70 border-b border-white/40 shadow-[0_1px_20px_rgba(99,102,241,0.08)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center font-extrabold text-lg tracking-tight bg-gradient-to-r from-indigo-600 via-violet-600 to-fuchsia-500 bg-clip-text text-transparent">
                    Nerve
                </div>

                <div class="hidden space-x-1 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('dashboard') }}"
                       class="relative inline-flex items-center px-3 pt-1 text-sm font-medium leading-5 text-gray-900 rounded-lg hover:bg-white/60 transition-colors group">
                        Dashboard
                        <span class="absolute left-3 right-3 -bottom-px h-0.5 rounded-full bg-gradient-to-r from-indigo-500 to-fuchsia-500"></span>
                    </a>
                    <a href="{{ route('expenses.index') }}"
                       class="inline-flex items-center px-3 pt-1 text-sm font-medium leading-5 text-gray-500 hover:text-gray-900 rounded-lg hover:bg-white/60 transition-colors">Expenses</a>
                    <a href="{{ route('incomes.index') }}"
                       class="inline-flex items-center px-3 pt-1 text-sm font-medium leading-5 text-gray-500 hover:text-gray-900 rounded-lg hover:bg-white/60 transition-colors">Incomes</a>
                    <a href="{{ route('categories.index') }}"
                       class="inline-flex items-center px-3 pt-1 text-sm font-medium leading-5 text-gray-500 hover:text-gray-900 rounded-lg hover:bg-white/60 transition-colors">Categories</a>
                    <a href="{{ route('budgets.index') }}"
                       class="inline-flex items-center px-3 pt-1 text-sm font-medium leading-5 text-gray-500 hover:text-gray-900 rounded-lg hover:bg-white/60 transition-colors">Budgets</a>
                    <a href="{{ route('accounts.index') }}"
                       class="inline-flex items-center px-3 pt-1 text-sm font-medium leading-5 text-gray-500 hover:text-gray-900 rounded-lg hover:bg-white/60 transition-colors">Accounts</a>
                    <a href="{{ route('savings.index') }}"
                       class="inline-flex items-center px-3 pt-1 text-sm font-medium leading-5 text-gray-500 hover:text-gray-900 rounded-lg hover:bg-white/60 transition-colors">Savings</a>
                    <a href="{{ route('reviews.index') }}"
                       class="inline-flex items-center px-3 pt-1 text-sm font-medium leading-5 text-gray-500 hover:text-gray-900 rounded-lg hover:bg-white/60 transition-colors">Monthly Review</a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-3">
                <span class="text-sm font-medium text-gray-600 px-3 py-1 rounded-full bg-white/60 border border-white/60">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm font-medium text-red-600 hover:text-white hover:bg-red-500 px-3 py-1.5 rounded-full border border-red-200 hover:border-red-500 transition-colors">Log Out</button>
                </form>
            </div>

            {{-- Mobile hamburger --}}
            <div class="flex items-center sm:hidden">
                <button @click="open = !open" class="p-2 rounded-lg text-gray-500 hover:bg-white/60 transition-colors">
                    <svg x-show="!open" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="open" x-cloak class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div x-show="open" x-cloak x-transition class="sm:hidden backdrop-blur-md bg-white/80 border-t border-white/40">
        <div class="px-4 pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-900 bg-white/60">Dashboard</a>
            <a href="{{ route('expenses.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-white/60">Expenses</a>
            <a href="{{ route('incomes.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-white/60">Incomes</a>
            <a href="{{ route('categories.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-white/60">Categories</a>
            <a href="{{ route('budgets.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-white/60">Budgets</a>
            <a href="{{ route('accounts.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-white/60">Accounts</a>
            <a href="{{ route('savings.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-white/60">Savings</a>
            <a href="{{ route('reviews.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-white/60">Monthly Review</a>
        </div>
        <div class="px-4 pb-4 pt-2 border-t border-white/40 flex items-center justify-between">
            <span class="text-sm font-medium text-gray-600">{{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm font-medium text-red-600">Log Out</button>
            </form>
        </div>
    </div>
</nav>