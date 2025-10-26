<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    // --- 1. REGISTER: Creates user in DB with hashed password ---
    public function register(Request $request)
    {
        // Validation should cover all fields collected in Step 1, plus the future fields.
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => [
            'required',
            'string',
            'min:8',              // Minimum 8 characters
            'confirmed',          // Must match password_confirmation
            'regex:/[a-z]/',      // Must contain lowercase
            'regex:/[A-Z]/',      // Must contain uppercase
            'regex:/[0-9]/',      // Must contain number
        ],
            
            // These fields are validated as nullable, so we safely use them below.
            'middle_name' => 'nullable|string|max:255',
            'suffix' => 'nullable|string|max:10',
            'phone_number' => 'nullable|string|max:20|unique:users,phone_number',
            'mpin' => 'nullable|digits:6',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'middle_name' => $request->middle_name,
            'suffix' => $request->suffix,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            
            // FIX: Use request()->input() helper for nullable fields, 
            // ensuring we grab the value if it exists, otherwise it defaults to null.
            // MPIN should also be hashed if it is present.
            'phone_number' => $request->input('phone_number'), 
            'mpin' => $request->mpin ? Hash::make($request->mpin) : null,
        ]);

        return response()->json([
            'message' => 'Registration successful.',
            'user' => $user,
        ], 201);
    }
    
    // --- 2. LOGIN: Authenticates user and generates Sanctum token ---
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'device_name' => 'required|string', // Sanctum requirement
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid email or password.'], 401);
        }

        $user = Auth::user();

        // Generates the plainTextToken
        $token = $user->createToken($request->device_name)->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }
    
    // --- 3. LOGOUT ---
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Successfully logged out']);
    }

    // Change Password
   public function changePassword(Request $request)
{
    // RATE LIMITING: Check if user exceeded attempts
    $key = 'change-password:' . $request->user()->id;
    
    if (RateLimiter::tooManyAttempts($key, 5)) {
        $seconds = RateLimiter::availableIn($key);
        return response()->json([
            'message' => "Too many password change attempts. Please try again in {$seconds} seconds.",
        ], 429);
    }

    // Validate incoming request
    $request->validate([
        'current_password' => 'required|string',
        'new_password' => [
        'required',
        'string',
        'min:8',
        'confirmed',
        'regex:/[a-z]/',      // Must contain lowercase
        'regex:/[A-Z]/',      // Must contain uppercase
        'regex:/[0-9]/',      // Must contain number
         ],
    ]);


    $user = $request->user();

    if (!$user) {
        return response()->json([
            'message' => 'User not authenticated.'
        ], 401);
    }

    //  INCREMENT RATE LIMIT ON FAILED ATTEMPT
    // Verify current password matches
    if (!Hash::check($request->current_password, $user->password)) {
        RateLimiter::hit($key, 60); // Block for 60 seconds after 5 failed attempts
        
        return response()->json([
            'message' => 'current password incorrect.',
            'errors' => [
                'current_password' => ['current password incorrect.']
            ]
        ], 422);
    }

    // Prevent using the same password
    if (Hash::check($request->new_password, $user->password)) {
        return response()->json([
            'message' => 'New password must be different from current password.',
            'errors' => [
                'new_password' => ['New password must be different from current password.']
            ]
        ], 422);
    }

    // Update password
    $user->password = Hash::make($request->new_password);
    $user->save();

    // Revoke ALL tokens EXCEPT the current one
    $user->tokens()
        ->where('id', '!=', $request->user()->currentAccessToken()->id)
        ->delete();

    // CLEAR RATE LIMIT ON SUCCESS
    RateLimiter::clear($key);

    return response()->json([
        'message' => 'Password changed successfully. Please log in again.',
        'force_logout' => true,
    ], 200);
  }
}
