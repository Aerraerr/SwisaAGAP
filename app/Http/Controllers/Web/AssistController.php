<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Jobs\CheckDocumentRequirements;
use App\Services\DocumentMatcherService;
use App\Models\Application;
use App\Models\Grant;
use App\Models\Sector;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Services\DocumentChecker;
/*foreach ($grants as $grant) {
            foreach ($grant->requirements as $requirement) {
                $matched = false;
                $matchedDocId = null;

                foreach ($member->documents as $doc) {
                    $filePath = storage_path("app/{$doc->file_path}");
                    if (!file_exists($filePath)) continue;

                    $text = $checker->extractText($filePath);

                    // Match requirement name inside doc text
                    if (stripos($text, $requirement->requirement_name) !== false) {
                        $matched = true;
                        $matchedDocId = $doc->id;
                        break;
                    }
                }

                // Attach a virtual property for blade use
                $requirement->member_status = [
                    'status' => $matched ? 'matched' : 'missing',
                    'document_id' => $matchedDocId,
                    'user_id' => $member->id,
                ];
            }
        }*///$checker = new DocumentChecker();
class AssistController extends Controller
{
    //pass the 'members' variable to the assisted page for data display
    public function displayMembers(){
        //get only the user who are members and its relations
        $members = User::with(['documents', 'user_info', 'applications.grant'])->where('role_id', 1)->get();
        $sectors = Sector::all();
        $grants  = Grant::with('requirements')->get();

        foreach ($members as $member) {
            // Split name (your existing logic)
            $parts = explode(' ', $member->name);
            $member->first_name = $parts[0] ?? '';
            $member->middle_name = $parts[1] ?? '';
            $member->last_name = isset($parts[2]) ? implode(' ', array_slice($parts, 2)) : '';
        }

        return view('swisa-support_staff.assisted-creation', compact('members', 'sectors', 'grants'));
    }

    //assist create account
    public function assistRegisterAccount(Request $request){

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
    }
    

    //assist membership application
    public function assistMembershipApplication(Request $request, $id){
        //dd($request->all());
        //validate inputs
        $request->validate([
            // Primary Information
            'fname'       => 'required|string|max:50',
            'mname'       => 'nullable|string|max:50',
            'lname'       => 'required|string|max:50',
            'suffix'      => 'nullable|string|max:10',
            'birthdate'   => 'required|date',
            'civil_status' => 'nullable|string|max:10',
            'sex'      => 'required|string',
            'phone'  => 'required|string|max:20',
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
            'sc_phone' => 'nullable|string|max:20',
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
            
            'documents.*'   => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx|max:50120', // 5MB max
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
            foreach ($request->file('documents') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('application/membership', $filename, 'public');

                $application->documents()->create([
                    'file_name' => $filename,
                    'file_path' => $path,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Membership application successfully updated.');
    }

    //assist grant application
    public function assistGrantApplication(Request $request, $id){
        //dd($request->all());
        //validate inputs
        $request->validate([
            // Primary Information
            'fname'       => 'required|string|max:50',
            'mname'       => 'nullable|string|max:50',
            'lname'       => 'required|string|max:50',
            'suffix'      => 'nullable|string|max:10',
            'birthdate'   => 'required|date',
            'civil_status' => 'nullable|string|max:10',
            'sex'      => 'required|string',
            'phone'  => 'required|string|max:20',
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
            'sc_phone' => 'nullable|string|max:20',
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
            'grant_id'    => 'required|exists:grants,id',
            'documents.*'   => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx|max:50120', // 5MB max
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

        // Handle file uploads
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('application/grants', $filename, 'public');

                // Create document record
                $application->documents()->create([
                    'grant_requirement_id' => null, 
                    'user_id' => $member->id,
                    'status_id' => 32, // pending review
                    'file_name' => $filename,
                    'file_path' => $path,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Grant application success!.');
    }
}
