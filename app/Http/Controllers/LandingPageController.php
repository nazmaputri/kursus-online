<?php

namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function lp()
    {
        $courses = Course::all(); // Ambil semua data kursus dari tabel courses
        return view('welcome', compact('courses'));
    }
}
