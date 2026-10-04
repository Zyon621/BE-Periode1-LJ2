<?php

use App\Http\Controllers\MagazijnController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin', function () {
    return view('roles.admin');
})->middleware(['auth', 'verified', 'role:admin'])->name('admin.dashboard');

Route::get('/klant', function () {
    return view('roles.klant');
})->middleware(['auth', 'verified', 'role:klant'])->name('klant.dashboard');

Route::middleware(['auth', 'verified', 'role:magazijn_medewerker'])->prefix('magazijn')->name('magazijn.')->group(function () {
    Route::get('/', [MagazijnController::class, 'overzicht'])->name('overzicht');
    Route::get('/create', [MagazijnController::class, 'create'])->name('create');
    Route::post('/', [MagazijnController::class, 'store'])->name('store');
    Route::get('/{product}/levering-info', [MagazijnController::class, 'leveringInfo'])->name('levering-info');
});

require __DIR__.'/auth.php';
