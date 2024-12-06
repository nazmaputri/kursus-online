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
    <section id="course" class="py-12 bg-white mt-16">
        <div class="container mx-auto p-10">
            <div class="mb-6 flex items-center space-x-2">
                <!-- Nama Kategori -->
                <a href="/" class="bg-sky-300 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded-full">
                    Kembali
                </a>
                <a href="/login" class="bg-sky-300 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded-full">
                    Beli Sekarang
                </a>
            </div>                  
            <div class="flex flex-col lg:flex-row items-start gap-8">
                <!-- Div Gambar -->
                <div class="relative lg:w-1/3 w-full z-10">
                    <div class="bg-white shadow-lg border rounded-xl p-6 transform transition-transform hover:scale-105">
                        <img src="{{ asset('storage/' . $course->image_path) }}" alt="{{ $course->title }}" class="rounded-lg w-full h-auto mb-4">
                        <p class="text-2xl font-semibold text-gray-800 mb-2">Rp {{ number_format($course->price, 0, ',', '.') }}</p>
                        <p class="text-gray-600 mb-2">Kursus ini mencakup :</p>
                        <ul class="list-disc list-inside text-gray-600 space-y-2">
                            <li>Total Materi: {{ $course->materi->count() }}</li>
                            <li>Total Materi Video: {{ $course->videos_count }}</li>
                            <li>Total Materi PDF: {{ $course->pdfs_count }}</li>
                            <li>Chat dengan Mentor</li>
                            <li>Akses penuh seumur hidup</li>
                            <li>Sertifikat penyelesaian</li>
                        </ul>
                    </div>
                </div>
            
                <!-- Div Informasi -->
                <div class="lg:w-2/3 w-full flex flex-col gap-8">
                    <!-- Informasi Kursus -->
                    <div class="bg-white p-8 rounded-xl shadow-lg border">
                        <h2 class="text-3xl font-bold text-gray-900">{{ $course->title }}</h2>
                        <p class="text-gray-700 mt-4">{{ $course->description }}</p>
                        <p class="text-gray-600 mt-2"><strong>Mentor :</strong> {{ $course->mentor->name }}</p>
            
                        <!-- Rating -->
                        <div class="flex items-center mt-4">
                            @for ($i = 0; $i < 5; $i++)
                                @if ($i < floor($course->rating))
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 15l-5.45 3.18 1.04-6.06L.45 7.64l6.09-.88L10 1l2.46 5.72 6.09.88-4.64 4.48 1.04 6.06L10 15z" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 15l-5.45 3.18 1.04-6.06L.45 7.64l6.09-.88L10 1l2.46 5.72 6.09.88-4.64 4.48 1.04 6.06L10 15z" />
                                    </svg>
                                @endif
                            @endfor
                            <span class="ml-2 text-gray-600">({{ $course->rating }} / 5)</span>
                        </div>
                    </div>
                    <!-- Yang Akan di Pelajari -->
                    <div class="bg-white shadow-lg p-8 rounded-xl border">
                        <h2 class="text-3xl font-bold text-gray-900">Yang Akan di Pelajari :</h2>
                        <ul class="grid grid-cols-1 sm:grid-cols-2 text-gray-700 mt-4 gap-y-2">
                            @foreach ($course->materi as $materi)
                                <li class="flex items-center space-x-2">
                                    <!-- Icon ceklis -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L7 13.586 4.707 11.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l9-9a1 1 0 000-1.414z" clip-rule="evenodd" />
                                    </svg>
                                    <!-- Teks materi -->
                                    <span>{{ $materi->judul }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>                    
                </div>
            </div>            
        </div>
    </section>
    <!-- Silabus -->
    <div class="bg-sky-50 w-full p-12 rounded-t-[70px]">
        <h3 class="text-3xl uppercase font-bold mb-6 pb-2 inline-block text-gray-600 border-b-4 ">Materi Kursus</h3>
        <div class="space-y-4">
            @foreach($course->materi as $materi)
                <div class="bg-white shadow-md rounded-lg p-6 transform transition-transform hover:scale-105 hover:bg-neutral-50">
                    <div x-data="{ open: false }">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 font-semibold mr-2">
                                {{ sprintf('%02d', $loop->iteration) }}.
                            </span>
                            <h4 class="text-lg font-semibold text-gray-800 flex-1">
                                {{ $materi->judul }}
                            </h4>
                            <button @click="open = !open" class="text-gray-600 hover:text-gray-800">
                                <svg :class="open ? 'rotate-180' : ''" class="w-5 h-5 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                        </div>
                        <p class="text-gray-600 mt-2" x-show="open" x-transition>{{ $materi->deskripsi }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @include('components.footer') <!-- Menambahkan Footer -->
</body>
</html>
