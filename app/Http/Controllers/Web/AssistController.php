<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Grant;
use App\Models\MembershipRequirement;
use App\Models\Notification;
use App\Models\Sector;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Services\DocumentChecker;
use App\Services\SMSService;

class AssistController extends Controller
{

    public function displayMembers(){
        //get only the user who are members and its relations
        $members = User::with(['documents', 'documents.requirement', 'user_info', 'applications.grant'])->where('role_id', 1)->get();
        $sectors = Sector::all();
        $grants  = Grant::with('grant_requirements.requirement')->get();
        $membershipRequirements = MembershipRequirement::with('requirement')
        ->get()
        ->map(function ($item) {
            return (object)[
                'id' => $item->id, // membership_requirements.id
                'requirement_name' => $item->requirement->requirement_name
            ];
        });

        foreach ($members as $member) {
            $member->first_name  = $member->first_name ?? '';
            $member->middle_name = $member->middle_name ?? '';
            $member->last_name   = $member->last_name ?? '';
            $member->suffix      = $member->suffix ?? '';
        }

        return view('swisa-support_staff.assisted-creation', compact('members', 'sectors', 'grants', 'membershipRequirements'));
    }

    //assist create account
    public function assistRegisterAccount(Request $request){

        try{
            //validate inputs
            $request->validate([
                'first_name'     => 'required|string|max:50',
                'middle_name'     => 'nullable|string|max:50',
                'last_name'     => 'required|string|max:50',
                'suffix'     => 'nullable|string|max:50',
                'email' => 'required|string|lowercase|email|max:50|unique:users,email',
                'password' => 'required|confirmed',
            ]);

            // Create user using same Breeze logic
            $createdUser = User::create([
                'first_name'     => $request->first_name,
                'middle_name'     => $request->middle_name,
                'last_name'     => $request->last_name,
                'suffix'     => $request->suffix,
                'name' => implode(' ', array_filter([
                    $request->first_name,
                    $request->middle_name,
                    $request->last_name,
                    $request->suffix
                ])),
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role_id'  => 1, //  created by staff is a member role
            ]);


            //create notification of the action
            Notification::create([ 
                'user_id' => Auth::id(),
                'message' => 'You have successfully created account ' .$createdUser->formatted_id. '!' ,
                'sent_at' => now(),
            ]);

            return redirect()->back()->with('success', 'User account created successfully.');
        }catch(\Exception $error) {
            Log::error('User Registration Error: ' . $error->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while creating a user.');
        }
    }
    

    //assist membership application
    public function assistMembershipApplication(Request $request, $id){
        //dd($request->all());
        try{
            //validate inputs
            $request->validate([
                // Primary Information
                'fname'       => 'required|string|max:50',
                'mname'       => 'nullable|string|max:50',
                'lname'       => 'required|string|max:50',
                'suffix'      => 'nullable|string|max:10',
                'birthdate'   => 'required|date',
                'civil_status' => 'nullable|string',
                'sex'      => 'required|string',
                'phone'  => 'required|string|regex:/^09[0-9]{9}$/|max:20',
                'province'    => 'required|string|max:50',
                'city'        => 'required|string|max:50',
                'barangay'    => 'required|string|max:50',
                'purok'        => 'required|string|max:50',
                'email'       => 'required|email|max:100',

                // Secondary Contact
                'sc_fname'      => 'required|string|max:50',
                'sc_mname'      => 'nullable|string|max:50',
                'sc_lname'      => 'required|string|max:50',
                'sc_suffix'     => 'nullable|string|max:10',
                'sc_sex'     => 'nullable|string',
                'sc_phone' => 'nullable|string|regex:/^09[0-9]{9}$/|max:20',
                'sc_email'      => 'nullable|email|max:100',
                'sc_province'   => 'nullable|string|max:50',
                'sc_city'       => 'nullable|string|max:50',
                'sc_barangay'   => 'nullable|string|max:50',
                'sc_purok'       => 'nullable|string|max:50',
                'relationship'  => 'required|string',

                // Agriculture / Purpose
                'sector'     => 'nullable|integer',
                'purpose' => 'nullable|string|max:100',
                'other_purpose' => 'nullable|string|max:100',
                'farm_location' => 'nullable|string|max:100',
                'land_size'     => 'nullable|string|max:50',
                'water_source'  => 'nullable|string|max:50',
                
                'documents' => 'required|array',
                'documents.*' => 'required|file|mimes:pdf,jpg,jpeg,png,docx|max:5120',
                'requirement_ids'         => 'nullable|array',
                'requirement_ids.*'       => 'nullable|integer|exists:membership_requirements,id',
            ]);

            $membership = User::findOrFail($id);

            // Update primary info
            $membership->update([
                'name' => $request->fname . ' ' . ($request->mname ?? '') . ' ' . $request->lname,
                'first_name' => $request->fname,
                'middle_name' => $request->mname,
                'last_name' => $request->lname,
                'suffix' => $request->suffix,
                'email' => $request->email,
                'phone_number' => $request->phone,
            ]);

            //Update or create related user_info
            $membership->user_info()->updateOrCreate(
                ['user_id' => $membership->id],
                [
                    'sector_id'     => $request->sector,
                    'fname'         => $request->fname,
                    'mname'         => $request->mname,
                    'lname'         => $request->lname,
                    'suffix'        => $request->suffix,
                    'birthdate'     => $request->birthdate,
                    'gender'        => $request->sex,
                    'civil_status'  => $request->civil_status,
                    'contact_no'    => $request->phone,
                    'province'      => $request->province,
                    'city'          => $request->city,
                    'barangay'      => $request->barangay,
                    'zone'          => $request->purok,
                    'farm_location' => $request->farm_location,
                    'land_size'     => $request->land_size,
                    'water_source'  => $request->water_source,

                    // Secondary contact
                    'sc_fname'      => $request->sc_fname,
                    'sc_mname'      => $request->sc_mname,
                    'sc_lname'      => $request->sc_lname,
                    'sc_suffix'     => $request->sc_suffix,
                    'sc_gender'     => $request->sc_sex,
                    'sc_contact_no' => $request->sc_phone,
                    'sc_email'      => $request->sc_email,
                    'sc_province'   => $request->sc_province,
                    'sc_city'       => $request->sc_city,
                    'sc_barangay'   => $request->sc_barangay,
                    'sc_zone'       => $request->sc_purok,
                    'relationship'  => $request->relationship,
                ]
            );


            // Create a membership application record
            $application = Application::create([
                'user_id'          => $membership->id,
                'status_id'        => 32, // pending
                'application_type' => 'membership',
                'purpose'          => $request->purpose ?? $request->other_purpose,
            ]);

            // Handle file uploads and auto check it after uploading
            if ($request->hasFile('documents')) {
                $documentChecker = new DocumentChecker();

                foreach ($request->file('documents') as $requirementId => $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('application/membership', $filename, 'public');

                    $document = $application->documents()->create([
                        'file_name'                 => $filename,
                        'file_path'                 => $path,
                        'membership_requirement_id' => $requirementId,
                    ]);

                    // Get requirement name
                    $requirementName = \App\Models\MembershipRequirement::find($requirementId)?->requirement?->requirement_name;

                    if ($requirementName) {

                        $result = $documentChecker->verifyDocumentBelongsToUser(
                            storage_path('app/public/' . $path),
                            $requirementName,
                            $membership // the user who owns the membership
                        );

                        $document->update([
                            'check_result' => $result
                        ]);
                    }
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
                'message' => 'You successfully assisted '.$membership->name .' application for Membership and waiting for approval.' ,
                'sent_at' => now(),
            ]);

            /*send sms of the application
            if ($membership && $membership->phone_number) {
                
                $number = $membership->phone_number;
                $message = '[SWISA-AGAP] Your Membership Application is created and pending for approval.';

                SMSService::send($number, $message);
            }*/

            return redirect()->back()->with('success', 'Membership application success!');
        }catch(\Exception $error) {
            Log::error('Membership Application Error: ' . $error->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while submitting your membership application.');
        }
    }

    //assist grant application
    public function assistGrantApplication(Request $request, $id){
        //dd($request->all());
        try {
            //validate inputs
            $request->validate([
                // Primary Information
                'fname'       => 'required|string|max:50',
                'mname'       => 'nullable|string|max:50',
                'lname'       => 'required|string|max:50',
                'suffix'      => 'nullable|string|max:10',
                'birthdate'   => 'required|date',
                'civil_status' => 'nullable|string',
                'sex'      => 'required|string',
                'phone'  => 'required|string|regex:/^09[0-9]{9}$/|max:20',
                'province'    => 'required|string|max:50',
                'city'        => 'required|string|max:50',
                'barangay'    => 'required|string|max:50',
                'purok'        => 'required|string|max:50',
                'email'       => 'required|email|max:100',

                // Secondary Contact
                'sc_fname'      => 'required|string|max:50',
                'sc_mname'      => 'nullable|string|max:50',
                'sc_lname'      => 'required|string|max:50',
                'sc_suffix'     => 'nullable|string|max:10',
                'sc_sex'     => 'required|string',
                'sc_phone' => 'required|string|regex:/^09[0-9]{9}$/|max:20',
                'sc_email'      => 'required|email|max:100',
                'sc_province'   => 'required|string|max:50',
                'sc_city'       => 'required|string|max:50',
                'sc_barangay'   => 'required|string|max:50',
                'sc_purok'       => 'required|string|max:50',
                'relationship'  => 'required|string',

                // Agriculture / Purpose
                'sector'     => 'nullable|integer',
                'purpose' => 'nullable|string|max:255',
                'other_purpose' => 'nullable|string|max:100',
                'farm_location' => 'nullable|string|max:100',
                'land_size'     => 'nullable|string|max:50',
                'water_source'  => 'nullable|string|max:50',
                'grant_id'    => 'required|exists:grants,id',

                'documents' => 'required|array',
                'documents.*' => 'required|file|mimes:pdf,jpg,jpeg,png,docx|max:5120',
                'requirement_ids' => 'nullable|array',
                'requirement_ids.*' => 'nullable|integer|exists:grant_requirements,id',
            ]);

            $member = User::findOrFail($id);
            $grant  = Grant::with('requirements')->findOrFail($request->grant_id);

            //Check if member already applied for this grant
            $existingApplication = Application::where('user_id', $member->id)
                ->where('grant_id', $grant->id)
                ->where('application_type', 'grant_request')
                ->exists();

            if ($existingApplication) {
                return redirect()->back()->with('error', 'This member already has an existing application for this grant.');
            }

            // Update primary info
            $member->update([
                'name' => $request->fname . ' ' . ($request->mname ?? '') . ' ' . $request->lname,
                'first_name' => $request->fname,
                'middle_name' => $request->mname,
                'last_name' => $request->lname,
                'suffix' => $request->suffix,
                'email' => $request->email,
                'phone_number' => $request->phone,
            ]);

            //Update or create related user_info
            $member->user_info()->updateOrCreate(
                ['user_id' => $member->id],
                [
                    'sector_id'     => $request->sector,
                    'fname'         => $request->fname,
                    'mname'         => $request->mname,
                    'lname'         => $request->lname,
                    'suffix'        => $request->suffix,
                    'birthdate'     => $request->birthdate,
                    'civil_status' => $request->civil_status,
                    'gender'        => $request->sex,
                    'contact_no'    => $request->phone,
                    'province'      => $request->province,
                    'city'          => $request->city,
                    'barangay'      => $request->barangay,
                    'zone'          => $request->purok,
                    'farm_location' => $request->farm_location,
                    'land_size'     => $request->land_size,
                    'water_source'  => $request->water_source,

                    // Secondary contact
                    'sc_fname'      => $request->sc_fname,
                    'sc_mname'      => $request->sc_mname,
                    'sc_lname'      => $request->sc_lname,
                    'sc_suffix'     => $request->sc_suffix,
                    'sc_gender'     => $request->sc_sex,
                    'sc_contact_no' => $request->sc_phone,
                    'sc_email'      => $request->sc_email,
                    'sc_province'   => $request->sc_province,
                    'sc_city'       => $request->sc_city,
                    'sc_barangay'   => $request->sc_barangay,
                    'sc_zone'       => $request->sc_purok,
                    'relationship'  => $request->relationship,
                ]
            );


            // Create a membership application record
            $application = Application::create([
            'user_id'          => $member->id,
                'grant_id'         => $grant->id,
                'status_id'        => 32, // pending
                'application_type' => 'grant_request',
                'purpose'          => $request->purpose,
            ]);

            //Handle file uploads and auto checked documents once its uploaded
            if ($request->hasFile('documents')) {
                $documentChecker = new DocumentChecker();
                foreach ($request->file('documents') as $grantRequirementId  => $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('application/grants', $filename, 'public');

                    $document = $application->documents()->create([
                        'file_name' => $filename,
                        'file_path' => $path,
                        'grant_requirement_id' => $grantRequirementId ,
                    ]);

                    //Run DocumentChecker
                   $requirementName = $grant->grant_requirements->find($grantRequirementId)?->requirement?->requirement_name;

                    if ($requirementName) {
                        $checkResult = $documentChecker->verifyDocumentBelongsToUser(
                            storage_path('app/public/' . $path),
                            $requirementName,
                            $application->user // The user name of the applicant
                        );

                        $document->update([
                            'check_result' => $checkResult
                        ]);
                    }
                }
            }

            //create pdf file of the form application
            $application->load(['documents', 'status', 'user.user_info']);
            $pdf = Pdf::loadView('pdf.membership_application_form', ['application' => $application]);

            $fileName = $request->lname . '_grant_request_application_form_' . $application->id . '.pdf';
            $filePath = 'applications/' . $fileName;

            Storage::disk('public')->put($filePath, $pdf->output());
            $application->update(['form_img' => $filePath]);

            //store a confirmation message to table
            Notification::create([ 
                'user_id' => Auth::id(),
                'message' => 'You successfully assisted '.$member->name .' application for grant' .$grant->title . 'and waiting for approval.' ,
                'sent_at' => now(),
            ]);

            /*send sms of the application
            if ($member && $member->phone_number) {
                
                $number = $member->phone_number;
                $message = '[SWISA-AGAP] Your application for grant' .$grant->title . 'is created and pending for approval.';

                SMSService::send($number, $message);
            }*/

            return redirect()->back()->with('success', 'Grant application success!.');
        }catch (\Exception $error) {
            Log::error('Grant Application Error: ' . $error->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while submitting your grant application.');
        }
    }
    
}
