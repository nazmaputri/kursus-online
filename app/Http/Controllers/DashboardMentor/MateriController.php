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
        $quizzes = Quiz::where('materi_id', $materiId)->get();
    
        return view('dashboard-mentor.materi-detail', compact('materi', 'quizzes', 'courseId', 'materiId'));
    }
    
    public function store(Request $request, $courseId)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'courses_id' => 'required|exists:courses,id', 
            'videos.*' => 'file|mimes:mp4,avi,mkv|max:1024000', 
            'video_titles.*' => 'required|string|max:255', 
            'material_files.*' => 'file|mimes:pdf,doc,docx,ppt,pptx|max:10240', 
            'material_titles.*' => 'required|string|max:255', 
        ]);

        $course = Course::findOrFail($courseId);

        // Buat data materi dengan course_id yang sesuai
        $materi = Materi::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'courses_id' => $courseId, 
        ]);

        // Simpan video dan judul video
        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $index => $video) {
                $path = $video->store('images/videos', 'public');
                MateriVideo::create([
                    'materi_id' => $materi->id,
                    'video_url' => $path,
                    'judul' => $request->video_titles[$index], 
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
                ]);
            }
        }

        return redirect()->route('courses.show', ['course' => $courseId])->with('success', 'Materi berhasil ditambahkan');
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
            'deskripsi' => 'required|string',
            'video.*' => 'nullable|file|mimes:mp4,avi,mkv|max:1024000',  
            'pdf.*' => 'nullable|file|mimes:pdf|max:10240',  
        ]);
    
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
                $video = Video::find($videoId);
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

        // Tambahkan video baru jika ada
        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $video) {
                // Simpan video ke folder 'images/videos'
                $path = $video->store('images/videos', 'public');
                MateriVideo::create([
                    'materi_id' => $materi->id,
                    'video_url' => $path,
                ]);
            }
        }

        // Tambahkan PDF baru jika ada
        if ($request->hasFile('material_files')) {
            foreach ($request->file('material_files') as $file) {
                // Simpan PDF ke folder 'images/pdfs'
                $path = $file->store('images/pdfs', 'public');
                MateriPdf::create([
                    'materi_id' => $materi->id,
                    'pdf_file' => $path,
                ]);
            }
        }
      
        return redirect()->route('courses.show', ['course' => $courseId])->with('success', 'Materi berhasil diperbarui!');
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

        $materi->delete();

        return redirect()->route('courses.show', ['course' => $courseId])
            ->with('success', 'Materi beserta video dan PDF berhasil dihapus!');
    }   

}
