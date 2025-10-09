<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class GrantRequestController extends Controller
{
    public function displayApplications(){
        $applications = [
            'all' => Application::with('grant.documents')->where('application_type', 'grant_request')->get(),
            'pending' => Application::with('status', 'grant.documents')->where('application_type', 'grant_request')->whereHas('status', function($q)
                {$q->where('status_name', 'pending'); 
                })->get(),
            'approved' => Application::with('status', 'grant.documents')->where('application_type', 'grant_request')->whereHas('status', function($q)
                {$q->where('status_name', 'approved'); 
                })->get(),
            'rejected' => Application::with('status', 'grant.documents')->where('application_type', 'grant_request')->whereHas('status', function($q)
                {$q->where('status_name', 'rejected'); 
                })->get(),
        ];

        return view('swisa-admin.grant-request', compact('applications'));
    }
}
