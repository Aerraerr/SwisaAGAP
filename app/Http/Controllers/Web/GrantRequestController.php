<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\DocumentChecker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class GrantRequestController extends Controller
{
    public function displayApplications(){
        // initialized the DocumentChecker service
        $checker = new DocumentChecker();

        //load the application data with eager loading with status
        $applications = [
            'all' => Application::with('grant.grant_requirements.requirement', 'grant.documents', 'documents', 'user.user_info', 'status')->where('application_type', 'grant_request')->get(),
            'pending' => Application::with('status', 'grant.grant_requirements.requirement', 'grant.documents', 'documents', 'user.user_info', 'status')->where('application_type', 'grant_request')->whereHas('status', function($q)
                {$q->where('status_name', 'pending'); 
                })->get(),
            'approved' => Application::with('status', 'grant.grant_requirements.requirement', 'grant.documents', 'documents', 'user.user_info', 'status')->where('application_type', 'grant_request')->whereHas('status', function($q)
                {$q->where('status_name', 'approved'); 
                })->get(),
            'rejected' => Application::with('status', 'grant.grant_requirements.requirement', 'grant.documents', 'documents', 'user.user_info', 'status')->where('application_type', 'grant_request')->whereHas('status', function($q)
                {$q->where('status_name', 'rejected'); 
                })->get(),
        ];
        
        foreach ($applications['pending'] as $app) {
            foreach ($app->documents as $document) {
                // Construct file path
                $filePath = storage_path('app/public/' . $document->file_path);

                // Retrieve corresponding requirement name
                $requirementName = $document->grantRequirement->requirement->requirement_name ?? null;

                // Check if file exists and has a matching requirement
                if (file_exists($filePath) && $requirementName) {
                    $isMatch = $checker->checkRequirementInFile($filePath, $requirementName);
                    $document->check_result = $isMatch ? 'Passed' : 'Needs Checking';
                } else {
                    $document->check_result = 'Missing';
                }
            }
        }

        // Sync check results to the 'all' tab (for matching pending applications)
        foreach ($applications['all'] as $app) {
            if ($app->status->status_name === 'pending') {
                // Find the same app from the pending collection
                $pendingApp = $applications['pending']->firstWhere('id', $app->id);
                if ($pendingApp) {
                    // Apply the computed document check results
                    foreach ($app->documents as $document) {
                        $matchingDoc = $pendingApp->documents->firstWhere('id', $document->id);
                        if ($matchingDoc) {
                            $document->check_result = $matchingDoc->check_result ?? 'Missing';
                        }
                    }
                }
            }
        }

        //load the grant_requirements data
        $grantRequirements = DB::table('grant_requirements')
        ->join('requirements', 'grant_requirements.requirement_id', '=', 'requirements.id')
        ->select(
            'grant_requirements.id as grant_requirement_id',
            'requirements.requirement_name'
        )
        ->get();

        return view('swisa-admin.grant-request', compact('applications', 'grantRequirements'));
    }

    public function approvedApplication(Request $request, $id){

        try{
            $application = Application::findOrFail($id);

            if ($request->action === 'approve') {
                $application->status_id = 33; //Approved id

            } elseif ($request->action === 'reject') {
                $application->status_id = 35; //Rejected id
                $application->rejection_reason = $request->input('rejection_reason');
            }

            $application->save();
            
            return redirect()->back()->with('success', 'Application ' . strtolower($request->action) . 'd successfully!');
        }catch(\Exception $error){
            Log::error('Grant Application Update Error: ' . $error->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while creating a user.');
        }
    }
}
