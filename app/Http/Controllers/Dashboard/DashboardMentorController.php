<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardMentor\CourseController;
use App\Http\Controllers\DashboardAdmin\CategoryController;
use App\Models\Category;
use App\Models\Course;
use App\Models\Materi;
use App\Models\User;
use App\Models\RatingKursus;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class DashboardMentorController extends Controller
{
    public function index() {
        $mentorId = Auth::id();
        return view('layouts.dashboard-mentor');
    }

    public function rating()
    {
        $mentorId = Auth::id();
        $courses = Course::where('mentor_id', $mentorId)->get(); // Filter kursus berdasarkan mentor yang login
        return view('dashboard-mentor.rating', compact('courses'));
    }    

    public function ratingDetail($id)
    {
        $mentorId = Auth::id();
        $course = Course::where('id', $id)->where('mentor_id', $mentorId)->firstOrFail(); // Pastikan kursus milik mentor
        $ratings = RatingKursus::where('course_id', $id)->with('user')->get(); // Ambil rating kursus

        return view('dashboard-mentor.rating-detail', compact('course', 'ratings'));
    }

    public function show()
    {
        // Ambil ID mentor yang sedang login
        $mentorId = Auth::id();
    
        // Menghitung jumlah peserta unik dengan status pembayaran 'success' untuk kursus mentor
        $jumlahPeserta = Payment::where('transaction_status', 'success')
            ->whereHas('course', function ($query) use ($mentorId) {
                $query->where('mentor_id', $mentorId);
            })
            ->distinct('user_id')
            ->count('user_id'); 
    
        // Menghitung jumlah kursus milik mentor
        $jumlahKursus = Course::where('mentor_id', $mentorId)->count(); 
    
        // Menghitung jumlah materi yang terkait dengan kursus mentor
        $jumlahMateri = Materi::whereHas('course', function ($query) use ($mentorId) {
                $query->where('mentor_id', $mentorId);
            })
            ->count(); 
    
        // Mengirimkan data ke view
        return view('dashboard-mentor.welcome', compact('jumlahPeserta', 'jumlahKursus', 'jumlahMateri'));
    }    
   
    public function tambahmateri() {
        $mentorId = Auth::id();
        return view('dashboard-mentor.materi-create');
    }

    public function datapeserta() {
        $mentorId = Auth::id();
        $users = User::where ('role', 'student')->get(); 
        return view('dashboard-mentor.data-peserta', compact('users'));
    }

    public function laporan(Request $request)
    {
        $mentorId = Auth::id();
        $currentYear = $request->input('year', date('Y')); // Ambil tahun dari URL atau gunakan tahun sekarang sebagai default
    
        // Ambil data pendapatan bulanan berdasarkan kursus mentor dan tahun yang dipilih
        $payments = DB::table('payments')
            ->join('courses', 'payments.course_id', '=', 'courses.id') // Gabungkan dengan tabel courses
            ->selectRaw('MONTH(payments.created_at) as month, SUM(payments.amount) as total')
            ->where('courses.mentor_id', $mentorId) // Filter berdasarkan mentor yang login
            ->where('payments.transaction_status', 'success') // Hanya transaksi sukses
            ->whereYear('payments.created_at', $currentYear) // Filter berdasarkan tahun
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    
        // Siapkan data untuk grafik
        $months = collect(range(1, 12))->map(function ($month) {
            return Carbon::create()->month($month)->format('F'); // Nama bulan
        });
    
        $revenueData = $months->map(function ($monthName, $index) use ($payments) {
            $payment = $payments->firstWhere('month', $index + 1);
            return $payment ? $payment->total : 0; // Isi dengan 0 jika tidak ada data
        });
    
        $years = range(date('Y'), date('Y') - 2); // Tahun saat ini hingga 2 tahun terakhir
    
        return view('dashboard-mentor.laporan', compact('revenueData', 'months', 'years', 'currentYear'));
    }    

}
