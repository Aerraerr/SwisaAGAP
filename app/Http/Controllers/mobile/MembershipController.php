<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserInfo;
use App\Models\Application;
use App\Models\Document;
use Illuminate\Support\Str;
use App\Services\DocumentChecker;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\CreditScore;
use App\Models\CreditScoreHistory;
use App\Services\SMSService;
use App\Models\Notification;

class MembershipController extends Controller
{
    /**
     * Submit membership application
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sector_id' => 'required|integer',
            'fname' => 'required|string',
            'mname' => 'nullable|string',
            'lname' => 'required|string',
            'suffix' => 'nullable|string',
            'birthdate' => 'required|date',
            'civil_status' => 'nullable|string',
            'gender' => 'required|string',
            'contact_info' => 'nullable|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'house_no' => 'nullable|string',
            'barangay' => 'required|string',
            'zone' => 'required|string',
            'farm_location' => 'nullable|string',
            'land_size' => 'nullable|string',
            'water_source' => 'nullable|string',
            'sc_fname' => 'nullable|string',
            'sc_mname' => 'nullable|string',
            'sc_lname' => 'nullable|string',
            'sc_suffix' => 'nullable|string',
            'sc_gender' => 'nullable|string',
            'sc_contact_info' => 'nullable|string',
            'sc_province' => 'nullable|string',
            'sc_city' => 'nullable|string',
            'sc_house_no' => 'nullable|string',
            'sc_barangay' => 'nullable|string',
            'sc_zone' => 'nullable|string',
            'relationship' => 'nullable|string',
            'valid_id' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $user = $request->user();

        // Check if user already submitted
        if ($user->userInfo) {
            return response()->json([
                'success' => false,
                'message' => 'Application already submitted.'
            ], 409);
        }

        // Auto-detect primary contact (phone or email)
        $primaryContact = $validatedData['contact_info'] ?? null;

        $contactPhone = null;
        $contactEmail = null;
        
        if ($this->isEmail($primaryContact)) {
            $contactEmail = $primaryContact;
        } else {
            $contactPhone = $primaryContact;
        }
        
        // Auto-detect secondary contact (phone or email)
        $secondaryContact = $validatedData['sc_contact_info'] ?? null;
        $scPhone = null;
        $scEmail = null;
        
        if ($secondaryContact) {
            if ($this->isEmail($secondaryContact)) {
                $scEmail = $secondaryContact;
            } else {
                $scPhone = $secondaryContact;
            }
        }

        // Create UserInfo with smart detection
        $userInfo = UserInfo::create([
            'user_id' => $user->id,
            'sector_id' => $validatedData['sector_id'],
            'fname' => $validatedData['fname'],
            'mname' => $validatedData['mname'],
            'lname' => $validatedData['lname'],
            'name' => $validatedData['fname'] . ' ' .($validatedData['mname'] ?? ' '). ' ' .$validatedData['lname'],
            'suffix' => $validatedData['suffix'],
            'birthdate' => $validatedData['birthdate'],
            'civil_status' => $validatedData['civil_status'],
            'gender' => $validatedData['gender'],
            
            // Store contact in both formats
            'contact_info' => $primaryContact,
            'phone_no' => $contactPhone,
            'email' => $contactEmail,
            
            'province' => $validatedData['province'],
            'city' => $validatedData['city'],
            'house_no' => $validatedData['house_no'],
            'barangay' => $validatedData['barangay'],
            'zone' => $validatedData['zone'],
            'farm_location' => $validatedData['farm_location'],
            'land_size' => $validatedData['land_size'],
            'water_source' => $validatedData['water_source'],
            
            // Secondary Contact
            'sc_fname' => $validatedData['sc_fname'],
            'sc_mname' => $validatedData['sc_mname'],
            'sc_lname' => $validatedData['sc_lname'],
            'sc_suffix' => $validatedData['sc_suffix'],
            'sc_gender' => $validatedData['sc_gender'],
            
            // Store secondary contact in both formats
            'sc_contact_info' => $secondaryContact,
            'sc_phone_no' => $scPhone,
            'sc_email' => $scEmail,
            
            'sc_province' => $validatedData['sc_province'],
            'sc_city' => $validatedData['sc_city'],
            'sc_house_no' => $validatedData['sc_house_no'],
            'sc_barangay' => $validatedData['sc_barangay'],
            'sc_zone' => $validatedData['sc_zone'],
            'relationship' => $validatedData['relationship'],
        ]);

        // Create Application with PENDING status
        $application = Application::create([
            'user_id' => $user->id,
            'grant_id' => null,
            'status_id' => 3, // PENDING STATUS // 3 ang pending
            'application_type' => 'Membership',
            'purpose' => 'Membership Application',
        ]);

        // Store Valid ID document
        if ($request->hasFile('valid_id')) {

            $file = $request->file('valid_id');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('application/membership', $filename, 'public');

            // CREATE DOCUMENT ENTRY
            $document = Document::create([
                'grant_requirement_id' => null,
                'membership_requirement_id' => 1, // ⚠️ SET THE VALID ID REQUIREMENT ID HERE
                'status_id' => 3, // PENDING STATUS
                'file_path' => $path,
                'file_name' => $filename,
                'documentable_type' => 'App\Models\Application',
                'documentable_id' => $application->id,
            ]);

            // Initialize checker
            $checker = new DocumentChecker();

            // Get requirement name (example: "Valid ID")
            $requirement = \App\Models\MembershipRequirement::find(1); // SAME ID AS ABOVE
            $requirementName = $requirement?->requirement?->requirement_name;

            if ($requirementName) {

                // RUN AUTO CHECKER (same as web)
                $result = $checker->verifyDocumentBelongsToUser(
                    storage_path('app/public/' . $path),
                    $requirementName,
                    $userInfo // same membership owner
                );

                // UPDATE DOCUMENT WITH RESULT
                $document->update([
                    'check_result' => $result
                ]);
            }
        }

        //create pdf file of the application form
        $application->load(['documents', 'status', 'user.user_info']);
        $pdf = Pdf::loadView('pdf.membership_application_form', ['application' => $application]);

        $fileName = $request->lname . '_membership_application_form_' . $application->id . '.pdf';
        $filePath = 'applications/' . $fileName;

        Storage::disk('public')->put($filePath, $pdf->output());
        $application->update(['form_img' => $filePath]);

        //store a confirmation message to table
        Notification::create([ 
            'user_id' => Auth::id(),
            'message' => 'Your membership application was submitted successfully and is now pending approval.' ,
            'sent_at' => now(),
        ]);

        // Send SMS to applicant
        if ($userInfo && $userInfo->phone_no) {

            $number = $userInfo->phone_no;

            // Convert "09..." to "639..."
            $number = preg_replace('/^0/', '63', $number);

            $message = '[SWISA-AGAP] Your membership application was submitted successfully and is now pending approval.';

            SMSService::send($number, $message);
        }

        return response()->json([
            'success' => true,
            'message' => 'Membership application submitted successfully! Please wait for admin approval.',
            'user_info' => $userInfo,
            'application' => $application
        ], 201);
    }

    /**
     * Approve membership application (Admin only)
     */
    public function approveMembership(Request $request, $applicationId)
    {
        $application = Application::findOrFail($applicationId);
        
        // Check if application is for membership
        if ($application->application_type !== 'Membership') {
            return response()->json([
                'success' => false,
                'message' => 'This is not a membership application.'
            ], 400);
        }
        
        // Check if already approved
        if ($application->status_id == 4) {
            return response()->json([
                'success' => false,
                'message' => 'Application already approved.'
            ], 400);
        }
        
        $user = $application->user;
        //$userInfo = $user->userInfo;
        
        // Update application status to APPROVED
        $application->update(['status_id' => 4]); // 4 = Approved
        
        // Update document status to APPROVED
        $application->documents()->update(['status_id' => 4]);
        
        // Generate QR code
        /*if (!$userInfo->qr_code) {
            $userInfo->qr_code = Str::uuid()->toString();
            $userInfo->save();
        }*/
        
        // Assign initial credit score (if not exists)
        if (!$user->creditScore) {
            $user->creditScore()->create([
                'score' => 20,
            ]);
            
            // Create credit history
            $user->creditScoreHistory()->create([
                'activity' => 'Membership Approved',
                'points' => 20
            ]);
        }
        
        // Change user role to member
        $user->update(['role_id' => 1]); // 1 ang member nata 2 kinaag mo
        
        return response()->json([
            'success' => true,
            'message' => 'Membership application approved successfully!',
            'application' => $application,
        ]);
    }

    /**
     * Reject membership application (Admin only)
     */
    public function rejectMembership(Request $request, $applicationId)
    {
        $request->validate([
            'reason' => 'nullable|string|max:500',
        ]);

        $application = Application::findOrFail($applicationId);
        
        // Check if application is for membership
        if ($application->application_type !== 'Membership') {
            return response()->json([
                'success' => false,
                'message' => 'This is not a membership application.'
            ], 400);
        }
        
        // Check if already rejected
        if ($application->status_id == 6) {
            return response()->json([
                'success' => false,
                'message' => 'Application already rejected.'
            ], 400);
        }
        
        // Update application status to REJECTED
        $application->update([
            'status_id' => 6, // 6 = Rejected
            'rejection_reason' => $request->input('reason'),
        ]);
        
        // Update document status to REJECTED
        $application->documents()->update(['status_id' => 6]);
        
        return response()->json([
            'success' => true,
            'message' => 'Membership application rejected.',
            'application' => $application,
        ]);
    }
    
    /**
     * Helper method to detect if input is email
     */
    private function isEmail($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }
}