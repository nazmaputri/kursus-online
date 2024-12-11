<?php

namespace App\Http\Controllers\DashboardMentor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use App\Models\Materi;
use App\Models\MateriVideo;
use App\Models\MateriPdf;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        // Validasi data yang dikirimkan
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|integer',
            'price' => 'required|numeric',
            'capacity' => 'nullable|integer',
            'chat' => 'nullable|boolean', // Validasi chat
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'start_date' => 'nullable|date|before_or_equal:end_date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);
    
        // Cari kategori berdasarkan ID
        $category = Category::find($request->category);
    
        if (!$category) {
            return redirect()->back()->withErrors(['category' => 'Selected category does not exist.']);
        }
    
        // Buat instance baru untuk kursus
        $course = new Course($request->only('title', 'description', 'price', 'capacity', 'start_date', 'end_date'));
    
        // Menyimpan kategori dan mentor
        $course->category = $category->name;
        $course->mentor_id = auth()->user()->id;
    
        // Simpan status chat (gunakan boolean untuk memastikan nilainya benar)
        $course->chat = $request->boolean('chat');
    
        // Simpan gambar jika diunggah
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/kursus', 'public');
            $course->image_path = $path; // Simpan path gambar ke database
        }
    
        // Simpan data ke database
        $course->save();
    
        // Redirect ke halaman kursus dengan pesan sukses
        return redirect()->route('courses.index')->with('success', 'Kursus berhasil ditambahkan!');
    }
    
    
    public function show($id)
    {
        // Ambil data course beserta relasi materi yang terkait
        $course = Course::with('materi')->findOrFail($id);
        
        // Menggunakan pagination untuk menampilkan 5 materi per halaman
        $materi = $course->materi()->paginate(5);
        
        // Ambil peserta yang pembayaran kursusnya lunas
        $participants = Payment::where('course_id', $id)
        ->where('transaction_status', 'success') 
        ->with('user') 
        ->paginate(5); 
    
        // Kembalikan data ke view
        return view('dashboard-mentor.kursus-detail', compact('course', 'materi', 'participants'));
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
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Validasi gambar
            'start_date' => 'nullable|date|after_or_equal:today', // Validasi start_date tidak boleh di masa lalu
            'end_date' => 'nullable|date|after_or_equal:start_date', // Validasi end_date harus setelah start_date
            'chat' => 'nullable|boolean', // Validasi status chat, bisa null atau boolean
        ]);
    
        // Update data kursus
        $course->title = $validated['title'];
        $course->description = $validated['description'];
        $course->price = $validated['price'];
        $course->category = $validated['category']; // Simpan nama kategori langsung
        $course->capacity = $validated['capacity'] ?? null;
        $course->start_date = $validated['start_date']; // Update start_date
        $course->end_date = $validated['end_date']; // Update end_date
    
        // Perbarui status fitur chat jika ada di request
        $course->chat = $validated['chat'] ?? false; // Default ke false jika tidak ada input chat
    
        // Periksa apakah ada gambar yang diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($course->image_path) {
                \Storage::disk('public')->delete($course->image_path);
            }
    
            // Simpan gambar baru
            $course->image_path = $request->file('image')->store('images/kursus', 'public');
        }
    
        // Simpan perubahan ke database
        $course->save();
    
        // Redirect dengan pesan sukses
        return redirect()->route('courses.index')->with('success', 'Kursus berhasil diupdate!');
    }
    
    
    public function destroy(Course $course)
    {
        // Menghapus gambar kursus jika ada
        if ($course->image_path && Storage::disk('public')->exists($course->image_path)) {
            Storage::disk('public')->delete($course->image_path);
        }
    
        // Memeriksa apakah ada materi terkait dengan kursus
        if ($course->materi) {
            // Menghapus semua materi terkait dengan kursus
            foreach ($course->materi as $materi) {
                // Menghapus file video terkait jika ada
                if ($materi->videos) {
                    foreach ($materi->videos as $video) {
                        if (Storage::disk('public')->exists($video->video_url)) {
                            Storage::disk('public')->delete($video->video_url);
                        }
                        $video->delete();
                    }
                }
                
                // Hapus PDF terkait jika ada
                if ($materi->pdfs) {
                    foreach ($materi->pdfs as $pdf) {
                        if (Storage::disk('public')->exists($pdf->pdf_file)) {
                            Storage::disk('public')->delete($pdf->pdf_file);
                        }
                        $pdf->delete();
                    }
                }
                
                // Memeriksa apakah ada kuis yang terkait dengan materi
                if ($materi->quizzes) {
                    foreach ($materi->quizzes as $quiz) {
                        // Menghapus soal dan jawaban kuis
                        $quiz->questions->each(function($question) {
                            // Hapus jawaban soal jika ada
                            $question->answers->each(function($answer) {
                                $answer->delete();
                            });
                            $question->delete();
                        });
    
                        $quiz->delete();  // Menghapus kuis itu sendiri
                    }
                }
    
                // Menghapus materi
                $materi->delete();
            }
        }
    
        // Menghapus kursus
        $course->delete();
    
        return redirect()->route('courses.index')->with('success', 'Kursus beserta materi dan kuis berhasil dihapus!');
    }
    
    
    
}
