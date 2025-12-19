<div 
    id="activityLogsModal" 
    class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 z-20 h-full w-full flex items-center justify-center"
>
    <div 
        x-data="activityLogFilter()" 
        class="relative w-1/2 max-w-3xl max-auto p-6 border shadow-lg rounded-xl bg-white transition-transform transform scale-95 duration-300">

        <!-- Modal Header -->
        <div class="flex items-center justify-between pb-2">
            <h3 class="text-2xl font-bold text-customIT">Activity Logs</h3>
            <div>
                <button onclick="closeModal('activityLogsModal')" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Filter + Sort -->
        <div class="flex justify-end items-center gap-3 border-b b  order-gray-200 pb-4">
S
            <!-- Filter by Type -->
            <select 
                x-model="filterType" 
                class="h-9 pl-3 w-40 text-xs text-btncolor bg-white rounded-[3px]"
            >
                <option value="">All Types</option>
                <template x-for="type in uniqueTypes" :key="type">
                    <option x-text="type"></option>
                </template>
            </select>
            <!-- Sorting -->
            <select 
                x-model="sortOrder" 
                class="h-9 pl-3 w-40 text-xs text-white bg-btncolor rounded-[3px]"
            >
                <option value="desc">Newest First</option>
                <option value="asc">Oldest First</option>
            </select>
        </div>

        <!-- Modal Body -->
        <div class="mt-4 max-h-[80vh] overflow-auto">

@forelse($activityLogs as $date => $logs)

    <div class="mb-4">
        <p class="text-sm font-bold text-gray-500 mb-2">{{ $date }}</p>

        <div class="space-y-3">

            @foreach ($logs as $log)
                <div 
                    class="border border-customIT rounded-md p-3"
                    x-data="{ open: false }"
                >
                    <!-- Main Log Row -->
                    <div class="flex justify-between items-start">
                        <div>
                            <span class="text-sm text-gray-500 font-medium mr-2">
                                {{ $log->created_at->format('g:i A') }}
                            </span>

                            <span class="text-sm text-customIT font-medium">
                                {{ $log->type }}
                            </span>

                            <p class="text-xs text-gray-600 ml-6">
                                {{ $log->message }}
                            </p>
                        </div>

                        <!-- Toggle Button -->
                        <button 
                            @click="open = !open" 
                            class="text-xs text-customIT font-medium hover:underline"
                        >
                            <span x-show="!open">View Activity History</span>
                            <span x-show="open">Hide Activity History</span>
                        </button>
                    </div>

                    <!-- Collapsible History -->
                    <div 
                        x-show="open"
                        x-transition
                        class="mt-3 ml-6 border-l-2 border-customIT pl-3 space-y-1"
                    >
                        @if(is_array($log->details) && count($log->details))
                            @foreach($log->details as $history)
                                <p class="text-xs text-gray-700">• {{ $history }}</p>
                            @endforeach
                        @else
                            <p class="text-xs text-gray-400 italic">No additional activity history.</p>
                        @endif
                    </div>
                </div>
            @endforeach

        </div>
    </div>

@empty
    <p class="text-center text-gray-500">No activity logs found.</p>
@endforelse


        </div>

        <!-- Modal Footer -->
        <div class="text-right px-4 py-3">
            <button 
                onclick="closeModal('activityLogsModal')" 
                class="w-1/3 px-4 py-2 bg-cancel text-gray-500 rounded-md hover:bg-gray-400 hover:text-white"
            >
                Close
            </button>
        </div>

    </div>
</div>

<!-- Alpine Script -->
<script>
function activityLogFilter() {
    return {
        filterType: "",
        sortOrder: "desc",

        uniqueTypes: [
            @foreach($activityLogs as $logs)
                @foreach($logs as $log)
                    "{{ $log->type }}",
                @endforeach
            @endforeach
        ].filter((v, i, a) => a.indexOf(v) === i),

        shouldShowLog(type) {
            if (!this.filterType) return true;
            return this.filterType === type;
        },

        shouldShowDate(date, logs) {
            if (!this.filterType) return true;
            return logs.some(l => l.type === this.filterType);
        }
    };
}
</script>
