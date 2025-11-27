<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //pass the 'members' variable to the members page for data display
    public function displayMember(){
        //get only the user who are members and approved membership
       $members = User::with(['documents', 'user_info',
            'applications' => function ($q) {
                $q->where('application_type', 'membership')
                ->where('status_id', 33);
            },
            'applications.grant'])->where('role_id', 1)->whereHas('applications', function ($q) {
                $q->where('application_type', 'membership')
                ->where('status_id', 33);
            })->get();

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
        $member = User::with('documents', 'user_info', 'applications.grant')->findOrFail($id);

        return view('swisa-admin.view-profile', compact('member'));
    }
}
