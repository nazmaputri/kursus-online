@extends('layouts.dashboard-admin')
@section('content')

    <!-- Notifikasi -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif
    <div class="bg-white rounded-lg shadow-md p-8 w-full flex flex-col md:flex-row h-60 items-center">
        <div class="md:w-2/3 text-center md:text-left">
            <h1 class="text-3xl font-bold mb-4 text-gray-800">Selamat datang, {{ Auth::user()->name }}!</h1>
            <p class="mb-6 text-gray-600">
                Semoga hari ini membawa kemudahan dan kelancaran dalam tugas-tugas Anda. 
                <br>Mari kita capai hal-hal hebat bersama.
            </p>
        </div>
        <div class="md:w-1/3 flex justify-center md:justify-end">
            <img src="{{ asset('storage/admin.png') }}" alt="Welcome Image" class="w-54"/>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-10">
        <!-- Card Jumlah Mentor -->
        <div class="bg-red-100 rounded-lg shadow-md p-5 flex items-center">
            <div class="p-4 bg-red-500 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 640 512" stroke="currentColor" fill="white">
                    <path d="M160 64c0-35.3 28.7-64 64-64L576 0c35.3 0 64 28.7 64 64l0 288c0 35.3-28.7 64-64 64l-239.2 0c-11.8-25.5-29.9-47.5-52.4-64l99.6 0 0-32c0-17.7 14.3-32 32-32l64 0c17.7 0 32 14.3 32 32l0 32 64 0 0-288L224 64l0 49.1C205.2 102.2 183.3 96 160 96l0-32zm0 64a96 96 0 1 1 0 192 96 96 0 1 1 0-192zM133.3 352l53.3 0C260.3 352 320 411.7 320 485.3c0 14.7-11.9 26.7-26.7 26.7L26.7 512C11.9 512 0 500.1 0 485.3C0 411.7 59.7 352 133.3 352z"/>
                </svg>
            </div>
            <div class="ml-4">
                <h2 class="text-2xl font-bold text-red-800">Jumlah Mentor</h2>
                <p class="text-xl font-semibold text-red-600">{{ $jumlahMentor }} Mentor</p>
            </div>
        </div>
         <!-- Card Jumlah Kursus -->
         <div class="bg-blue-100 rounded-lg shadow-md p-5 flex items-center">
            <div class="p-4 bg-blue-500 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 448 512" stroke="currentColor" fill="white">
                    <path d="M96 0C43 0 0 43 0 96L0 416c0 53 43 96 96 96l288 0 32 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l0-64c17.7 0 32-14.3 32-32l0-320c0-17.7-14.3-32-32-32L384 0 96 0zm0 384l256 0 0 64L96 448c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16l192 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-192 0c-8.8 0-16-7.2-16-16zm16 48l192 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-192 0c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
                </svg>
            </div>
            <div class="ml-4">
                <h2 class="text-2xl font-bold text-blue-800">Jumlah Kursus</h2>
                <p class="text-xl font-semibold text-blue-600">{{ $jumlahKursus }} Kursus</p>
            </div>
        </div>
        <!-- Card Jumlah Peserta -->
        <div class="bg-yellow-100 rounded-lg shadow-md p-5 flex items-center">
            <div class="p-4 bg-yellow-500 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 640 512" stroke="currentColor" fill="white">
                    <path d="M96 0C43 0 0 43 0 96L0 416c0 53 43 96 96 96l448 0c53 0 96-43 96-96l0-320c0-53-43-96-96-96L96 0zM64 96c0-17.7 14.3-32 32-32l448 0c17.7 0 32 14.3 32 32l0 320c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32L64 96zm159.8 80a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM96 309.3c0 14.7 11.9 26.7 26.7 26.7l56.1 0c8-34.1 32.8-61.7 65.2-73.6c-7.5-4.1-16.2-6.4-25.3-6.4l-69.3 0C119.9 256 96 279.9 96 309.3zM461.2 336l56.1 0c14.7 0 26.7-11.9 26.7-26.7c0-29.5-23.9-53.3-53.3-53.3l-69.3 0c-9.2 0-17.8 2.3-25.3 6.4c32.4 11.9 57.2 39.5 65.2 73.6zM372 289c-3.9-.7-7.9-1-12-1l-80 0c-4.1 0-8.1 .3-12 1c-26 4.4-47.3 22.7-55.9 47c-2.7 7.5-4.1 15.6-4.1 24c0 13.3 10.7 24 24 24l176 0c13.3 0 24-10.7 24-24c0-8.4-1.4-16.5-4.1-24c-8.6-24.3-29.9-42.6-55.9-47zM512 176a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM320 256a64 64 0 1 0 0-128 64 64 0 1 0 0 128z"/>
                </svg>
            </div>
            <div class="ml-4">
                <h2 class="text-2xl font-bold text-yellow-800">Jumlah Peserta</h2>
                <p class="text-xl font-semibold text-yellow-600">{{ $jumlahPeserta }} Peserta</p>
            </div>
        </div>
    </div>
@endsection