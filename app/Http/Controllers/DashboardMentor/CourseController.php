<?php

namespace App\Http\Controllers\DashboardMentor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use App\Models\Materi;
use App\Models\MateriVideo;
use App\Models\MateriPdf;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::paginate(5);
        return view('dashboard-mentor.kursus', compact('courses'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard-mentor.kursus-create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|integer',
            'price' => 'nullable|numeric',
            'capacity' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $category = Category::find($request->category);

        if (!$category) {
            return redirect()->back()->withErrors(['category' => 'Selected category does not exist.']);
        }

        $course = new Course($request->only('title', 'description', 'price', 'capacity'));
        $course->category = $category->name;
        $course->mentor_id = auth()->user()->id;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/kursus', 'public');
            $course->image_path = $path;  // Save the path in the database
        }

        $course->save();

        return redirect()->route('courses.index')->with('success', 'Kursus berhasil ditambahkan!');
    }
    
    public function show($id)
    {
        // Ambil data course beserta relasi materi yang terkait
        $course = Course::with('materi')->findOrFail($id);
        
        // Menggunakan pagination untuk menampilkan 5 materi per halaman
        $materi = $course->materi()->paginate(5);
        
        // Kembalikan data ke view
        return view('dashboard-mentor.kursus-detail', compact('course', 'materi'));
    }

    public function edit(Course $course)
    {
        $categories = Category::all();
        return view('dashboard-mentor.kursus-edit', compact('course', 'categories'));
    }

    public function update(Request $request, Course $course)
    {
        // Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|string|exists:categories,name', // Pastikan nama kategori valid
            'capacity' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048' // Validasi gambar
        ]);
    
        // Update data kursus
        $course->title = $validated['title'];
        $course->description = $validated['description'];
        $course->price = $validated['price'];
        $course->category = $validated['category']; // Simpan nama kategori langsung
        $course->capacity = $validated['capacity'] ?? null;
    
        // Periksa apakah ada gambar yang diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($course->image_path) {
                \Storage::disk('public')->delete($course->image_path);
            }
    
            // Simpan gambar baru
            $course->image_path = $request->file('image')->store('images/courses', 'public');
        }
    
        // Simpan perubahan ke database
        $course->save();
    
        // Redirect dengan pesan sukses
        return redirect()->route('courses.index')->with('success', 'Kursus berhasil diupdate.');
    }
    

    public function destroy(Course $course)
    {
        // Hapus gambar jika ada
        if ($course->image_path) {
            \Storage::delete('public/' . $course->image_path);
        }

        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Kursus berhasil dihapus.');
    }
}
