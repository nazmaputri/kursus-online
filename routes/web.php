<?php

use App\Http\Controllers\Dashboard\DashboardAdminController;
use App\Http\Controllers\Dashboard\DashboardPesertaController;
use App\Http\Controllers\Dashboard\DashboardMentorController;
use App\Http\Controllers\DashboardMentor\CourseController;
use App\Http\Controllers\DashboardMentor\MateriController;
use App\Http\Controllers\DashboardMentor\VideoController;
use App\Http\Controllers\DashboardMentor\PdfController;
use App\Http\Controllers\DashboardMentor\QuizController;
use App\Http\Controllers\DashboardAdmin\CategoryController;
use App\Http\Controllers\DashboardMentor\RatingKursusController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CertificateController;
use App\Models\Course;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'lp']);
Route::get('/course/{id}', [LandingPageController::class, 'detail'])->name('kursus.detail');
Route::get('/category/{name}', [LandingPageController::class, 'category'])->name('category.detail');
Route::post('/ratings', [RatingController::class, 'store'])->name('rating.store');

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
Route::get('/kursus/{id}/{name}', [DashboardAdminController::class, 'detailkursus'])->name('detail-kursusadmin');
Route::get('dashboard-admin/laporan', [DashboardAdminController::class, 'laporan'])->name('laporan-admin');
Route::get('dashboard-admin/rating', [DashboardAdminController::class, 'rating'])->name('rating-admin');
Route::get('/ratings/toggle-display/{id}', [RatingController::class, 'toggleDisplay'])->name('toggle.display');
Route::patch('/admin/users/{id}/status', [DashboardAdminController::class, 'updateStatus'])->name('admin.users.updateStatus');
Route::get('/mentor/user/{id}', [DashboardAdminController::class, 'detailmentor'])->name('detaildata-mentor');
Route::get('/peserta/user/{id}', [DashboardAdminController::class, 'detailpeserta'])->name('detaildata-peserta');
Route::get('/settings', [SettingController::class, 'admin'])->name('settings.admin');
Route::post('/settings', [SettingController::class, 'update']);
// Kategori
Route::patch('/courses/{id}/{name}/approve', [DashboardAdminController::class, 'approve'])->name('courses.approve');
Route::patch('/courses/{id}/{name}/publish', [DashboardAdminController::class, 'publish'])->name('courses.publish');
Route::resource('categories', CategoryController::class);
Route::get('/categories/{name}', [CategoryController::class, 'show'])->name('categories.show');

//Dashboard Peserta
Route::get('dashboard-peserta/welcome', [DashboardPesertaController::class, 'show'])->name('welcome-peserta');
Route::get('dashboard-peserta/daftar', [DashboardPesertaController::class, 'daftar'])->name('daftar-peserta');
Route::get('dashboard-peserta/kursus', [DashboardPesertaController::class, 'kursusTerdaftar'])->name('daftar-kursus');
Route::get('kursus/{id}', [DashboardPesertaController::class, 'kursus'])->name('kursus-peserta');
Route::get('dashboard-peserta/kursus/{id}', [DashboardPesertaController::class, 'detail'])->name('detail-kursus');
Route::get('dashboard-peserta/study/{id}', [DashboardPesertaController::class, 'study'])->name('study-peserta');
Route::get('dashboard-peserta/video', [DashboardPesertaController::class, 'video'])->name('video-peserta');
Route::get('dashboard-peserta/quiz', [DashboardPesertaController::class, 'quiz'])->name('quiz-peserta');
Route::get('dashboard-peserta/kategori', [DashboardPesertaController::class, 'kategori'])->name('kategori-peserta');
Route::get('/categories/{id}/detail', [DashboardPesertaController::class, 'showCategoryDetail'])->name('categories-detail');
Route::get('/settings-student', [SettingController::class, 'student'])->name('settings-student');
Route::post('/kursus/{course_id}/rating', [RatingKursusController::class, 'store'])->name('ratings.store');

