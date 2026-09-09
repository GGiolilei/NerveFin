<nav x-data="{ open: false }" class="hidden md:flex md:flex-col md:fixed md:inset-y-0 md:left-0 md:w-24 z-50 bg-white/80 backdrop-blur-md border-r border-white/60 py-6 items-center">

    {{-- Logo --}}
    <div class="shrink-0 w-11 h-11 rounded-2xl bg-[#3E5C46] flex items-center justify-center font-extrabold text-white text-sm mb-8 shadow-sm">
        N
    </div>

    {{-- Nav icons --}}
    <div class="flex-1 flex flex-col gap-2 w-full items-center">
        <a href="{{ route('dashboard') }}" class="group relative flex items-center justify-center w-12 h-12 rounded-2xl bg-[#3E5C46] text-white shadow-sm transition-transform hover:scale-105">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            <span class="pointer-events-none absolute left-full ml-3 whitespace-nowrap rounded-lg bg-gray-900 text-white text-xs font-medium px-2.5 py-1.5 opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition-all origin-left">Dashboard</span>
        </a>

        <a href="{{ route('expenses.index') }}" class="group relative flex items-center justify-center w-12 h-12 rounded-2xl text-gray-400 hover:bg-emerald-50 hover:text-[#3E5C46] transition-all hover:scale-105">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 20V4m-8 8l8 8 8-8"/></svg>
            <span class="pointer-events-none absolute left-full ml-3 whitespace-nowrap rounded-lg bg-gray-900 text-white text-xs font-medium px-2.5 py-1.5 opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition-all origin-left">Expenses</span>
        </a>

        <a href="{{ route('incomes.index') }}" class="group relative flex items-center justify-center w-12 h-12 rounded-2xl text-gray-400 hover:bg-emerald-50 hover:text-[#3E5C46] transition-all hover:scale-105">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8l-8-8-8 8"/></svg>
            <span class="pointer-events-none absolute left-full ml-3 whitespace-nowrap rounded-lg bg-gray-900 text-white text-xs font-medium px-2.5 py-1.5 opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition-all origin-left">Incomes</span>
        </a>

        <a href="{{ route('categories.index') }}" class="group relative flex items-center justify-center w-12 h-12 rounded-2xl text-gray-400 hover:bg-emerald-50 hover:text-[#3E5C46] transition-all hover:scale-105">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5.586a1 1 0 01.707.293l6.414 6.414a1 1 0 010 1.414l-7.586 7.586a1 1 0 01-1.414 0L3.293 12.293A1 1 0 013 11.586V6a3 3 0 013-3z"/></svg>
            <span class="pointer-events-none absolute left-full ml-3 whitespace-nowrap rounded-lg bg-gray-900 text-white text-xs font-medium px-2.5 py-1.5 opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition-all origin-left">Categories</span>
        </a>

        <a href="{{ route('budgets.index') }}" class="group relative flex items-center justify-center w-12 h-12 rounded-2xl text-gray-400 hover:bg-emerald-50 hover:text-[#3E5C46] transition-all hover:scale-105">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3v18h18M7 15l4-4 3 3 5-6"/></svg>
            <span class="pointer-events-none absolute left-full ml-3 whitespace-nowrap rounded-lg bg-gray-900 text-white text-xs font-medium px-2.5 py-1.5 opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition-all origin-left">Budgets</span>
        </a>

        <a href="{{ route('accounts.index') }}" class="group relative flex items-center justify-center w-12 h-12 rounded-2xl text-gray-400 hover:bg-emerald-50 hover:text-[#3E5C46] transition-all hover:scale-105">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M4 10h16M4 10l8-6 8 6M6 10v11m4-11v11m4-11v11m4-11v11"/></svg>
            <span class="pointer-events-none absolute left-full ml-3 whitespace-nowrap rounded-lg bg-gray-900 text-white text-xs font-medium px-2.5 py-1.5 opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition-all origin-left">Accounts</span>
        </a>

        <a href="{{ route('savings.index') }}" class="group relative flex items-center justify-center w-12 h-12 rounded-2xl text-gray-400 hover:bg-emerald-50 hover:text-[#3E5C46] transition-all hover:scale-105">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-3.5 0-6 2-6 5s2.5 5 6 5 6-2 6-5m-6-5c1.5 0 3 .5 4 1.5M12 8V5m0 0a2 2 0 100-4 2 2 0 000 4z"/></svg>
            <span class="pointer-events-none absolute left-full ml-3 whitespace-nowrap rounded-lg bg-gray-900 text-white text-xs font-medium px-2.5 py-1.5 opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition-all origin-left">Savings</span>
        </a>

        <a href="{{ route('reviews.index') }}" class="group relative flex items-center justify-center w-12 h-12 rounded-2xl text-gray-400 hover:bg-emerald-50 hover:text-[#3E5C46] transition-all hover:scale-105">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            <span class="pointer-events-none absolute left-full ml-3 whitespace-nowrap rounded-lg bg-gray-900 text-white text-xs font-medium px-2.5 py-1.5 opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition-all origin-left">Monthly Review</span>
        </a>
    </div>

    {{-- User + logout --}}
    <div class="shrink-0 flex flex-col items-center gap-3 mt-4">
        <div class="group relative w-10 h-10 rounded-full bg-[#3E5C46] text-white flex items-center justify-center font-bold text-sm shadow-sm hover:scale-105 transition-transform cursor-default">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            <span class="pointer-events-none absolute left-full ml-3 whitespace-nowrap rounded-lg bg-gray-900 text-white text-xs font-medium px-2.5 py-1.5 opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition-all origin-left">{{ Auth::user()->name }}</span>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="group relative flex items-center justify-center w-12 h-12 rounded-2xl text-red-400 hover:bg-red-50 hover:text-red-600 transition-all hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                <span class="pointer-events-none absolute left-full ml-3 whitespace-nowrap rounded-lg bg-gray-900 text-white text-xs font-medium px-2.5 py-1.5 opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition-all origin-left">Log Out</span>
            </button>
        </form>
    </div>
