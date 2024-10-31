<!-- resources/views/course-detail.blade.php -->
@extends('layouts.dashboard-peserta')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <!-- Card Informasi Kategori IT -->
    <div class="flex mb-4">
        <div class="w-1/3">
            <img src="https://via.placeholder.com/300x200" alt="Gambar IT" class="rounded-lg w-full h-auto">
        </div>
        <div class="ml-4 w-2/3">
            <h2 class="text-3xl font-bold mb-2">Kategori: IT</h2>
            <p class="text-gray-700 mb-2">IT atau Teknologi Informasi adalah bidang yang mencakup semua aspek teknologi komputer dan telekomunikasi. Ini termasuk pengembangan perangkat lunak, pengelolaan jaringan, keamanan informasi, dan banyak lagi.</p>
        </div>
    </div>

    <div class="mt-6">
        <h3 class="text-xl font-semibold">Informasi Kursus</h3>
        <ul class="list-disc list-inside">
            <li><strong>Silabus Kursus:</strong></li>
            <li>Pengenalan Kursus</li>
            <li>Materi Dasar</li>
            <li>Praktik dan Studi Kasus</li>
            <li>Penyelesaian dan Evaluasi</li>
        </ul>
    </div>
</div>

<!-- Kursus Lainnya yang Terkait -->
<div class="mt-6 bg-white p-6 rounded-lg shadow-md">
    <h3 class="text-xl font-semibold">Kursus Lainnya di Kategori IT</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-gray-100 p-4 rounded-lg">
            <h4 class="text-lg font-semibold">Kursus Laravel Dasar</h4>
            <p class="text-gray-600">Pelajari dasar-dasar Laravel dalam pembuatan aplikasi web.</p>
            <p class="text-gray-600"><strong>Biaya:</strong> Rp 500.000</p>
            <a href="{{ route('daftar-peserta') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Daftar Sekarang</a>
        </div>
        <div class="bg-gray-100 p-4 rounded-lg">
            <h4 class="text-lg font-semibold">Kursus JavaScript Interaktif</h4>
            <p class="text-gray-600">Membangun aplikasi web interaktif menggunakan JavaScript.</p>
            <p class="text-gray-600"><strong>Biaya:</strong> Rp 600.000</p>
            <a href="{{ route('daftar-peserta') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Daftar Sekarang</a>
        </div>
        <div class="bg-gray-100 p-4 rounded-lg">
            <h4 class="text-lg font-semibold">Kursus ReactJS</h4>
            <p class="text-gray-600">Pelajari pembuatan aplikasi front-end dengan ReactJS.</p>
            <p class="text-gray-600"><strong>Biaya:</strong> Rp 700.000</p>
            <a href="{{ route('daftar-peserta') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Daftar Sekarang</a>
        </div>
        <div class="bg-gray-100 p-4 rounded-lg">
            <h4 class="text-lg font-semibold">Kursus Pengembangan API</h4>
            <p class="text-gray-600">Membangun dan mengelola API dengan Laravel.</p>
            <p class="text-gray-600"><strong>Biaya:</strong> Rp 800.000</p>
            <a href="{{ route('daftar-peserta') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Daftar Sekarang</a>
        </div>
    </div>
</div>

@endsection
