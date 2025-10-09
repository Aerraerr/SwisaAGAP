<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\GrantReport;
use Illuminate\Http\Request;

class GrantReportController extends Controller
{
    public function displayGrantReports(){
        $grantReports = GrantReport::with(['user.user_info', 'application.grant', 'documents'])->get();
    
        return view('swisa-support_staff.reports', compact('grantReports'));
    }

    public function viewGrantReport($id){
        $grantReport = GrantReport::with(['user.user_info', 'application.grant', 'documents'])->findOrFail($id);

        $reportHistory = GrantReport::whereHas('application', function ($query) use ($grantReport) {
        $query->where('user_id', $grantReport->application->user_id); })->orderBy('created_at', 'desc')->get();    
        
        return view('swisa-support_staff.view-report', compact('grantReport', 'reportHistory'));
    }

    public function updateStatus(Request $request, $id){
        $giveback = GrantReport::findOrFail($id);

        $giveback->status_id = '46';
        $giveback->save();

        return redirect()->back()->with('success', 'Giveback marked as received.');
    }
}
