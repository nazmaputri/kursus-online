<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index() {
        return view('layouts.dashboard-admin');
    }

    public function data() {
    $users = User::all(); 
    return view('dashboard-admin.data-user', compact('users'));

    }

    public function show() {
        return view('dashboard-admin.welcome');
    }

    public function laporan()
    {
        // Ambil data yang diperlukan untuk laporan
        $users = User::all(); 
        // $courses = Course::all(); 

        return view('dashboard-admin.laporan', compact('users'));
    }

}
