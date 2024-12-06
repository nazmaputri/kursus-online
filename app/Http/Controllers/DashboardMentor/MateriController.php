<?php

namespace App\Http\Controllers\DashboardMentor;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\MateriVideo;
use App\Models\MateriPdf;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function index()
    {
        $materi = Materi::with('videos', 'pdfs', 'course')->get();
        return view('dashboard-mentor.materi', compact('materi'));
    }

    public function create($courseId)
    {
        $course = Course::findOrFail($courseId);
    
        return view('dashboard-mentor.materi-create', compact('course'));
    }    

    public function show($courseId, $materiId)
    {
        $materi = Materi::with(['videos', 'pdfs', 'course'])->findOrFail($materiId);
        $course = Course::findOrFail($courseId);
        $quizzes = Quiz::where('materi_id', $materiId)->paginate(5);
    
        return view('dashboard-mentor.materi-detail', compact('materi', 'quizzes', 'courseId', 'materiId', 'course'));
    }
    
    public function store(Request $request, $courseId)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'videos.*' => 'file|mimes:mp4,avi,mkv|max:1024000', 
            'video_titles.*' => 'nullable|string|max:255', 
            'material_files.*' => 'file|mimes:pdf,doc,docx,ppt,pptx|max:10240', 
            'material_titles.*' => 'nullable|string|max:255', 
        ]);
        
        // Temukan kursus yang sesuai dengan ID yang diteruskan
        $course = Course::findOrFail($courseId);
    
        // Buat data materi dengan course_id yang sesuai
        $materi = Materi::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'courses_id' => $courseId, // Menyimpan course_id
        ]);
    
        // Simpan video dan judul video
        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $index => $video) {
                $path = $video->store('images/videos', 'public');
                MateriVideo::create([
                    'materi_id' => $materi->id,
                    'video_url' => $path,
                    'judul' => $request->video_titles[$index],
                    'course_id' => $courseId, // Menyimpan course_id pada materi video
                ]);
            }
        }
    
        // Simpan file materi dan judul materi PDF
        if ($request->hasFile('material_files')) {
            foreach ($request->file('material_files') as $index => $file) {
                $path = $file->store('images/pdfs', 'public');
                MateriPdf::create([
                    'materi_id' => $materi->id,
                    'pdf_file' => $path,
                    'judul' => $request->material_titles[$index],
                    'course_id' => $courseId,  // Menyimpan course_id pada materi pdf
                ]);
            }
        }
    
        // Kembali ke halaman kursus dengan pesan sukses
        return redirect()->route('courses.show', ['course' => $courseId])
                         ->with('success', 'Materi berhasil ditambahkan');
    }    
    
    public function edit($courseId, $materiId)
    {
        $course = Course::findOrFail($courseId);
        $materi = Materi::where('courses_id', $courseId)->findOrFail($materiId);
        $materi->load('videos', 'pdfs'); 
    
        return view('dashboard-mentor.materi-edit', compact('materi', 'course'));
    }

    public function update(Request $request, $courseId, $materiId)
    {
        // Validasi input
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'videos.*' => 'nullable|file|mimes:mp4,avi,mkv|max:1024000',
            'video_titles.*' => 'nullable|string|max:255',
            'material_files.*' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:10240',
            'material_titles.*' => 'nullable|string|max:255',
        ]);
    
        // Temukan kursus dan materi yang sesuai
        $course = Course::findOrFail($courseId);
        $materi = Materi::where('courses_id', $courseId)->findOrFail($materiId);
    
        // Update materi
        $materi->update([
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
        ]);
    
        // Hapus video lama jika ada
        if ($request->has('remove_video')) {
            foreach ($request->remove_video as $videoId) {
                $video = MateriVideo::find($videoId);
                if ($video) {
                    // Menghapus file video dari storage
                    if (Storage::exists('public/' . $video->video_url)) {
                        Storage::delete('public/' . $video->video_url);
                    }
                    // Menghapus record video dari database
                    $video->delete();
                }
            }
        }
    
        // Hapus PDF lama jika ada
        if ($request->has('remove_pdf')) {
            foreach ($request->remove_pdf as $pdfId) {
                $pdf = MateriPdf::find($pdfId);
                if ($pdf) {
                    // Menghapus file PDF dari storage
                    if (Storage::exists('public/' . $pdf->pdf_file)) {
                        Storage::delete('public/' . $pdf->pdf_file);
                    }
                    // Menghapus record PDF dari database
                    $pdf->delete();
                }
            }
        }
    
        // Update video yang ada jika judulnya diubah
        if ($request->has('video_titles') && is_array($request->video_titles)) {
            foreach ($request->video_titles as $index => $newTitle) {
                $video = MateriVideo::where('materi_id', $materi->id)
                    ->where('course_id', $courseId)
                    ->skip($index)
                    ->first();
                if ($video) {
                    $video->update(['judul' => $newTitle]);  // Update judul video
                }
            }
        }
    
        // Update PDF yang ada jika judulnya diubah
        if ($request->has('material_titles') && is_array($request->material_titles)) {
            foreach ($request->material_titles as $index => $newTitle) {
                $pdf = MateriPdf::where('materi_id', $materi->id)
                    ->where('course_id', $courseId)
                    ->skip($index)
                    ->first();
                if ($pdf) {
                    $pdf->update(['judul' => $newTitle]);  // Update judul PDF
                }
            }
        }
    
        // Tambahkan video baru jika ada
        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $index => $video) {
                $path = $video->store('images/videos', 'public');
                MateriVideo::create([
                    'materi_id' => $materi->id,
                    'video_url' => $path,
                    'judul' => $request->video_titles[$index] ?? '',
                    'course_id' => $courseId,
                ]);
            }
        }
    
        // Tambahkan PDF baru jika ada
        if ($request->hasFile('material_files')) {
            foreach ($request->file('material_files') as $index => $file) {
                $path = $file->store('images/pdfs', 'public');
                MateriPdf::create([
                    'materi_id' => $materi->id,
                    'pdf_file' => $path,
                    'judul' => $request->material_titles[$index] ?? '',
                    'course_id' => $courseId,
                ]);
            }
        }
    
        // Redirect dengan pesan sukses
        return redirect()->route('courses.show', ['course' => $courseId])
                         ->with('success', 'Materi berhasil diperbarui!');
    }
    
    

    public function destroy($courseId, $materiId)
    {
        $materi = Materi::findOrFail($materiId);
    
        // Hapus video terkait
        foreach ($materi->videos as $video) {
            if (Storage::disk('public')->exists($video->video_url)) {
                Storage::disk('public')->delete($video->video_url);
            }
            $video->delete();
        }
    
        // Hapus PDF terkait
        foreach ($materi->pdfs as $pdf) {
            if (Storage::disk('public')->exists($pdf->pdf_file)) {
                Storage::disk('public')->delete($pdf->pdf_file);
            }
            $pdf->delete();
        }
    
        // Hapus materi
        $materi->delete();
    
        return redirect()->route('courses.show', ['course' => $courseId])
            ->with('success', 'Materi beserta video dan PDF berhasil dihapus!');
    }    


}
