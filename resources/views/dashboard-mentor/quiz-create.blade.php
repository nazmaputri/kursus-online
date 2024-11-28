@extends('layouts.dashboard-mentor')

@section('content')
<div class="container mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <!-- Judul Halaman -->
        <h2 class="text-2xl uppercase font-bold mb-6 text-center border-b-2 border-gray-300 pb-4">Tambah Kuis Baru</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Tambah Kuis -->
        <form action="{{ route('quiz.store', ['courseId' => $courseId, 'materiId' => $materiId]) }}" method="POST" class="space-y-6">
            @csrf
            <!-- Input untuk Judul Kuis -->
            <div>
                <label for="title" class="block text-gray-700 font-bold mb-2">Judul Kuis</label>
                <input type="text" name="title" id="title" class="w-full p-2 border rounded" placeholder="Masukkan judul kuis" required>
            </div>
        
            <!-- Input untuk Deskripsi Kuis -->
            <div>
                <label for="description" class="block text-gray-700 font-bold mb-2">Deskripsi</label>
                <textarea name="description" id="description" rows="5" class="w-full p-2 border rounded" placeholder="Masukkan deskripsi kuis" required></textarea>
            </div>
        
            <!-- Input untuk Waktu Pengerjaan Kuis -->
            <div>
                <label for="duration" class="block text-gray-700 font-bold mb-2">Durasi (menit)</label>
                <input type="number" name="duration" id="duration" class="w-full p-2 border rounded" placeholder="Masukkan durasi kuis (menit)" min="1" required>
            </div>
        
            <!-- Daftar Soal Dinamis -->
            <div id="questions-container">
                <h3 class="text-xl font-semibold mb-4">Soal dan Jawaban</h3>
        
                <!-- Soal Template (untuk cloning) -->
                <template id="question-template">
                    <div class="question-item border p-4 mb-4 rounded bg-gray-50">
                        <!-- Menampilkan Nomor Soal -->
                        <div class="mb-3">
                            <span class="text-lg font-semibold">Soal <span class="question-number"></span></span>
                        </div>
        
                        <!-- Input Pertanyaan -->
                        <div class="mb-3">
                            <label class="block text-gray-700 font-bold mb-2">Soal</label>
                            <input type="text" name="questions[0][question]" class="w-full p-2 border rounded question-input" placeholder="Masukkan teks soal" required>
                        </div>
        
                        <!-- Input Jawaban Pilihan Ganda -->
                        <div class="answers-container">
                            <label class="block text-gray-700 font-bold mb-2">Jawaban Pilihan Ganda</label>
                            @for ($i = 0; $i < 4; $i++)
                                <div class="flex items-center mb-2">
                                    <input type="radio" name="questions[0][correct_answer]" value="{{ $i }}" class="mr-2 answer-radio" required>
                                    <input type="text" name="questions[0][answers][]" class="w-full p-2 border rounded answer-input" placeholder="Masukkan jawaban" required>
                                </div>
                            @endfor
                        </div>
        
                        <!-- Tombol Hapus Soal -->
                        <button type="button" onclick="removeQuestion(this)" class="text-red-600 hover:text-red-800 font-semibold mt-2">Hapus Soal</button>
                    </div>
                </template>
        
                <!-- Container untuk Soal-soal -->
                <div id="question-list"></div>
        
                <!-- Tombol Tambah Soal -->
                <button type="button" onclick="addQuestion()" class="mt-4 bg-green-400 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                    Tambah Soal
                </button>
            </div>
        
            <!-- Tombol Submit -->
            <div class="mt-6 flex justify-end space-x-2">
                <button type="submit" class="bg-sky-400 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded">
                    Simpan Kuis
                </button>
                <a href="{{ route('courses.index') }}" class="bg-red-400 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                    Batal
                </a>
            </div>
        </form>
        
    </div>
</div>

<script>
    let questionCounter = 0;

    function addQuestion() {
        const template = document.getElementById('question-template').content.cloneNode(true);
        const questionList = document.getElementById('question-list');
        const newIndex = questionCounter++;

        template.querySelector('.question-number').textContent = newIndex + 1;

        template.querySelectorAll('.question-input, .answer-input, .answer-radio').forEach(el => {
            if (el.classList.contains('question-input')) {
                el.name = `questions[${newIndex}][question]`;
            } else if (el.classList.contains('answer-radio')) {
                el.name = `questions[${newIndex}][correct_answer]`;
            } else {
                el.name = `questions[${newIndex}][answers][]`;
            }
        });

        questionList.appendChild(template);
    }

    function removeQuestion(element) {
        element.closest('.question-item').remove();
    }
</script>
@endsection
