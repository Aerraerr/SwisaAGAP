<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Application;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class GrantRequestController extends Controller
{
    public function displayApplications(){
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

    public function markAsChecked($id){
        $application = Application::findOrFail($id);

        $application->update([
            'is_checked_by_staff' => true,
            'checked_by_staff_at' => now()
        ]);

        // Get the admin (role_id = 3)
        $admin = User::where('role_id', 3)->first();

        // Notify Admin
        if ($admin) {
            Notification::create([
                'user_id' => $admin->id,
                'message' => "Application {$application->formatted_id} has been reviewed by staff and is ready for approval.",
                'sent_at' => now(),
            ]);
        }

        return back()->with('success', 'Application marked as checked.');
    }

    public function approvedApplication(Request $request, $id){

        try{
            $application = Application::with('user.user_info', 'grant')->findOrFail($id);

            if ($request->action === 'approve') {
                $application->status_id = 33; //Approved id

                $notifMessage = "Congratulations! Your application for the grant '{$application->grant->title}' has been APPROVED.";
                $smsMessage = "[SWISA-AGAP] Congratulations! Your application for the grant '{$application->grant->title}' has been APPROVED.";

            } elseif ($request->action === 'reject') {
                $application->status_id = 35; //Rejected id
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

            /*send sms of the application
            if ($member && $member->phone_number) {
                
                $number = $member->phone_number;
                $message = $smsMessage;

                SMSService::send($number, $message);
            }*/

            return redirect()->back()->with('success', 'Grant application ' . strtolower($request->action) . 'd successfully!');
        }catch(\Exception $error){
            Log::error('Grant Application Update Error: ' . $error->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while updating grant application.');
        }
    }
}
