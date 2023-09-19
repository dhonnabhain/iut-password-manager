<?php

use App\Http\Controllers\{LandingController, PasswordController};
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'show'])->name('landing');

Route::get('/passwords', [PasswordController::class, 'index'])->name('passwords.index');
Route::get('/passwords/create', [PasswordController::class, 'create'])->name('passwords.create');
Route::post('/passwords/store', [PasswordController::class, 'store'])->name('passwords.store');
