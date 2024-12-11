<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardMentor\CourseController;
use App\Http\Controllers\DashboardAdmin\CategoryController;
use App\Models\Category;
use App\Models\Course;
use App\Models\Payment;
use Illuminate\Http\Request;

class DashboardPesertaController extends Controller
{
    public function detail($id)
    {
        // Ambil satu data kursus berdasarkan ID
        $course = Course::find($id);

        // Jika kursus tidak ditemukan, kembalikan halaman 404
        if (!$course) {
            return abort(404);
        }

        // Kirim data kursus ke view
        return view('dashboard-peserta.kursus-detail', compact('course'));
    }

    public function index() {
        return view('layouts.dashboard-peserta');
    }

    public function show()
    {
        $userId = auth()->id(); // Mendapatkan ID user yang sedang login
    
        // Mengambil kursus yang sudah dibeli oleh user
        $courses = Course::whereHas('payments', function ($query) use ($userId) {
            $query->where('user_id', $userId)
                  ->where('transaction_status', 'success');
        })->get();
    
        // Menghitung progress setiap kursus
        foreach ($courses as $course) {
            // Mengambil materi yang terkait dengan kursus ini
            $totalMateri = $course->materi->count(); // Total materi yang tersedia di kursus ini
    
            // Menghitung jumlah materi yang sudah diselesaikan oleh user
            $completedMateri = 0;
            foreach ($course->materi as $materi) {
                // Cek jika user sudah menyelesaikan materi ini (ada data completed_at di tabel pivot)
                $isCompleted = $materi->users()->wherePivot('user_id', $userId)
                                              ->wherePivot('completed_at', '!=', null)
                                              ->exists();
                if ($isCompleted) {
                    $completedMateri++;
                }
            }
    
            // Menghitung persentase progres
            $progress = $totalMateri > 0 ? round(($completedMateri / $totalMateri) * 100, 2) : 0;
    
            // Menyimpan progress ke dalam kursus
            $course->progress = $progress;
    
            // Menentukan apakah user sudah menyelesaikan materi untuk tombol sertifikat
            $isCompletedForCertificate = $completedMateri === $totalMateri; // Jika semua materi diselesaikan
    
            // Menambahkan flag untuk sertifikat
            $course->isCompletedForCertificate = $isCompletedForCertificate;
        }
    
        // Kirim data kursus dengan progress dan status penyelesaian ke view
        return view('dashboard-peserta.welcome', compact('courses'));
    }
    

    public function chat() {
        return view('dashboard-peserta.chat');
    }

    public function kursus($id)
    {
        // Ambil data kursus
        $course = Course::findOrFail($id);
    
        // Pastikan relasi kategori diakses dengan benar
        $category = $course->category; // Menyimpan objek kategori yang terkait dengan kursus
    
        // Cek apakah user sudah membeli kursus ini
        $hasPurchased = Payment::where('course_id', $course->id)
                                ->where('user_id', auth()->id())
                                ->where('transaction_status', 'success')
                                ->exists();
    
        // Ambil status pembayaran berdasarkan user yang login dan kursus yang dibeli
        $paymentStatus = null;
        if ($hasPurchased) {
            // Pengguna sudah membeli kursus ini, jadi sembunyikan tombol beli
            $course->is_purchased = true;
        } else {
            // Cek status pembayaran jika belum membeli
            $payment = Payment::where('course_id', $course->id)
                                ->where('user_id', auth()->id())
                                ->first();
    
            if ($payment) {
                $paymentStatus = $payment->transaction_status; // Status transaksi, misal 'success'
            }
        }
    
        // Kirim data kursus dan kategori ke view
        return view('dashboard-peserta.detail', compact('course', 'paymentStatus', 'hasPurchased', 'category'));
    }    
    
    public function study($id)
    {
        // Mengambil course beserta materi
        $course = Course::with('materi')->findOrFail($id);
    
        // Mengambil ID materi yang sudah diselesaikan oleh user
        $completedMateriIds = \DB::table('materi_user')
            ->where('user_id', auth()->id())
            ->whereNotNull('completed_at')
            ->pluck('materi_id')
            ->toArray();
    
        return view('dashboard-peserta.study', compact('course', 'completedMateriIds'));
    }    

    public function daftar() {
        return view('dashboard-peserta.daftar');
    }

    public function kursusTerdaftar()
    {
        // Mendapatkan ID user yang sedang login
        $userId = auth()->id();
    
        // Mengambil kursus yang sudah dibeli oleh user dengan status pembayaran 'success'
        $courses = Course::whereHas('payments', function ($query) use ($userId) {
            $query->where('user_id', $userId)
                  ->where('transaction_status', 'success');
        })->get();
    
        // Mengecek apakah chat aktif pada setiap kursus
        foreach ($courses as $course) {
            // Jika chat aktif, maka akan ditandai
            $course->isChatActive = $course->chat == 1;
        }
    
        return view('dashboard-peserta.kursus', compact('courses'));
    }
    

    public function video() {
        return view('dashboard-peserta.video');
    }

    public function quiz() {
        return view('dashboard-peserta.quiz');
    }

    public function kategori() {
        $categories = Category::paginate(4);
        return view('dashboard-peserta.categories', compact('categories'));
    }

    public function showCategoryDetail($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $courses = Course::where('category', $category->name)->get();

        return view('dashboard-peserta.categories-detail', compact('category', 'courses'));
    }
}
