<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardMentor\CourseController;
use App\Http\Controllers\DashboardAdmin\CategoryController;
use App\Models\Category;
use App\Models\Course;
use App\Models\Materi;
use App\Models\User;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DashboardMentorController extends Controller
{
    public function index() {
        return view('layouts.dashboard-mentor');
    }

    public function show()
    {
        $jumlahPeserta = User::count(); 
        $jumlahKursus = Course::count(); 
        $jumlahMateri = Materi::count(); 
    
        // Mengirimkan data ke view
        return view('dashboard-mentor.welcome', compact('jumlahPeserta', 'jumlahKursus', 'jumlahMateri'));
    }
    

    public function materi() {
        return view('dashboard-mentor.materi');
    }


    public function tambahmateri() {
        return view('dashboard-mentor.materi-create');
    }

    public function datapeserta() {
        $users = User::where ('role', 'student')->get(); 
        return view('dashboard-mentor.data-peserta', compact('users'));
    }

    public function laporan()
    {
        // Ambil data pendapatan bulanan dari tabel `payments`
        $payments = DB::table('payments')
            ->selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->where('transaction_status', 'pending') // Hanya transaksi sukses
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

        return view('dashboard-mentor.laporan', compact('revenueData', 'months'));
    }

}
