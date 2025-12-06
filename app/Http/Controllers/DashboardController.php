<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Grant;
use App\Models\Application;
use App\Models\Contribution;
use App\Models\Sector;
use App\Models\Training;
use App\Models\UserInfo;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Count total members (role_id = 1)
        $totalMembers = User::where('role_id', 1)->count();

        // Count all available grants
        $totalGrants = Grant::count();
        $totalGivebacks = Contribution::count();

        // Count upcoming trainings/events (assuming 'start_date' field exists)
        $upcomingTrainings = Training::whereDate('date', '>=', Carbon::today())->count();

        // Count all pending requests (status_id = 3)
        $pendingRequests = Application::where('application_type', 'Grant Application')->where('status_id', 3)->count();
        $inProcessRequests = Application::where('application_type', 'Grant Application')->where('status_id', 15)->count();
        $approvedRequests = Application::where('application_type', 'Grant Application')->where('status_id', 4)->count();
        $rejectedRequests = Application::where('application_type', 'Grant Application')->where('status_id', 6)->count();

        //announcement display
        $announcements = Announcement::where(function ($query) {
            $query->whereNull('end_at')
                  ->orWhere('end_at', '>=', Carbon::today());
        })
         ->orderBy('posted_at', 'desc') 
        ->take(3)         
        ->get();

        //members demographic display
        $members = UserInfo::whereHas('user', function($q){
        $q->where('role_id', 1); // members only
        })->get();

        $total = $members->count();

        // Gender count
        $maleCount   = $members->where('gender', 'Male')->count();
        $femaleCount = $members->where('gender', 'Female')->count();

        $malePercent   = $total ? round(($maleCount / $total) * 100) : 0;
        $femalePercent = $total ? round(($femaleCount / $total) * 100) : 0;

        // Age groups
        $ageGroups = [
            'below_18' => 0,
            '18-25' => 0,
            '26-40' => 0,
            '41-60' => 0,
            '60+'   => 0,
        ];

        foreach ($members as $member) {
            if (!$member->birthdate) continue;

            $age = Carbon::parse($member->birthdate)->age;

            if ($age >= 18 && $age <= 25) $ageGroups['18-25']++;
            elseif ($age >= 26 && $age <= 40) $ageGroups['26-40']++;
            elseif ($age >= 41 && $age <= 60) $ageGroups['41-60']++;
            elseif ($age > 60) $ageGroups['41-60']++;
            else $ageGroups['below_18']++;
        }

        $agePercent = [];
        foreach ($ageGroups as $key => $count) {
            $agePercent[$key] = $total ? round(($count / $total) * 100) : 0;
        }

        // Monthly grant application submissions
        $monthlyRequests = Application::select(
                DB::raw("MONTH(created_at) as month"),
                DB::raw("COUNT(id) as total")
            )
            ->where('application_type', 'Grant Application')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->pluck('total', 'month');

        // Prepare 12 months (Jan–Dec)
        $monthlyData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyData[] = $monthlyRequests[$i] ?? 0;
        }

        //top 5 grants
        $topGrants = Grant::whereDate('end_at', '>=', Carbon::today()) // only active grants
            ->withCount([
                'applications as approved_applicants' => function ($query) {
                    $query->where('status_id', 4); // only approved applications
                }
            ])
            ->orderByDesc('approved_applicants') // highest approved first
            ->take(5)
            ->get();

        // Get all sectors dynamically
        $sectorLabels = Sector::pluck('sector_name'); 

        // Count users per sector
        $sectorCounts = $sectorLabels->map(function($label) {
            $sector = Sector::where('sector_name', $label)->first();
            return $sector ? UserInfo::where('sector_id', $sector->id)->count() : 0;
        });

        return view('dashboard', compact('totalMembers', 'totalGrants', 'totalGivebacks', 'upcomingTrainings', 'pendingRequests',
        'inProcessRequests', 'approvedRequests', 'rejectedRequests', 'announcements', 'malePercent', 'femalePercent', 'agePercent',
        'monthlyData', 'topGrants', 'sectorLabels', 'sectorCounts'));
    }
}
