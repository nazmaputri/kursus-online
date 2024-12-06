<?php

namespace App\Http\Controllers\DashboardMentor;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Course;
use App\Models\Materi; 
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function show($courseId, $materiId, $quizId)
    {
        // Cari course berdasarkan ID, atau gagal jika tidak ditemukan
        $course = Course::findOrFail($courseId);
    
        // Cari materi berdasarkan ID, atau gagal jika tidak ditemukan
        $materi = Materi::findOrFail($materiId);
    
        // Cari quiz berdasarkan ID, atau gagal jika tidak ditemukan
        $quiz = Quiz::where('materi_id', $materiId)
                    ->where('id', $quizId)
                    ->firstOrFail();
    
        // Tampilkan view dengan data yang relevan
        return view('dashboard-mentor.quiz-detail', compact('quiz', 'course', 'materi'));
    }    

    public function create($courseId, $materiId)
    {
        $course = Course::findOrFail($courseId);
        $materi = Materi::findOrFail($materiId);

        return view('dashboard-mentor.quiz-create', compact('course', 'courseId', 'materiId', 'materi'));
    }

    public function store(Request $request, $courseId, $materiId)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|integer',
            'questions' => 'required|array|min:1',
            'questions.*.question' => 'required|string',
            'questions.*.answers' => 'required|array|min:4|max:4', // Harus tepat 4 jawaban
            'questions.*.correct_answer' => 'required|integer|min:0|max:3',
        ]);
    
        try {
            // Validasi course_id dan materi_id
            $course = Course::findOrFail($courseId);
            $materi = Materi::findOrFail($materiId);
    
            // Membuat kuis baru
            $quiz = Quiz::create([
                'title' => $request->title,
                'description' => $request->description,
                'course_id' => $course->id,
                'materi_id' => $materi->id,
                'duration' => $request->duration,
            ]);
    
            // Menyimpan soal dan jawaban
            foreach ($request->questions as $questionData) {
                $question = $quiz->questions()->create([
                    'question' => $questionData['question'],
                ]);
    
                foreach ($questionData['answers'] as $index => $answerText) {
                    $question->answers()->create([
                        'answer' => $answerText,
                        'is_correct' => $index == $questionData['correct_answer'], // Menetapkan jawaban yang benar
                    ]);
                }
            }
    
            return redirect()->route('materi.show', ['courseId' => $courseId, 'materiId' => $materiId])
                             ->with('success', 'Kuis berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    public function edit($courseId, $materiId, $id)
    {
        $course = Course::findOrFail($courseId);
        $materi = Materi::findOrFail($materiId);
        // Menampilkan form untuk mengedit kuis
        $quiz = Quiz::findOrFail($id); // Mengambil kuis berdasarkan ID

        return view('dashboard-mentor.quiz-edit', compact('quiz', 'course', 'courseId', 'materiId', 'materi'));
    }

    public function update(Request $request, $courseId, $materiId, $id)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|integer',
            'questions' => 'required|array|min:1',
            'questions.*.id' => 'nullable|integer|exists:questions,id',
            'questions.*.question' => 'required|string',
            'questions.*.answers' => 'required|array|min:4|max:4', // Harus tepat 4 jawaban
            'questions.*.correct_answer' => 'required|integer|min:0|max:3',
        ]);
    
        try {
            // Validasi course_id dan materi_id
            $course = Course::findOrFail($courseId);
            $materi = Materi::findOrFail($materiId);
    
            // Temukan kuis yang ingin diperbarui
            $quiz = Quiz::findOrFail($id);
    
            // Perbarui data kuis
            $quiz->update([
                'title' => $request->title,
                'description' => $request->description,
                'duration' => $request->duration,
            ]);
    
            // Ambil ID soal yang disertakan dalam permintaan
            $questionIds = collect($request->questions)->pluck('id')->filter()->toArray();
    
            // Hapus soal yang tidak ada di permintaan
            $quiz->questions()->whereNotIn('id', $questionIds)->delete();
    
            // Perbarui soal dan jawaban
            foreach ($request->questions as $index => $questionData) {
                // Jika `id` soal ada, perbarui; jika tidak, buat baru
                $question = isset($questionData['id'])
                    ? $quiz->questions()->findOrFail($questionData['id'])
                    : $quiz->questions()->create(['question' => $questionData['question']]);
    
                // Perbarui teks soal
                $question->update(['question' => $questionData['question']]);
    
                // Perbarui jawaban
                foreach ($questionData['answers'] as $answerIndex => $answerText) {
                    // Cari jawaban berdasarkan indeks
                    $answer = $question->answers()->firstOrNew(['index' => $answerIndex]);
    
                    $answer->fill([
                        'answer' => $answerText,
                        'is_correct' => $answerIndex == $questionData['correct_answer'],
                    ])->save();
                }
            }
    
            return redirect()->route('materi.show', ['courseId' => $courseId, 'materiId' => $materiId])
                             ->with('success', 'Kuis berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Terjadi kesalahan: ' . $e->getMessage());
        }
    }    

    public function destroy($courseId, $materiId, $id)
    {
        // Menghapus kuis berdasarkan ID
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();

        // Redirect kembali ke halaman daftar kuis
        return redirect()->route('materi.show', ['courseId' => $courseId, 'materiId' => $materiId])
                         ->with('success', 'Kuis berhasil dihapus');
    }
}
