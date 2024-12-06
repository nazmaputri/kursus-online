<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardMentor\CourseController;
use App\Models\Course;
use App\Models\Category;
use App\Models\User;
use App\Models\Rating;
use Illuminate\Http\Request;

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
        $users = User::where('role', 'mentor')->get(); 
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

            return redirect()->back()->with('success', 'User status updated to active.');
        }

        return redirect()->back()->with('info', 'User is already active.');
    }

    public function laporan()
    {
        // Ambil data yang diperlukan untuk laporan
        $users = User::all(); 
        // $courses = Course::all(); 

        return view('dashboard-admin.laporan', compact('users'));
    }

    // Metode untuk menghapus pengguna
    public function destroy($id)
    {
        // Temukan pengguna berdasarkan ID
        $user = User::find($id);

        // Cek apakah pengguna ditemukan
        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }

        // Hapus pengguna
        $user->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('datapeserta-admin')->with('success', 'User berhasil dihapus.');
    }

}
