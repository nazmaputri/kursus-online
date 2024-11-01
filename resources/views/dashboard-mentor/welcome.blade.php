@extends('layouts.dashboard-mentor')
@section('content')
    <div class="bg-white rounded-lg shadow-md p-8 w-full flex flex-col md:flex-row h-auto items-center">
        <div class="md:w-2/3 text-center md:text-left">
            <h1 class="text-3xl font-bold mb-4 text-gray-800">Selamat datang, {{ Auth::user()->name }}!</h1>
            <p class="mb-6 text-gray-600">
                Menginspirasi satu orang mungkin terlihat kecil, tapi bisa menciptakan perubahan besar. 
                Teruslah berbagi ilmu, karena setiap hal yang Anda ajarkan adalah langkah menuju masa depan yang lebih cerah.
            </p>
        </div>
        <div class="md:w-1/3 flex justify-center md:justify-end">
            <img src="{{ asset('storage/mentor.png') }}" alt="Welcome Image" class="w-full h-auto md:w-54"/>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-10">
        <!-- Card Jumlah Mentor -->
        <div class="bg-red-100 rounded-lg shadow-md p-6 flex flex-col md:flex-row items-center">
            <div class="p-4 bg-red-500 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7a4 4 0 118 0v4a4 4 0 11-8 0V7zm4 13a8 8 0 01-8-8h16a8 8 0 01-8 8z" />
                </svg>
            </div>
            <div class="ml-4">
                <h2 class="text-2xl font-bold text-red-800">Jumlah Peserta</h2>
                <p class="text-xl font-semibold text-red-600">Peserta</p>
            </div>
        </div>

        <!-- Card Jumlah Kategori -->
        <div class="bg-yellow-100 rounded-lg shadow-md p-6 flex flex-col md:flex-row items-center">
            <div class="p-4 bg-yellow-500 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                </svg>
            </div>
            <div class="ml-4">
                <h2 class="text-2xl font-bold text-yellow-800">Jumlah Materi</h2>
                <p class="text-xl font-semibold text-yellow-600">Materi</p>
            </div>
        </div>

        <!-- Card Jumlah Kursus -->
        <div class="bg-blue-100 rounded-lg shadow-md p-6 flex flex-col md:flex-row items-center">
            <div class="p-4 bg-blue-500 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2zM3 16a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2z" />
                </svg>
            </div>
            <div class="ml-4">
                <h2 class="text-2xl font-bold text-blue-800">Jumlah Kursus</h2>
                <p class="text-xl font-semibold text-blue-600">kursus</p>
            </div>
        </div>
    </div>
@endsection
