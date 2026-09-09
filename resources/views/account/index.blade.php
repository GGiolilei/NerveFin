<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Financial Accounts</h2>
            <a href="{{ route('accounts.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md">+ Add Account</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($accounts as $account)
                <div class="bg-white p-6 rounded-lg shadow-sm space-y-2">
                    <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded uppercase font-semibold">{{ $account->type }}</span>
                    <h3 class="text-xl font-bold text-gray-900">{{ $account->name }}</h3>
                    <p class="text-2xl font-bold text-indigo-600">{{ $account->formatted_balance }}</p>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>