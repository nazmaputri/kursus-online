<?php

use App\Http\Controllers\Dashboard\DashboardAdminController;
use App\Http\Controllers\Dashboard\DashboardPesertaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Dashboard Admin
Route::get('dashboard-admin', [DashboardAdminController::class, 'index'])->name('dashboard-admin');
Route::get('dashboard-admin/welcome', [DashboardAdminController::class, 'show'])->name('welcome-admin');
Route::get('dashboard-admin/data-user', [DashboardAdminController::class, 'data'])->name('datauser-admin');
Route::get('dashboard-admin/laporan', [DashboardAdminController::class, 'laporan'])->name('laporan-admin');

//Dashboard Peserta
Route::get('dashboard-peserta', [DashboardPesertaController::class, 'index'])->name('dashboard-peserta');

require __DIR__.'/auth.php';

