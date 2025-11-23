<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // ✅ UPDATED: Added password strength validation
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:10',
            'email' => 'nullable|string|email|max:255|unique:users',
            'phone_number' => 'nullable|string|max:15|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/[a-z]/',      // Must contain lowercase
                'regex:/[A-Z]/',      // Must contain uppercase
                'regex:/[0-9]/',      // Must contain number
            ],
            'mpin' => 'required|string|size:4|regex:/^[0-9]{4}$/', // Must be 4 digits
            'login_method' => 'nullable|string|in:email,phone', // Optional field
        ], [
            // Custom error messages
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, and one number.',
            'password.min' => 'Password must be at least 8 characters.',
            'mpin.size' => 'MPIN must be exactly 4 digits.',
            'mpin.regex' => 'MPIN must contain only numbers.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // ✅ Validate: Must have either email OR phone
        if (!$request->email && !$request->phone_number) {
            return response()->json([
                'success' => false,
                'message' => 'Either email or phone number is required'
            ], 422);
        }

        try {
            // ✅ Determine login method if not provided
            $loginMethod = $request->login_method ?? ($request->email ? 'email' : 'phone');

            // ✅ Create user with ALL fields
            $user = User::create([
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'suffix' => $request->suffix ?? 'N/A',
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password' => Hash::make($request->password),
                'mpin' => Hash::make($request->mpin),
                'login_method' => $loginMethod,
                'email_verified_at' => $request->email ? now() : null,
                'phone_verified_at' => $request->phone_number ? now() : null,
            ]);

            // Generate token
            $token = $user->createToken('SwisaAGAP')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Registration successful',
                'token' => $token,
                'user' => [
                    'id' => $user->id,
                    'first_name' => $user->first_name,
                    'middle_name' => $user->middle_name,
                    'last_name' => $user->last_name,
                    'suffix' => $user->suffix,
                    'email' => $user->email,
                    'phone_number' => $user->phone_number,
                    'login_method' => $user->login_method,
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Registration failed: ' . $e->getMessage()
            ], 500);
        }
    }

    // ✅ UPDATED: Login with email OR phone number
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identifier' => 'required', // Can be email or phone
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // ✅ Auto-detect if email or phone
        $field = filter_var($request->identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_number';
        
        $user = User::where($field, $request->identifier)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        // ✅ Generate token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'middle_name' => $user->middle_name,
                'last_name' => $user->last_name,
                'suffix' => $user->suffix,
                'email' => $user->email,
                'phone_number' => $user->phone_number,
                'login_method' => $user->login_method,
            ]
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully'
        ]);
    }

    // ✅ NEW: Verify MPIN
    public function verifyMpin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mpin' => 'required|string|size:4',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();

        if (!Hash::check($request->mpin, $user->mpin)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid MPIN'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'message' => 'MPIN verified successfully'
        ]);
    }

    // ✅ NEW: Change Password
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'new_password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'different:current_password', // New password must be different
            ],
        ], [
            'new_password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, and one number.',
            'new_password.min' => 'Password must be at least 8 characters.',
            'new_password.different' => 'New password must be different from current password.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();

        // Verify current password
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Current password is incorrect'
            ], 401);
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        // ✅ Revoke all other tokens (logout other devices)
        $user->tokens()->where('id', '!=', $request->user()->currentAccessToken()->id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Password changed successfully. Other devices have been logged out.'
        ]);
    }
}
