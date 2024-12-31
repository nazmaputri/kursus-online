@extends('layouts.dashboard-admin')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl uppercase font-bold mb-6 border-b-2 border-gray-300 pb-2">Detail Kursus</h2>
    <!-- Card Informasi Kursus -->
    <div class="flex mb-4">
            <!-- Thumbnail Kursus -->
            <div class="w-1/3">
                    <img src="{{ asset('storage/' . $course->image_path) }}" alt="{{ $course->title }}" class="rounded-lg w-full h-auto">
                </div>
                <!-- Informasi Kursus -->
                <div class="ml-4 w-2/3 space-y-1">
                    <h2 class="text-2xl font-bold mb-2">{{ $course->title }}</h2>
                    <p class="text-gray-700 mb-2">{{ $course->description }}</p>
                    <p class="text-gray-600"><strong>Mentor :</strong> {{ $course->mentor->name }}</p>
                    <p class="text-gray-600"><strong>Tanggal Mulai :</strong> {{ $course->start_date }}</p>
                    <p class="text-gray-600"><strong>Durasi :</strong> {{ $course->duration }}</p>
                    <p class="text-gray-600"><strong>Biaya :</strong> Rp {{ number_format($course->price, 0, ',', '.') }}</p>
                </div>
            </div>
            <!-- Tambahkan Alpine.js -->
            <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

            <!-- Silabus -->
            <div class="mt-10">
                <h3 class="text-2xl uppercase font-bold mb-6 border-b-2 border-gray-300 pb-2">Materi Kursus</h3>
                <div class="space-y-6">
                    @foreach($course->materi as $materi)
                    <div class="bg-neutral-50 p-4 rounded-lg shadow-md">
                        <div x-data="{ open: false }">
                            <!-- Judul Materi dengan Toggle Dropdown -->
                            <div class="flex justify-between items-center">
                                <!-- Menambahkan nomor urut di sebelah kiri judul -->
                                <span class="text-gray-700 font-semibold mr-2">
                                    {{ sprintf('%02d', $loop->iteration) }}.
                                </span>
                                <h4 class="text-lg font-semibold text-gray-800 flex-1">{{ $materi->judul }}</h4>
                                
                                <!-- Tombol Toggle -->
                                <button @click="open = ! open" class="text-gray-600 hover:text-gray-800">
                                    <svg :class="open ? 'transform rotate-180' : ''" class="w-5 h-5 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                            </div>

                            <!-- Deskripsi Materi -->
                            <p class="text-gray-600 mb-2 mt-2" x-show="open" x-transition>{{ $materi->deskripsi }}</p>

                            <!-- Video (Tampilkan hanya jika open adalah true) -->
                            <div x-show="open" x-transition>
                                @if($materi->videos->count())
                                <div class="mt-4">
                                    <h5 class="text-md font-semibold text-gray-800">🎥 Video</h5>
                                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4 list-none p-0">
                                        @foreach($materi->videos as $video)
                                        <li class="text-gray-700">
                                            <p>{{ $video->judul }}</p>
                                            <!-- Menampilkan video dalam ukuran lebih kecil -->
                                            <video controls class="w-full h-full object-cover mt-2">
                                                <source src="{{ asset('storage/' . $video->video_url) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>                                
                                @else
                                <p class="text-gray-600 mt-4">Belum ada video untuk materi ini.</p>
                                @endif
                            </div>

                            <!-- Materi PDF -->
                            <div x-show="open" x-transition>
                                @if($materi->pdfs->count())
                                <div class="mt-10">
                                    <h5 class="text-md font-semibold text-gray-800">📄 Materi PDF</h5>
                                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4 list-none p-0">
                                        @foreach($materi->pdfs as $file)
                                        <li class="text-gray-700">
                                            <p>{{ $file->judul }}</p>
                                            <iframe 
                                                src="{{ asset('storage/' . $file->pdf_file) }}" 
                                                class="w-full h-96 rounded-md mt-2" 
                                                frameborder="0">
                                            </iframe>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @else
                                <p class="text-gray-600 mt-4">Belum ada materi PDF untuk materi ini.</p>
                                @endif
                            </div>

                            <!-- Kuis -->
                            <div x-show="open" x-transition>
                                {{-- @if($materi->quizzes->count())
                                <div class="mt-4">
                                    <h5 class="text-md font-semibold text-gray-800">📝 Kuis</h5>
                                    <ul class="list-disc list-inside">
                                        @foreach($materi->quizzes as $quiz)
                                        <li>
                                            <a href="{{ route('quizzes.show', $quiz->id) }}" class="text-sky-400 hover:underline">
                                                {{ $quiz->title }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @else
                                <p class="text-gray-600 mt-4">Belum ada kuis untuk materi ini.</p>
                                @endif --}}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Tabel Peserta Terdaftar -->
        <div class="mt-6 bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-bold mb-6 text-left border-b-2 border-gray-300 pb-2 uppercase">Peserta Terdaftar</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full border-separate border-spacing-1" id="courseTable">
                    <thead>
                        <tr class="bg-sky-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="border border-gray-300 py-2 px-2 rounded-md">No</th>
                            <th class="border border-gray-300 py-2 px-4 rounded-md">Nama Peserta</th>
                            <th class="border border-gray-300 py-2 px-4 rounded-md">Email</th>
                            <th class="border border-gray-300 py-2 rounded-md">Status Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($participants as $index => $participant)
                        <tr class="bg-white hover:bg-sky-50 user-row">
                            <td class="py-2 px-4 text-center border border-gray-300 rounded-md">{{ $index + 1 }}</td>
                            <td class="py-2 px-4 border border-gray-300 rounded-md">{{ $participant->user->name }}</td>
                            <td class="py-2 px-4 border border-gray-300 rounded-md">{{ $participant->user->email }}</td>
                            <td class="py-2 border border-gray-300 rounded-md text-center text-green-500">{{ $participant->transaction_status }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-gray-500">Belum ada peserta terdaftar.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $participants->links() }}
                </div>
            </div>
            <div class="mt-6 flex justify-end">
            <a href="{{ route('categories.show', $category->name) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                Kembali
            </a>
        </div> 
    </div>
</div>

@endsection
