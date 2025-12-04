<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Mail;
use App\Services\SMSService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class AuthController extends Controller
{
    // --- 1. REGISTER: Creates user in DB with hashed password ---
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
                'qr_code' => Str::uuid()->toString(), // ✅ Generate QR immediately
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
    
    // --- 2. LOGIN: Authenticates user and generates Sanctum token ---
   public function login(Request $request)
{
    $validator = Validator::make($request->all(), [
        'identifier' => 'required', // Can be email or phone
        'password'   => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors'  => $validator->errors(),
        ], 422);
    }

    // Auto-detect if email or phone
    $field = filter_var($request->identifier, FILTER_VALIDATE_EMAIL)
        ? 'email'
        : 'phone_number';

    $user = User::where($field, $request->identifier)->first();

    // Failed login
    if (!$user || !Hash::check($request->password, $user->password)) {

        if ($user) {
            DB::table('activity_history')->insert([
                'user_id'    => $user->id,
                'type'       => 'Login Failed',
                'message'    => 'Failed login attempt.',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid credentials',
        ], 401);
    }

    // Successful login
    $token = $user->createToken('auth_token')->plainTextToken;

    DB::table('activity_history')->insert([
        'user_id'    => $user->id,
        'type'       => 'Login Success',
        'message'    => 'User logged in via mobile app.',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Login successful',
        'token'   => $token,
        'user'    => [
            'id'           => $user->id,
            'first_name'   => $user->first_name,
            'middle_name'  => $user->middle_name,
            'last_name'    => $user->last_name,
            'suffix'       => $user->suffix,
            'email'        => $user->email,
            'phone_number' => $user->phone_number,
            'login_method' => $user->login_method,
            'role_id'      => $user->role_id,
        ],
    ]);
}

    // --- 3. LOGOUT ---
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully'
        ]);
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

     //  Create activity history entry
    DB::table('activity_history')->insert([
    'user_id'    => $user->id,
    'type'       => 'Change Password', 
    'message'    => "You Changed your password.",
    'created_at' => now(),
    'updated_at' => now(),
    ]);

   if ($user) {
    // Send SMS if phone number exists
    if ($user->phone_number) {
        $number = preg_replace('/^0/', '63', $user->phone_number);
        $smsMessage = "[SWISA-AGAP]\nHello {$user->first_name}, your password was changed successfully on " . now()->toDateTimeString() . ".\nIf you did not request this change, please contact our support immediately.\n\nThank you,\nSwisaAGAP Team";
        SMSService::send($number, $smsMessage);
    }

    // Send email if email exists
    if ($user->email) {
        $emailMessage = "Hello {$user->first_name},\n\nYour password for SwisaAGAP was changed successfully on " . now()->toDateTimeString() . ".\nIf you did not request this change, please contact our support immediately.\n\nThank you,\nSwisaAGAP Team";
        Mail::raw($emailMessage, function ($mail) use ($user) {
            $mail->to($user->email)
                 ->subject('SwisaAGAP - Password Changed')
                 ->replyTo('noreply@yourdomain.com', 'No Reply');
        });
    }
}

    return response()->json([
        'message' => 'Password changed successfully. Please log in again.',
        'force_logout' => true,
    ], 200);
  }

    // API route: POST /api/reset-password
   public function resetPassword(Request $request)
{
    $request->validate([
        'email' => 'nullable|string|email|exists:users,email',
        'phone' => 'nullable|string|exists:users,phone_number',
        'new_password' => [
            'required', 'string', 'min:8', 'confirmed',
            'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/'
        ]
    ]);
    if (!$request->email && !$request->phone) {
        return response()->json([
            'success' => false,
            'message' => 'Either email or phone is required.'
        ], 422);
    }
    $user = null;
    if ($request->email) {
        $user = User::where('email', $request->email)->first();
    } elseif ($request->phone) {
        $user = User::where('phone_number', $request->phone)->first();
    }
    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'User not found.'
        ], 404);
    }

    $user->password = Hash::make($request->new_password);
    $user->save();

    if ($user->email) {
        $message = "Hello {$user->first_name},\n\n";
        $message .= "Your password for SwisaAGAP was changed successfully on " . now()->toDateTimeString() . ".\n";
        $message .= "If you did not request this change, please contact our support immediately.\n\n";
        $message .= "Thank you,\nSwisaAGAP Team";
        Mail::raw($message, function ($mail) use ($user) {
            $mail->to($user->email)
                ->subject('SwisaAGAP - Password Changed')
                ->replyTo('noreply@yourdomain.com', 'No Reply');
        });
    }

    if ($user->phone_number) {
        $number = preg_replace('/^0/', '63', $user->phone_number);
        $smsMessage = "[SWISA-AGAP]\nHello {$user->first_name}, your password was changed successfully on " . now()->toDateTimeString() . ". If this wasn't you, contact support.";
        SMSService::send($number, $smsMessage);
    }

    return response()->json([
        'success' => true,
        'message' => 'Password reset successful.'
    ]);
}

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

}