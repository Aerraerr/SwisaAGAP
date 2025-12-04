<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\Web\GrantRequestController;
use App\Http\Controllers\Web\MembershipController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\AnnouncementController;
use App\Http\Controllers\Web\AssistController;
use App\Http\Controllers\Web\GrantController;
use App\Http\Controllers\Web\GrantReportController;
use App\Http\Controllers\ReportMembershipController;
use App\Http\Controllers\ReportRequestController;
use App\Http\Controllers\ReportFinancialController;
use App\Http\Controllers\ReportFeedbackController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Web\MemberController;
use App\Http\Controllers\Web\TrainingController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\QuickRepliesController;
use App\Http\Controllers\Web\ContributionController;
use App\Http\Controllers\Web\UserManagementController;
use App\Http\Controllers\Web\FaqsController;
use Illuminate\Support\Facades\Route;
use App\Services\SMSService;

Route::get('/app-download', function () {
    return view('app-download.download-page');
})->name('app.download');

//
Route::get('/', function () {
    return view('auth.landing');
});
Route::get('/landing', function () {
    return view('auth.landing');
});

// SWISA ADMIN: Main pages
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

//sms testing
Route::get('/test-sms', function () {
    $number = '09943801688'; // your phone number
    $message = 'Hello from vakla SWISA-AGAP (IPROG Test)!';
    $response = SMSService::send($number, $message);
    return $response;
});

