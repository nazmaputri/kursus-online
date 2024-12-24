<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;


// Route untuk login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

//Route untuk register
Route::get('register', [RegisterController::class, 'show'])->name('register');
Route::get('register-mentor', [RegisterController::class, 'showmentor'])->name('registermentor');
Route::post('register', [RegisterController::class, 'register']);

// Route untuk logout
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/logoutadmin', [LoginController::class, 'logoutAdmin'])->name('logout.admin');
Route::get('/logoutmentor', [LoginController::class, 'logoutMentor'])->name('logout.mentor');
