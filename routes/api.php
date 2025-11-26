<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\mobile\DocumentController;
use App\Http\Controllers\mobile\AuthController;
use App\Http\Controllers\mobile\ProfileController;
use App\Http\Controllers\mobile\MembershipController;
use App\Http\Controllers\mobile\CreditScoreController;
use App\Http\Controllers\mobile\GrantController;
use App\Http\Controllers\mobile\GrantApplicationController;
use App\Http\Controllers\mobile\OtpController;
use App\Http\Controllers\mobile\SectorController;
use App\Http\Controllers\mobile\SettingsController; 
use App\Http\Controllers\mobile\ApplicationController;
use App\Http\Controllers\mobile\GrantTypeController;
use App\Http\Controllers\mobile\PhoneOtpController;
use App\Http\Controllers\mobile\FeedbackController; // <-- ADD THIS

// ============================================
// PUBLIC ROUTES (No Authentication Required)
// ============================================

// Feedback Routes: public, no authentication required
Route::post('/feedback', [FeedbackController::class, 'store']);
Route::get('/feedback', [FeedbackController::class, 'index']); // (optional, for admin/analytics)

// Authentication
Route::post('/register', [AuthController::class, 'register']); // Register new user account
Route::post('/login', [AuthController::class, 'login']); // User login (returns auth token)

// Public Data - Available to all users
Route::get('/sectors', [SectorController::class, 'index']); // Get list of all sectors (agriculture, fishery, etc.)
Route::get('/grant-types', [GrantTypeController::class, 'index']); // Get list of grant types (cash, rice, etc.)

// ============================================
// OTP ROUTES (PUBLIC)
// ============================================

// Email OTP - For email verification
Route::prefix('otp')->group(function () {
    Route::post('/send', [OtpController::class, 'sendOtp']); // Send OTP to user's email
    Route::post('/verify', [OtpController::class, 'verifyOtp']); // Verify email OTP code
});

// Phone/SMS OTP - For phone number verification
Route::prefix('phone/otp')->group(function () {
    Route::post('/send', [PhoneOtpController::class, 'sendOtp']); // Send SMS OTP to phone
    Route::post('/verify', [PhoneOtpController::class, 'verifyOtp']); // Verify SMS OTP code
    Route::post('/resend', [PhoneOtpController::class, 'resendOtp']); // Resend OTP if expired
    Route::post('/check', [PhoneOtpController::class, 'checkVerification']); // Check if phone is verified
});

// ============================================
// PROTECTED ROUTES (Authentication Required)
// ============================================

