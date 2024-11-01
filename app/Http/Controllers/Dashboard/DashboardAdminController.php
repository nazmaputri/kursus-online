<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index() {
        $users = User::all(); 
        return view('layouts.dashboard-admin');
    }

    public function mentor() {
        $users = User::where('role', 'mentor')->get(); 
        return view('dashboard-admin.data-mentor', compact('users'));
    }    

    public function peserta() {
        $users = User::where('role', 'student')->get(); 
        return view('dashboard-admin.data-peserta', compact('users'));
    }

    public function show() {
        return view('dashboard-admin.welcome');
    }

    public function kursus() {
        return view('dashboard-admin.daftar-kursus');
    }

    public function detailkursus() {
        return view('dashboard-admin.detail-kursus');
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

}
