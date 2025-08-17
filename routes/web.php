<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.landing');
});
Route::get('/landing', function () {
    return view('auth.landing');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/members', function () {
    return view('swisa-admin.members');
})->middleware(['auth', 'verified'])->name('members');

Route::get('/grantsNequipment', function () {
    return view('swisa-admin.grantsNequipment');
})->middleware(['auth', 'verified'])->name('grantsNequipment');

Route::get('/view-profile', function () {
    return view('swisa-admin.view-profile');
})->middleware(['auth', 'verified'])->name('view-profile');

Route::get('/view-grant', function () {
    return view('swisa-admin.view-grant');
})->middleware(['auth', 'verified'])->name('view-grant');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';




