<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log; // make sure you have a Log model

class LogController extends Controller
{
    public function index()
    {
        // Fetch latest logs with pagination
        $logs = Log::latest('activity_timestamp')->paginate(20);

        // Send the logs to your view
        return view('swisa-admin.logs', compact('logs'));
    }
    public function getRecentLogs()
    {
        // Get the 5 most recent logs
        $recentLogs = \App\Models\Log::latest('activity_timestamp')->take(5)->get();

        return view('charts.recent-activity', compact('recentLogs'));
    }
}
