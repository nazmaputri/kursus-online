<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $course->judul ?? 'Kursus' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    @include('components.navbar') <!-- Menambahkan Navbar -->

    <!-- Bagian Materi Kursus -->
    <section id="course" class="py-12 bg-white mt-16 p-6">
        <div class="mb-4">
            <h3 class="text-3xl font-bold text-center text-sky-400">
                Daftar Kursus Yang Tersedia
            </h3>
        </div>

        <!-- Description -->
        <p class="text-lg text-gray-700 text-center mb-6">
            Kategori : {{ $category->name }}
        </p>
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
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
                                    @php
                                        $fullStars = floor($course->rating); // Bintang penuh
                                        $halfStar = $course->rating - $fullStars >= 0.5; // Bintang setengah
                                        $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0); // Bintang kosong
                                    @endphp
                                    <!-- Bintang Penuh -->
                                    @for ($i = 0; $i < $fullStars; $i++)
                                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927a1 1 0 011.902 0l1.715 4.993 5.274.406a1 1 0 01.593 1.75l-3.898 3.205 1.473 4.74a1 1 0 01-1.516 1.11L10 15.347l-4.692 3.783a1 1 0 01-1.516-1.11l1.473-4.74-3.898-3.205a1 1 0 01.593-1.75l5.274-.406L9.049 2.927z"></path>
                                        </svg>
                                    @endfor
    
                                    <!-- Bintang Setengah -->
                                    @if ($halfStar)
                                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <defs>
                                                <linearGradient id="half-star">
                                                    <stop offset="50%" stop-color="currentColor" />
                                                    <stop offset="50%" stop-color="white" />
                                                </linearGradient>
                                            </defs>
                                            <path fill="url(#half-star)" d="M9.049 2.927a1 1 0 011.902 0l1.715 4.993 5.274.406a1 1 0 01.593 1.75l-3.898 3.205 1.473 4.74a1 1 0 01-1.516 1.11L10 15.347l-4.692 3.783a1 1 0 01-1.516-1.11l1.473-4.74-3.898-3.205a1 1 0 01.593-1.75l5.274-.406L9.049 2.927z"></path>
                                        </svg>
                                    @endif
    
                                    <!-- Bintang Kosong -->
                                    @for ($i = 0; $i < $emptyStars; $i++)
                                        <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927a1 1 0 011.902 0l1.715 4.993 5.274.406a1 1 0 01.593 1.75l-3.898 3.205 1.473 4.74a1 1 0 01-1.516 1.11L10 15.347l-4.692 3.783a1 1 0 01-1.516-1.11l1.473-4.74-3.898-3.205a1 1 0 01.593-1.75l5.274-.406L9.049 2.927z"></path>
                                        </svg>
                                    @endfor
                                </div>
                                
                                <!-- Harga Kursus -->
                                <p class="text-lg font-semibold text-gray-800 mb-4">
                                    <span class="text-sky-400">Rp {{ number_format($course->price, 0, ',', '.') }}</span>
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
</body>
</html>