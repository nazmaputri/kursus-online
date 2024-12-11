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
    public function submitQuiz(Request $request, $quizId)
    {
        $score = $request->input('score'); // Ambil skor dari request

        // Simpan hasil kuis di session
        session()->put("quiz_results.{$quizId}", [
            'score' => $score,
            'completed' => $score >= 70, // Selesai jika skor >= 70
        ]);

        return redirect()->route('course.show', $request->course_id)
                        ->with('success', 'Kuis telah diselesaikan!');
    }

    public function show($quizId)
    {
        $quiz = Quiz::with('questions.answers')->findOrFail($quizId);
        return view('dashboard-peserta.quiz', compact('quiz'));
    }

    public function detail($courseId, $materiId, $id)
    {
        // Ambil quiz berdasarkan ID
        $quiz = Quiz::findOrFail($id);

        // Ambil data course dan materi
        $course = Course::findOrFail($courseId);
        $materi = Materi::findOrFail($materiId);

        return view('dashboard-mentor.quiz-detail', compact('quiz', 'course', 'courseId', 'materiId', 'materi'));
    }

    public function result($quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        
        // Ambil skor, hasil, dan waktu mulai ujian dari session
        $score = session('score', null);
        $results = session('results', []);
        $startTime = session('start_time', null);
        
        // Ambil course terkait dengan quiz
        $course = $quiz->course; 
    
        if ($score === null || empty($results) || $startTime === null) {
            return redirect()->route('quiz.show', $quizId)->withErrors('Hasil kuis tidak ditemukan.');
        }
        
        return view('dashboard-peserta.quiz-result', compact('quiz', 'score', 'results', 'startTime', 'course'));
    }    

    public function submit(Request $request, $quizId)
    {
        \Log::info("Submit method called for Quiz ID: {$quizId}");
        \Log::info("Request data: ", $request->all());
    
        $quiz = Quiz::with('questions.answers', 'materi')->findOrFail($quizId);
        \Log::info("Quiz loaded: {$quiz->title}");
    
        $totalQuestions = $quiz->questions->count();
        $correctAnswers = 0;
    
        // Validasi bahwa semua pertanyaan telah dijawab
        $validatedData = $request->validate([
            'question_*' => 'required|integer|exists:answers,id',
        ]);
    
        $questionResults = []; // Untuk menyimpan hasil tiap soal
        foreach ($quiz->questions as $question) {
            $submittedAnswerId = $request->input("question_{$question->id}");
            $correctAnswer = $question->answers()->where('is_correct', true)->first();
    
            // Hitung jawaban benar
            $isCorrect = $submittedAnswerId == $correctAnswer->id;
            if ($isCorrect) {
                $correctAnswers++;
            }
    
            // Simpan hasil per soal
            $questionResults[] = [
                'question' => $question->question,
                'submitted_answer' => $question->answers->where('id', $submittedAnswerId)->first()->answer ?? null,
                'correct_answer' => $correctAnswer->answer,
                'is_correct' => $isCorrect,
            ];
        }
    
        $score = round(($correctAnswers / $totalQuestions) * 100, 2);
    
        // Ambil waktu mulai dari session
        $startTime = session("quiz_start_time.$quizId", now());
    
        // Mendapatkan ID materi yang terkait dengan kuis ini
        $materiId = $quiz->materi->id; // Misalkan ada relasi antara quiz dan materi
        $userId = auth()->id();
    
        // Simpan status penyelesaian ke tabel materi_user
        \DB::table('materi_user')->updateOrInsert(
            [
                'user_id' => $userId,
                'materi_id' => $materiId,
            ],
            [
                'completed_at' => now(),
                'updated_at' => now(),
            ]
        );
    
        // Simpan ID materi yang sudah dikerjakan di session
        $completedMateriIds = session()->get('completed_materi_ids', []);
        if (!in_array($materiId, $completedMateriIds)) {
            $completedMateriIds[] = $materiId;
        }
        session(['completed_materi_ids' => $completedMateriIds]);
    
        return redirect()->route('quiz.result', ['quiz' => $quizId])->with([
            'score' => $score,
            'results' => $questionResults,
            'start_time' => $startTime, // Simpan waktu mulai ujian
        ]);
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
