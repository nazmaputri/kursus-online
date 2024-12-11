@extends('layouts.dashboard-peserta')

@section('content')
<div class="container mx-auto">
    <!-- Konten Belajar -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200">

        <!-- Header Course -->
        <div class="bg-yellow-100/50 text-gray-600 p-6 border-gray-200 border rounded-lg">
            <h2 class="text-2xl font-bold">{{ $course->title }}</h2>
            <p class="text-sm mt-2">Mentor : {{ $course->mentor->name ?? 'Tidak ada mentor' }}</p>
        </div>

        <!-- Silabus Materi -->
        <div class="p-6">
            @foreach ($course->materi as $index => $materi)
                <div class="mb-6">
                    @php
                        // Mendapatkan ID materi yang sudah dikerjakan dari database
                        $completedMateriIds = auth()->user()->materiUsers()->whereNotNull('completed_at')->pluck('materi_id')->toArray();
                    @endphp
                    
                    <!-- Tombol atau Panel Materi -->
                    @if ($index === 0 || in_array($course->materi[$index - 1]->id, $completedMateriIds))
                        <button class="toggle-button w-full text-left bg-gray-50 border hover:bg-gray-200 p-4 rounded-md focus:outline-none flex items-center space-x-2" data-target="materi-{{ $materi->id }}">
                            <!-- Ikon File -->
                            <i class="fas fa-file text-gray-600"></i>
                            <!-- Judul Materi -->
                            <h4 class="font-semibold text-gray-800">{{ $materi->judul }}</h4>
                        </button>
                    @else
                        <button class="w-full text-left bg-neutral-100 p-4 rounded-md focus:outline-none cursor-not-allowed">
                            <div class="flex items-center">
                                <!-- Gembok Ikon -->
                                <i class="fas fa-lock text-yellow-500 mr-2"></i> <!-- Gembok -->
                                <h4 class="font-semibold text-gray-500">{{ $materi->judul }}</h4>
                            </div>
                        </button>
                    @endif                
                    <!-- Panel Konten Materi -->
                    <div id="materi-{{ $materi->id }}" class="materi-content hidden p-4 bg-white rounded-md mt-4 border-t-8 border-t-yellow-200 border">
                        <p class="text-gray-700 mb-4">{{ $materi->deskripsi }}</p>

                        <!-- Video -->
                        @if ($materi->videos && $materi->videos->count())
                            <div class="mt-4">
                                <h5 class="text-md font-semibold text-gray-800 flex items-center space-x-2 mb-2">
                                    <!-- Icon -->
                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M464 256A208 208 0 1 0 48 256a208 208 0 1 0 416 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM188.3 147.1c7.6-4.2 16.8-4.1 24.3 .5l144 88c7.1 4.4 11.5 12.1 11.5 20.5s-4.4 16.1-11.5 20.5l-144 88c-7.4 4.5-16.7 4.7-24.3 .5s-12.3-12.2-12.3-20.9l0-176c0-8.7 4.7-16.7 12.3-20.9z" />
                                    </svg>
                                    <span>Video</span>
                                </h5>        
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                                    @foreach ($materi->videos as $video)
                                        <div class="border p-4 rounded-md shadow-md">
                                            <h4 class="font-semibold mb-2">{{ $video->judul }}</h4>
                                            <video controls class="w-full rounded-md shadow-md">
                                                <source src="{{ asset('storage/' . $video->video_url) }}" type="video/mp4">
                                                Browser Anda tidak mendukung tag video.
                                            </video>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- PDF -->
                        @if ($materi->pdfs && $materi->pdfs->count())
                            <div class="mt-4">
                                <h5 class="text-md font-semibold text-gray-800 flex items-center space-x-2 mb-2">
                                    <!-- Icon -->
                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                        <path d="M64 464c-8.8 0-16-7.2-16-16L48 64c0-8.8 7.2-16 16-16l160 0 0 80c0 17.7 14.3 32 32 32l80 0 0 288c0 8.8-7.2 16-16 16L64 464zM64 0C28.7 0 0 28.7 0 64L0 448c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-293.5c0-17-6.7-33.3-18.7-45.3L274.7 18.7C262.7 6.7 246.5 0 229.5 0L64 0zm56 256c-13.3 0-24 10.7-24 24s10.7 24 24 24l144 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-144 0zm0 96c-13.3 0-24 10.7-24 24s10.7 24 24 24l144 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-144 0z"/>
                                    </svg>
                                    <span>File Dokumen</span>
                                </h5>  
                                <ul class="list-disc pl-6">
                                    @foreach ($materi->pdfs as $pdf)
                                        <li>
                                            <a href="{{ asset('storage/' . $pdf->pdf_file) }}" class="text-blue-500 hover:underline" target="_blank">{{ $pdf->judul }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if ($materi->quizzes && $materi->quizzes->count())
                            <div class="mt-4">
                                <h5 class="text-md font-semibold text-gray-800 flex items-center space-x-2 mb-2">
                                    <!-- Icon -->
                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                        <path d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 125.7-86.8 86.8c-10.3 10.3-17.5 23.1-21 37.2l-18.7 74.9c-2.3 9.2-1.8 18.8 1.3 27.5L64 512c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128zM549.8 235.7l14.4 14.4c15.6 15.6 15.6 40.9 0 56.6l-29.4 29.4-71-71 29.4-29.4c15.6-15.6 40.9-15.6 56.6 0zM311.9 417L441.1 287.8l71 71L382.9 487.9c-4.1 4.1-9.2 7-14.9 8.4l-60.1 15c-5.5 1.4-11.2-.2-15.2-4.2s-5.6-9.7-4.2-15.2l15-60.1c1.4-5.6 4.3-10.8 8.4-14.9z"/>
                                    </svg>
                                    <span>Kuis</span>
                                </h5>  
                                <ul class="list-disc pl-6">
                                    @foreach ($materi->quizzes as $quiz)
                                        <li>
                                            <a href="#" 
                                            class="text-green-500 hover:underline quiz-link" 
                                            data-quiz-title="{{ $quiz->title }}" 
                                            data-quiz-url="{{ route('quiz.show', $quiz) }}" 
                                            data-quiz-duration="{{ $quiz->duration }}">
                                                {{ $quiz->title }}
                                            </a>                                            
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <!-- Modal -->
                        <div id="quizModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                            <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                                <h3 id="modalTitle" class="text-lg font-semibold mb-4">Konfirmasi</h3>
                                <p id="modalMessage" class="text-gray-700 mb-6"></p>
                                <div class="flex justify-end space-x-4">
                                    <button id="cancelButton" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-400 focus:outline-none">
                                        Tidak
                                    </button>
                                    <a id="confirmButton" href="#" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 focus:outline-none">
                                        Ya
                                    </a>
                                </div>
                            </div>
                        </div>
                        <script>
                            document.addEventListener("DOMContentLoaded", function () {
                                const quizLinks = document.querySelectorAll(".quiz-link");
                                const modal = document.getElementById("quizModal");
                                const modalTitle = document.getElementById("modalTitle");
                                const modalMessage = document.getElementById("modalMessage");
                                const confirmButton = document.getElementById("confirmButton");
                                const cancelButton = document.getElementById("cancelButton");
                        
                                // Menambahkan event listener hanya pada elemen dengan kelas .quiz-link
                                quizLinks.forEach(link => {
                                    link.addEventListener("click", function (event) {
                                        event.preventDefault(); // Mencegah navigasi langsung ke URL kuis
                                    
                                        const title = this.dataset.quizTitle;
                                        const url = this.dataset.quizUrl;
                                        const duration = this.dataset.quizDuration;
                        
                                        // Mengupdate konten modal
                                        modalTitle.textContent = `Apakah Anda yakin ingin mengambil kuis ini?`;
                                        modalMessage.textContent = `Kuis "${title}" membutuhkan waktu ${duration} menit untuk diselesaikan.`;
                                        confirmButton.href = url; // Memastikan link kuis diteruskan ke tombol konfirmasi
                        
                                        // Menampilkan modal
                                        modal.classList.remove("hidden");
                                    });
                                });
                        
                                // Menangani tombol "Tidak"
                                cancelButton.addEventListener("click", function () {
                                    modal.classList.add("hidden"); // Menyembunyikan modal jika dibatalkan
                                });
                            });
                        </script>
                    
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggleButtons = document.querySelectorAll(".toggle-button");

        toggleButtons.forEach(button => {
            button.addEventListener("click", function () {
                const targetId = this.getAttribute("data-target");
                const content = document.getElementById(targetId);

                // Toggle hidden class
                content.classList.toggle("hidden");
            });
        });
    });
</script>
@endsection
