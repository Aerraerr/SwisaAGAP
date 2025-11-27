<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Requirement;
use App\Services\DocumentChecker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MembershipController extends Controller
{
    public function displayApplications(){
        // initialized the DocumentChecker service
        //$checker = new DocumentChecker();

        $applications = [
            'all' => Application::with(['user.user_info', 'status', 'documents.membershipRequirement.requirement'])->where('application_type', 'membership')->get(),
            'pending' => Application::with(['user.user_info', 'status', 'documents.membershipRequirement.requirement'])->where('application_type', 'membership')->whereHas('status', function($q)
                {$q->where('status_name', 'pending'); 
                })->get(),
            'approved' => Application::with(['user.user_info', 'status', 'documents.membershipRequirement.requirement'])->where('application_type', 'membership')->whereHas('status', function($q)
                {$q->where('status_name', 'approved'); 
                })->get(),
            'rejected' => Application::with(['user.user_info', 'status', 'documents.membershipRequirement.requirement'])->where('application_type', 'membership')->whereHas('status', function($q)
                {$q->where('status_name', 'rejected'); 
                })->get(),
        ];

        /*foreach ($applications['pending'] as $app) {
            foreach ($app->documents as $document) {
                // Construct file path
                $filePath = storage_path('app/public/' . $document->file_path);

                // Retrieve corresponding requirement name
                $requirementName = $document->membershipRequirement->requirement->requirement_name ?? null;

                // Check if file exists and has a matching requirement
                if (file_exists($filePath) && $requirementName) {
                    $document->check_result = $checker->checkRequirementInFile(
                        $filePath,
                        $requirementName,
                        $app->user
                    );
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
        }*/

        $membershipRequirements = DB::table('membership_requirements')
        ->join('requirements', 'membership_requirements.requirement_id', '=', 'requirements.id')
        ->select(
            'membership_requirements.id as membership_requirement_id',
            'requirements.requirement_name'
        )
        ->get();

        return view('swisa-admin.member-application', compact('applications', 'membershipRequirements'));
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

            return redirect()->back()->with('success', 'Membership application ' . strtolower($request->action) . 'd successfully!');
        }catch(\Exception $error){
            Log::error('Membership Application Update Error: ' . $error->getMessage());
            return redirect()->back()->with('error', 'Something went wrong updating membership application.');
        }
    }

}
