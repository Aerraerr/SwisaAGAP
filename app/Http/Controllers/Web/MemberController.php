<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //pass the 'members' variable to the members page for data display
    public function displayMember(){
        //initializa for pagination
        $perPage = (int) request('per_page', 10);
        $perPage = in_array($perPage, [10, 20, 50, 100]) ? $perPage : 10;

        //get only the user who are members and approved membership
        $members = User::with(['documents', 'user_info',
            'applications' => function ($q) {
                $q->where('application_type', 'Membership')
                ->where('status_id', 4);
            },
            'applications.grant'])->where('role_id', 1)->whereHas('applications', function ($q) {
                $q->where('application_type', 'Membership')
                ->where('status_id', 4);
            })->paginate($perPage)->withQueryString();

        // Count all members
        $totalMembers = $members->count();

        //this month member count
        $monthlyMembers = $members->filter(function ($member) {
            return $member->created_at->isSameMonth(now());
        })->count();

        //new members today
        $todayMembers = $members->filter(function ($member) {
            return $member->created_at->isToday();
        })->count();

        return view('swisa-admin.members', compact('members', 'totalMembers', 'monthlyMembers', 'todayMembers' ));
    }

    public function viewProfile($id){
        $member = User::with('applications.documents', 'user_info.sector', 'applications.grant.grant_type', 'applications.status', 'participants.training', 'activityHistory')->findOrFail($id);

        $activityLogs = $member->activityHistory
            ->sortByDesc('created_at')
            ->groupBy(function ($log) {
                return $log->created_at->format('F d, Y');
            });

        $programsJoined = $member->participants->count();
        $completion = $member->participants->whereNotNull('check_in_at')->count();

        return view('swisa-admin.view-profile', compact('member', 'activityLogs', 'programsJoined', 'completion'));
    }
}
