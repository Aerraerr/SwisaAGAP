<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;

// Controllers
use App\Http\Controllers\mobile\AuthController; 
use App\Http\Controllers\mobile\AnnouncementController;
use App\Http\Controllers\mobile\TrainingsController;
use App\Http\Controllers\mobile\MemberFaqsController;
use App\Http\Controllers\mobile\NotificationController;
use App\Http\Controllers\mobile\CreditScoreController; 
use App\Http\Controllers\mobile\DocumentController;
use App\Http\Controllers\mobile\ProfileController;
use App\Http\Controllers\mobile\MembershipController;
use App\Http\Controllers\Api\SettingsController; 
use App\Http\Controllers\mobile\SectorController;
use App\Http\Controllers\mobile\GrantController;
use App\Http\Controllers\Api\ApplicationController;
use App\Http\Controllers\mobile\GrantApplicationController;
use App\Http\Controllers\mobile\OtpController;
use App\Http\Controllers\mobile\PhoneOtpController;
// Public routes
Route::prefix('mobile')->group(function (Router $router) {
    // PUBLIC AUTH ROUTES
    $router->post('/register', [AuthController::class, 'register']);
    $router->post('/login', [AuthController::class, 'login']);

    

    Route::post('/otp/send', [OtpController::class, 'sendOtp']);
    Route::post('/otp/verify', [OtpController::class, 'verifyOtp']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);

    // PROTECTED ROUTES (Requires Sanctum token)
    $router->middleware('auth:sanctum')->group(function () use ($router) {
        // Test route to get the authenticated user
        $router->get('/user', function (Request $request) {
            return $request->user();
        });        
        $router->post('/logout', [AuthController::class, 'logout']);
        $router->post('/change-password', [AuthController::class, 'changePassword']);

        Route::get('/grants', [GrantController::class, 'index']);
        Route::get('/grant-settings', [SettingsController::class, 'getGrantSettings']);


        // Contributions 
        // Contributions
        Route::post('/{applicationId}/contribute', [ApplicationController::class, 'contribute']);
        Route::get('/{applicationId}/contributions', [ApplicationController::class, 'getContributions']);
        Route::post('/{applicationId}/contributions', [ApplicationController::class, 'submitContribution']);
        
        Route::get('/grant-applications/{id}', [GrantApplicationController::class, 'getClaimDetails']);

        Route::post('/grant-applications', [GrantApplicationController::class, 'store']);
        Route::get('/grant-applications', [GrantApplicationController::class, 'index']);
        Route::get('/grant-applications/{id}', [GrantApplicationController::class, 'show']);
         Route::post('/grant-applications/{id}/approve', [GrantApplicationController::class, 'approve']);
        Route::post('/grant-applications/{id}/reject', [GrantApplicationController::class, 'reject']);
        Route::post('/grant-applications/{id}/complete', [GrantApplicationController::class, 'complete']);

    });
});

// OTP SMS
Route::prefix('phone/otp')->group(function () {
    Route::post('/send', [PhoneOtpController::class, 'sendOtp']);
    Route::post('/verify', [PhoneOtpController::class, 'verifyOtp']);
    Route::post('/resend', [PhoneOtpController::class, 'resendOtp']);
    Route::post('/check', [PhoneOtpController::class, 'checkVerification']);
});

// Member FAQs (public)
Route::get('/member/faqs', [MemberFaqsController::class, 'index']);

// Protected routes requiring authentication
Route::middleware(['auth:sanctum'])->group(function() {

     // Announcements
    Route::get('/announcements', [AnnouncementController::class, 'index']);
    Route::post('/announcements', [AnnouncementController::class, 'store']);

    // Credit Score
      Route::get('/credit-score', [CreditScoreController::class, 'show']);
 
    // Profile
    Route::get('/profile', [ProfileController::class, 'show']);
   
    Route::get('/sectors', [SectorController::class, 'index']);

    // Document Management
    Route::get('/applications/{applicationId}/documents', [DocumentController::class, 'index']);
    Route::get('/documents/{id}', [DocumentController::class, 'show']);
    Route::get('/documents/{id}/download', [DocumentController::class, 'download']);
    Route::delete('/documents/{id}', [DocumentController::class, 'destroy']);
    
    // Grant Applications
    Route::get('/grant-applications', [GrantApplicationController::class, 'index']);
    Route::get('/grant-applications/{id}', [GrantApplicationController::class, 'show']);

     // Notifications
        Route::prefix('notifications')->group(function () {
        Route::get('/', [NotificationController::class, 'index']);
        Route::patch('/{id}/read', [NotificationController::class, 'markAsRead']);
        Route::get('/unread', [NotificationController::class, 'hasUnread']);
        Route::patch('/{id}/unread', [NotificationController::class, 'markAsUnread']);
        Route::delete('/{id}', [NotificationController::class, 'destroy']);
    });

});

    // With rate limit
  $router->middleware('auth:sanctum', 'throttle:10,1')->group(function () use ($router) { 
    // Profile 
     Route::post('/profile/picture', [ProfileController::class, 'updatePicture']);
     // Membership 
    Route::post('/membership-application', [MembershipController::class, 'store']);
    Route::post('/membership-application/{id}/approve', [MembershipController::class, 'approveMembership']);
    Route::post('/membership-application/{id}/reject', [MembershipController::class, 'rejectMembership']);
     // Grant Applications
    Route::post('/grant-applications', [GrantApplicationController::class, 'store']);
       // Document Management
    Route::post('/documents/upload', [DocumentController::class, 'upload']);
  });



// Trainings routes (protected sanctum auth)
Route::prefix('mobile')->middleware('auth:sanctum')->group(function () {
    Route::get('/trainings', [TrainingsController::class, 'index']);
    Route::get('/myevents', [TrainingsController::class, 'myEvents']);
    Route::post('/trainings/{trainingId}/attend', [TrainingsController::class, 'attend']);
    Route::get('/trainings/{trainingId}', [TrainingsController::class, 'show']);
    Route::delete('/trainings/{trainingId}/cancel', [TrainingsController::class, 'cancelAttendance']);
});

// Debug route
Route::get('/check-php-config', function () {
    $uploadMax = ini_get('upload_max_filesize');
    $postMax = ini_get('post_max_size');
    
    return response()->json([
        'upload_max_filesize' => $uploadMax,
        'post_max_size' => $postMax,
        'message' => 'These are the current settings your server is using.'
    ]);
});

//============================================
// FOR CHAT 
//============================================
use App\Http\Controllers\mobile\MobileChatController;

Route::middleware('auth:sanctum')->prefix('mobile/chat')->group(function () {
    // Changed from post /get-or-create to get /get (no creation, just fetch)
    Route::get('/get', [MobileChatController::class, 'getChat']);

    // Keep existing message endpoints
    Route::post('/send', [MobileChatController::class, 'sendMessage']);
    Route::get('/history/{chat_id}', [MobileChatController::class, 'getChatHistory']);
    Route::get('/quick-replies/{role_id}', [MobileChatController::class, 'getQuickReplies']);
    Route::post('/mark-read', [MobileChatController::class, 'markAsRead']);
});
