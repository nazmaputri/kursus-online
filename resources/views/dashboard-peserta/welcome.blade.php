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
    <h2 class="text-2xl font-bold mb-5 text-gray-800">My Course</h2>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Dummy Data with rating -->
        @foreach([
            ['title' => 'Kursus Laravel Dasar', 'progress' => '60%', 'rating' => 4],
            ['title' => 'Kursus JavaScript', 'progress' => '80%', 'rating' => 5],
            ['title' => 'Kursus Dasar ReactJS', 'progress' => '45%', 'rating' => 4],
        ] as $kursus)
            <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                <!-- Image -->
                <img src="https://via.placeholder.com/300x200" alt="Progres {{ $kursus['title'] }}" class="w-full h-40 object-cover rounded-t-lg">

                <!-- Course Content -->
                <div class="p-4">
                    <div class="flex justify-between items-center mb-2">
                        <!-- Course Title and Rating -->
                        <div>
                            <h3 class="text-lg font-semibold">{{ $kursus['title'] }}</h3>
                            <div class="flex text-yellow-500">
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < $kursus['rating'])
                                        <span>&#9733;</span>
                                    @else
                                        <span class="text-gray-300">&#9733;</span>
                                    @endif
                                @endfor
                            </div>
                        </div>

                        <!-- Progress Circle -->
                        <div class="w-12 h-12 rounded-full border-4 border-sky-600 flex items-center justify-center">
                            <span class="text-sm font-bold text-sky-600">{{ $kursus['progress'] }}</span>
                        </div>
                    </div>

                    <!-- Button -->
                    <button class="bg-sky-300 text-white w-full py-2 m-2 rounded-lg font-semibold hover:bg-sky-500 transition-colors">
                        Lanjut Belajar
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</div>


@endsection