//Quiz Peserta
Route::get('/quiz/{quiz}', [QuizController::class, 'show'])->name('quiz.show');
Route::post('/quiz/{quiz}/submit', [QuizController::class, 'submit'])->name('quiz.submit');
Route::get('/quiz/{quiz}/result', [QuizController::class, 'result'])->name('quiz.result');

//Dashboard Mentor
Route::get('dashboard-mentor/welcome', [DashboardMentorController::class, 'show'])->name('welcome-mentor');
Route::get('dashboard-mentor/data-peserta', [DashboardMentorController::class, 'datapeserta'])->name('datapeserta-mentor');
Route::get('dashboard-mentor/laporan', [DashboardMentorController::class, 'laporan'])->name('laporan-mentor');
Route::get('dashboard-mentor/rating', [DashboardMentorController::class, 'rating'])->name('rating-kursus');
Route::get('dashboard-mentor/rating/{id}', [DashboardMentorController::class, 'ratingDetail'])->name('rating-detail');
Route::post('/rating/{id}/toggle-display', [RatingKursusController::class, 'toggleDisplay'])->name('toggle.displaymentor');
Route::get('/settings', [SettingController::class, 'mentor'])->name('settings.mentor');

//Kursus
Route::resource('courses', CourseController::class);

// Materi
Route::get('/materi/{courseId}/{materiId}', [MateriController::class, 'show'])->name('materi.show');
Route::get('/materi/{courseId}', [MateriController::class, 'create'])->name('materi.create');
Route::post('/materi/{courseId}', [MateriController::class, 'store'])->name('materi.store');
Route::get('/materi/edit/{courseId}/{materiId}', [MateriController::class, 'edit'])->name('materi.edit');
Route::put('/materi/edit/{courseId}/{materiId}', [MateriController::class, 'update'])->name('materi.update');
Route::delete('/materi/{courseId}/destroy/{materiId}', [MateriController::class, 'destroy'])->name('materi.destroy');
Route::delete('video/{video}', [VideoController::class, 'destroy'])->name('video.destroy');
Route::delete('pdf/{pdf}', [PdfController::class, 'destroy'])->name('pdf.destroy');

// Quiz
Route::get('/quiz/{courseId}/{materiId}/{quiz}', [QuizController::class, 'detail'])->name('quiz.detail');
Route::get('/quiz/{courseId}/{materiId}', [QuizController::class, 'create'])->name('quiz.create');
Route::post('/quiz/{courseId}/{materiId}', [QuizController::class, 'store'])->name('quiz.store');
Route::get('/quiz/{courseId}/{materiId}/{quiz}/edit', [QuizController::class, 'edit'])->name('quiz.edit');
Route::put('/quiz/{courseId}/{materiId}/{quiz}', [QuizController::class, 'update'])->name('quiz.update');
Route::delete('/quiz/{courseId}/{materiId}/{quiz}', [QuizController::class, 'destroy'])->name('quiz.destroy');

//Umum
Route::post('/create-payment/{course_id}', [PaymentController::class, 'createPayment'])->name('create.payment');
Route::post('/payment-success', [PaymentController::class, 'updatePaymentStatus']);
Route::get('/search', [SearchController::class, 'index'])->name('search.index');
Route::get('/certificate/{courseId}', [CertificateController::class, 'showCertificate'])->name('certificate.show');
Route::get('/certificate/download/{courseId}', [CertificateController::class, 'downloadCertificate'])->name('certificate.download');

Route::middleware('auth')->group(function () {
    Route::get('chat/mentor/{courseId}/{chatId?}', [ChatController::class, 'chatMentor'])->name('chat.mentor');
    Route::get('chat/student/{courseId}/{chatId?}', [ChatController::class, 'chatStudent'])->name('chat.student');
    Route::post('chat/{chatId}/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::get('chat/start/{studentId}', [ChatController::class, 'startChat'])->name('chat.start');
});

require __DIR__.'/auth.php';

