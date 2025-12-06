<!-- Add this in your <head> if not already -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!-- Top Requested Equipment / Grants Monitoring -->
<div class="lg:col-span-2 bg-white p-5 rounded-xl shadow flex flex-col h-full">
    <p class="font-semibold mb-4 pt-2 primary-color dashheader flex items-center shrink-0">
        <span class="material-icons mr-2 text-custom">leaderboard</span>
        Most Availed Grants 
    </p>
    
    <!-- Content Area - Set to flex-grow to push footer down -->
    <div class="text-sm space-y-4 flex-grow overflow-y-auto pr-2">
        @forelse($topGrants as $index => $item)
            @php
                $approved = $item->approved_applicants ?? 0;
                $totalQuantity = $item->total_quantity ?? 0;

                $percent = $totalQuantity > 0
                    ? round(($approved / $totalQuantity) * 100)
                    : 0;

                $percent = min($percent, 100);
            @endphp

            <div class="flex items-center justify-between">
                <!-- Rank -->
                <div class="w-10 font-bold text-green-700 text-lg shrink-0">
                    {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                </div>

                <!-- Name + Bar -->
                <div class="flex-1 min-w-0 mx-2">
                    <p class="text-gray-700 truncate" title="{{ $item->title ?? 'Unknown Item' }}">
                        {{ $item->title ?? 'Unknown Item' }}
                    </p>

                    <div class="w-full h-2 bg-[#E8F6EF] rounded-full">
                        <div class="h-2 bg-green-700 rounded-full"
                            style="width: {{ $percent }}%">
                        </div>
                    </div>
                </div>

                <!-- Percentage -->
                <div class="ml-2 border rounded-lg px-3 py-1 text-green-700 font-semibold text-sm shrink-0">
                    {{ $percent }}%
                </div>
            </div>
        @empty
            <!-- Added wrapper to maintain vertical height even when empty -->
            <div class="h-full flex items-center justify-center">
                <p class="text-gray-500 text-center">No active grant data available</p>
            </div>
        @endforelse
    </div>


    <!-- Footer Link - Fixed position at the bottom -->
    <div class="mt-4 text-right shrink-0">
        <a href="{{ route('admin-reports') }}" class="text-sm text-[#2C6E49] hover:underline">View All Requests &gt;</a>
    </div>
</div>
