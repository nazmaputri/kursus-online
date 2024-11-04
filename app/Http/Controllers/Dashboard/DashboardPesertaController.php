<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardMentor\CourseController;
use App\Http\Controllers\DashboardAdmin\CategoryController;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;

class DashboardPesertaController extends Controller
{
    public function index() {
        return view('layouts.dashboard-peserta');
    }

    public function show() {
        $categories = Category::all(); 
        return view('dashboard-peserta.welcome', compact('categories'));
    }

    public function chat() {
        return view('dashboard-peserta.chat');
    }

    public function kursus() {
        $categories = Category::all(); 
        return view('dashboard-peserta.kursus', compact('categories'));
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
        $categories = Category::all(); 
        return view('dashboard-peserta.categories', compact('categories'));
    }
}
