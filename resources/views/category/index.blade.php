<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Household Categories</h2>
            <a href="{{ route('categories.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md">+ Add Category</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($categories as $category)
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="font-bold text-lg text-gray-800">{{ $category->name }}</div>
                    <p class="text-sm text-gray-500 mt-1">{{ $category->description ?? 'No description provided.' }}</p>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>