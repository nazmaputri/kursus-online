@extends('layouts.dashboard-peserta')

@section('content')
<div class="container mx-auto">
    <div class="bg-white p-8 rounded-lg shadow-md relative">
        <h2 class="text-2xl font-bold mb-8 border-b-2 border-gray-300 pb-2 uppercase">Detail Kursus</h2>
        @if(session('success'))
        <div class="fixed top-0 left-0 right-0 z-50 p-4 bg-green-500 text-white text-center">
            <p>{{ session('success') }}</p>
        </div>
        @endif
        <!-- Card Informasi Kursus -->
        <div class="flex flex-col lg:flex-row mb-4">
            <div class="w-full lg:w-1/3 mb-4 lg:mb-0">
                @if($course && $course->image_path)
                    <img src="{{ asset('storage/' . $course->image_path) }}" alt="{{ $course->title }}" class="rounded-lg w-full h-auto">
                @else
                    <img src="https://via.placeholder.com/400x300" alt="Default Course Image" class="rounded-lg w-full h-auto">
                @endif
            </div>
            <div class="ml-4 w-2/3 space-y-3">
                <h2 class="text-2xl font-bold capitalize">{{ $course->title }}</h2>
                <p class="text-gray-700 text-sm">{{ $course->description }}</p>
                <p class="text-gray-600"><strong>Mentor :</strong> {{ $course->mentor->name }}</p>
                <p class="text-gray-600"><strong>Biaya :</strong> Rp {{ number_format($course->price, 0, ',', '.') }}</p>
                @if($course->start_date && $course->end_date)
                    <p class="text-gray-600"><strong>Tanggal Mulai :</strong> {{ \Carbon\Carbon::parse($course->start_date)->format('d F Y') }} - {{ \Carbon\Carbon::parse($course->end_date)->format('d F Y') }}</p>
                @endif
                @if($course->duration)
                    <p class="text-gray-600"><strong>Durasi :</strong> {{ $course->duration }}</p>
                @endif
                @if($course->capacity)
                    <p class="text-gray-600"><strong>Kapasitas :</strong> {{ $course->capacity }}</p>
                @endif
            </div>
        </div> 
        <div class="flex mb-6">
            <!-- Tombol Rating di sebelah kiri Tombol Kembali -->
            <button id="ratingButton" class="bg-yellow-300 hover:bg-yellow-500 text-white font-bold py-2 px-3 rounded absolute bottom-0 right-24 mb-4 mr-4">
                Beri Rating
            </button>

            <!-- Tombol Kembali di pojok kanan bawah -->
            <a href="{{ route('daftar-kursus') }}" class="bg-sky-300 hover:bg-sky-600 text-white font-bold py-2 px-3 rounded absolute bottom-0 right-0 mb-4 mr-4">
                Kembali
            </a>

            <!-- Pop-up Modal -->
            <div id="ratingModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                    <h2 class="text-xl font-semibold mb-4 text-center border-b-2 pb-2">Beri Rating Kursus</h2>
                    <p class="mb-4 text-gray-600">Bagaimana pengalaman Anda dengan kursus ini?</p>

                    <!-- Form Rating -->
                    <form action="{{ route('ratings.store', $course->id) }}" method="POST">
                        @csrf
                        <!-- Rating Input -->
                        <div class="flex space-x-2 mb-4">
                            <input type="hidden" name="stars" id="ratingValue" value="">
                            @for ($i = 1; $i <= 5; $i++)
                            <span 
                                class="star text-2xl cursor-pointer text-gray-400 hover:text-yellow-400" 
                                data-value="{{ $i }}">★</span>
                            @endfor
                        </div>

                        <!-- Komentar -->
                        <div class="mb-4">
                            <label for="comment" class="block text-gray-700 font-semibold mb-2">Komentar (Opsional)</label>
                            <textarea name="comment" id="comment" rows="4" class="w-full border border-gray-300 rounded-lg px-3 py-2" placeholder="Berikan komentar Anda..."></textarea>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="flex justify-end space-x-2">
                            <button id="closeModal" type="button" class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded">
                                Tutup
                            </button>
                            <button type="submit" class="bg-blue-400 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                Kirim Rating
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const ratingButton = document.getElementById('ratingButton');
                    const ratingModal = document.getElementById('ratingModal');
                    const closeModal = document.getElementById('closeModal');
                    const stars = document.querySelectorAll('.star');
                    const ratingValue = document.getElementById('ratingValue');

                    // Tampilkan modal
                    ratingButton.addEventListener('click', () => {
                        ratingModal.classList.remove('hidden');
                    });

                    // Tutup modal
                    closeModal.addEventListener('click', () => {
                        ratingModal.classList.add('hidden');
                    });

                    // Logika interaktif untuk bintang
                    stars.forEach(star => {
                        star.addEventListener('click', () => {
                            const value = star.getAttribute('data-value');
                            ratingValue.value = value;  // Set nilai rating yang dipilih pada input hidden

                            // Reset warna bintang
                            stars.forEach(s => {
                                s.classList.remove('text-yellow-400');
                                s.classList.add('text-gray-400');
                            });

                            // Warnai bintang yang dipilih dan sebelumnya
                            for (let i = 0; i < value; i++) {
                                stars[i].classList.remove('text-gray-400');
                                stars[i].classList.add('text-yellow-400');
                            }
                        });
                    });
                });
            </script>
        </div>
    </div>
</div>
@endsection
