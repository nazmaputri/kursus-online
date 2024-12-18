<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Course;
use App\Models\MateriVideo;
use App\Models\MateriPdf;
use App\Models\Rating;
use App\Models\RatingKursus;
use App\Models\Quiz;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function detail($id)
    {
        $ratings = RatingKursus::where('course_id', $id)->with('user')->get();
        $course = Course::with(['mentor', 'category'])->findOrFail($id);
    
        return view('kursus-detail', compact('course', 'ratings'));
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

        // Menghitung rating rata-rata untuk setiap kursus dari tabel rating_kursus
        foreach ($courses as $course) {
            $course->video_count = $course->videos()->count();
            $course->quiz_count = $course->quizzes()->count();
            $course->pdf_count = $course->pdfMaterials()->count();
            
            // Menghitung rata-rata rating dan membatasi maksimal 5
            $averageRating = RatingKursus::where('course_id', $course->id)->avg('stars');
            $course->average_rating = min($averageRating, 5);  // Membatasi nilai rating maksimal 5 
        }

        $categories = Category::all();
        $ratings = Rating::all();
        
        // Kirim data ke view
        return view('welcome', compact('categories', 'courses', 'ratings'));
    }

}
