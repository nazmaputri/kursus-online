<?php

namespace App\Http\Controllers\DashboardMentor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // public function index()
    // {
    //     $courses = Course::all(); // Anda dapat menambahkan metode paginate() jika ingin membagi halaman
    //     return view('dashboard-mentor.kursus', compact('courses')); // Ganti dengan path view yang sesuai
    // }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|integer', // Adjusted to match your schema
            'price' => 'nullable|numeric',
            'capacity' => 'nullable|integer',
            'video_url' => 'nullable|url',
            'quiz' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Add image validation
            'pdf_path' => 'nullable|file|mimes:pdf|max:2048', // PDF validation
        ]);

        // Membuat instance Course dan mengisi data
        $course = new Course($request->all());

        // Menetapkan instructor_id ke ID pengguna yang sedang login
        $course->mentor_id = auth()->user()->id; // Pastikan Anda menggunakan ID pengguna yang benar

        // Mengupload gambar jika ada
        if ($request->hasFile('image')) {
            $course->image_path = $request->file('image')->store('images', 'public'); // Store in public disk
        }

        // Mengupload PDF jika ada
        if ($request->hasFile('pdf_path')) {
            $course->pdf_path = $request->file('pdf_path')->store('pdfs', 'public'); // Store in public disk
        }

        $course->save();

        return redirect()->route('kursus-mentor')->with('success', 'Kursus berhasil ditambahkan!');
    }
}
