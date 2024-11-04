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

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-5">
    <!-- Dummy Kursus 1 -->
    <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
        <img src="https://via.placeholder.com/300x200" alt="Progres Kursus 1" class="w-full h-40 object-cover rounded-t-lg">
        <div class="p-4">
            <h3 class="text-lg font-semibold mb-2">Kursus Laravel Dasar</h3>
            <div class="bg-sky-50 p-2 rounded-lg">
                <div class="bg-gray-300 rounded-full w-full h-4">
                    <!-- Progres bar -->
                    <div class="bg-blue-500 rounded-full h-full" style="width: 60%;"></div>
                </div>
                <span class="text-gray-700 text-sm font-bold">60% Selesai</span>
            </div>
        </div>
    </div>

    <!-- Dummy Kursus 2 -->
    <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
        <img src="https://via.placeholder.com/300x200" alt="Progres Kursus 2" class="w-full h-40 object-cover rounded-t-lg">
        <div class="p-4">
            <h3 class="text-lg font-semibold mb-2">Kursus JavaScript Lanjutan</h3>
            <div class="bg-sky-50 p-2 rounded-lg">
                <div class="bg-gray-300 rounded-full w-full h-4">
                    <!-- Progres bar -->
                    <div class="bg-blue-500 rounded-full h-full" style="width: 80%;"></div>
                </div>
                <span class="text-gray-700 text-sm font-bold">80% Selesai</span>
            </div>
        </div>
    </div>

    <!-- Dummy Kursus 3 -->
    <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
        <img src="https://via.placeholder.com/300x200" alt="Progres Kursus 3" class="w-full h-40 object-cover rounded-t-lg">
        <div class="p-4">
            <h3 class="text-lg font-semibold mb-2">Kursus Dasar ReactJS</h3>
            <div class="bg-sky-50 p-2 rounded-lg">
                <div class="bg-gray-300 rounded-full w-full h-4">
                    <!-- Progres bar -->
                    <div class="bg-blue-500 rounded-full h-full" style="width: 45%;"></div>
                </div>
                <span class="text-gray-700 text-sm font-bold">45% Selesai</span>
            </div>
        </div>
    </div>

    <!-- Dummy Kursus 4 -->
    <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
        <img src="https://via.placeholder.com/300x200" alt="Progres Kursus 4" class="w-full h-40 object-cover rounded-t-lg">
        <div class="p-4">
            <h3 class="text-lg font-semibold mb-2">Kursus Pengembangan API</h3>
            <div class="bg-sky-50 p-2 rounded-lg">
                <div class="bg-gray-300 rounded-full w-full h-4">
                    <!-- Progres bar -->
                    <div class="bg-blue-500 rounded-full h-full" style="width: 30%;"></div>
                </div>
                <span class="text-gray-700 text-sm font-bold">30% Selesai</span>
            </div>
        </div>
    </div>
</div>

@endsection
