<?php

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

Route::get('/magazijn', function () {
    return view('roles.magazijn');
})->middleware(['auth', 'verified', 'role:magazijn_medewerker'])->name('magazijn.dashboard');

require __DIR__.'/auth.php';
