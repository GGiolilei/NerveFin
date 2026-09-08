<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center font-bold text-lg text-indigo-600">
                    🏠 Financial House
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-900">Dashboard</a>
                    <a href="{{ route('expenses.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-500 hover:text-gray-700">Expenses</a>
                    <a href="{{ route('incomes.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-500 hover:text-gray-700">Incomes</a>
                    <a href="{{ route('categories.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-500 hover:text-gray-700">Categories</a>
                    <a href="{{ route('budgets.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-500 hover:text-gray-700">Budgets</a>
                    <a href="{{ route('accounts.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-500 hover:text-gray-700">Accounts</a>
                    <a href="{{ route('savings.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-500 hover:text-gray-700">Savings</a>
                    <a href="{{ route('reviews.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-500 hover:text-gray-700">Monthly Review</a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <span class="text-sm font-medium text-gray-500 mr-4">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-red-600 hover:text-red-800">Log Out</button>
                </form>
            </div>
        </div>
    </div>
</nav>