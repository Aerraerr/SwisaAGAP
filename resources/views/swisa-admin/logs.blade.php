@extends('layouts.app')

@section('content')
@include('layouts.loading-overlay')

@php
    use Carbon\Carbon;

    // Group logs by date (Today, Yesterday, or exact date)
    $groupedLogs = $logs->sortByDesc('activity_timestamp')->groupBy(function($log) {
        $date = $log->activity_timestamp ? Carbon::parse($log->activity_timestamp) : $log->created_at;
        if ($date->isToday()) {
            return 'Today';
        } elseif ($date->isYesterday()) {
            return 'Yesterday';
        } else {
            return $date->format('F d, Y');
        }
    });
@endphp

<div class="p-4">
    <div class="bg-mainbg px-6 min-h-screen">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-3">
            <div class="text-customIT flex flex-col">
                <h2 class="text-[20px] sm:text-[25px] font-bold text-custom">Activity Logs</h2>
                <p class="text-sm text-gray-600">Manage, track, and publish important information for SWISA members.</p>
            </div>
        </div>

        <!-- Filters & Search -->
        <div class="bg-white shadow rounded-lg p-4 mb-6">
            <div class="flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between">
                <!-- Search Bar -->
                <div class="flex items-center w-full sm:w-1/3">
                    <input 
                        id="searchInput"
                        type="text"
                        placeholder="Search by user, activity..."
                        class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-btncolor focus:outline-none">
                </div>

                <!-- Filters -->
                <div class="flex flex-wrap gap-2">
                    <select id="roleFilter" class="border rounded-lg px-3 py-2 text-sm">
                        <option value="">All Roles</option>
                        <option value="Admin">Admin</option>
                        <option value="Member">SWISA Member</option>
                        <option value="Support Staff">Support Staff</option>
                    </select>

                    <select id="statusFilter" class="border rounded-lg px-3 py-2 text-sm">
                        <option value="">All Status</option>
                        <option value="success">Successful</option>
                        <option value="failed">Failed</option>
                        <option value="pending">Pending</option>
                    </select>

                    <input id="dateFrom" type="date" class="border rounded-lg px-3 py-2 text-sm">
                    <input id="dateTo" type="date" class="border rounded-lg px-3 py-2 text-sm">

                    <button id="filterButton" class="bg-btncolor text-white px-4 py-2 rounded-lg text-sm hover:bg-btnhover">Filter</button>

                    <button id="resetButton" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-300">Reset</button>
                </div>
            </div>
        </div>

        <!-- Activity Timeline -->
