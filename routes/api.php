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


// ============================================
// PUBLIC ROUTES (No Authentication Required)
// ============================================
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/sectors', [SectorController::class, 'index']);


// ✅ Grant Types (public so filter works before login)
Route::get('/grant-types', [GrantTypeController::class, 'index']);


// ✅ OTP routes (PUBLIC)
Route::post('/otp/send', [OtpController::class, 'sendOtp']);
Route::post('/otp/verify', [OtpController::class, 'verifyOtp']);


// ============================================
// PROTECTED ROUTES (Authentication Required)
// ============================================
Route::middleware('auth:sanctum')->group(function() {
    // Profile
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::post('/profile/picture', [ProfileController::class, 'updatePicture']);


    // Membership
    Route::post('/membership-application', [MembershipController::class, 'store']);
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);


    // Credit Score
    Route::get('/credit-score', [CreditScoreController::class, 'show']);


    // Grants
    Route::get('/grants', [GrantController::class, 'index']);


    // ============================================
    // GRANT APPLICATIONS (Order matters!)
    // ============================================
    
    // ✅ SPECIFIC ROUTES FIRST (before generic routes)
    Route::post('/grant-applications/{id}/approve', [GrantApplicationController::class, 'approve']);
    Route::post('/grant-applications/{id}/reject', [GrantApplicationController::class, 'reject']);
    Route::post('/grant-applications/{id}/complete', [GrantApplicationController::class, 'complete']);
    
    // ✅ Then ID-based routes
    Route::get('/grant-applications/{id}', [GrantApplicationController::class, 'getClaimDetails']); // For claim screen
    
    // ✅ Finally, the general list route
    Route::get('/grant-applications', [GrantApplicationController::class, 'index']); // List all applications
    Route::post('/grant-applications', [GrantApplicationController::class, 'store']); // Create new application


    // ============================================
    // APPLICATION ROUTES (Separate from grant-applications)
    // ============================================
    Route::get('/applications', [GrantApplicationController::class, 'index']); // List all (alternative endpoint)
    Route::get('/applications/{id}', [ApplicationController::class, 'show']); // ✅ Get single application
    Route::post('/applications/{id}/resubmit', [ApplicationController::class, 'resubmit']); // ✅ Resubmit documents
    
    // ✅ NEW: CONTRIBUTIONS (via ApplicationController)
    Route::post('/applications/{applicationId}/contributions', [ApplicationController::class, 'submitContribution']); // Submit contribution


    // Grant Settings
    Route::get('/grant-settings', [SettingsController::class, 'getGrantSettings']);
    
    
    // Contribution
    Route::post('/applications/{applicationId}/contribute', [ApplicationController::class, 'contribute']);
    Route::get('/applications/{applicationId}/contributions', [ApplicationController::class, 'getContributions']);




    // ============================================
    // DOCUMENT MANAGEMENT
    // ============================================
    Route::post('/documents/upload', [DocumentController::class, 'upload']);
    Route::get('/applications/{applicationId}/documents', [DocumentController::class, 'index']);
    Route::get('/documents/{id}', [DocumentController::class, 'show']);
    Route::get('/documents/{id}/download', [DocumentController::class, 'download']);
    Route::delete('/documents/{id}', [DocumentController::class, 'destroy']);
});


// ============================================
// DEBUG ROUTE (Optional - remove in production)
// ============================================
Route::get('/check-php-config', function () {
    $uploadMax = ini_get('upload_max_filesize');
    $postMax = ini_get('post_max_size');
    
    return response()->json([
        'upload_max_filesize' => $uploadMax,
        'post_max_size' => $postMax,
        'message' => 'These are the current settings your server is using.'
    ]);
});
