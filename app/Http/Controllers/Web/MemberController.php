<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //pass the 'members' variable to the members page for data display
    public function displayMember(){
        //get only the user who are members and its relations
        $members = User::with('documents', 'user_info', 'applications.grant')->where('role_id', '1')->get();

        // Count all members
        $totalApplications = $members->count();

        // Pending membership applications
        $pendingApplications = $members->pluck('applications')->flatten()
            ->where('membership', '!=', null)->where('status', 'approved')->count();

        // Rejected membership applications
        $rejectedApplications = $members->pluck('applications')->flatten()
            ->where('membership', '!=', null)->where('status', 'pending')->count();

        return view('swisa-admin.members', compact('members', 'totalApplications', 'pendingApplications', 'rejectedApplications'));
    }

    public function viewProfile($id){
        $member = User::with('documents', 'user_info', 'applications.grant')->findOrFail($id);

        return view('swisa-admin.view-profile', compact('member'));
    }
}
