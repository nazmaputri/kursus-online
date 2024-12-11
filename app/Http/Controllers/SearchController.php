<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Course;
use App\Models\Category;
use App\Models\User;
use App\Models\Materi;
use App\Models\Rating;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'query' => 'required|string|min:1',
        ]);

        $query = $request->input('query');

        // Mencari di setiap model berdasarkan kolom tertentu
        $quizzes = Quiz::where('title', 'LIKE', "%{$query}%")->get();
        $courses = Course::where('title', 'LIKE', "%{$query}%")->get();
        $categories = Category::where('name', 'LIKE', "%{$query}%")->get();
        $users = User::where('name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->get();
        $materi = Materi::where('judul', 'LIKE', "%{$query}%")->get();
        $ratings = Rating::where('nama', 'LIKE', "%{$query}%")->get();

        // Menampilkan hasil di view
        return view('dashboard-peserta.search', compact(
            'query', 'quizzes', 'courses', 'categories', 'users', 'materi', 'ratings'
        ));
    }
}
