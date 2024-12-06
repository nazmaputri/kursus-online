@extends('layouts.dashboard-peserta')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Belajar dengan Eduflix</h1>

    <div class="space-y-8">
        @foreach($lessons as $index => $lesson)
            @if($lesson->completed || $index == 0) <!-- Tampilkan materi jika sudah selesai atau materi pertama -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">{{ $lesson->title }}</h2>
                    <p class="text-gray-600 mb-4">{{ $lesson->description }}</p>

                    <!-- Tampilkan kuis jika materi telah selesai -->
                    @if($lesson->quiz && $lesson->quiz->completed)
                        <p class="text-green-500">Kuis selesai. Anda dapat melanjutkan ke materi berikutnya.</p>
                    @elseif($lesson->quiz)
                        <form action="{{ route('learning.completeQuiz', $lesson->quiz->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Selesaikan Kuis</button>
                        </form>
                    @else
                        <p class="text-gray-500">Tidak ada kuis untuk materi ini.</p>
                    @endif

                    <!-- Button untuk menyelesaikan materi -->
                    @if(!$lesson->completed)
                        <form action="{{ route('learning.completeLesson', $lesson->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg mt-4">Selesaikan Materi</button>
                        </form>
                    @else
                        <p class="text-green-500">Materi selesai. Anda dapat melanjutkan ke materi berikutnya.</p>
                    @endif
                </div>
            @else
                <div class="bg-gray-200 shadow-md rounded-lg p-6 opacity-50">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">{{ $lesson->title }}</h2>
                    <p class="text-gray-600 mb-4">Materi ini terkunci. Selesaikan materi sebelumnya untuk membuka materi ini.</p>
                </div>
            @endif
        @endforeach
    </div>
</div>
@endsection
