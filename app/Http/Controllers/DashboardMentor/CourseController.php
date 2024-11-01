<?php

namespace App\Http\Controllers\DashboardMentor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category; 
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // // Menampilkan form untuk membuat kursus baru
    // public function create()
    // {
    //     $categories = Category::all(); // Mengambil semua kategori dari tabel categories
    //     return view('dashboard-mentor.kursus', compact('categories')); // Mengirimkan kategori ke view
    // }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|integer',
            'price' => 'nullable|numeric',
            'capacity' => 'nullable|integer',
            'video_url' => 'nullable|url',
            'quiz' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'pdf_path' => 'nullable|file|mimes:pdf|max:2048',
        ]);
    
        // Ambil nama kategori dari tabel categories
        $category = Category::find($request->category_id);
    
        // Membuat instance Course dan mengisi data
        $course = new Course($request->only('title', 'description', 'price', 'capacity', 'video_url', 'quiz'));
        $course->category = $category->name; // Menyimpan nama kategori
    
        $course->mentor_id = auth()->user()->id; // ID mentor yang sedang login
    
        if ($request->hasFile('image')) {
            $course->image_path = $request->file('image')->store('images', 'public');
        }
    
        if ($request->hasFile('pdf_path')) {
            $course->pdf_path = $request->file('pdf_path')->store('pdfs', 'public');
        }
    
        $course->save();
    
        return redirect()->route('kursus-mentor')->with('success', 'Kursus berhasil ditambahkan!');
    }
}
