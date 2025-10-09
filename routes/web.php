<?php

use App\Http\Controllers\Web\GrantRequestController;
use App\Http\Controllers\Web\MembershipController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\AnnouncementController;
use App\Http\Controllers\Web\AssistController;
use App\Http\Controllers\Web\GivebackController;
use App\Http\Controllers\Web\GrantController;
use App\Http\Controllers\Web\GrantReportController;
use App\Http\Controllers\Web\MemberController;
use App\Http\Controllers\Web\TrainingController;
use App\Models\GrantReport;
use Illuminate\Support\Facades\Route;

use App\Services\DocumentChecker;

Route::get('/test-doc', function () {
    $filePath = storage_path('app/testfiles/requestform.docx'); // change to your test file
    $checker = new DocumentChecker();
    $text = $checker->extractText($filePath);

    return nl2br(e($text)); // show extracted text
});

Route::get('/test-img', function () {
    $filePath = storage_path('app/testfiles/1758968894_Screenshot 2025-09-27 182621.png'); // your test file
    $checker = new DocumentChecker();
    $text = $checker->extractText($filePath);

    return nl2br(e($text));
});

Route::get('/', function () {
    return view('auth.landing');
});
Route::get('/landing', function () {
    return view('auth.landing');
});

// SWISA ADMIN: Main pages
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//-----------ADMIN-REPORTS ROUTES----------------

Route::get('/admin-reports', function () {
    return view('swisa-admin.reports');
})->middleware(['auth', 'verified'])->name('admin-reports');

//------------MEMBER ROUTES--------------


Route::get('/members', [MemberController::class, 'displayMember'])
->middleware(['auth', 'verified'])->name('members');

//for view profile 
Route::get('/view-profile/{id}', [MemberController::class, 'viewProfile'])
->middleware(['auth', 'verified'])->name('view-profile');

//-----------GRANT ROUTES-------------

//display grant
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

//for grantcontroller/addgrant
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

//------------APPLICATION ROUTE------------------

Route::get('/member-application', [MembershipController::class, 'displayApplications'])
->middleware(['auth', 'verified'])->name('member-application');


Route::get('/settings', function () {
    return view('swisa-admin.settings');
})->middleware(['auth', 'verified'])->name('settings');

Route::get('/logs', function () {
    return view('swisa-admin.logs');
})->middleware(['auth', 'verified'])->name('logs');

Route::get('/messages', function () {
    return view('swisa-admin.messages');
})->middleware(['auth', 'verified'])->name('messages');




// SWISA STAFF: Main pages

// ----- for giveback -------------
Route::get('/giveback', [GivebackController::class, 'displayGivebacks'])
->middleware(['auth', 'verified'])->name('giveback');

Route::get('/view-giveback/{id}', [GivebackController::class, 'viewGiveback'])
->middleware(['auth', 'verified'])->name('view-giveback');

Route::patch('/view-giveback/{id}/received', [GivebackController::class, 'updateStatus'])
->middleware(['auth', 'verified'])->name('giveback.updateStatus');

// -------- for assisting page ---------------
Route::get('/assisted-creation', [AssistController::class, 'displayMembers'])
->middleware(['auth', 'verified'])->name('assisted-creation');

//assist register
Route::post('/assisted-creation', [AssistController::class, 'assistRegisterAccount'])
->name('assistRegister.store');

//assist membership
Route::post('/assisted-creation/{id}/membership', [AssistController::class, 'assistMembershipApplication'])
->middleware(['auth', 'verified'])->name('assistMembershipApplication.store');

//assist grant request
Route::post('/assisted-creation/{id}/request_grant', [AssistController::class, 'assistGrantApplication'])
->middleware(['auth', 'verified'])->name('assistGrantApplication.store');

//  --------- for grant reports -------------

Route::get('/report', [GrantReportController::class, 'displayGrantReports'])
->middleware(['auth', 'verified'])->name('report');

//views in support staff
Route::get('/view-report/{id}', [GrantReportController::class, 'viewGrantReport'])
->middleware(['auth', 'verified'])->name('view-report');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';




