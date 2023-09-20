<?php

use App\Http\Controllers\{DashboardController, LandingController, PasswordController, TeamController};
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'show'])->name('landing');;


Route::middleware(['auth'])->group(function () {
    Route::get('/passwords', [PasswordController::class, 'index'])->name('passwords');
    Route::get('/passwords/create', [PasswordController::class, 'create'])->name('passwords.create');
    Route::get('/passwords/{password}/edit', [PasswordController::class, 'edit'])->name('passwords.edit');
    Route::post('/passwords/store', [PasswordController::class, 'store'])->name('passwords.store');
    Route::patch('/passwords/{password}/update', [PasswordController::class, 'update'])->name('passwords.update');

    Route::get('/teams', [TeamController::class, 'index'])->name('teams');
    Route::get('/teams/create', [TeamController::class, 'create'])->name('teams.create');
    Route::post('/teams/store', [TeamController::class, 'store'])->name('teams.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
