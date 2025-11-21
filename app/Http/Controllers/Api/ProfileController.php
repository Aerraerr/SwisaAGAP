<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show the authenticated user's profile information.
     */
    public function show(Request $request)
    {
        $user = $request->user();
        
        // ✅ Load relationships
        $user->load(['userInfo', 'creditScore']);
        
        return response()->json([
            'success' => true,
            'user' => [
                'id' => $user->id,
                'email' => $user->email,
                'phone_number' => $user->phone_number, // ✅ ADD THIS LINE
                'role_id' => $user->role_id,
                
                // Basic info from users table
                'first_name' => $user->first_name,
                'middle_name' => $user->middle_name,
                'last_name' => $user->last_name,
                'suffix' => $user->suffix,
                
                // ✅ COMPLETE user_info with ALL fields
                'user_info' => $user->userInfo ? [
                    'id' => $user->userInfo->id,
                    'user_id' => $user->userInfo->user_id,
                    'fname' => $user->userInfo->fname,
                    'mname' => $user->userInfo->mname,
                    'lname' => $user->userInfo->lname,
                    'name' => $user->userInfo->name,
                    'suffix' => $user->userInfo->suffix,
                    'birthdate' => $user->userInfo->birthdate,
                    'civil_status' => $user->userInfo->civil_status,
                    'gender' => $user->userInfo->gender,
                    
                    // ✅ NEW: Contact fields
                    'contact_info' => $user->userInfo->contact_info,
                    'phone_no' => $user->userInfo->phone_no,
                    'email' => $user->userInfo->email,
                    
                    'province' => $user->userInfo->province,
                    'city' => $user->userInfo->city,
                    'house_no' => $user->userInfo->house_no,
                    'barangay' => $user->userInfo->barangay,
                    'zone' => $user->userInfo->zone,
                    'profile_img' => $user->userInfo->profile_img,
                    'qr_code' => $user->userInfo->qr_code,
                    'farmer_type' => $user->userInfo->farmer_type,
                    'farm_location' => $user->userInfo->farm_location,
                    'land_size' => $user->userInfo->land_size,
                    'water_source' => $user->userInfo->water_source,
                    
                    // Secondary Contact fields
                    'sc_fname' => $user->userInfo->sc_fname,
                    'sc_mname' => $user->userInfo->sc_mname,
                    'sc_lname' => $user->userInfo->sc_lname,
                    'sc_suffix' => $user->userInfo->sc_suffix,
                    'sc_gender' => $user->userInfo->sc_gender,
                    
                    // ✅ NEW: Secondary contact fields
                    'sc_contact_info' => $user->userInfo->sc_contact_info,
                    'sc_phone_no' => $user->userInfo->sc_phone_no,
                    'sc_email' => $user->userInfo->sc_email,
                    
                    'sc_province' => $user->userInfo->sc_province,
                    'sc_city' => $user->userInfo->sc_city,
                    'sc_house_no' => $user->userInfo->sc_house_no,
                    'sc_barangay' => $user->userInfo->sc_barangay,
                    'sc_zone' => $user->userInfo->sc_zone,
                    'relationship' => $user->userInfo->relationship,
                    
                    'created_at' => $user->userInfo->created_at,
                    'updated_at' => $user->userInfo->updated_at,
                ] : null,
                
                // ✅ Credit score
                'credit_score' => $user->creditScore ? [
                    'id' => $user->creditScore->id,
                    'score' => $user->creditScore->score,
                    'created_at' => $user->creditScore->created_at,
                    'updated_at' => $user->creditScore->updated_at,
                ] : null,
            ]
        ]);
    }

    /**
     * Update the user's profile picture.
     */
    public function updatePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $user = $request->user();

        if (!$user->userInfo) {
            return response()->json([
                'success' => false,
                'message' => 'Only members can upload a profile picture.'
            ], 403);
        }

        try {
            if ($user->userInfo->profile_img && Storage::disk('public')->exists($user->userInfo->profile_img)) {
                Storage::disk('public')->delete($user->userInfo->profile_img);
            }

            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->userInfo->update(['profile_img' => $path]);

            return response()->json([
                'success' => true,
                'message' => 'Profile picture updated successfully.',
                'path' => $path,
                'url' => Storage::url($path),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Upload failed: ' . $e->getMessage(),
            ], 500);
        }
    }
}
