<?php

use App\Http\Controllers\Dashboard\DashboardAdminController;
use App\Http\Controllers\Dashboard\DashboardPesertaController;
use App\Http\Controllers\Dashboard\DashboardMentorController;
use App\Http\Controllers\DashboardMentor\CourseController;
use App\Http\Controllers\DashboardAdmin\CategoryController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'lp']);


// Route berdasarkan role
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/dashboard-peserta', function () {
        return view('dashboard-peserta.welcome');
    })->name('dashboard-peserta');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard-admin', function () {
        return view('dashboard-admin.welcome');
    })->name('dashboard-admin');
});

//Dashboard Admin
Route::get('dashboard-admin/welcome', [DashboardAdminController::class, 'show'])->name('welcome-admin');
Route::get('dashboard-admin/data-mentor', [DashboardAdminController::class, 'mentor'])->name('datamentor-admin');
Route::get('dashboard-admin/data-peserta', [DashboardAdminController::class, 'peserta'])->name('datapeserta-admin');
Route::get('dashboard-admin/kursus', [DashboardAdminController::class, 'kursus'])->name('kursus-admin');
Route::get('/kursus/{id}', [DashboardAdminController::class, 'detailkursus'])->name('detailkursus-admin');
Route::get('dashboard-admin/laporan', [DashboardAdminController::class, 'laporan'])->name('laporan-admin');
Route::patch('/admin/users/{id}/status', [DashboardAdminController::class, 'updateStatus'])->name('admin.users.updateStatus');
Route::get('/mentor/user/{id}', [DashboardAdminController::class, 'detailmentor'])->name('detaildata-mentor');
Route::get('/peserta/user/{id}', [DashboardAdminController::class, 'detailpeserta'])->name('detaildata-peserta');

//Dashboard Peserta
Route::get('dashboard-peserta/welcome', [DashboardPesertaController::class, 'show'])->name('welcome-peserta');
Route::get('dashboard-peserta/chat', [DashboardPesertaController::class, 'chat'])->name('chat-peserta');
Route::get('dashboard-peserta/daftar', [DashboardPesertaController::class, 'daftar'])->name('daftar-peserta');
Route::get('dashboard-peserta/kursus', [DashboardPesertaController::class, 'kursus'])->name('kursus-peserta');
Route::get('dashboard-peserta/study', [DashboardPesertaController::class, 'study'])->name('study-peserta');
Route::get('dashboard-peserta/detail', [DashboardPesertaController::class, 'detail'])->name('detail-peserta');
Route::get('dashboard-peserta/kategori', [DashboardPesertaController::class, 'kategori'])->name('kategori-peserta');

//Dashboard Mentor
Route::get('dashboard-mentor/welcome', [DashboardMentorController::class, 'show'])->name('welcome-mentor');
Route::get('dashboard-mentor/data-peserta', [DashboardMentorController::class, 'datapeserta'])->name('datapeserta-mentor');
Route::get('dashboard-mentor/chat', [DashboardMentorController::class, 'chat'])->name('chat-mentor');
Route::get('dashboard-mentor/tambah-kursus', [DashboardMentorController::class, 'tambahkursus'])->name('tambahkursus-mentor');
Route::get('dashboard-mentor/kursus', [DashboardMentorController::class, 'kursus'])->name('kursus-mentor');
Route::get('dashboard-mentor/tambah-materi', [DashboardMentorController::class, 'tambahmateri'])->name('tambahmateri-mentor');
Route::get('dashboard-mentor/tambah-quiz', [DashboardMentorController::class, 'tambahquiz'])->name('tambahquiz-mentor');
Route::get('dashboard-mentor/laporan', [DashboardMentorController::class, 'laporan'])->name('laporan-mentor');

Route::post('dashboard-mentor/tambah-kursus', [CourseController::class, 'store'])->name('courses-store');



// Route untuk menampilkan daftar kategori
Route::get('/kategori', [CategoryController::class, 'index'])->name('kategori-admin');

// Route untuk menampilkan form tambah kategori
Route::get('/kategori/tambah', [CategoryController::class, 'create'])->name('kategori-create');

// Route untuk menyimpan kategori baru
Route::post('/kategori', [CategoryController::class, 'store'])->name('kategori-store');

// Route untuk menampilkan form edit kategori
Route::get('/kategori/edit/{id}', [CategoryController::class, 'edit'])->name('kategori-edit');

// Route untuk mengupdate kategori
Route::put('/kategori/{id}', [CategoryController::class, 'update'])->name('kategori.update');

// Route untuk menghapus kategori
Route::delete('/kategori/{id}', [CategoryController::class, 'destroy'])->name('kategori-delete');


require __DIR__.'/auth.php';

