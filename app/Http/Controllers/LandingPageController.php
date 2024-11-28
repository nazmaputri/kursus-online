<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function lp()
    {
        $courses = Course::all();
        $categories = Category::all();
        return view('welcome', compact('categories', 'courses'));
    }
}
