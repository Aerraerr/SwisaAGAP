<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Assuming your User model is here

class MobileLogController extends Controller
{
    /**
     * Store login activity from Flutter mobile
     * Can log success or fail attempts
     */
  public function storeLoginLog(Request $request)
{
    $userId = $request->user_id;
    $userName = $request->user_name ?? 'Unknown';
    $role = $request->role ?? 'Guest';
    $status = $request->status ?? 'fail';
    $details = $request->details;

    Log::create([
        'user_id' => $userId,
        'user_name' => $userName,
        'role' => $role,
        'activity' => $status === 'success' ? 'Logged In' : 'Login Attempt',
        'ip_address' => $request->ip(),
        'status' => $status,
        'activity_timestamp' => now(),
        'details' => $details,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Login log saved',
    ]);
}

    /**
     * Fetch recent logs for Flutter
     */
    public function recentLogs()
    {
        $recentLogs = Log::latest('activity_timestamp')->take(10)->get();
        return response()->json([
            'success' => true,
            'logs' => $recentLogs,
        ]);
    }
}
