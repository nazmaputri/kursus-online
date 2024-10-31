@extends('layouts.dashboard-peserta') <!-- Pastikan layout ini sesuai dengan layout proyek Anda -->

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-4xl font-bold mb-8 text-center text-blue-600">Detail Kursus yang Sedang Diikuti</h1>

    <!-- Card Informasi Kursus -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <img src="https://via.placeholder.com/800x400" alt="Gambar Kursus" class="w-full h-64 object-cover">
        
        <div class="p-6">
            <h2 class="text-3xl font-bold mb-4">Kursus Pemrograman Web</h2>
            <p class="text-gray-700 mb-4">Pelajari cara membuat aplikasi web dengan Laravel dan Tailwind CSS. Kursus ini cocok untuk pemula hingga menengah yang ingin mengembangkan keterampilan dalam pengembangan web.</p>

            <h3 class="text-xl font-semibold mt-4">Video Pembelajaran:</h3>
            <div class="mb-4">
                <video controls class="w-full h-64">
                    <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4"> <!-- Ganti dengan URL video pembelajaran Anda -->
                    Your browser does not support the video tag.
                </video>
            </div>

            <h3 class="text-xl font-semibold mt-4">Chat dengan Mentor:</h3>
            <div class="bg-gray-100 p-4 rounded-lg mb-4">
                <p class="text-gray-600">Tanya jawab dengan mentor Anda di sini. Klik tombol di bawah untuk membuka chat.</p>
                <a href="#" class="mt-2 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">Buka Chat</a>
            </div>

            <h3 class="text-xl font-semibold mt-4">E-Sertifikat:</h3>
            <p class="text-gray-600 mb-2">Setelah menyelesaikan kursus, Anda dapat mengunduh e-sertifikat Anda di bawah ini:</p>
            <a href="#" class="mt-2 inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition duration-300">Unduh E-Sertifikat</a>
        </div>
    </div>
</div>
@endsection
