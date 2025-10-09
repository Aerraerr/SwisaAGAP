<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\AnnouncementController;
use App\Http\Controllers\Web\GrantController;
use App\Http\Controllers\Web\MemberController;
use App\Http\Controllers\Web\TrainingController;
use App\Http\Controllers\Web\FaqController;
use App\Http\Controllers\Web\FaqsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/grant-request', function () {
    return view('swisa-admin.grant-request');
})->middleware(['auth', 'verified'])->name('grant-request'); 

//------------APPLICATION ROUTE------------------

Route::get('/member-application', function () {
    return view('swisa-admin.member-application');
})->middleware(['auth', 'verified'])->name('member-application');


Route::get('/settings', function () {
    return view('swisa-admin.settings');
})->middleware(['auth', 'verified'])->name('settings');

Route::get('/logs', function () {
    return view('swisa-admin.logs');
})->middleware(['auth', 'verified'])->name('logs');


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


Route::middleware('auth')->group(function () {
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
use App\Http\Controllers\ChatController;

Route::middleware(['auth'])->group(function () {
    Route::get('/messages', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/messages/{chat}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{chat}/message', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::get('/chat/{chat}/poll', [ChatController::class, 'poll'])->name('chat.poll');
    Route::get('/chat/{userId}/load', [ChatController::class, 'load'])->name('chat.load'); // ✅ Add this
    Route::get('/chat/unread-check', [ChatController::class, 'checkUnread']);
    Route::post('/chat/{chatId}/mark-as-read', [ChatController::class, 'markAsRead']);


    
});







require __DIR__.'/auth.php';