Route::get('/admin-reports', [ReportFeedbackController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('admin-reports');

Route::middleware(['auth'])->group(function () {
    Route::get('/logs', [LogController::class, 'index'])->name('logs.index');
    Route::get('/scan-qr-user/{qr_code}', [AttendanceController::class, 'scanQr']);
});

// ------------REPORTS---------------

//engagement report
Route::get('/reports/engagement', [ReportsController::class, 'engagement']);
//feedback reports
Route::get('/admin-reports', [ReportFeedbackController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('admin-reports');
//financial reports
Route::get('/reports/financial/export/pdf', [ReportFinancialController::class, 'exportPdf'])->name('financial.export.pdf');
Route::get('/reports/financial/export/csv', [ReportFinancialController::class, 'exportFinancialCsv'])->name('financial.export.csv');
Route::get('/reports/financial/export/excel', [ReportFinancialController::class, 'exportFinancialExcel'])->name('financial.export.excel');
//request grants reports
Route::get('/reports/requests', [ReportRequestController::class, 'index'])->name('requests.report');
Route::get('/reports/requests/export/csv', [ReportRequestController::class, 'exportCsv'])->name('requests.export.csv');
Route::get('/reports/requests/export/excel', [ReportRequestController::class, 'exportExcel'])->name('requests.export.excel');
Route::get('/reports/requests/export/pdf', [ReportRequestController::class, 'exportPdf'])->name('requests.export.pdf');
Route::get('/reports/requests/stats', [ReportRequestController::class, 'requestStats'])->name('requests.stats');
Route::get('/reports/request/chart', [ReportRequestController::class, 'requestChartData'])
    ->name('requests.chart');
Route::get('/reports/request/table', [ReportRequestController::class, 'requestTableData']);
Route::get('/requests', [ReportRequestController::class, 'index'])->name('requests.index');
//membership report
Route::get('/reports/membership', [ReportMembershipController::class, 'index'])->name('membership');
Route::get('/reports/membership/export/csv', [ReportMembershipController::class, 'exportCsv'])->name('membership.export.csv');
Route::get('/reports/membership/export/excel', [ReportMembershipController::class, 'exportExcel'])->name('membership.export.excel');
Route::get('/reports/membership/export/pdf', [ReportMembershipController::class, 'exportPdf'])->name('membership.export.pdf');

//-------------ANNOUNCEMENT ROUTES------------

Route::get('/announcements', [AnnouncementController::class, 'dispalyAnnouncement'])
->middleware(['auth', 'verified'])->name('announcements');

Route::post('/announcements', [AnnouncementController::class, 'addAnnouncement'])
->middleware(['auth', 'verified'])->name('announcement.store');

//edit training
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

//for add training
Route::post('/trainings', [TrainingController::class, 'addTraining'])
->middleware(['auth', 'verified'])->name('training.store');

//for view training 
Route::get('/view-training/{id}', [TrainingController::class, 'viewTrainingDetails'])
->middleware(['auth', 'verified'])->name('view-training');

//edit training
Route::patch('view-training/{id}/edit-training', [TrainingController::class, 'editTrainingInfo'])
->middleware(['auth', 'verified'])->name('training.update');

//delete training
Route::delete('view-training/{id}/delete-event', [TrainingController::class, 'deleteTraining'])
->middleware(['auth', 'verified'])->name('deleteTraining.delete');

//-----------REQUEST ROUTES----------------

Route::get('/grant-request', [GrantRequestController::class, 'displayApplications'] )
->middleware(['auth', 'verified'])->name('grant-request'); 

Route::patch('/grant-application/{id}/checked', [GrantRequestController::class, 'markAsChecked'])
->middleware(['auth', 'verified'])->name('checked-grant-application.update');

Route::patch('/grant-application/{id}/approved', [GrantRequestController::class, 'approvedApplication'])
->middleware(['auth', 'verified'])->name('approved-grant-application.update'); 

//------------APPLICATION ROUTE------------------

Route::get('/member-application', [MembershipController::class, 'displayApplications'])
->middleware(['auth', 'verified'])->name('member-application');

Route::patch('/member-application/{id}', [MembershipController::class, 'approvedApplication'])
->middleware(['auth', 'verified'])->name('member-application.update');


Route::get('/settings', function () {
    return view('swisa-admin.settings');
})->middleware(['auth', 'verified'])->name('settings');



Route::get('/faqs', function () {
    return view('swisa-admin.faqs');
})->middleware(['auth', 'verified'])->name('faqs');




Route::middleware(['role:3', 'verified'])->group(function () {

    //-----------ADMIN-REPORTS ROUTES----------------

    Route::get('/admin-reports', function () {
        return view('swisa-admin.reports');
    })->name('admin-reports');

    //------------MEMBER ROUTES--------------


    Route::get('/members', [MemberController::class, 'displayMember'])->name('members');

    //for view profile 
    Route::get('/view-profile/{id}', [MemberController::class, 'viewProfile'])->name('view-profile');

    //-----------GRANT ROUTES-------------

    //display grant
    Route::get('/grantsNequipment', [GrantController::class, 'displayGrants'])->name('grantsNequipment');

    //for view grant 
    Route::get('/view-grant/{id}', [GrantController::class, 'viewGrantDetails'])->name('view-grant');

    //for grantcontroller/addgrant
    Route::post('/grantsNequipment/add-grant', [GrantController::class, 'addGrant'])->name('grantsNequipment.store');

    //add stock to a grant
    Route::patch('view-grant/{id}/add-stock', [GrantController::class, 'addGrantStock'])->name('addGrantStock.update');

    //edit grant
    Route::patch('view-grant/{id}/edit-grant', [GrantController::class, 'editGrantInfo'])->name('editGrantInfo.update');

    //delete grant
    Route::delete('view-grant/{id}/delete-grant', [GrantController::class, 'deleteGrant'])->name('deleteGrant.delete');
});

// SWISA STAFF: Main pages
Route::middleware(['role:2', 'verified'])->group(function () {
    // ----- for giveback -------------
    Route::get('/giveback', [ContributionController::class, 'displayGivebacks'])->name('giveback');

    Route::get('/view-giveback/{id}', [ContributionController::class, 'viewGiveback'])->name('view-giveback');

    Route::patch('/view-giveback/{id}/received', [ContributionController::class, 'updateStatus'])->name('giveback.updateStatus');

    // -------- for assisting page ---------------
    Route::get('/assisted-creation', [AssistController::class, 'displayMembers'])->name('assisted-creation');

    //assist register
    Route::post('/assisted-creation', [AssistController::class, 'assistRegisterAccount'])->name('assistRegister.store');

    //assist membership
    Route::post('/assisted-creation/{id}/membership', [AssistController::class, 'assistMembershipApplication'])->name('assistMembershipApplication.store');

    //assist grant request
    Route::post('/assisted-creation/{id}/grant_application', [AssistController::class, 'assistGrantApplication'])->name('assistGrantApplication.store');
});




Route::middleware('auth', 'verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});





// FAQS
// Display FAQs
Route::get('/faqs', [FaqsController::class, 'index'])->name('faqs.index');
// Add new FAQ
Route::post('/faqs', [FaqsController::class, 'store'])->name('faqs.store');
// Delete FAQ
Route::delete('/faq/{id}', [FaqsController::class, 'destroy'])->name('faq.destroy');
// Optional: Edit/Update FAQ
Route::put('/faq/{faq}', [FaqsController::class, 'update'])->name('faq.update');

// CHATS
Route::middleware(['auth'])->group(function () {
    Route::get('/messages', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/messages/{chat}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{chat}/message', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::get('/chat/{chat}/poll', [ChatController::class, 'poll'])->name('chat.poll');
    Route::get('/chat/{userId}/load', [ChatController::class, 'load'])->name('chat.load');
    Route::get('/chat/unread-check', [ChatController::class, 'checkUnread']);
    Route::post('/chat/{chatId}/mark-as-read', [ChatController::class, 'markAsRead']);
    Route::get('/quickreplies/manage', [QuickRepliesController::class, 'index'])->name('quickreplies.manage');
});


// SETTINGS
//================================================

// CHAT SETTINGS

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/quickreplies/manage', [QuickRepliesController::class, 'index'])->name('quickreplies.manage');
    Route::post('/settings/chat/quick-replies', [QuickRepliesController::class, 'store'])->name('quickreplies.store');
    Route::put('/settings/chat/quick-replies/{quickReply}', [QuickRepliesController::class, 'update'])->name('quickreplies.update');
    Route::delete('/settings/chat/quick-replies/{quickReply}', [QuickRepliesController::class, 'destroy'])->name('quickreplies.destroy');
});

// USER MANAGEMENT

Route::get('/settings', [UserManagementController::class, 'index'])->name('settings');
Route::post('/settings/users/add-requirement', [UserManagementController::class, 'addRequirement'])->name('admin.requirement.store');
Route::post('/settings/users/add-sector', [UserManagementController::class, 'addSector'])->name('admin.sector.store');
Route::post('/settings/users/add-grant_type', [UserManagementController::class, 'addGrantType'])->name('admin.grant_type.store');
Route::post('/settings/users/add-membership_requirement', [UserManagementController::class, 'addMembershipRequirement'])->name('admin.membership_requirement.store');
Route::post('/settings/users/store', [UserManagementController::class, 'store'])->name('admin.users.store');

Route::delete('/settings/users/delete-requirement/{id}', [UserManagementController::class, 'deleteRequirement'])->name('admin.requirement.destroy');
Route::delete('/settings/users/delete-sector/{id}', [UserManagementController::class, 'deleteSector'])->name('admin.sector.destroy');
Route::delete('/settings/users/delete-grant_type/{id}', [UserManagementController::class, 'deleteGrantType'])->name('admin.grant_type.destroy');
Route::delete('/settings/users/delete-membership_requirement/{id}', [UserManagementController::class, 'deleteMembershipRequirement'])->name('admin.membership_requirement.destroy');
Route::delete('/settings/users/{id}', [UserManagementController::class, 'destroy'])->name('admin.users.destroy');

Route::post('/applications/{id}/claimed', [GrantRequestController::class, 'claimed'])->name('applications.claimed');



require __DIR__.'/auth.php';




