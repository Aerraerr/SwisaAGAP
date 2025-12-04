<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<div class="lg:col-span-3 bg-white p-7 rounded-xl shadow">
    <p class="font-semibold mb-2 primary-color dashheader flex items-center">
        <span class="material-icons mr-2 text-custom">history</span>
        Recent Activity
    </p>

    @if(isset($recentLogs) && $recentLogs->count() > 0)
        <ul class="text-sm space-y-2">
            @foreach($recentLogs as $log)
                @php
                    $timestamp = $log->activity_timestamp ?? $log->created_at;
                    $timeAgo = \Carbon\Carbon::parse($timestamp)->diffForHumans();

                    // Determine text color based on activity type
                    $activity = strtolower($log->activity ?? '');
                    $activityColor = 'text-gray-700';

                    if (str_contains($activity, 'attempt')) {
                        $activityColor = 'text-red-600';
                    } elseif (str_contains($activity, 'login') || str_contains($activity, 'logged in') || str_contains($activity, 'sign in')) {
                        $activityColor = 'text-green-600';
                    } elseif (str_contains($activity, 'logout') || str_contains($activity, 'logged out') || str_contains($activity, 'sign out')) {
                        $activityColor = 'text-yellow-600';
                    } elseif (str_contains($activity, 'create') || str_contains($activity, 'add') || str_contains($activity, 'register')) {
                        $activityColor = 'text-blue-600';
                    } elseif (str_contains($activity, 'update') || str_contains($activity, 'edit') || str_contains($activity, 'change')) {
                        $activityColor = 'text-yellow-700';
                    } elseif (str_contains($activity, 'delete') || str_contains($activity, 'remove') || str_contains($activity, 'destroy')) {
                        $activityColor = 'text-red-600';
                    }
                @endphp

                <li class="flex justify-between items-start border-b border-gray-100 pb-0">
                    <div class="flex-1">
                        <span class="font-semibold text-gray-800">{{ $log->user_name ?? 'Unknown User' }}</span>
                        <span class="ml-1 text-xs text-gray-500">
                            {{ $log->role ? '(' . ucwords(str_replace('_',' ',$log->role)) . ')' : '' }}
                        </span>
                        <br>
                        <span class="ml-1 {{ $activityColor }} font-sm">
                            {{ $log->activity }}
                        </span>
                    </div>
                    <span class="text-xs text-gray-500 whitespace-nowrap">
                        {{ $timeAgo }}
                    </span>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-gray-500 text-sm">No recent activity.</p>
    @endif

    <div class="text-right mt-3">
        <a href="{{ route('logs.index') }}" class="text-xs text-custom hover:underline">
            View All Activity →
        </a>
    </div>
</div>
