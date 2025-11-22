<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserInfo;
use App\Models\Application;
use App\Models\Document;
use Illuminate\Support\Str;
use App\Models\CreditScore;
use App\Models\CreditScoreHistory;

class MembershipController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'farmer_type' => 'required|string|max:255',
            'fname' => 'required|string',
            'mname' => 'nullable|string',
            'lname' => 'required|string',
            'suffix' => 'nullable|string',
            'birthdate' => 'required|date',
            'civil_status' => 'nullable|string',
            'gender' => 'required|string',
            'contact_info' => 'required|string', // ✅ Changed from contact_no
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
            'sc_contact_info' => 'nullable|string', // ✅ Changed from sc_phone/sc_email
            'sc_province' => 'nullable|string',
            'sc_city' => 'nullable|string',
            'sc_house_no' => 'nullable|string',
            'sc_barangay' => 'nullable|string',
            'sc_zone' => 'nullable|string',
            'sector_id' => 'required|integer',
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

        // ✅ Auto-detect primary contact (phone or email)
        $primaryContact = $validatedData['contact_info'];
        $contactPhone = null;
        $contactEmail = null;
        
        if ($this->isEmail($primaryContact)) {
            $contactEmail = $primaryContact;
        } else {
            $contactPhone = $primaryContact;
        }
        
        // ✅ Auto-detect secondary contact (phone or email)
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

        // ✅ Create UserInfo with smart detection
        $userInfo = UserInfo::create([
            'user_id' => $user->id,
            'farmer_type' => $validatedData['farmer_type'],
            'fname' => $validatedData['fname'],
            'mname' => $validatedData['mname'],
            'lname' => $validatedData['lname'],
            'name' => $validatedData['fname'] . ' ' . $validatedData['lname'],
            'suffix' => $validatedData['suffix'],
            'birthdate' => $validatedData['birthdate'],
            'civil_status' => $validatedData['civil_status'],
            'gender' => $validatedData['gender'],
            
            // ✅ Store contact in both formats
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
            
            // ✅ Store secondary contact in both formats
            'sc_contact_info' => $secondaryContact,
            'sc_phone_no' => $scPhone,
            'sc_email' => $scEmail,
            
            'sc_province' => $validatedData['sc_province'],
            'sc_city' => $validatedData['sc_city'],
            'sc_house_no' => $validatedData['sc_house_no'],
            'sc_barangay' => $validatedData['sc_barangay'],
            'sc_zone' => $validatedData['sc_zone'],
            'relationship' => $validatedData['relationship'],

            'sector_id' => $validatedData['sector_id'],
        ]);

        // ✅ Create Application record for membership
        $application = Application::create([
            'user_id' => $user->id,
            'grant_id' => null,
            'status_id' => 3, // 3 ang pending
            'application_type' => 'Membership',
            'purpose' => 'Membership Application',
        ]);

        // ✅ Store Valid ID document
        if ($request->hasFile('valid_id')) {
            $file = $request->file('valid_id');
            $path = $file->store('membership_documents', 'public');
            
            Document::create([
                'grant_requirement_id' => null,
                'status_id' => 4,
                'file_path' => $path,
                'file_name' => $file->getClientOriginalName(),
                'documentable_type' => 'App\Models\Application',
                'documentable_id' => $application->id,
            ]);
        }

        // Generate QR code
        $userInfo->qr_code = Str::uuid()->toString();
        $userInfo->save();

        // Assign initial credit score
        $user->creditScore()->create([
            'score' => 20,
        ]);

        // Create credit history
        $user->creditScoreHistory()->create([
            'activity' => 'Membership Approved',
            'points' => 20
        ]);

        // Change user role to member
        $user->update(['role_id' => 2]);

        return response()->json([
            'success' => true,
            'message' => 'Membership application submitted successfully!',
            'user_info' => $userInfo,
            'application' => $application
        ], 201);
    }
    
    // ✅ Helper method to detect if input is email
    private function isEmail($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }
}
