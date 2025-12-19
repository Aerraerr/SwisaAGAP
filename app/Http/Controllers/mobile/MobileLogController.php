<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MobileLogController extends Controller
{
    /**
     * Store only successful login activity from Flutter
     */
    public function storeLoginLog(Request $request)
    {
        $userId = $request->input('user_id');
        $userName = $request->input('user_name') ?? 'Unknown';
        $role = $request->input('role') ?? 'Member';
        $details = $request->input('details') ?? null;

        $user = User::find($userId);

        // Only log if user exists
        if ($user) {
            $log = Log::create([
                'user_id' => $userId,
                'user_name' => $userName,
                'role' => $role,
                'activity' => 'Logged In',
                'ip_address' => $request->ip(),
                'status' => 'success',
                'activity_timestamp' => now(),
                'details' => $details,
            ]);

            // Optional: log in user server-side
            Auth::login($user);

            return response()->json([
                'success' => true,
                'message' => 'Login logged successfully',
                'log' => $log,
            ]);
        }

        // Do not log failed attempts
        return response()->json([
            'success' => false,
            'message' => 'User not found, login not logged',
        ]);
    }

    /**
     * Fetch recent logs
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