Route::middleware('auth:sanctum')->group(function() {
    
    // ============================================
    // AUTHENTICATION
    // ============================================
    Route::post('/logout', [AuthController::class, 'logout']); // User logout (invalidate token)

    // ============================================
    // PROFILE MANAGEMENT
    // ============================================
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'show']); // Get current user profile data
        Route::post('/picture', [ProfileController::class, 'updatePicture']); // Update profile picture
    });

    // ============================================
    // MEMBERSHIP APPLICATION
    // ============================================
    // User Routes
    Route::post('/membership-application', [MembershipController::class, 'store']); // Submit new membership application
    
    // Admin Routes - Manage membership applications
    Route::prefix('membership-applications')->group(function () {
        Route::post('/{id}/approve', [MembershipController::class, 'approveMembership']); // Admin: Approve membership
        Route::post('/{id}/reject', [MembershipController::class, 'rejectMembership']); // Admin: Reject membership
    });
    
    // ============================================
    // CREDIT SCORE
    // ============================================
    Route::get('/credit-score', [CreditScoreController::class, 'show']); // Get user's credit score details

    // ============================================
    // GRANTS (Browse Available Grants)
    // ============================================
    Route::get('/grants', [GrantController::class, 'index']); // Get list of all available grants
    Route::get('/grant-settings', [SettingsController::class, 'getGrantSettings']); // Get grant system settings

    // ============================================
    // GRANT APPLICATIONS (Old System - Keep for backward compatibility)
    // ============================================
    // ⚠️ IMPORTANT: Specific routes MUST come before generic {id} routes
    
    // Admin Action Routes (specific endpoints)
    Route::post('/grant-applications/{id}/approve', [GrantApplicationController::class, 'approve']); // Admin: Approve grant application
    Route::post('/grant-applications/{id}/reject', [GrantApplicationController::class, 'reject']); // Admin: Reject grant application
    Route::post('/grant-applications/{id}/complete', [GrantApplicationController::class, 'complete']); // Admin: Mark as complete
    
    // User Routes
    Route::get('/grant-applications/{id}', [ApplicationController::class, 'getGrantApplicationDetails']); // Get claim details (QR code, reference number) for approved grant
    Route::get('/grant-applications', [GrantApplicationController::class, 'index']); // Get all grant applications (for admin)
    Route::post('/grant-applications', [GrantApplicationController::class, 'store']); // Submit new grant application

    // ============================================
    // APPLICATIONS (Unified System - Grants + Membership)
    // ============================================
    // User Application Management
    Route::get('/applications', [ApplicationController::class, 'getMyApplications']); // Get all user applications (grants + membership)
    Route::get('/applications/{id}', [ApplicationController::class, 'show']); // Get single application details with status history
    
    // Grant Workflow Actions
    Route::post('/applications/{id}/claim', [ApplicationController::class, 'claimGrant']); // Claim approved grant (status: approved → claimed)
    Route::post('/applications/{id}/resubmit', [ApplicationController::class, 'resubmit']); // Resubmit documents for on-hold application
    Route::post('/applications/{id}/contribute', [ApplicationController::class, 'contribute']); // Submit contribution after claiming grant
    
    // Contribution Tracking
    Route::get('/applications/{id}/contributions', [ApplicationController::class, 'getContributions']); // Get contributions for specific application

    // ============================================
    // CONTRIBUTIONS (Global)
    // ============================================
    Route::get('/contributions', [ApplicationController::class, 'getAllContributions']); // Get all user contributions across all applications

    // ============================================
    // DOCUMENT MANAGEMENT
    // ============================================
    Route::prefix('documents')->group(function () {
        Route::post('/upload', [DocumentController::class, 'upload']); // Upload document (ID, proof, etc.)
        Route::get('/{id}', [DocumentController::class, 'show']); // View document details
        Route::get('/{id}/download', [DocumentController::class, 'download']); // Download document file
        Route::delete('/{id}', [DocumentController::class, 'destroy']); // Delete document
    });
});

// ============================================
// DEBUG ROUTES (Remove in Production)
// ============================================
if (config('app.debug')) {
    // System Configuration Check
    Route::get('/check-php-config', function () {
        return response()->json([
            'upload_max_filesize' => ini_get('upload_max_filesize'),
            'post_max_size' => ini_get('post_max_size'),
            'memory_limit' => ini_get('memory_limit'),
            'max_execution_time' => ini_get('max_execution_time'),
            'php_version' => PHP_VERSION,
            'laravel_version' => app()->version(),
        ]);
    }); // Test endpoint: Check PHP/Laravel configuration
    
    // SMS Service Testing
    Route::get('/test-sms', function () {
        $result = \App\Services\SMSService::send('09171234567', 'Test message from SwisaAGAP');
        return response()->json($result);
    }); // Test endpoint: Send test SMS message
    
    // Application Testing
    Route::get('/test-applications', function() {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => 'Not authenticated'], 401);
        }
        
        return response()->json([
            'user_id' => $user->id,
            'grant_applications' => $user->applications()->count(),
            'membership_applications' => $user->applications()->whereNull('grant_id')->count(),
            'total_applications' => $user->applications()->count(),
            'applications' => $user->applications()->with('status')->get()->map(function($app) {
                return [
                    'id' => $app->id,
                    'type' => $app->application_type ?? ($app->grant_id ? 'Grant' : 'Membership'),
                    'status' => $app->status->status_name ?? 'unknown',
                    'grant_id' => $app->grant_id,
                ];
            }),
        ]);
    })->middleware('auth:sanctum'); // Test endpoint: Check user's applications and counts
}