</nav>

{{-- Mobile top bar (unchanged behavior, just restyled) --}}
<nav x-data="{ open: false }" class="md:hidden sticky top-0 z-50 backdrop-blur-md bg-white/80 border-b border-white/40">
    <div class="flex items-center justify-between px-4 h-16">
        <div class="w-9 h-9 rounded-xl bg-[#3E5C46] flex items-center justify-center font-extrabold text-white text-sm">N</div>
        <button @click="open = !open" class="p-2 rounded-xl text-gray-500 hover:bg-emerald-50 transition-colors">
            <svg x-show="!open" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <svg x-show="open" x-cloak class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <div x-show="open" x-cloak x-transition class="backdrop-blur-md bg-white/90 border-t border-white/40">
        <div class="px-4 pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-xl text-sm font-medium text-white bg-[#3E5C46]">Dashboard</a>
            <a href="{{ route('expenses.index') }}" class="block px-3 py-2 rounded-xl text-sm font-medium text-gray-600 hover:bg-emerald-50">Expenses</a>
            <a href="{{ route('incomes.index') }}" class="block px-3 py-2 rounded-xl text-sm font-medium text-gray-600 hover:bg-emerald-50">Incomes</a>
            <a href="{{ route('categories.index') }}" class="block px-3 py-2 rounded-xl text-sm font-medium text-gray-600 hover:bg-emerald-50">Categories</a>
            <a href="{{ route('budgets.index') }}" class="block px-3 py-2 rounded-xl text-sm font-medium text-gray-600 hover:bg-emerald-50">Budgets</a>
            <a href="{{ route('accounts.index') }}" class="block px-3 py-2 rounded-xl text-sm font-medium text-gray-600 hover:bg-emerald-50">Accounts</a>
            <a href="{{ route('savings.index') }}" class="block px-3 py-2 rounded-xl text-sm font-medium text-gray-600 hover:bg-emerald-50">Savings</a>
            <a href="{{ route('reviews.index') }}" class="block px-3 py-2 rounded-xl text-sm font-medium text-gray-600 hover:bg-emerald-50">Monthly Review</a>
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