<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardMentor\CourseController;
use App\Models\Course;
use App\Models\Category;
use App\Models\User;
use App\Models\Role;
use App\Models\Rating;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Mail\HelloMail;
use Illuminate\Support\Facades\Mail;

class DashboardAdminController extends Controller
{
    public function approve($id, $name)
    {
        $course = Course::findOrFail($id);
        $course->status = 'approved';
        $course->save();
    
        return redirect()->route('categories.show', $name)->with('success', 'Kursus disetujui!');
    }    

    public function publish($id, $name)
    {
        $course = Course::findOrFail($id);
        $course->status = 'published';
        $course->save();

        return redirect()->route('categories.show', $name)->with('success', 'Kursus dipublikasikan!');
    }

    public function rating()
    {
        $ratings = Rating::paginate(6); 

        return view('dashboard-admin.rating', compact('ratings'));
    }

    public function displayRating($id)
    {
        $ratings = Rating::findOrFail($id);  
        if (!$ratings) {
            // Jika rating tidak ditemukan, redirect ke halaman sebelumnya dengan pesan error
            return redirect()->route('rating-admin')->with('error', 'Rating tidak ditemukan');
        }
        return view('components.rating', compact('ratings'));  
    }

    public function index() {
        $users = User::all(); 
        return view('layouts.dashboard-admin');
    }

    public function detailmentor($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard-admin.detail-mentor', compact('user'));
    }

    public function mentor() {
        // Mengambil data mentor dengan pagination 5 per halaman
        $users = User::where('role', 'mentor')->paginate(5);
    
        // Mengirim data mentor ke view
        return view('dashboard-admin.data-mentor', compact('users'));
    }      

    public function detailpeserta($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard-admin.detail-peserta', compact('user'));
    }

    public function peserta() {
        $users = User::where('role', 'student')->get(); 
        return view('dashboard-admin.data-peserta', compact('users'));
    }

    public function show() {
        $jumlahMentor = User::where('role', 'mentor')->count();
        $jumlahPeserta = User::where('role', 'student')->count(); 
        $jumlahKursus = Course::count();

        return view('dashboard-admin.welcome', [
            'jumlahMentor' => $jumlahMentor,
            'jumlahPeserta' => $jumlahPeserta,
            'jumlahKursus' => $jumlahKursus,
        ]);
    }

    public function detailkursus($id, $name) {
        $category = Category::with('courses')->where('name', $name)->firstOrFail();
        $course = Course::findOrFail($id);

        return view('dashboard-admin.detail-kursus', compact('course', 'category'));
    }

    public function updateStatus($id)
    {
        $user = User::findOrFail($id);

        // Periksa apakah status saat ini 'pending'
        if ($user->status === 'pending') {
            // Ubah status menjadi 'active'
            $user->status = 'active';
            $user->save();

            // Kirim email ke user
            Mail::to($user->email)->send(new HelloMail($user->name));

            return redirect()->back()->with('success', 'User status updated to active and email has been sent.');
        }

        return redirect()->back()->with('info', 'User is already active.');
    }
    
    public function laporan()
    {
        // Ambil data jumlah pengguna yang mendaftar setiap bulan
        $userGrowth = User::select(
                            DB::raw('MONTH(created_at) as month'),
                            DB::raw('YEAR(created_at) as year'),
                            DB::raw('COUNT(*) as user_count')
                        )
                        ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
                        ->orderBy(DB::raw('YEAR(created_at), MONTH(created_at)'), 'asc')
                        ->get();
        
        // Nama bulan
        $monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        
        // Format data untuk grafik, inisialisasi dengan 0 untuk setiap bulan
        $userGrowthData = array_fill(0, 12, 0);  // Array dengan 12 bulan, semua nilai awal 0
        
        // Isi data pengguna yang terdaftar di bulan yang sesuai
        foreach ($userGrowth as $data) {
            $userGrowthData[$data->month - 1] = $data->user_count; // Month-1 untuk indexing dari 0
        }
    
        return view('dashboard-admin.laporan', compact('userGrowthData', 'monthNames'));
    }
    

    public function destroy($id)
    {
        // Cari user berdasarkan ID
        $user = User::findOrFail($id);

        // Hapus user
        $user->delete();

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('datamentor-admin')->with('success', 'User berhasil dihapus.');
    }

}
