@extends('layouts.dashboard-peserta')

@section('title', 'Video Pembelajaran')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-5">Video Pembelajaran</h1>

    <div class="grid gap-6">
        <!-- Card 1 -->
        <div class="bg-white rounded-lg shadow-md p-5 flex items-start">
            <!-- Video -->
            <div class="w-1/2 mr-5">
                <div class="aspect-w-16 aspect-h-9">
                    <iframe src="https://www.youtube.com/embed/your_video_id_1" title="Video Pembelajaran 1" allowfullscreen class="w-full h-full rounded-lg"></iframe>
                </div>
            </div>
            <!-- Judul Materi -->
            <div class="w-1/2">
                <h2 class="text-xl font-semibold text-gray-800 mb-3">Materi Pembelajaran 1</h2>
                <p class="text-gray-600">Deskripsi singkat materi yang dibahas dalam video ini. Penjelasan mengenai topik yang diangkat dan tujuan pembelajaran.</p>
                <!-- Link PDF -->
                <div class="mt-4">
                    <a href="{{ asset('path/to/materi1.pdf') }}" target="_blank" class="text-blue-600 hover:underline">
                        Download Materi PDF 1
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-lg shadow-md p-5 flex items-start">
            <!-- Video -->
            <div class="w-1/2 mr-5">
                <div class="aspect-w-16 aspect-h-9">
                    <iframe src="https://www.youtube.com/embed/your_video_id_2" title="Video Pembelajaran 2" allowfullscreen class="w-full h-full rounded-lg"></iframe>
                </div>
            </div>
            <!-- Judul Materi -->
            <div class="w-1/2">
                <h2 class="text-xl font-semibold text-gray-800 mb-3">Materi Pembelajaran 2</h2>
                <p class="text-gray-600">Deskripsi singkat materi yang dibahas dalam video ini. Penjelasan mengenai topik yang diangkat dan tujuan pembelajaran.</p>
                <!-- Link PDF -->
                <div class="mt-4">
                    <a href="{{ asset('path/to/materi2.pdf') }}" target="_blank" class="text-blue-600 hover:underline">
                        Download Materi PDF 2
                    </a>
                </div>
            </div>
        </div>

    </div>
@endsection
