<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class OtpController extends Controller
{
    /**
     * Send OTP to email
     */
    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Generate 6-digit OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Store OTP in cache for 5 minutes
        $cacheKey = 'otp_' . $request->email;
        Cache::put($cacheKey, $otp, now()->addMinutes(5));

        // Send email OTP
        $this->sendEmailOtp($request->email, $otp);

        return response()->json([
            'success' => true,
            'message' => 'OTP Sent Successfully',
            'otp' => config('app.debug') ? $otp : null, // Only show in debug mode
        ]);
    }

    /**
     * Verify OTP
     */
    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'otp' => 'required|string|size:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $cacheKey = 'otp_' . $request->email;
        $storedOtp = Cache::get($cacheKey);

        if (!$storedOtp) {
            return response()->json([
                'success' => false,
                'message' => 'OTP expired or not found'
            ], 400);
        }

        if ($storedOtp !== $request->otp) {
            return response()->json([
                'success' => false,
                'message' => 'Incorrect OTP'
            ], 400);
        }

        // Delete OTP after successful verification
        Cache::forget($cacheKey);

        return response()->json([
            'success' => true,
            'message' => 'OTP Verified Successfully'
        ]);
    }

    /**
     * Send OTP via Email
     */
    private function sendEmailOtp($email, $otp)
    {
        $message = "Your SwisaAGAP verification code is: $otp\n\nThis code will expire in 5 minutes.\n\nIf you did not request this code, please ignore this email.";
        
        Mail::raw($message, function ($mail) use ($email) {
            $mail->to($email)
                 ->subject('SwisaAGAP - Verification Code');
        });
    }
}
