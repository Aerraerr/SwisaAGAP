<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/admin-reports', function () {
    return view('swisa-admin.reports');
})->middleware(['auth', 'verified'])->name('admin-reports');

Route::get('/members', function () {
    return view('swisa-admin.members');
})->middleware(['auth', 'verified'])->name('members');

Route::get('/grantsNequipment', function () {
    return view('swisa-admin.grantsNequipment');
})->middleware(['auth', 'verified'])->name('grantsNequipment');

Route::get('/announcements', function () {
    return view('swisa-admin.announcements');
})->middleware(['auth', 'verified'])->name('announcements');

Route::get('/initandevents', function () {
    return view('swisa-admin.initandevents');
})->middleware(['auth', 'verified'])->name('initandevents');

Route::get('/training-workshop', function () {
    return view('swisa-admin.training-workshop');
})->middleware(['auth', 'verified'])->name('training-workshop');

Route::get('/grant-request', function () {
    return view('swisa-admin.grant-request');
})->middleware(['auth', 'verified'])->name('grant-request'); 

Route::get('/member-application', function () {
    return view('swisa-admin.member-application');
})->middleware(['auth', 'verified'])->name('member-application');

//view pages
Route::get('/view-profile', function () {
    return view('swisa-admin.view-profile');
})->middleware(['auth', 'verified'])->name('view-profile');

Route::get('/settings', function () {
    return view('swisa-admin.settings');
})->middleware(['auth', 'verified'])->name('settings');

Route::get('/logs', function () {
    return view('swisa-admin.logs');
})->middleware(['auth', 'verified'])->name('logs');

Route::get('/messages', function () {
    return view('swisa-admin.messages');
})->middleware(['auth', 'verified'])->name('messages');

Route::get('/view-grant', function () {
    return view('swisa-admin.view-grant');
})->middleware(['auth', 'verified'])->name('view-grant');

Route::get('/view-training', function () {
    return view('swisa-admin.view-training');
})->middleware(['auth', 'verified'])->name('view-training');



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

require __DIR__.'/auth.php';




