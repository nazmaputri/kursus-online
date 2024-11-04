@extends('layouts.dashboard-peserta')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-4xl font-bold mb-8 text-center text-blue-600">Detail Kursus</h1>
    <!-- Card Informasi Kursus -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <img src="https://via.placeholder.com/800x400" alt="Gambar Kursus" class="w-full h-64 object-cover">
        
        <div class="p-6">
            <h2 class="text-3xl font-bold mb-4">Kursus Pemrograman Web</h2>
            <p class="text-gray-700 mb-4">Pelajari cara membuat aplikasi web dengan Laravel dan Tailwind CSS. Kursus ini cocok untuk pemula hingga menengah yang ingin mengembangkan keterampilan dalam pengembangan web.</p>
            
            <h3 class="text-xl font-semibold mt-4">Manfaat yang Didapatkan:</h3>
            <ul class="list-disc list-inside text-gray-600 mb-4">
                <li>Penguasaan konsep dasar pemrograman web.</li>
                <li>Praktik langsung dengan proyek nyata.</li>
                <li>Akses ke video pembelajaran dan materi kursus.</li>
                <li>Komunitas belajar yang suportif.</li>
                <li>Pembelajaran yang fleksibel dan bisa diakses kapan saja.</li>
            </ul>

            <div class="mt-4">
                <p class="text-gray-600"><strong>Harga:</strong> <span class="text-blue-600 font-semibold">Rp 1.000.000</span></p>
                <p class="text-gray-600"><strong>Durasi:</strong> 4 minggu</p>
                <p class="text-gray-600"><strong>Jumlah Video:</strong> 10 video</p>
                <p class="text-gray-600"><strong>Jumlah Kuis:</strong> 5 kuis</p>
                <p class="text-gray-600"><strong>Mentor:</strong> John Doe</p>
                <p class="text-green-600 font-semibold mt-2">E-Sertifikat akan diberikan setelah menyelesaikan kursus!</p>
            </div>

            <a href="#" class="mt-6 block bg-blue-500 text-white text-center px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-300">Bayar Sekarang</a>
        </div>
    </div>
</div>
@endsection
