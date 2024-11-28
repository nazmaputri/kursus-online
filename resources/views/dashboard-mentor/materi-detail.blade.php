@extends('layouts.dashboard-mentor')

@section('content')
<div class="container mx-auto">

    <!-- Card Wrapper -->
    <div class="bg-white p-6 rounded-lg shadow-md">

        <!-- Judul Halaman -->
        <h1 class="text-2xl font-bold mb-6 border-b-2 pb-2 uppercase">Detail Materi : {{ $materi->judul }}</h1>

        <!-- Detail Materi -->
        <p class="text-gray-700">{{ $materi->deskripsi ?? 'Tidak ada deskripsi' }}</p>

        <!-- Nama Kursus -->
        <p class="mt-4"><strong>Kursus :</strong> {{ $materi->course->title ?? 'Kursus tidak tersedia' }}</p>

        <!-- Video Materi -->
        @if($materi->videos->isNotEmpty())
        <div class="mt-6">
            <h3 class="font-semibold mb-2">Video Materi</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6"> <!-- Added grid layout for two videos per row -->
                @foreach($materi->videos as $video)
                    <div class="border p-4 rounded-md shadow-md">
                        <h4 class="font-semibold mb-2 capitalize"> {{ $video->judul }} </h4>
                        <video controls class="w-full rounded-md shadow-md">
                            <source src="{{ asset('storage/' . $video->video_url) }}" type="video/mp4">
                            Browser Anda tidak mendukung tag video.
                        </video>
                    </div>
                @endforeach
            </div>
        </div>
        @else
        <p class="mt-4 text-gray-500">Tidak ada video materi yang tersedia.</p>
        @endif

        <!-- File Materi -->
        @if($materi->pdfs->isNotEmpty())
        <div class="mt-6">
            <h3 class="font-semibold mb-2">File Materi</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6"> <!-- Added grid layout for two PDFs per row -->
                @foreach($materi->pdfs as $file)
                    <div class="border p-4 rounded-md shadow-md">
                        <h4 class="font-semibold mb-2 capitalize">{{ $file->judul }}</h4>
                        <iframe 
                            src="{{ asset('storage/' . $file->pdf_file) }}" 
                            class="w-full h-96 rounded-md" 
                            frameborder="0">
                        </iframe>
                    </div>
                @endforeach
            </div>
        </div>
        @else
        <p class="mt-4 text-gray-500">Tidak ada file materi yang tersedia.</p>
        @endif
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 mt-8">
        <h2 class="text-3xl font-bold mb-6 border-b-2 pb-2 uppercase">Kuis</h2>

        @if(session('success'))
            <div class="bg-green-500 text-white p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-4 text-right p-1 ">
            <a href="{{ route('quiz.create', ['courseId' => $courseId, 'materiId' => $materiId]) }}" class="bg-sky-300 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded">
                Tambah quiz
            </a>
        </div>

        <table class="min-w-full border-separate border-spacing-1 mt-4">
            <thead>
                <tr class="bg-sky-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="border border-gray-300 px-2 py-2 rounded-md">No</th>
                    <th class="border border-gray-300 px-4 py-2 rounded-md">Judul</th>
                    <th class="border border-gray-300 px-4 py-2 rounded-md">Durasi</th>
                    <th class="border border-gray-300 px-4 py-2 rounded-md">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quizzes as $quiz)
                    <tr>
                        <td class="border border-gray-300 px-2 py-2 rounded-md text-center">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2 rounded-m">{{ $quiz->title }}</td>
                        <td class="border border-gray-300 px-4 py-2 rounded-m">{{ $quiz->duration }} menit</td>
                        <td class="border border-gray-300 px-4 py-2 rounded-m">
                            <div class="flex items-center justify-center space-x-6">
                                <a href="{{ route('quiz.show',  ['courseId' => $courseId, 'materiId' => $materiId, $quiz->id]) }}" class="text-white bg-gray-500 p-1 rounded-md hover:bg-gray-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </a>
                                <a href="{{ route('quiz.edit',  ['courseId' => $courseId, 'materiId' => $materiId, $quiz->id]) }}" class="text-white bg-blue-500 p-1 rounded-md hover:bg-blue-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>
                                <form id="deleteForm" action="{{ route('quiz.destroy', ['courseId' => $courseId, 'materiId' => $materiId, $quiz->id]) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white bg-red-500 p-1 rounded-md hover:bg-red-800" onclick="return confirm('Apakah Anda yakin ingin menghapus materi ini?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                @if ($quizzes->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center text-gray-500 py-4">Belum ada Kuis untuk Materi ini.</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="mt-6 flex justify-end space-x-2">
            <a href="{{ route('courses.index') }}" class="bg-sky-300 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded">
                Kembali
            </a>
        </div>      
    </div>
</div>
@endsection
