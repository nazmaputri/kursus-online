<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardMentor\CourseController;
use App\Http\Controllers\DashboardAdmin\CategoryController;
use App\Models\Category;
use App\Models\Course;
use App\Models\Payment;
use App\Models\RatingKursus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        // Cek apakah user sudah memberikan rating untuk kursus ini
        $hasRated = DB::table('rating_kursus')
            ->where('course_id', $id)
            ->where('user_id', auth()->id())
            ->exists();

        // Kirim data kursus dan status rating ke view
        return view('dashboard-peserta.kursus-detail', compact('course', 'hasRated'));
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
    
        // Menghitung progress dan rating setiap kursus
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
    
            // Menghitung rata-rata rating untuk kursus ini
            $averageRating = RatingKursus::where('course_id', $course->id)->avg('stars');
            
            // Membatasi rating maksimal 5
            $averageRating = min($averageRating, 5);
    
            // Menyimpan rata-rata rating untuk kursus
            $course->average_rating = $averageRating;
            
            // Menghitung jumlah bintang penuh, setengah, dan kosong
            $fullStars = floor($averageRating); // Bintang penuh
            $halfStar = $averageRating - $fullStars >= 0.5; // Bintang setengah
            $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0); // Bintang kosong
    
            // Menyimpan jumlah bintang penuh, setengah, dan kosong untuk ditampilkan di view
            $course->rating_full_stars = $fullStars;
            $course->rating_half_star = $halfStar;
            $course->rating_empty_stars = $emptyStars;
        }
    
        // Kirim data kursus dengan progress, rating, dan status penyelesaian ke view
        return view('dashboard-peserta.welcome', compact('courses'));
    }
    

    public function chat() {
        return view('dashboard-peserta.chat');
    }

    public function kursus($id, $categoryId = null)
    {
        // Ambil data kursus
        $course = Course::findOrFail($id);
    
        // Ambil kategori jika $categoryId diberikan
        $category = $categoryId ? Category::findOrFail($categoryId) : null;
    
        // Cek apakah user sudah membeli kursus ini
        $hasPurchased = Payment::where('course_id', $course->id)
                                ->where('user_id', auth()->id())
                                ->where('transaction_status', 'success')
                                ->exists();
    
        // Ambil status pembayaran berdasarkan user yang login dan kursus yang dibeli
        $paymentStatus = null;
        if ($hasPurchased) {
            $course->is_purchased = true;
        } else {
            $payment = Payment::where('course_id', $course->id)
                                ->where('user_id', auth()->id())
                                ->first();
            if ($payment) {
                $paymentStatus = $payment->transaction_status;
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
        // Ambil kategori berdasarkan ID
        $category = Category::findOrFail($categoryId);
    
        // Ambil semua kursus berdasarkan kategori
        $courses = Course::where('category', $category->name)->get();
    
        // Iterasi setiap kursus untuk menghitung rating
        foreach ($courses as $course) {
            // Menghitung rata-rata rating untuk kursus ini
            $averageRating = RatingKursus::where('course_id', $course->id)->avg('stars');
    
            // Membatasi rating maksimal 5
            $averageRating = min($averageRating, 5);
    
            // Menyimpan rata-rata rating ke properti kursus
            $course->average_rating = $averageRating;
    
            // Menghitung jumlah bintang penuh, setengah, dan kosong
            $fullStars = floor($averageRating); // Bintang penuh
            $halfStar = $averageRating - $fullStars >= 0.5; // Bintang setengah
            $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0); // Bintang kosong
    
            // Menyimpan jumlah bintang untuk ditampilkan di view
            $course->rating_full_stars = $fullStars;
            $course->rating_half_star = $halfStar;
            $course->rating_empty_stars = $emptyStars;
        }
    
        // Return data ke view
        return view('dashboard-peserta.categories-detail', compact('category', 'courses'));
    }
    
}
