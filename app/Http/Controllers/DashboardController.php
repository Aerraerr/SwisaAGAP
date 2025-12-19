<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Grant;
use App\Models\Application;
use App\Models\Training;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Count total members (role_id = 1)
        $totalMembers = User::where('role_id', 1)->count();

        // Count all available grants
        $totalGrants = Grant::count();

        // Count upcoming trainings/events (assuming 'start_date' field exists)
        $upcomingTrainings = Training::whereDate('date', '>=', Carbon::today())->count();

        // Count all pending requests (status_id = 3)
        $pendingRequests = Application::where('status_id', 3)->count();

        return view('dashboard', compact('totalMembers', 'totalGrants', 'upcomingTrainings', 'pendingRequests'));
    }
}
