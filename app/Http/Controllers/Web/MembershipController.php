<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function displayApplications(){
        $applications = [
            'all' => Application::where('application_type', 'membership')->get(),
            'pending' => Application::with('status')->where('application_type', 'membership')->whereHas('status', function($q)
                {$q->where('status_name', 'pending'); 
                })->get(),
            'approved' => Application::with('status')->where('application_type', 'membership')->whereHas('status', function($q)
                {$q->where('status_name', 'approved'); 
                })->get(),
            'rejected' => Application::with('status')->where('application_type', 'membership')->whereHas('status', function($q)
                {$q->where('status_name', 'rejected'); 
                })->get(),
        ];

        $uploadedReq = Application::with(['documents'])->get();

        return view('swisa-admin.member-application', compact('applications', 'uploadedReq'));
    }

}
