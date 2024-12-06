<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Course;
use App\Models\MateriVideo;
use App\Models\MateriPdf;
use App\Models\Rating;
use App\Models\Quiz;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function detail($id)
    {
        $course = Course::with(['mentor', 'category'])->findOrFail($id);
    
        return view('kursus-detail', compact('course'));
    }    

    public function category($name)
    {
        $category = Category::with(['courses' => function ($query) {
            $query->whereIn('status', ['approved', 'published']);
        }])->where('name', $name)->firstOrFail();

        $courses = $category->courses;
    
        return view('category-detail', compact('category', 'courses'));
    }
    
    public function lp()
    {
        $courses = Course::where('status', 'published')->get();
        
        foreach ($courses as $course) {
            $course->video_count = $course->videos()->count();
            $course->quiz_count = $course->quizzes()->count();
            $course->pdf_count = $course->pdfMaterials()->count();
        }        
        
        $categories = Category::all();
        $ratings = Rating::all();
        
        // Kirim data ke view
        return view('welcome', compact('categories', 'courses', 'ratings'));
    }
    
}
