<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\AnnouncementController;
use App\Http\Controllers\Web\GrantController;
use App\Http\Controllers\Web\MemberController;
use App\Http\Controllers\Web\TrainingController;
use App\Http\Controllers\Web\FaqController;
use App\Http\Controllers\Web\FaqsController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserManagementController;


Route::get('/', function () {
    return view('auth.landing');
});
Route::get('/landing', function () {
    return view('auth.landing');
});
Route::get('/app-download', function () {
    return view('app-download.download-page');
})->name('app.download');

// SWISA ADMIN: Main pages
// ✅ Fixed: Use the controller method
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


//-----------ADMIN-REPORTS ROUTES----------------
use App\Http\Controllers\ReportFeedbackController;

Route::get('/admin-reports', [ReportFeedbackController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('admin-reports');


//------------MEMBER ROUTES--------------
Route::get('/members', [MemberController::class, 'displayMember'])
    ->middleware(['auth', 'verified'])->name('members');

//for view profile 
Route::get('/view-profile/{id}', [MemberController::class, 'viewProfile'])
    ->middleware(['auth', 'verified'])->name('view-profile');

//-----------GRANT ROUTES-------------
Route::get('/grantsNequipment', [GrantController::class, 'displayGrants'])
    ->middleware(['auth', 'verified'])->name('grantsNequipment');

//for view grant 
Route::get('/view-grant/{id}', [GrantController::class, 'viewGrantDetails'])
    ->middleware(['auth', 'verified'])->name('view-grant');

//for grantcontroller/addgrant
Route::post('/grantsNequipment/add-grant', [GrantController::class, 'addGrant'])
    ->middleware(['auth', 'verified'])->name('grantsNequipment.store');

//add stock to a grant
Route::patch('view-grant/{id}/add-stock', [GrantController::class, 'addGrantStock'])
    ->middleware(['auth', 'verified'])->name('addGrantStock.update');

//edit grant
Route::patch('view-grant/{id}/edit-grant', [GrantController::class, 'editGrantInfo'])
    ->middleware(['auth', 'verified'])->name('editGrantInfo.update');

//delete grant
Route::delete('view-grant/{id}/delete-grant', [GrantController::class, 'deleteGrant'])
    ->middleware(['auth', 'verified'])->name('deleteGrant.delete');

//-------------ANNOUNCEMENT ROUTES------------
Route::get('/announcements', [AnnouncementController::class, 'dispalyAnnouncement'])
    ->middleware(['auth', 'verified'])->name('announcements');

Route::post('/announcements', [AnnouncementController::class, 'addAnnouncement'])
    ->middleware(['auth', 'verified'])->name('announcement.store');

//edit announcement
Route::patch('announcements/{id}/edit-announcement', [AnnouncementController::class, 'editAnnouncementInfo'])
    ->middleware(['auth', 'verified'])->name('announcement.update');

//delete announcement
Route::delete('announcements/{id}/delete-announcement', [AnnouncementController::class, 'deleteAnnouncement'])
    ->middleware(['auth', 'verified'])->name('announcement.delete');

//---------TRAININGS ROUTES------------
Route::get('/initandevents', function () {
    return view('swisa-admin.initandevents');
})->middleware(['auth', 'verified'])->name('initandevents');

Route::get('/training-workshop', [TrainingController::class, 'displayTraining'])
    ->middleware(['auth', 'verified'])->name('training-workshop');

//add training
Route::post('/trainings', [TrainingController::class, 'addTraining'])
    ->middleware(['auth', 'verified'])->name('training.store');

//view training 
Route::get('/view-training/{id}', [TrainingController::class, 'viewTrainingDetails'])
    ->middleware(['auth', 'verified'])->name('view-training');

//edit training
Route::patch('view-training/{id}/edit-training', [TrainingController::class, 'editTrainingInfo'])
    ->middleware(['auth', 'verified'])->name('training.update');

//delete training
Route::delete('view-training/{id}/delete-event', [TrainingController::class, 'deleteTraining'])
    ->middleware(['auth', 'verified'])->name('deleteTraining.delete');

//-----------REQUEST ROUTES----------------
Route::get('/grant-request', function () {
    return view('swisa-admin.grant-request');
})->middleware(['auth', 'verified'])->name('grant-request'); 

//------------APPLICATION ROUTE------------------
Route::get('/member-application', function () {
    return view('swisa-admin.member-application');
})->middleware(['auth', 'verified'])->name('member-application');



Route::get('/faqs', function () {
    return view('swisa-admin.faqs');
})->middleware(['auth', 'verified'])->name('faqs');

// SWISA STAFF: Main pages
Route::get('/report', function () {
    return view('swisa-support_staff.reports');
})->middleware(['auth', 'verified'])->name('report');

Route::get('/giveback', function () {
    return view('swisa-support_staff.giveback');
})->middleware(['auth', 'verified'])->name('giveback');

Route::get('/assisted-creation', function () {
    return view('swisa-support_staff.assisted-creation');
})->middleware(['auth', 'verified'])->name('assisted-creation');

//views in support staff
Route::get('/view-report', function () {
    return view('swisa-support_staff.view-report');
})->middleware(['auth', 'verified'])->name('view-report');

Route::get('/view-giveback', function () {
    return view('swisa-support_staff.view-giveback');
})->middleware(['auth', 'verified'])->name('view-giveback');

// PROFILE
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// FAQS CRUD
Route::get('/faqs', [FaqsController::class, 'index'])->name('faqs.index');
Route::post('/faqs', [FaqsController::class, 'store'])->name('faqs.store');
Route::delete('/faq/{id}', [FaqsController::class, 'destroy'])->name('faq.destroy');
Route::put('/faq/{faq}', [FaqsController::class, 'update'])->name('faq.update');

Route::get('/faqs/list', function () {
    return \App\Models\FAQ::where('target_audience', 'user')
        ->select('type', 'question', 'answer')
        ->orderBy('type')
        ->orderBy('id')
        ->get();
});



// CHATS
Route::middleware(['auth'])->group(function () {
    Route::get('/messages', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/messages/{chat}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{chat}/message', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::get('/chat/{chat}/poll', [ChatController::class, 'poll'])->name('chat.poll');
    Route::get('/chat/{userId}/load', [ChatController::class, 'load'])->name('chat.load');
    Route::get('/chat/unread-check', [ChatController::class, 'checkUnread']);
    Route::post('/chat/{chatId}/mark-as-read', [ChatController::class, 'markAsRead']);
    Route::get('/quickreplies/manage', [QuickReplyController::class, 'index'])->name('quickreplies.manage');
});

use App\Http\Controllers\mobile\MobileChatController;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/mobile/chat/create-or-get', [MobileChatController::class, 'createOrGetChat']);
});


// SETTINGS
//================================================

// CHAT SETTINGS
use App\Http\Controllers\QuickRepliesController;

Route::middleware(['auth'])->group(function () {
    Route::get('/quickreplies/manage', [QuickRepliesController::class, 'index'])->name('quickreplies.manage');
    Route::post('/settings/chat/quick-replies', [QuickRepliesController::class, 'store'])->name('quickreplies.store');
    Route::put('/settings/chat/quick-replies/{quickReply}', [QuickRepliesController::class, 'update'])->name('quickreplies.update');
    Route::delete('/settings/chat/quick-replies/{quickReply}', [QuickRepliesController::class, 'destroy'])->name('quickreplies.destroy');
});

// USER MANAGEMENT

Route::get('/settings', [UserManagementController::class, 'index'])->name('settings');
Route::post('/settings/users/store', [UserManagementController::class, 'store'])->name('admin.users.store');
Route::delete('/settings/users/{id}', [UserManagementController::class, 'destroy'])->name('admin.users.destroy');



// SCAN ATTENDANCE

use App\Http\Controllers\AttendanceController;

Route::get('/scan-qr-user/{qr_code}', [AttendanceController::class, 'scanQr']);



// REPORTS
use App\Http\Controllers\ReportsController;
Route::get('/reports/engagement', [ReportsController::class, 'engagement']);



use App\Http\Controllers\ReportMembershipController;
Route::get('/reports/membership', [ReportMembershipController::class, 'index'])->name('membership');
Route::get('/reports/membership/export/csv', [ReportMembershipController::class, 'exportCsv'])->name('membership.export.csv');
Route::get('/reports/membership/export/excel', [ReportMembershipController::class, 'exportExcel'])->name('membership.export.excel');
Route::get('/reports/membership/export/pdf', [ReportMembershipController::class, 'exportPdf'])->name('membership.export.pdf');


use App\Http\Controllers\ReportFinancialController;
Route::get('/reports/financial/export/pdf', [ReportFinancialController::class, 'exportPdf'])->name('financial.export.pdf');

Route::get('/reports/financial/export/csv', [ReportFinancialController::class, 'exportFinancialCsv'])->name('financial.export.csv');
Route::get('/reports/financial/export/excel', [ReportFinancialController::class, 'exportFinancialExcel'])->name('financial.export.excel');


use App\Http\Controllers\ReportRequestController;

Route::get('/reports/requests', [ReportRequestController::class, 'index'])->name('requests.report');
Route::get('/reports/requests/export/csv', [ReportRequestController::class, 'exportCsv'])->name('requests.export.csv');
Route::get('/reports/requests/export/excel', [ReportRequestController::class, 'exportExcel'])->name('requests.export.excel');
Route::get('/reports/requests/export/pdf', [ReportRequestController::class, 'exportPdf'])->name('requests.export.pdf');
Route::get('/reports/requests/stats', [ReportRequestController::class, 'requestStats'])->name('requests.stats');
Route::get('/reports/request/chart', [ReportRequestController::class, 'requestChartData'])
    ->name('requests.chart');
Route::get('/reports/request/table', [ReportRequestController::class, 'requestTableData']);
Route::get('/requests', [ReportRequestController::class, 'index'])->name('requests.index');

    

// routes/web.php
Route::get('/color-purple', function () {
    return view('color-purple');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/logs', [LogController::class, 'index'])->name('logs.index');
});

require __DIR__.'/auth.php';
