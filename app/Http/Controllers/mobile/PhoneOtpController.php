<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use App\Models\PhoneOtp;
use App\Services\SMSService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\RateLimiter;
use Carbon\Carbon;

class PhoneOtpController extends Controller
{
    /**
     * Send OTP to phone number
     */
    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|string|min:10|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid phone number format',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $phoneNumber = $request->phone_number;

            // Rate limiting: Max 3 OTP requests per phone per hour
            $key = 'send-otp:' . $phoneNumber;
            
            if (RateLimiter::tooManyAttempts($key, 3)) {
                $seconds = RateLimiter::availableIn($key);
                return response()->json([
                    'success' => false,
                    'message' => 'Too many OTP requests. Please try again in ' . ceil($seconds / 60) . ' minutes.',
                    'retry_after' => $seconds
                ], 429);
            }

            // Generate 6-digit OTP
            $otpCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

            // Save to database with 3 minutes expiration ✅
            PhoneOtp::updateOrCreate(
                ['phone_number' => $phoneNumber],
                [
                    'otp' => $otpCode,
                    'expires_at' => Carbon::now()->addMinutes(3), // ✅ 3 minutes
                    'verified' => false,
                    'attempts' => 0,
                ]
            );

            // Send SMS
            $result = SMSService::sendOTP($phoneNumber, $otpCode);

            if ($result['success']) {
                RateLimiter::hit($key, 3600); // 1 hour expiry

                return response()->json([
                    'success' => true,
                    'message' => 'OTP sent successfully to ' . $phoneNumber,
                    'expires_in' => 180, // ✅ 3 minutes = 180 seconds
                    'debug_otp' => config('app.debug') ? $otpCode : null, // Only in debug
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to send OTP. Please try again.',
                'error' => $result['message'] ?? 'SMS service error'
            ], 500);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while sending OTP',
                'error' => config('app.debug') ? $e->getMessage() : 'Server error'
            ], 500);
        }
    }

    /**
     * Verify OTP
     */
    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|string',
            'otp' => 'required|string|size:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid input',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $phoneOtp = PhoneOtp::where('phone_number', $request->phone_number)
                ->where('otp', $request->otp)
                ->first();

            // Check if OTP exists
            if (!$phoneOtp) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid OTP code',
                ], 400);
            }

            // Check if expired
            if ($phoneOtp->isExpired()) {
                return response()->json([
                    'success' => false,
                    'message' => 'OTP has expired. Please request a new one.',
                    'expired' => true
                ], 400);
            }

            // Check if already verified
            if ($phoneOtp->verified) {
                return response()->json([
                    'success' => false,
                    'message' => 'OTP has already been used',
                ], 400);
            }

            // ✅ Check max attempts (3)
            if ($phoneOtp->attempts >= 3) {
                return response()->json([
                    'success' => false,
                    'message' => 'Maximum verification attempts (3) reached. Please request a new OTP.',
                    'max_attempts_reached' => true
                ], 400);
            }

            // Increment attempts BEFORE verifying (to count this attempt)
            $phoneOtp->incrementAttempts();

            // Check if OTP matches (after incrementing attempts)
            if ($phoneOtp->otp !== $request->otp) {
                $remainingAttempts = 3 - $phoneOtp->attempts;
                return response()->json([
                    'success' => false,
                    'message' => "Invalid OTP. {$remainingAttempts} attempts remaining.",
                    'attempts_remaining' => $remainingAttempts
                ], 400);
            }

            // ✅ Verify OTP (mark as verified)
            $phoneOtp->update(['verified' => true]);

            return response()->json([
                'success' => true,
                'message' => 'Phone number verified successfully',
                'phone_number' => $request->phone_number,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Verification failed',
                'error' => config('app.debug') ? $e->getMessage() : 'Server error'
            ], 500);
        }
    }

    /**
     * Resend OTP (with 60-second cooldown)
     */
    public function resendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid phone number',
                'errors' => $validator->errors()
            ], 422);
        }

        // Check last OTP time (60 seconds cooldown)
        $lastOtp = PhoneOtp::where('phone_number', $request->phone_number)
            ->latest()
            ->first();

        if ($lastOtp && Carbon::now()->diffInSeconds($lastOtp->created_at) < 60) {
            $remainingSeconds = 60 - Carbon::now()->diffInSeconds($lastOtp->created_at);
            
            return response()->json([
                'success' => false,
                'message' => "Please wait {$remainingSeconds} seconds before requesting a new OTP",
                'retry_after' => $remainingSeconds
            ], 429);
        }

        return $this->sendOtp($request);
    }

    /**
     * Check if phone number is verified
     */
    public function checkVerification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid phone number',
            ], 422);
        }

        $phoneOtp = PhoneOtp::where('phone_number', $request->phone_number)
            ->where('verified', true)
            ->latest()
            ->first();

        return response()->json([
            'success' => true,
            'phone_number' => $request->phone_number,
            'verified' => $phoneOtp ? true : false,
            'verified_at' => $phoneOtp ? $phoneOtp->updated_at : null,
        ]);
    }
}