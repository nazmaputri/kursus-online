<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $course->judul ?? 'Kursus' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

     <!-- AOS CSS -->
     <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

     <!-- Custom Style -->
     <style>
        body {
            font-family: "Quicksand", sans-serif !important;
        }
    </style>
</head>
<body>
    @include('components.navbar') 

    <!-- Bagian Materi Kursus -->
    <section id="course" class="py-12 bg-sky-50">
        <div class="container mx-auto px-6 lg:px-8 mt-16">
            <!-- Kontainer Kursus -->
            <div class="flex flex-col lg:flex-row bg-white shadow-lg overflow-hidden border rounded-xl">
                <!-- Bagian Langganan -->
                <div class="lg:w-2/3 w-full flex flex-col justify-center bg-white shadow-lg rounded-xl p-8 text-center">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2" data-aos="zoom-in">
                        Yuk Berlangganan Untuk Akses Materinya!
                    </h2>
                    <!-- Deskripsi -->
                    <p class="text-sm text-gray-700 mb-6 px-6 lg:px-20" data-aos="zoom-in">
                        Berlangganan sekarang di Eduflix dan mulai tingkatkan skillmu! Pilih kursus yang kamu butuhkan, 
                        pelajari kapan saja, di mana saja. Nikmati video pembelajaran terstruktur dan modul praktik interaktif yang dirancang oleh para ahli di bidangnya.
                    </p>
                    <!-- Button Langganan -->
                    <a href="/login">
                        <button class="bg-yellow-300 hover:bg-yellow-500 text-white font-semibold py-3 px-6 rounded-full text-md shadow-lg shadow-yellow-100 hover:shadow-none" data-aos="zoom-in">
                            Langganan Sekarang
                        </button>
                    </a>                    
                </div>
                <!-- Informasi Kursus -->
                <div class="lg:w-1/3 w-full p-8" data-aos="zoom-in">
                    <div class="flex flex-col">
                        <!-- Materi Kursus -->
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Materi</h3>
                            <ul class="divide-y divide-gray-200">
                                @foreach ($course->materi as $index => $materi)
                                    <li class="flex items-center space-x-4 py-3">
                                        <!-- Icon -->
                                        <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path d="M464 256A208 208 0 1 0 48 256a208 208 0 1 0 416 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM188.3 147.1c7.6-4.2 16.8-4.1 24.3 .5l144 88c7.1 4.4 11.5 12.1 11.5 20.5s-4.4 16.1-11.5 20.5l-144 88c-7.4 4.5-16.7 4.7-24.3 .5s-12.3-12.2-12.3-20.9l0-176c0-8.7 4.7-16.7 12.3-20.9z"/>
                                        </svg>
                                        <!-- Nomor dan Judul Materi -->
                                        <span class="text-sm font-semibold text-gray-700">
                                            {{ $index + 1 }}. {{ $materi->judul }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </section>

    <!-- Informasi Kursus -->
    <section class="bg-white p-10">
        <a href="/">
            <button class="bg-sky-200 text-gray-600 py-2 px-4 rounded-full font-bold mb-6">
                Kembali
            </button>
        </a>        

        <div class="flex flex-col lg:flex-row mb-4">
            <div class="w-full lg:w-1/3 mb-4 lg:mb-0">
                <img src="{{ asset('storage/' . $course->image_path) }}" alt="{{ $course->title }}" class="rounded-lg w-full h-auto">
            </div>
            <div class="ml-6 w-2/3">
                <h2 class="text-2xl font-bold capitalize mb-1">{{ $course->title }}</h2>
                <p class="text-gray-600 mb-3"><strong>Mentor :</strong> {{ $course->mentor->name }}</p>
                <p class="text-gray-700 mb-4">{{ $course->description }}</p>
                <p class="text-green-600 bg-green-300 inline-block text-xl p-3 rounded-2xl font-bold">Rp. {{ number_format($course->price, 0, ',', '.') }}</p>
            </div>
        </div>
        
        <div class="border-t mt-8 pt-6">
            <!-- Judul -->
            <h3 class="text-xl font-bold text-gray-800 mb-4">Yang Akan Didapatkan</h3>
            
            <!-- Daftar Button -->
            <div class="flex space-x-4">
                <button class="bg-blue-400 hover:bg-blue-600 text-white font-semibold py-2 px-3 rounded-lg text-sm shadow-lg shadow-blue-100 hover:shadow-none flex items-center space-x-2" data-aos="zoom-in-right">
                    <img class="w-6 h-6" style="filter: invert(1);" src="https://img.icons8.com/fluency-systems-regular/50/certificate--v1.png" alt="certificate--v1"/>
                    <span>Sertifikat</span>
                </button>
                <button class="bg-blue-400 hover:bg-blue-600 text-white font-semibold py-2 px-3 rounded-lg text-sm shadow-lg shadow-blue-100 hover:shadow-none flex items-center space-x-2" data-aos="zoom-in-right">
                    <img class="w-6 h-6" style="filter: invert(1);" src="https://img.icons8.com/ios-glyphs/30/last-24-hours.png" alt="last-24-hours"/>
                    <span>Akses Materi 24 Jam</span>
                </button>
                <button class="bg-blue-400 hover:bg-blue-600 text-white font-semibold py-2 px-3 rounded-lg text-sm shadow-lg shadow-blue-100 hover:shadow-none flex items-center space-x-2" data-aos="zoom-in-right">
                    <img class="w-6 h-6" style="filter: invert(1);" src="https://img.icons8.com/material-outlined/24/book.png" alt="book"/>
                    <span>Bahan Bacaan</span>
                </button>
                <button class="bg-blue-400 hover:bg-blue-600 text-white font-semibold py-2 px-3 rounded-lg text-sm shadow-lg shadow-blue-100 hover:shadow-none flex items-center space-x-2" data-aos="zoom-in-right">
                    <img class="w-6 h-6" style="filter: invert(1);" src="https://img.icons8.com/sf-black/64/cinema-.png" alt="cinema-"/>
                    <span>Video Pembelajaran</span>
                </button>
            </div>                     
        </div>       
        
        <div class="border-t mt-8 pt-6">
            <!-- Judul -->
            <h3 class="text-xl font-bold text-gray-800 mb-4">Rating Kursus</h3>
            
            <!-- Daftar Button -->
            <div class="flex items-center space-x-2 mt-4">
                <!-- Rating Bintang -->
                @foreach ($ratings as $rating)
                    @if ($rating->display == 1) <!-- Memastikan hanya rating dengan status 1 yang ditampilkan -->
                        <div class="border border-gray-200 rounded-xl w-full md:w-1/2 lg:w-1/3 p-6 mt-6 mx-2 hover:shadow-lg transition-shadow duration-300 ease-in-out" data-aos="zoom-in-up">
                            <!-- Nama User -->
                            <h4 class="text-xl font-semibold text-gray-800">{{ $rating->user->name }}</h4>
                        
                            <!-- Rating Bintang -->
                            <div class="flex items-center space-x-1 mb-4">
                                @for ($i = 0; $i < 5; $i++)
                                    <span class="{{ $i < $rating->stars ? 'text-yellow-500' : 'text-gray-300' }}">&starf;</span>
                                @endfor
                            </div>
                        
                            <!-- Tanggal -->
                            <div class="flex items-center text-sm text-gray-500 space-x-2 mb-4">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                                </svg>
                                <span>{{ \Carbon\Carbon::parse($rating->created_at)->format('d F Y') }}</span>
                            </div>
                        
                            <!-- Ulasan -->
                            <p class="text-gray-700 text-sm">"{{ $rating->comment }}"</p>
                        </div>
                    @endif
                @endforeach
            </div>
            
        </div>       
    </section>

    @include('components.footer') <!-- Menambahkan Footer -->

     <!-- AOS JS -->
     <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
     <script>
         // Initialize AOS animation
         AOS.init({
             duration: 1000, 
             once: true,    
         });
     </script>
</body>
</html>
