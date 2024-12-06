@extends('layouts.dashboard-mentor')

@section('content')
<div class="container mx-auto">

    <!-- Card Wrapper untuk Kuis -->
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <!-- Judul Kuis -->
        <h1 class="text-3xl font-bold mb-4 border-b-2 pb-2 uppercase">{{ $quiz->title }}</h1>

        <!-- Deskripsi Kuis -->
        <p class="text-gray-700 mb-4">
            {{ $quiz->description ?? 'Tidak ada deskripsi untuk kuis ini.' }}
        </p>

        <!-- Durasi Kuis -->
        <p class="text-gray-600 mb-6">
            <strong>Durasi :</strong> {{ $quiz->duration }} Menit
        </p>

        <!-- Daftar Soal -->
        @if($quiz->questions->isNotEmpty())
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            @foreach($quiz->questions as $index => $question)
            <!-- Card untuk Setiap Soal -->
            <div class="bg-gray-50 border rounded-lg p-4 shadow-md">
                <div class="flex items-start">
                    <!-- Nomor Soal -->
                    <span class="text-2xl font-bold mr-4">{{ $index + 1 }}.</span>
                    
                    <!-- Pertanyaan -->
                    <p class="text-lg font-medium text-gray-700 flex-1 capitalize">{{ $question->question }}</p>
                </div>

                <!-- Jawaban Tersembunyi dengan Dropdown -->
                <details class="mt-4">
                    <summary class="cursor-pointer text-sky-400">Lihat Jawaban</summary>
                    <ul class="list-none mt-2 space-y-2">
                        @foreach($question->answers as $answer)
                        <li class="p-2 border rounded-md {{ $answer->is_correct ? 'bg-green-100 text-green-700 font-semibold' : 'bg-gray-100 text-gray-600' }}">
                            {{ $answer->answer }}
                        </li>
                        @endforeach
                    </ul>
                </details>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-gray-500">Belum ada soal yang ditambahkan untuk kuis ini.</p>
        @endif

        <!-- Tombol Kembali -->
        <div class="mt-6 justify-end flex">
            <a href="{{ route('materi.show', ['courseId' => $course->id, 'materiId' => $materi->id]) }}"
               class="bg-sky-400 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded">
                Kembali
            </a>
        </div>
    </div>

</div>
@endsection
