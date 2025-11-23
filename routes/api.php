<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DocumentController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\MembershipController;
use App\Http\Controllers\Api\CreditScoreController;
use App\Http\Controllers\Api\GrantController;
use App\Http\Controllers\Api\GrantApplicationController;
use App\Http\Controllers\Api\OtpController;
use App\Http\Controllers\Api\SectorController;
use App\Http\Controllers\Api\SettingsController; 
use App\Http\Controllers\Api\ApplicationController;
use App\Http\Controllers\Api\GrantTypeController;
use App\Http\Controllers\Api\PhoneOtpController;

// ============================================
// PUBLIC ROUTES (No Authentication Required)
// ============================================

// Authentication
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Public Data
Route::get('/sectors', [SectorController::class, 'index']);
Route::get('/grant-types', [GrantTypeController::class, 'index']);

// ============================================
// OTP ROUTES (PUBLIC)
// ============================================

// Email OTP
Route::prefix('otp')->group(function () {
    Route::post('/send', [OtpController::class, 'sendOtp']);
    Route::post('/verify', [OtpController::class, 'verifyOtp']);
});

// Phone/SMS OTP
Route::prefix('phone/otp')->group(function () {
    Route::post('/send', [PhoneOtpController::class, 'sendOtp']);
    Route::post('/verify', [PhoneOtpController::class, 'verifyOtp']);
    Route::post('/resend', [PhoneOtpController::class, 'resendOtp']);
    Route::post('/check', [PhoneOtpController::class, 'checkVerification']);
});

// ============================================
// PROTECTED ROUTES (Authentication Required)
// ============================================

Route::middleware('auth:sanctum')->group(function() {
    
    // ============================================
    // AUTHENTICATION
    // ============================================
    Route::post('/logout', [AuthController::class, 'logout']);

    // ============================================
    // PROFILE
    // ============================================
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'show']);
        Route::post('/picture', [ProfileController::class, 'updatePicture']);
    });

    // ============================================
    // MEMBERSHIP
    // ============================================
    // User: Submit membership application
    Route::post('/membership-application', [MembershipController::class, 'store']);
    
    // Admin: Approve/Reject membership applications
    Route::prefix('membership-applications')->group(function () {
        Route::post('/{id}/approve', [MembershipController::class, 'approveMembership']);
        Route::post('/{id}/reject', [MembershipController::class, 'rejectMembership']);
    });
    
    // ============================================
    // CREDIT SCORE
    // ============================================
    Route::get('/credit-score', [CreditScoreController::class, 'show']);

    // ============================================
    // GRANTS
    // ============================================
    Route::get('/grants', [GrantController::class, 'index']);
    Route::get('/grant-settings', [SettingsController::class, 'getGrantSettings']);

    // ============================================
    // GRANT APPLICATIONS
    // ============================================
    // ⚠️ IMPORTANT: Specific routes MUST come before generic {id} routes
    
    // Action routes (specific)
    Route::post('/grant-applications/{id}/approve', [GrantApplicationController::class, 'approve']);
    Route::post('/grant-applications/{id}/reject', [GrantApplicationController::class, 'reject']);
    Route::post('/grant-applications/{id}/complete', [GrantApplicationController::class, 'complete']);
    
    // Single resource route
    Route::get('/grant-applications/{id}', [GrantApplicationController::class, 'getClaimDetails']);
    
    // Collection routes
    Route::get('/grant-applications', [GrantApplicationController::class, 'index']);
    Route::post('/grant-applications', [GrantApplicationController::class, 'store']);

    // ============================================
    // APPLICATIONS (NEW - Includes Grants + Membership)
    // ============================================
    // ✅ Get all user applications (grants + membership)
    Route::get('/applications', [ApplicationController::class, 'getMyApplications']);
    
    // ✅ Get single application details
    Route::get('/applications/{id}', [ApplicationController::class, 'show']);
    
    // ✅ Claim approved grant
    Route::post('/applications/{id}/claim', [ApplicationController::class, 'claimGrant']);
    
    // ✅ Resubmit documents for on-hold application
    Route::post('/applications/{id}/resubmit', [ApplicationController::class, 'resubmit']);
    
    // ✅ Submit contribution after claiming
    Route::post('/applications/{id}/contribute', [ApplicationController::class, 'contribute']);
    
    // ✅ Get contributions for specific application
    Route::get('/applications/{id}/contributions', [ApplicationController::class, 'getContributions']);

    // ============================================
    // CONTRIBUTIONS (Global)
    // ============================================
    // ✅ Get all user contributions (across all applications)
    Route::get('/contributions', [ApplicationController::class, 'getAllContributions']);

    // ============================================
    // DOCUMENT MANAGEMENT
    // ============================================
    Route::prefix('documents')->group(function () {
        Route::post('/upload', [DocumentController::class, 'upload']);
        Route::get('/{id}', [DocumentController::class, 'show']);
        Route::get('/{id}/download', [DocumentController::class, 'download']);
        Route::delete('/{id}', [DocumentController::class, 'destroy']);
    });
});

// ============================================
// DEBUG ROUTES (Remove in Production)
// ============================================
if (config('app.debug')) {
    Route::get('/check-php-config', function () {
        return response()->json([
            'upload_max_filesize' => ini_get('upload_max_filesize'),
            'post_max_size' => ini_get('post_max_size'),
            'memory_limit' => ini_get('memory_limit'),
            'max_execution_time' => ini_get('max_execution_time'),
            'php_version' => PHP_VERSION,
            'laravel_version' => app()->version(),
        ]);
    });
    
    Route::get('/test-sms', function () {
        $result = \App\Services\SMSService::send('09171234567', 'Test message from SwisaAGAP');
        return response()->json($result);
    });
    
    // ✅ NEW: Test applications endpoint
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
    })->middleware('auth:sanctum');
}
