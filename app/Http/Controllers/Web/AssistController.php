<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Document;
use App\Models\Grant;
use App\Models\MembershipRequirement;
use App\Models\Requirement;
use App\Models\Sector;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Services\DocumentChecker;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AssistController extends Controller
{

    public function displayMembers(){
        //get only the user who are members and its relations
        $members = User::with(['documents', 'documents.requirement', 'user_info', 'applications.grant'])->where('role_id', 1)->paginate(10);
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
            // Split name (your existing logic)
            $parts = explode(' ', $member->name);
            $member->first_name = $parts[0] ?? '';
            $member->middle_name = $parts[1] ?? '';
            $member->last_name = isset($parts[2]) ? implode(' ', array_slice($parts, 2)) : '';
        }

        return view('swisa-support_staff.assisted-creation', compact('members', 'sectors', 'grants', 'membershipRequirements'));
    }

    //assist create account
    public function assistRegisterAccount(Request $request){

        try{
            //validate inputs
            $request->validate([
                'name'     => 'required|string|max:50',
                'email' => 'required|string|lowercase|email|max:50|unique:users,email',
                'password' => 'required|confirmed',
            ]);

            // Create user using same Breeze logic
            User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role_id'  => 1, //  created by staff is a member role
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
                'email' => $request->email,
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

            // Handle file uploads
            if ($request->hasFile('documents')) {
                foreach ($request->file('documents') as $requirementId => $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('application/membership', $filename, 'public');

                    $application->documents()->create([
                        'file_name'                 => $filename,
                        'file_path'                 => $path,
                        'membership_requirement_id' => $requirementId,
                    ]);
                }
            }

            $application->load(['documents', 'status', 'user.user_info']);
            $pdf = Pdf::loadView('pdf.membership_application_form', ['application' => $application]);

            $fileName = $request->lname . '_membership_application_form_' . $application->id . '.pdf';
            $filePath = 'applications/' . $fileName;

            Storage::disk('public')->put($filePath, $pdf->output());
            $application->update(['form_img' => $filePath]);

            return redirect()->back()->with('success', 'Membership application successfully updated.');
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

            // Update primary info
            $member->update([
                'name' => $request->fname . ' ' . ($request->mname ?? '') . ' ' . $request->lname,
                'email' => $request->email,
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

            //Handle file uploads
            if ($request->hasFile('documents')) {
                foreach ($request->file('documents') as $grantRequirementId  => $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('application/grants', $filename, 'public');

                    $application->documents()->create([
                        'file_name' => $filename,
                        'file_path' => $path,
                        'grant_requirement_id' => $grantRequirementId ,
                    ]);
                }
            }

            $application->load(['documents', 'status', 'user.user_info']);
            $pdf = Pdf::loadView('pdf.membership_application_form', ['application' => $application]);

            $fileName = $request->lname . '_grant_request_application_form_' . $application->id . '.pdf';
            $filePath = 'applications/' . $fileName;

            Storage::disk('public')->put($filePath, $pdf->output());
            $application->update(['form_img' => $filePath]);

            return redirect()->back()->with('success', 'Grant application success!.');
        }catch (\Exception $error) {
            Log::error('Grant Application Error: ' . $error->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while submitting your grant application.');
        }
    }
    
}
