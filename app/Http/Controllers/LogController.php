<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use App\Models\ActivityHistory;
use App\Models\UserInfo;

class LogController extends Controller
{
    public function index()
    {
        // Fetch main system logs
        $systemLogs = Log::select(
            'id',
            'user_id',
            'user_name',
            'activity',
            'status',
            'role',
            'details',
            'ip_address',
            'activity_timestamp',
            'created_at'
        )
        ->latest('activity_timestamp')
        ->get();

        // Fetch Activity History logs (from members) with actual user name from UserInfo
$historyLogs = ActivityHistory::with('user.user_info')
    ->select(
        'id',
        'user_id',
        \DB::raw("'' as role"),
        \DB::raw("'' as status"),
        \DB::raw("'' as ip_address"),
        \DB::raw("'' as details"),
        'type as activity',
        'created_at',
        \DB::raw("created_at as activity_timestamp")
    )
    ->latest('created_at')
    ->get()
    ->map(function($log){
        $log->user_name = optional($log->user->user_info)->name ?? 'Unknown User';
        return $log;
    });


        // Merge logs
        $mergedLogs = $systemLogs->concat($historyLogs);

        // Sort by timestamp
        $sortedLogs = $mergedLogs->sortByDesc(function ($log) {
            return $log->activity_timestamp ?? $log->created_at;
        });

        // Paginate manually
        $perPage = 20;
        $currentPage = request()->get('page', 1);
        $pagedLogs = new \Illuminate\Pagination\LengthAwarePaginator(
            $sortedLogs->slice(($currentPage - 1) * $perPage, $perPage),
            $sortedLogs->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('swisa-admin.logs', [
            'logs' => $pagedLogs
        ]);
    }
}
