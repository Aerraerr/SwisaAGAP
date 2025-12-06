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
use App\Services\SMSService;

class GrantRequestController extends Controller
{
    public function displayApplications(){
        $perPage = (int) request('per_page', 10);
        $perPage = in_array($perPage, [10, 20, 50, 100]) ? $perPage : 10;

        $pendingAndProcessing = Application::with(
            'grant.grant_requirements.requirement',
            'grant.documents',
            'documents',
            'user.user_info',
            'status'
        )
        ->where('application_type', 'Grant Application')
        ->whereHas('status', function($q) {
            $q->whereIn('status_name', ['pending', 'processing_application']);
        })
        ->latest()
        ->paginate($perPage)
        ->withQueryString();

        $applications = [
            'all' => Application::with('grant.grant_requirements.requirement', 'grant.documents', 'documents', 'user.user_info', 'status')->where('application_type', 'Grant Application')->latest()->paginate($perPage)->withQueryString(),
            'pending' => $pendingAndProcessing,
            'approved' => Application::with('status', 'grant.grant_requirements.requirement', 'grant.documents', 'documents', 'user.user_info', 'status')->where('application_type', 'Grant Application')->whereHas('status', function($q)
                {$q->where('status_name', 'approved'); 
                })->latest()
                ->paginate($perPage)->withQueryString(),
            'rejected' => Application::with('status', 'grant.grant_requirements.requirement', 'grant.documents', 'documents', 'user.user_info', 'status')->where('application_type', 'Grant Application')->whereHas('status', function($q)
                {$q->where('status_name', 'rejected'); 
                })->latest()
                ->paginate($perPage)->withQueryString(),
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
            'status' => 15, //processing application
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
        DB::beginTransaction(); //begin transaction: ensures all actions are success, if one fails, rollback

        try{
            $application = Application::with('user.user_info', 'grant')->findOrFail($id);
            $grant = $application->grant;
            $deduction = $grant->unit_per_request ?? 1;

            if ($request->action === 'approve') {
                //Check if grant has sufficient stock
                if ($grant->total_quantity < $deduction) {
                    return redirect()->back()->with('error', 'Cannot approve. Grant stock is insufficient.');
                }

                //Deduct stock total_quantity - unit_per_request
                $grant->decrement('total_quantity', $deduction);

                $application->status_id = 4; //Approved id

                $notifMessage = "Congratulations! Your application for the grant '{$application->grant->title}' has been APPROVED.";
                $smsMessage = "[SWISA-AGAP] Congratulations! Your application for the grant '{$application->grant->title}' has been APPROVED.";

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

            //send sms of the application
            if (!empty($application->user->phone_number)) {
                
                $number = $application->user->phone_number;
                $message = $smsMessage;

                SMSService::send($number, $message);
            }

            DB::commit(); //saved everything

            return redirect()->back()->with('success', 'Grant application ' . strtolower($request->action) . 'd successfully!');
        }catch(\Exception $error){
            DB::rollback(); // revert all database changes, ensuring data integrety

            Log::error('Grant Application Update Error: ' . $error->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while updating grant application.');
        }
    }

    public function claimed(Request $request, $id){
        try {
            // Validate
            $request->validate([
                'proof_claimed' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120', // 5MB
            ]);

            $application = Application::findOrFail($id);

            // Upload file
            if ($request->hasFile('proof_claimed')) {

                $file      = $request->file('proof_claimed');
                $fileName  = 'proof_claimed_' . $application->id . '_' . time() . '.' . $file->getClientOriginalExtension();
                $filePath  = 'applications/proof/' . $fileName;

                Storage::disk('public')->put($filePath, file_get_contents($file));

                // Save file path in database
                $application->proof_claimed = $filePath;
            }

            // OPTIONAL: Update status to "Claimed" (if status_id = 1 is Correct)
            $application->status_id = 14;

            $application->save();

            $smsMessage = "[SWISA-AGAP] Your application #{$application->id} for '{$application->grant->title}' has been successfully claimed on " . now()->format('F d, Y h:i A') . ". Thank you!";

            //send sms of the application
            if (!empty($application->user->phone_number)) {
                
                $number = $application->user->phone_number;
                $message = $smsMessage;

                SMSService::send($number, $message);
            }

            return back()->with('success', 'Application marked as claimed successfully!');
            
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update claimed status: ' . $e->getMessage());
        }
    }
}
