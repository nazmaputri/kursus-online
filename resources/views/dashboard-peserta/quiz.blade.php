@extends('layouts.dashboard-peserta')

@section('content')
<div class="container mx-auto">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden p-6">
        <div class="flex flex-wrap justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold">{{ $quiz->title }}</h1>
                <p class="text-gray-600 text-sm">{{ $quiz->course->title }}</p>
            </div>
            <div id="timer" class="mt-2 text-xl font-semibold border py-2 px-4 text-red-500"></div>
        </div>
        
        <!-- Wrapper Responsif -->
        <div class="flex flex-col md:flex-row gap-4 mt-6">
            <!-- Nomor Soal -->
            <div class="md:w-1/4 bg-neutral-50 p-4 rounded border">
                <h2 class="font-bold mb-2">Nomor Soal</h2>
                <div class="grid grid-cols-5 gap-2">
                    @foreach($quiz->questions as $key => $question)
                    <button
                        class="question-number border border-gray-300 rounded p-2 text-center hover:bg-blue-400 hover:text-white transition flex items-center justify-center"
                        data-question-id="{{ $question->id }}"
                        data-answered="false">
                        {{ $key + 1 }}
                    </button>
                    @endforeach
                </div>
            </div>            
        
            <!-- Soal dan Jawaban -->
            <div class="md:w-3/4 bg-white p-6 rounded shadow border">
                <form id="quiz-form" action="{{ route('quiz.submit', $quiz->id) }}" method="POST">
                    @csrf
                    <div id="question-container">
                        @foreach($quiz->questions as $key => $question)
                        <div
                            class="question {{ $key === 0 ? '' : 'hidden' }} space-y-2"
                            data-question-id="{{ $question->id }}">
                            <p class="font-bold mb-4">{{ $question->question }}</p>
                            @foreach($question->answers as $answer)
                            <div>
                                <label>
                                    <input type="radio" name="question_{{ $question->id }}" value="{{ $answer->id }}" required>
                                    {{ $answer->answer }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-6 flex justify-between space-x-2">
                        <button type="button" id="prev-btn" class="hidden border  hover:bg-neutral-100/50 font-semibold text-white px-4 py-2 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="w-4 h-4">
                                <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/>
                            </svg>
                        </button>
                        <button type="button" id="next-btn" class="border hover:bg-neutral-100/50 font-semibold text-white px-4 py-2 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="w-4 h-4">
                                <path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/>
                            </svg>
                        </button>
                        <button type="submit" id="submit-btn"
                            class="hidden bg-blue-400 shadow-md shadow-blue-200 text-white hover:shadow-none hover:bg-blue-600 font-semibold px-4 py-2 rounded">
                            Kirim
                        </button>
                    </div>
                </form>
            </div>
        </div>        

        <!-- Pop-up Validasi -->
        <div id="confirmation-popup" class="fixed inset-0 bg-gray-800 bg-opacity-75 z-50 hidden">
            <div class="absolute inset-0 flex justify-center items-center">
                <div class="bg-white p-6 rounded shadow-lg">
                    <h3 class="text-lg font-semibold">Yakin ingin mengirim kuis ini?</h3>
                    <div class="flex justify-center space-x-3 mt-4">
                        <button id="confirm-submit" class="bg-red-500 text-white px-4 py-2 rounded">Ya</button>
                        <button id="cancel-submit" class="bg-gray-500 text-white px-4 py-2 rounded">Tidak</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Variabel utama
                let currentQuestion = 0;
                const questions = document.querySelectorAll('.question');
                const totalQuestions = questions.length;
        
                const prevBtn = document.getElementById('prev-btn');
                const nextBtn = document.getElementById('next-btn');
                const submitBtn = document.getElementById('submit-btn');
                const timerElement = document.getElementById('timer');
                const popup = document.getElementById('confirmation-popup');
                const confirmSubmit = document.getElementById('confirm-submit');
                const cancelSubmit = document.getElementById('cancel-submit');
        
                const questionNumbers = document.querySelectorAll('.question-number');
        
                const quizDuration = {{ $quiz->duration * 60 }}; // Durasi kuis dalam detik
                let remainingTime = quizDuration;
        
                // **Fungsi: Update Timer**
                function updateTimer() {
                    const minutes = Math.floor(remainingTime / 60);
                    const seconds = remainingTime % 60;
                    timerElement.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        
                    if (remainingTime <= 0) {
                        clearInterval(timerInterval);
                        document.getElementById('quiz-form').submit(); // Kirim otomatis jika waktu habis
                    }
                    remainingTime--;
                }
        
                const timerInterval = setInterval(updateTimer, 1000);
                updateTimer();
        
                // **Fungsi: Perbarui status soal terjawab**
                function updateAnsweredStatus() {
                    questions.forEach((question, i) => {
                        const inputs = question.querySelectorAll('input[type="radio"]');
                        const isAnswered = Array.from(inputs).some(input => input.checked);
        
                        const btn = questionNumbers[i];
                        if (isAnswered) {
                            btn.dataset.answered = "true";
                            btn.classList.add('bg-green-300'); // Hijau permanen untuk soal terjawab
                        } else {
                            btn.dataset.answered = "false";
                            btn.classList.remove('bg-green-300'); // Hapus hijau jika belum terjawab
                        }
        
                        // Hover hanya aktif jika soal tidak sedang diakses
                        if (i === currentQuestion) {
                            btn.classList.add('hover:bg-blue-400'); // Hover biru untuk soal saat ini
                            btn.classList.remove('hover:bg-green-300'); // Hilangkan hover hijau
                        } else if (btn.dataset.answered === "true") {
                            btn.classList.add('hover:bg-green-300'); // Hijau untuk soal terjawab yang tidak diakses
                            btn.classList.remove('hover:bg-blue-400'); // Hilangkan hover biru
                        } else {
                            btn.classList.add('hover:bg-blue-400'); // Hover biru default untuk soal belum terjawab
                            btn.classList.remove('hover:bg-green-300'); // Hilangkan hover hijau
                        }
                    });
                }
        
                // **Fungsi: Tampilkan soal berdasarkan indeks**
                function showQuestion(index) {
                    questions.forEach((question, i) => {
                        question.classList.toggle('hidden', i !== index);
                    });
        
                    questionNumbers.forEach((btn, i) => {
                        const isCurrent = i === index;
                        const isAnswered = btn.dataset.answered === "true";
        
                        btn.classList.toggle('bg-blue-400', isCurrent); // Biru untuk soal saat ini
                        btn.classList.toggle('text-white', isCurrent); // Teks putih untuk soal saat ini
                        btn.classList.toggle('border-gray-300', !isCurrent); // Border abu untuk lainnya
        
                        // Hover biru hanya untuk soal saat ini
                        if (isCurrent) {
                            btn.classList.add('hover:bg-blue-400'); // Hover biru untuk soal yang sedang diakses
                            btn.classList.remove('hover:bg-green-300'); // Hilangkan hover hijau
                        } else if (isAnswered) {
                            btn.classList.add('hover:bg-green-300'); // Hijau untuk soal terjawab yang tidak diakses
                            btn.classList.remove('hover:bg-blue-400'); // Hilangkan hover biru
                        } else {
                            btn.classList.add('hover:bg-blue-400'); // Hover biru untuk soal belum terjawab
                            btn.classList.remove('hover:bg-green-300'); // Hilangkan hover hijau
                        }
                    });
        
                    prevBtn.classList.toggle('hidden', index === 0); // Sembunyikan tombol "Sebelumnya" di soal pertama
                    nextBtn.classList.toggle('hidden', index === totalQuestions - 1); // Sembunyikan tombol "Selanjutnya" di soal terakhir
                    submitBtn.classList.toggle('hidden', index !== totalQuestions - 1); // Tampilkan tombol "Kirim" di soal terakhir
                }
        
                // **Navigasi: Tombol Sebelumnya**
                prevBtn.addEventListener('click', function () {
                    if (currentQuestion > 0) {
                        currentQuestion--;
                        showQuestion(currentQuestion);
                        updateAnsweredStatus();
                    }
                });
        
                // **Navigasi: Tombol Selanjutnya**
                nextBtn.addEventListener('click', function () {
                    if (currentQuestion < totalQuestions - 1) {
                        currentQuestion++;
                        showQuestion(currentQuestion);
                        updateAnsweredStatus();
                    }
                });
        
                // **Navigasi: Tombol Kirim**
                submitBtn.addEventListener('click', function () {
                    popup.classList.remove('hidden'); // Tampilkan pop-up konfirmasi
                });
        
                // **Konfirmasi: Kirim kuis**
                confirmSubmit.addEventListener('click', function () {
                    document.getElementById('quiz-form').submit();
                });
        
                // **Batal Kirim**
                cancelSubmit.addEventListener('click', function () {
                    popup.classList.add('hidden'); // Sembunyikan pop-up konfirmasi
                });
        
                // **Tandai soal terjawab saat input berubah**
                questions.forEach((question, i) => {
                    const inputs = question.querySelectorAll('input[type="radio"]');
                    inputs.forEach(input => {
                        input.addEventListener('change', function () {
                            updateAnsweredStatus(); // Perbarui status terjawab
                        });
                    });
                });
        
                // **Navigasi langsung menggunakan nomor soal**
                questionNumbers.forEach((btn, index) => {
                    btn.addEventListener('click', function () {
                        currentQuestion = index;
                        showQuestion(index);
                        updateAnsweredStatus();
                    });
                });
        
                // **Inisialisasi awal**
                updateAnsweredStatus(); // Periksa status soal yang sudah dijawab
                showQuestion(currentQuestion); // Tampilkan soal pertama
            });
        </script>        
    </div>

@endsection
