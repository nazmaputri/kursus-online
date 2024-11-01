<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardMentor\CourseController;
use App\Http\Controllers\DashboardAdmin\CategoryController;
use App\Models\Category;
use App\Models\Course;
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

    public function kursus()
    {
        $courses = Course::all(); 
        return view('dashboard-mentor.kursus', compact('courses')); 
    }

    public function materi() {
        return view('dashboard-mentor.materi');
    }

    public function quiz() {
        return view('dashboard-mentor.quiz');
    }

    public function tambahkursus() {
        $categories = Category::all(); // Mengambil semua kategori dari tabel categories
        return view('dashboard-mentor.tambah-kursus', compact('categories'));
    }

    public function tambahmateri() {
        return view('dashboard-mentor.tambah-materi');
    }

    public function tambahquiz() {
        return view('dashboard-mentor.tambah-quiz');
    }

    public function datapeserta() {
        $users = User::where ('role', 'student')->get(); 
        return view('dashboard-mentor.data-peserta', compact('users'));
    }

    public function laporan() {
        return view('dashboard-mentor.laporan');
    }
}
