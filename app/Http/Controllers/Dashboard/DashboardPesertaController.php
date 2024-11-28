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

    public function kursus($id) {
        $course = Course::findOrFail($id);
        return view('dashboard-peserta.kursus', compact('course'));
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

    public function video() {
        return view('dashboard-peserta.video');
    }

    public function quiz() {
        return view('dashboard-peserta.quiz');
    }

    public function kategori() {
        $categories = Category::paginate(4);
        return view('dashboard-peserta.categories', compact('categories'));
    }

    public function showCategoryDetail($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $courses = Course::where('category', $category->name)->get();

        return view('dashboard-peserta.categories-detail', compact('category', 'courses'));
    }
}