<div class="bg-white shadow rounded-lg p-10" id="logsContainer">
    @forelse ($groupedLogs as $dateLabel => $logsForDate)
        <div class="mb-8 log-group" data-date="{{ $dateLabel }}">
            <!-- Date Header -->
            <h3 class="text-base font-semibold text-gray-800 mb-4 border-b border-gray-200 pb-1">
                {{ $dateLabel }}
            </h3>

            <div class="space-y-4">
                @foreach ($logsForDate as $log)
                    @php
                        $timestamp = $log->activity_timestamp ? Carbon::parse($log->activity_timestamp) : $log->created_at;
                        $activity = strtolower($log->activity ?? '');
                        $activityClass = 'bg-gray-100 text-gray-700';
                        if (str_contains($activity, 'attempt')) {
                            $activityClass = 'bg-red-100 text-red-700';
                        } elseif (str_contains($activity, 'login') || str_contains($activity, 'logged in') || str_contains($activity, 'sign in')) {
                            $activityClass = 'bg-green-100 text-green-700';
                        } elseif (str_contains($activity, 'logout') || str_contains($activity, 'logged out') || str_contains($activity, 'sign out')) {
                            $activityClass = 'bg-yellow-100 text-yellow-700';
                        } elseif (str_contains($activity, 'create') || str_contains($activity, 'add') || str_contains($activity, 'register')) {
                            $activityClass = 'bg-blue-100 text-blue-700';
                        } elseif (str_contains($activity, 'update') || str_contains($activity, 'edit') || str_contains($activity, 'change')) {
                            $activityClass = 'bg-yellow-100 text-yellow-700';
                        } elseif (str_contains($activity, 'delete') || str_contains($activity, 'remove') || str_contains($activity, 'destroy')) {
                            $activityClass = 'bg-red-100 text-red-700';
                        }

                        $statusColor = match($log->status) {
                            'success' => 'text-green-600 font-medium',
                            'failed' => 'text-red-600 font-medium',
                            'pending' => 'text-yellow-600 font-medium',
                            default => 'text-gray-600'
                        };

                        $role = $log->role ?? 'N/A';
                        $role = ucwords(str_replace('_', ' ', $role));

                        // Parse details if JSON
                        $details = is_array($log->details) ? $log->details : json_decode($log->details, true) ?? $log->details;
                        $device = $details['Device'] ?? null;
                    @endphp

                    <div 
                        class="log-item flex flex-col sm:flex-row sm:items-start sm:gap-5 border border-gray-100 rounded-lg p-4 hover:bg-gray-50 transition relative group"
                        data-username="{{ strtolower($log->user_name ?? '') }}"
                        data-activity="{{ strtolower($log->activity ?? '') }}"
                        data-role="{{ strtolower($role) }}"
                        data-status="{{ strtolower($log->status) }}"
                        data-date="{{ $timestamp->format('Y-m-d') }}"
                    >
                        <!-- Time -->
                        <div class="w-24 shrink-0 text-sm text-gray-500 mb-2 sm:mb-0 sm:text-right mr-8">
                            {{ $timestamp->format('h:i A') }}
                        </div>

                        <!-- Content -->
                        <div class="flex-1">
                            <div class="flex flex-col">
                                <span class="text-gray-800 text-sm leading-relaxed">
                                    <strong>{{ $log->user_name ?? 'Unknown User' }}</strong>
                                    <span class="text-gray-500 text-sm ml-1">({{ $role }})</span>
                                    performed
                                    <span class="inline-block px-2 py-1 text-xs font-medium rounded-full {{ $activityClass }}">
                                        {{ $log->activity }}
                                    </span>
                                </span>

                                <div class="text-xs text-gray-500 mt-1">
                                    IP: {{ $log->ip_address ?? '—' }} • 
                                    <span class="{{ $statusColor }}">
                                        {{ ucfirst($log->status) }}
                                    </span>
                                </div>

                                @if(!empty($details))
                                    <div class="text-xs text-gray-400 mt-1">
                                        @if($device)
                                            <strong>Device:</strong> {{ $device }}
                                        @else
                                            <strong>Details:</strong> {{ is_array($details) ? json_encode($details) : $details }}
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Action Menu (3 Dots) -->
                        <div class="absolute top-3 right-3">
                            <div class="relative">
                                <button 
                                    class="text-gray-500 hover:text-gray-700 focus:outline-none" 
                                    onclick="toggleMenu(this)">
                                    ⋮
                                </button>
                                <div class="hidden absolute right-0 mt-2 w-32 bg-white border rounded-lg shadow-md z-10">
                                    <button class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-100">View Details</button>
                                    <button class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-100">Copy Info</button>
                                    <button class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @empty
        <div class="text-center text-gray-500 py-6">
            No activity logs found.
        </div>
    @endforelse

    <!-- Pagination -->
    @if ($logs->hasPages())
        <div class="mt-6 flex justify-between items-center text-sm">
            <p class="text-white">
                Showing {{ $logs->firstItem() }} to {{ $logs->lastItem() }} of {{ $logs->total() }} logs
            </p>
            <div>
                {{ $logs->links() }}
            </div>
        </div>
    @endif
</div>

    </div>
</div>

<script>
    // Toggle menu (3 dots)
    function toggleMenu(button) {
        const menu = button.nextElementSibling;
        document.querySelectorAll('[onclick="toggleMenu(this)"] + div').forEach(el => {
            if (el !== menu) el.classList.add('hidden');
        });
        menu.classList.toggle('hidden');
    }

    document.addEventListener('click', function(e) {
        if (!e.target.closest('[onclick="toggleMenu(this)"]')) {
            document.querySelectorAll('[onclick="toggleMenu(this)"] + div').forEach(el => el.classList.add('hidden'));
        }
    });

    // Filtering and Search Logic
    const searchInput = document.getElementById('searchInput');
    const roleFilter = document.getElementById('roleFilter');
    const statusFilter = document.getElementById('statusFilter');
    const dateFrom = document.getElementById('dateFrom');
    const dateTo = document.getElementById('dateTo');
    const filterButton = document.getElementById('filterButton');
    const resetButton = document.getElementById('resetButton');

    function filterLogs() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedRole = roleFilter.value.toLowerCase();
        const selectedStatus = statusFilter.value.toLowerCase();
        const fromDate = dateFrom.value ? new Date(dateFrom.value) : null;
        const toDate = dateTo.value ? new Date(dateTo.value) : null;

        document.querySelectorAll('.log-item').forEach(item => {
            const username = item.dataset.username;
            const activity = item.dataset.activity;
            const role = item.dataset.role;
            const status = item.dataset.status;
            const date = new Date(item.dataset.date);

            let visible = true;

            if (searchTerm && !(username.includes(searchTerm) || activity.includes(searchTerm))) {
                visible = false;
            }
            if (selectedRole && role !== selectedRole) visible = false;
            if (selectedStatus && status !== selectedStatus) visible = false;
            if (fromDate && date < fromDate) visible = false;
            if (toDate && date > toDate) visible = false;

            item.style.display = visible ? '' : 'none';
        });
    }

    filterButton.addEventListener('click', filterLogs);
    searchInput.addEventListener('input', filterLogs);

    resetButton.addEventListener('click', () => {
        searchInput.value = '';
        roleFilter.value = '';
        statusFilter.value = '';
        dateFrom.value = '';
        dateTo.value = '';
        filterLogs();
    });
</script>
@endsection
