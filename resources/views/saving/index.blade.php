<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Saving Goals</h2>
            <a href="{{ route('savings.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-medium hover:bg-indigo-700">+ New Saving Goal</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($goals as $goal)
                @php
                    $saved = $goal->contributions->sum('amount');
                    $progress = $goal->target_amount > 0 ? min(100, round(($saved / $goal->target_amount) * 100)) : 0;
                @endphp
                <div class="bg-white shadow-sm rounded-lg p-6 space-y-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">{{ $goal->name }}</h3>
                            @if($goal->deadline)
                                <p class="text-xs text-gray-500">Target Date: {{ \Carbon\Carbon::parse($goal->deadline)->format('d M Y') }}</p>
                            @endif
                        </div>
                        <span class="text-xs font-semibold px-2 py-1 rounded bg-indigo-50 text-indigo-700">{{ $progress }}%</span>
                    </div>

                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-500">Saved: Rp {{ number_format($saved, 0, ',', '.') }}</span>
                            <span class="font-medium">Target: Rp {{ number_format($goal->target_amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-indigo-600 h-2.5 rounded-full" style="width: {{ $progress }}%"></div>
                        </div>
                    </div>

                    <div class="pt-2 flex justify-between items-center border-t">
                        <a href="{{ route('savings.show', $goal) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-900">View & Contribute &rarr;</a>
                        <form action="{{ route('savings.destroy', $goal) }}" method="POST" onsubmit="return confirm('Delete this saving goal?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs text-red-600 hover:underline">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white p-8 text-center text-gray-500 rounded-lg shadow-sm">
                    No saving goals created yet. Click "+ New Saving Goal" to start tracking your targets.
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>