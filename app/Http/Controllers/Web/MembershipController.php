<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\CreditScore;
use App\Models\Notification;
use App\Models\Requirement;
use App\Services\DocumentChecker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\SMSService;

class MembershipController extends Controller
{
    public function displayApplications(){
        $perPage = (int) request('per_page', 10);
        $perPage = in_array($perPage, [10, 20, 50, 100]) ? $perPage : 10;

        $applications = [
            'all' => Application::with(['user.user_info', 'status', 'documents.membershipRequirement.requirement'])->where('application_type', 'membership')->paginate($perPage)->withQueryString(),
            'pending' => Application::with(['user.user_info', 'status', 'documents.membershipRequirement.requirement'])->where('application_type', 'membership')->whereHas('status', function($q)
                {$q->where('status_name', 'pending'); 
                })->paginate($perPage)->withQueryString(),
            'approved' => Application::with(['user.user_info', 'status', 'documents.membershipRequirement.requirement'])->where('application_type', 'membership')->whereHas('status', function($q)
                {$q->where('status_name', 'approved'); 
                })->paginate($perPage)->withQueryString(),
            'rejected' => Application::with(['user.user_info', 'status', 'documents.membershipRequirement.requirement'])->where('application_type', 'membership')->whereHas('status', function($q)
                {$q->where('status_name', 'rejected'); 
                })->paginate($perPage)->withQueryString(),
        ];

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
            $application = Application::with('user')->findOrFail($id);

            if ($request->action === 'approve') {
                $application->status_id = 4; //Approved id
                
                // Update the user's role to 'member' (1)
                if ($application->user) {
                    $application->user->role_id = 1; // Member role
                    $application->user->save();

                    // 1. Check if a CreditScore record already exists for this user.
                    $existingScore = CreditScore::where('user_id', $application->user->id)->first();

                    if (!$existingScore) {
                        // 2. If no score exists, create a new one with a default score (max 50)
                        CreditScore::create([
                            'user_id' => $application->user->id,
                            'score' => 20, // Default starting score for new members
                        ]);
                        // logging for audit purposes
                        Log::info('Credit Score (50) created for new member User ID: ' . $application->user->id);
                    }

                    $notifMessage = "Congratulations! Your application for the grant '{$application->grant->title}' has been APPROVED.";
                    $smsMessage = "[SWISA-AGAP] Congratulations! Your application for the grant '{$application->grant->title}' has been APPROVED.";
                }

            } elseif ($request->action === 'reject') {
                $application->status_id = 6; //Rejected id
                $application->rejection_reason = $request->input('rejection_reason');

                $notifMessage = "Your application for the grant '{$application->grant->title}' has been REJECTED. Reason: {$application->rejection_reason}";
                $smsMessage = "[SWISA-AGAP] Your application for the grant '{$application->grant->title}' has been REJECTED. Reason: {$application->rejection_reason}";
            }

            $application->save();

            //store a confirmation message to table
            Notification::create([ 
                'user_id' => $application->user->id,
                'message' => $notifMessage,
                'sent_at' => now(),
            ]);

            //end sms of the application
            if (!empty($application->user->phone_number)) {
                
                $number = $application->user->phone_number;
                $message = $smsMessage;

                SMSService::send($number, $message);
            }

            return redirect()->back()->with('success', 'Membership application ' . strtolower($request->action) . 'd successfully!');
        }catch(\Exception $error){
            Log::error('Membership Application Update Error: ' . $error->getMessage());
            return redirect()->back()->with('error', 'Something went wrong updating membership application.');
        }
    }

}
