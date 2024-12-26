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
<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    @include('components.navbar') <!-- Menambahkan Navbar -->

    <!-- Bagian Materi Kursus -->
    <section id="course" class="py-12 bg-white mt-16 p-6">
        <div class="mb-4">
            <h3 class="text-3xl font-bold text-center text-sky-400" data-aos="fade-up">
                Daftar Kursus Yang Tersedia
            </h3>
        </div>

        <!-- Description -->
        <p class="text-lg text-gray-700 text-center mb-6" data-aos="fade-up">
            Kategori : {{ $category->name }}
        </p>
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" data-aos="zoom-in-down">
                @forelse ($category->courses as $course)
                    <!-- Card Kursus -->
                    <a href="{{ route('kursus.detail', $course->id) }}" class="block bg-white rounded-lg shadow-md hover:shadow-lg  transition-transform transform hover:scale-105">
                        <!-- Card Kursus -->
                        <div class="flex flex-col overflow-hidden">
                            <!-- Gambar Kursus -->
                            <div class="w-full">
                                <img src="{{ asset('storage/' . $course->image_path) }}" alt="{{ $course->title }}" class="w-full h-48 object-cover">
                            </div>
    
                            <!-- Konten Kursus -->
                            <div class="p-4 flex flex-col">
                                <!-- Judul Kursus -->
                                <h1 class="text-2xl font-semibold text-gray-800 mb-2">{{ $course->title }}</h1>
                                
                                <!-- Nama Mentor -->
                                <p class="text-sm text-gray-600 mb-2">
                                    👨‍🏫 Mentor : {{ $course->mentor ? $course->mentor->name : 'Mentor tidak ditemukan' }}
                                </p>                        
                                
                                <!-- Rating -->
                                <div class="flex items-center mb-2">
                                    <div class="flex">
                                        @for ($i = 0; $i < 5; $i++)
                                            @if ($i < floor($course->average_rating)) <!-- Rating Penuh -->
                                                <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927a1 1 0 011.902 0l1.715 4.993 5.274.406a1 1 0 01.593 1.75l-3.898 3.205 1.473 4.74a1 1 0 01-1.516 1.11L10 15.347l-4.692 3.783a1 1 0 01-1.516-1.11l1.473-4.74-3.898-3.205a1 1 0 01.593-1.75l5.274-.406L9.049 2.927z"></path>
                                                </svg>
                                            @elseif ($i < ceil($course->average_rating)) <!-- Rating Setengah -->
                                                <svg class="w-4 h-4" viewBox="0 0 20 20">
                                                    <defs>
                                                        <linearGradient id="half-star-{{ $i }}">
                                                            <stop offset="50%" stop-color="rgb(234,179,8)" /> <!-- Kuning -->
                                                            <stop offset="50%" stop-color="rgb(209,213,219)" /> <!-- Abu-abu -->
                                                        </linearGradient>
                                                    </defs>
                                                    <path fill="url(#half-star-{{ $i }})" d="M9.049 2.927a1 1 0 011.902 0l1.715 4.993 5.274.406a1 1 0 01.593 1.75l-3.898 3.205 1.473 4.74a1 1 0 01-1.516 1.11L10 15.347l-4.692 3.783a1 1 0 01-1.516-1.11l1.473-4.74-3.898-3.205a1 1 0 01.593-1.75l5.274-.406L9.049 2.927z"></path>
                                                </svg>
                                            @else <!-- Rating Kosong -->
                                                <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927a1 1 0 011.902 0l1.715 4.993 5.274.406a1 1 0 01.593 1.75l-3.898 3.205 1.473 4.74a1 1 0 01-1.516 1.11L10 15.347l-4.692 3.783a1 1 0 01-1.516-1.11l1.473-4.74-3.898-3.205a1 1 0 01.593-1.75l5.274-.406L9.049 2.927z"></path>
                                                </svg>
                                            @endif
                                        @endfor
                                          <!-- Jumlah Rating -->
                                          <span class="ml-2 text-gray-600 text-sm">({{ number_format($course->average_rating, 1) }} / 5)</span>
                                    </div>
                                </div>
                                <!-- Harga Kursus -->
                                <p class="inline-flex items-center text-xl mt-2 rounded-2xl font-bold">
                                    <span class="text-green-600 bg-green-300 inline-flex items-center text-xl p-3 rounded-2xl font-bold">Rp. {{ number_format($course->price, 0, ',', '.') }}</span>
                                </p>
                            </div>
                        </div>
                    </a>
                @empty
                    <!-- Pesan Jika Tidak Ada Kursus -->
                    <p class="col-span-full text-center text-gray-500">
                        Belum ada kursus dalam kategori ini.
                    </p>
                @endforelse
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
