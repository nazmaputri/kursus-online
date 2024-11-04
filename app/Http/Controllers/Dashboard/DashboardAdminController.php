<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardMentor\CourseController;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
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

    public function kursus() {
        $courses = Course::all();
        return view('dashboard-admin.daftar-kursus', compact('courses'));
    }

    public function detailkursus($id) {
        $course = Course::findOrFail($id);
        return view('dashboard-admin.detail-kursus', compact('course'));
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
