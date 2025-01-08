@extends('layouts.dashboard-peserta')

@section('content')
<div class="container mx-auto">
    <div class="bg-white p-8 rounded-lg shadow-md relative">
        <h2 class="text-2xl font-bold mb-8 border-b-2 border-gray-300 pb-2 uppercase">Detail Kursus</h2>
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
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
        <div class="flex flex-col sm:flex-row mb-6"> <!-- Menambahkan 'relative' pada induk -->
            <!-- Tombol Rating -->
            @if(!$hasRated)
            <button id="ratingButton" class="bg-yellow-400 hover:bg-yellow-600 text-white font-bold py-2 px-3 rounded mb-4 sm:mb-4 sm:absolute sm:bottom-0 sm:right-24 sm:mr-4">
                Beri Rating
            </button>
            @else
            <button class="bg-gray-400 text-white font-bold py-2 px-3 rounded mb-4 sm:mb-4 sm:absolute sm:bottom-0 sm:right-24 sm:mr-4 cursor-not-allowed" disabled>
                Anda sudah memberikan rating
            </button>
            @endif
        
            <!-- Tombol Kembali di pojok kanan bawah -->
            <a href="{{ route('daftar-kursus') }}" class="bg-sky-300 hover:bg-sky-600 text-white font-bold py-2 px-3 text-center rounded sm:absolute sm:bottom-0 sm:right-0 sm:mr-4 sm:mb-4">
                Kembali
            </a>
        </div>
        <!-- Modal Pop-up -->
    <div id="ratingModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h2 class="text-lg font-bold mb-4">Beri Rating untuk Kursus</h2>
            <form id="ratingForm" method="POST" action="{{ route('ratings.store', ['course_id' => $course->id]) }}">
                @csrf
                <input type="hidden" name="course_id" value="{{ $course->id }}">
                <div class="mb-4">
                    <label for="stars" class="block text-sm font-medium mb-2">Rating</label>
                    <div id="starRating" class="flex space-x-1">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg data-value="{{ $i }}" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400 cursor-pointer hover:text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 .587l3.668 7.451 8.332 1.151-6.064 5.865 1.486 8.246L12 18.897l-7.422 4.403 1.486-8.246L.667 9.189l8.332-1.151z" />
                            </svg>
                        @endfor
                    </div>
                    <input type="hidden" name="stars" id="stars" required>
                </div>
                <script>
                    const stars = document.querySelectorAll('#starRating svg');
                    const starInput = document.getElementById('stars');
                
                    stars.forEach(star => {
                        star.addEventListener('click', () => {
                            const value = star.getAttribute('data-value');
                            starInput.value = value;
                
                            // Reset warna semua bintang
                            stars.forEach(s => s.classList.remove('text-yellow-500'));
                            stars.forEach(s => s.classList.add('text-gray-400'));
                
                            // Warnai bintang sesuai rating yang dipilih
                            for (let i = 0; i < value; i++) {
                                stars[i].classList.remove('text-gray-400');
                                stars[i].classList.add('text-yellow-500');
                            }
                        });
                    });
                </script>                
                <div class="mb-4">
                    <label for="comment" class="block text-sm font-medium">Komentar</label>
                    <textarea name="comment" id="comment" class="w-full border rounded px-2 py-1" rows="4" placeholder="Tulis komentar Anda (opsional)"></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="button" id="closeRatingModal" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                        Batal
                    </button>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Menampilkan modal saat tombol "Beri Rating" diklik
        document.getElementById('ratingButton').addEventListener('click', function () {
            document.getElementById('ratingModal').classList.remove('hidden');
        });

        // Menyembunyikan modal saat tombol "Batal" diklik
        document.getElementById('closeRatingModal').addEventListener('click', function () {
            document.getElementById('ratingModal').classList.add('hidden');
        });
    </script>
    </div>
</div>
@endsection
