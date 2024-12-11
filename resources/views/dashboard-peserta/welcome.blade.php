@extends('layouts.dashboard-peserta')
@section('content')
<div class="bg-white rounded-lg shadow-md p-8 w-full flex flex-col md:flex-row h-auto items-center md:h-60">
    <div class="w-full md:w-2/3 text-center md:text-left mb-4 md:mb-0">
        <h1 class="text-3xl font-bold mb-4 text-gray-800">Selamat datang, {{ Auth::user()->name }}!</h1>
        <p class="mb-6 text-gray-600">
            Kami sangat senang Anda di sini. Di tempat ini, Anda dapat belajar, berbagi, dan terhubung dengan orang-orang yang memiliki minat yang sama.
            <br> Mari kita mulai perjalanan ini bersama-sama!
        </p>
    </div>
    <div class="md:w-1/3 flex justify-center md:justify-end">
        <img src="{{ asset('storage/buku.png') }}" alt="Welcome Image" class="w-full h-auto md:w-54"/>
    </div>
</div>

<div class="bg-white rounded-lg shadow-md p-6 mt-7">
    <h2 class="text-2xl font-bold mb-5 text-gray-800 uppercase border-b-2 pb-2">Kursus Saya</h2>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($courses as $course)
            <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 flex flex-col">
                <!-- Image -->
                <img src="{{ asset('storage/' . $course->image_path) }}" alt="Kursus {{ $course->title }}" class="w-full h-40 object-cover rounded-t-lg">
    
                <!-- Course Content -->
                <div class="p-4 flex flex-col flex-grow">
                    <div class="flex justify-between items-center mb-2">
                        <!-- Course Title and Rating -->
                        <div>
                            <h3 class="text-lg font-semibold capitalize">{{ $course->title }}</h3>
                            <div class="flex text-yellow-500">
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < ($course->rating ?? 0)) <!-- Rating dari database atau default 0 -->
                                        <span>&#9733;</span>
                                    @else
                                        <span class="text-gray-300">&#9733;</span>
                                    @endif
                                @endfor
                            </div>
                        </div>
                    </div>
                    <!-- Progress Bar -->
                    <div>
                        <div class="w-full bg-gray-200 rounded-full h-4">
                            <!-- Progress dengan warna selang-seling sky blue -->
                            <div class="h-4 rounded-full" style="width: {{ $course->progress }}%; background: repeating-linear-gradient(45deg, #87CEEB, #87CEEB 10px, #B0E0E6 10px, #B0E0E6 20px);"></div>
                        </div>
                        <p class="text-sm text-gray-500 mt-2 text-right">{{ $course->progress }}% completed</p>
                    </div>
                </div>
                <!-- Button -->
                <div class="p-4 mt-auto flex justify-between gap-4">
                    <!-- Button Lanjut Belajar -->
                    <a href="{{ route('daftar-kursus') }}" class="flex-1">
                        <button class="bg-yellow-100/50 text-yellow-500 border border-yellow-500 w-full py-2 rounded-lg font-semibold flex items-center justify-center gap-2 hover:text-white hover:bg-yellow-500 transition-colors">
                            Lanjut Belajar
                        </button>
                    </a>
                
                    <a href="{{ $course->isCompletedForCertificate ? route('certificate.download', $course->id) : '#' }}" class="flex-1">
                        <button class="w-full py-2 rounded-lg font-semibold flex items-center justify-center gap-2 
                            {{ !$course->isCompletedForCertificate ? 'bg-gray-400 text-gray-600 border-gray-600 cursor-not-allowed opacity-50' : 'bg-red-100/50 text-red-500 border border-red-500 hover:bg-red-600 hover:text-white transition-colors group' }}">
                            <svg class="h-5 w-5 transition-colors 
                                {{ !$course->isCompletedForCertificate ? 'text-gray-600' : 'text-red-500 group-hover:text-white' }}" 
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor">
                                <path d="M128 0C92.7 0 64 28.7 64 64l0 96 64 0 0-96 226.7 0L384 93.3l0 66.7 64 0 0-66.7c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0L128 0zM384 352l0 32 0 64-256 0 0-64 0-16 0-16 256 0zm64 32l32 0c17.7 0 32-14.3 32-32l0-96c0-35.3-28.7-64-64-64L64 192c-35.3 0-64 28.7-64 64l0 96c0 17.7 14.3 32 32 32l32 0 0 64c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-64zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/>
                            </svg>
                            Sertifikat
                        </button>
                    </a>                                  
                </div>                
            </div>
        @empty
            <div class="col-span-full">
                <p class="text-gray-600 text-center">Belum ada kursus yang diikuti.</p>
            </div>
        @endforelse
    </div>    
</div>

@endsection
