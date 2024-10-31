@extends('layouts.dashboard-peserta')
@section('content')
<div class="bg-white rounded-lg shadow-md p-8 w-full flex flex-col md:flex-row h-60 items-center">
    <div class="md:w-2/3 text-center md:text-left">
        <h1 class="text-3xl font-bold mb-4 text-gray-800">Selamat datang, {{ Auth::user()->name }}!</h1>
        <p class="mb-6 text-gray-600">
            Kami sangat senang Anda di sini. Di tempat ini, Anda dapat belajar, berbagi, dan terhubung dengan orang-orang yang memiliki minat yang sama. 
            <br> Mari kita mulai perjalanan ini bersama-sama!
        </p>
    </div>
    <div class="md:w-1/3 flex justify-center md:justify-end">
        <img src="{{ asset('storage/buku.png') }}" alt="Welcome Image" class="w-50"/>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-5">
    <!-- Card Jumlah Kursus -->
    <div class="bg-blue-200 p-4 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 text-gray-800 text-center">
        <h3 class="text-xl font-semibold mb-2">Jumlah Kursus Diikuti</h3>
        <p class="text-4xl font-bold">5</p> <!-- Ganti 5 dengan variabel dinamis jika perlu -->
        <p class="text-sm">Kursus yang telah Anda ikuti.</p>
    </div>

    <!-- Card Jumlah Sertifikat -->
    <div class="bg-green-200 p-4 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 text-gray-800 text-center">
        <h3 class="text-xl font-semibold mb-2">Jumlah Sertifikat</h3>
        <p class="text-4xl font-bold">3</p> <!-- Ganti 3 dengan variabel dinamis jika perlu -->
        <p class="text-sm">Sertifikat yang telah Anda terima.</p>
    </div>

    <!-- Card Poin Belajar -->
    <div class="bg-yellow-200 p-4 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 text-gray-800 text-center">
        <h3 class="text-xl font-semibold mb-2">Poin Belajar</h3>
        <p class="text-4xl font-bold">150</p> <!-- Ganti 150 dengan variabel dinamis jika perlu -->
        <p class="text-sm">Poin yang telah Anda kumpulkan dari kursus.</p>
    </div>
</div>



@endsection