<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\mobile\AuthController; 
use Illuminate\Http\Request;
use Illuminate\Routing\Router;

// Public routes
Route::prefix('mobile')->group(function (Router $router) { // Use Router $router for clarity

    // PUBLIC AUTH ROUTES
    $router->post('/register', [AuthController::class, 'register']);
    $router->post('/login', [AuthController::class, 'login']);

    // PROTECTED ROUTES (Requires Sanctum token)
    $router->middleware('auth:sanctum')->group(function () use ($router) {
        
        // Test route to get the authenticated user
        $router->get('/user', function (Request $request) {
            return $request->user();
        });
        
        $router->post('/logout', [AuthController::class, 'logout']);

        $router->post('/change-password', [AuthController::class, 'changePassword']);
    });
}
);

use App\Http\Controllers\mobile\AnnouncementController;
use App\Http\Controllers\mobile\TrainingsController;

Route::middleware('auth:sanctum')->get('/announcements', [AnnouncementController::class, 'index']);

Route::prefix('mobile')->middleware('auth:sanctum')->group(function () {
    Route::get('/trainings', [TrainingsController::class, 'index']);
    Route::get('/myevents', [TrainingsController::class, 'myEvents']);
    Route::post('/trainings/{trainingId}/attend', [TrainingsController::class, 'attend']);
    Route::get('/trainings/{trainingId}', [TrainingsController::class, 'show']);
    Route::delete('/trainings/{trainingId}/cancel', [TrainingsController::class, 'cancelAttendance']);
});

use App\Http\Controllers\mobile\MemberFaqsController;

Route::get('/member/faqs', [MemberFaqsController::class, 'index']);

use App\Http\Controllers\mobile\NotificationController;

Route::middleware('auth:sanctum')->prefix('notifications')->group(function () {
    Route::get('/', [NotificationController::class, 'index']);
    Route::patch('/{id}/read', [NotificationController::class, 'markAsRead']);
    Route::get('/unread', [NotificationController::class, 'hasUnread']);
    Route::patch('/{id}/unread', [NotificationController::class, 'markAsUnread']);
    Route::delete('/{id}', [NotificationController::class, 'destroy']);
});





