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
    // APPLICATIONS (Alternative Endpoints)
    // ============================================
    Route::prefix('applications')->group(function () {
        // List and single application
        Route::get('/', [GrantApplicationController::class, 'index']);
        Route::get('/{id}', [ApplicationController::class, 'show']);
        
        // Application actions
        Route::post('/{id}/resubmit', [ApplicationController::class, 'resubmit']);
        
        // Contributions
        Route::post('/{applicationId}/contribute', [ApplicationController::class, 'contribute']);
        Route::get('/{applicationId}/contributions', [ApplicationController::class, 'getContributions']);
        Route::post('/{applicationId}/contributions', [ApplicationController::class, 'submitContribution']);
        
        // Documents
        Route::get('/{applicationId}/documents', [DocumentController::class, 'index']);
    });

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
}
