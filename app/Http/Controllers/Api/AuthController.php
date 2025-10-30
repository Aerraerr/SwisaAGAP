<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // ✅ UPDATED: Added name fields, removed login_method
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:10',
            'email' => 'nullable|string|email|max:255|unique:users',
            'phone_number' => 'nullable|string|max:15|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'mpin' => 'required|string|size:4',
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
                'email_verified_at' => $request->email ? now() : null, // Only if email was verified
            ]);

            // Generate token
            $token = $user->createToken('SwisaAGAP')->plainTextToken;

            return response()->json([
                'success' => true,
                'token' => $token,
                'user' => $user
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

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token
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
}
