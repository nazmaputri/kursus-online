<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardPesertaController extends Controller
{
    public function index() {
        return view('layouts.dashboard-peserta');
    }

    public function show() {
        return view('dashboard-peserta.welcome');
    }

    public function chat() {
        return view('dashboard-peserta.chat');
    }

    public function kursus() {
        return view('dashboard-peserta.kursus');
    }

    public function study() {
        return view('dashboard-peserta.study');
    }

    public function daftar() {
        return view('dashboard-peserta.daftar');
    }

    public function detail() {
        return view('dashboard-peserta.detail');
    }

    public function kategori() {
        return view('dashboard-peserta.categories');
    }
}
