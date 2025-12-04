<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
public function index(Request $request)
{
    $userId = $request->user()->id;

    $activities = DB::table('activity_history')
        ->where('user_id', $userId)
        ->whereNull('deleted_at')
        ->orderByDesc('created_at')
        ->paginate(10);

    return response()->json([
        'success' => true,
        'data' => [
            'items'        => $activities->items(),
            'total'        => $activities->total(),
            'current_page' => $activities->currentPage(),
            'last_page'    => $activities->lastPage(),
        ],
    ]);
}

public function clear(Request $request)
{
    $userId = $request->user()->id;

    DB::table('activity_history')
        ->where('user_id', $userId)
        ->whereNull('deleted_at')
        ->update(['deleted_at' => now()]);

    return response()->json([
        'success' => true,
        'message' => 'Activity history cleared.',
    ]);
}

public function destroy(Request $request, $id)
{
    $userId = $request->user()->id;

    $updated = DB::table('activity_history')
        ->where('id', $id)
        ->where('user_id', $userId)
        ->whereNull('deleted_at')
        ->update(['deleted_at' => now()]);

    if (!$updated) {
        return response()->json([
            'success' => false,
            'message' => 'Activity not found.',
        ], 404);
    }

    return response()->json([
        'success' => true,
        'message' => 'Activity removed.',
    ]);
}

}