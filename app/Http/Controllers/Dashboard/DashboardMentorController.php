<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardMentorController extends Controller
{
    public function index() {
        return view('layouts.dashboard-mentor');
    }

    public function show() {
        return view('dashboard-mentor.welcome');
    }

    public function chat() {
        return view('dashboard-mentor.chat');
    }

    public function kursus() {
        return view('dashboard-mentor.kursus');
    }

    public function datapeserta() {
        $users = User::where('role', 'student')->get(); 
        return view('dashboard-mentor.data-peserta', compact('users'));
    }

    public function laporan() {
        return view('dashboard-mentor.laporan');
    }
}
