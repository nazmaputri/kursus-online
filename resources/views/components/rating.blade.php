<!-- Testimoni Section -->
<section id="rating" class="bg-white py-16">
    <div class="container mx-auto px-6">
        <div class="mb-6 text-center">
            <h3 class="text-3xl font-bold text-sky-400" data-aos="fade-down">
                Testimoni Pengguna
            </h3>
            <p class="text-lg text-gray-700 mt-2" data-aos="fade-down">
                Apa kata pengguna kami setelah mengikuti kursus di Eduflix?
            </p>
        </div>
        <div class="overflow-x-auto hide-scrollbar">
            <div class="flex space-x-6 m-7">
                @foreach ($ratings as $rating)
                    @if ($rating->display) 
                        <div class="bg-white border border-gray-200 rounded-lg shadow-md w-full md:w-1/2 lg:w-1/3 p-6 mt-6 mx-2 hover:shadow-lg transition-shadow duration-300 ease-in-out" data-aos="zoom-in-up">
                            <div class="flex items-center mb-4">
                                <!-- Gambar avatar (ikon user) -->
                                <div class="w-14 h-14 rounded-full flex items-center justify-center">
                                    <img width="48" height="48" src="https://img.icons8.com/pulsar-color/48/user-male-circle.png" alt="user-male-circle"/>
                                </div>
        
                                <!-- Nama dan Rating -->
                                <div class="ml-4">
                                    <!-- Nama User -->
                                    <h4 class="text-xl font-semibold text-sky-400 capitalize">{{ $rating->nama }}</h4>
                                    <div class="flex items-center mt-1">
                                        <!-- Menampilkan bintang berdasarkan rating -->
                                        @for ($i = 0; $i < 5; $i++)
                                            <span class="{{ $i < $rating->rating ? 'text-yellow-500' : 'text-gray-300' }}">&starf;</span>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            
                            <p class="text-gray-700 mt-2">"{{ $rating->comment }}"</p>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        
    </div>

    <style>
        /* Animasi hover untuk card testimoni */
        .hover\:shadow-lg:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
    </style>
</section>

<!-- Rating Section -->
<section id="rating" class="bg-neutral-50 py-16 rounded-t-[75px]">
    <div class="container mx-auto px-6">
        <div class="flex flex-col lg:flex-row lg:space-x-12 items-center">
            <!-- Image Section -->
            <div class="lg:w-1/3 order-1 lg:order-2 lg:mb-0 flex justify-center" data-aos="fade-left">
                <img src="{{ asset('storage/eduflix-1.png') }}" alt="Gambar" class="w-4/4 h-auto">
            </div>

            <!-- Text Content -->
            <div class="lg:w-7/12 space-y-6 order-2 lg:order-1" data-aos="fade-right">
                <!-- Title -->
                <div class="mb-6">
                    <h3 class="text-3xl font-bold text-sky-400">
                        Berikan Penilaian Anda untuk Eduflix
                    </h3>
                </div>

                <!-- Rating Form -->
                <form class="space-y-4" method="POST" action="{{ route('rating.store') }}">
                    @csrf
                    <div>
                        <label for="nama" class="block text-lg text-gray-700">Nama :</label>
                        <input type="nama" id="nama" name="nama" class="border border-gray-300 rounded-md p-2 w-full max-w-xs" placeholder="Masukkan nama Anda" required/>
                    </div>

                    <div>
                        <label for="email" class="block text-lg text-gray-700">Email :</label>
                        <input type="email" id="email" name="email" class="border border-gray-300 rounded-md p-2 w-full max-w-xs" placeholder="Masukkan email Anda" required/>
                    </div>

                    <div>
                        <label for="rating" class="block text-lg text-gray-700">Rating :</label>
                        <select id="rating" name="rating" class="border border-gray-300 rounded-md p-2 w-full max-w-xs" required>
                            <option value="5">⭐️⭐️⭐️⭐️⭐️ (5/5)</option>
                            <option value="4">⭐️⭐️⭐️⭐️ (4/5)</option>
                            <option value="3">⭐️⭐️⭐️ (3/5)</option>
                            <option value="2">⭐️⭐️ (2/5)</option>
                            <option value="1">⭐️ (1/5)</option>
                        </select>
                    </div>

                    <div>
                        <label for="comment" class="block text-lg text-gray-700">Komentar :</label>
                        <textarea id="comment" name="comment" rows="4" class="border border-gray-300 rounded-md p-2 w-full" placeholder="Tulis ulasan Anda di sini..."></textarea>
                    </div>

                    <button
                        type="submit" class="bg-sky-400 text-white px-4 py-2 rounded-md hover:bg-sky-500 focus:outline-none">
                        Kirim Ulasan
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Modal Pop-up Notifikasi -->
@if (session('success'))
    <div id="successModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-96">
            <h3 class="text-xl font-semibold text-center text-green-400">{{ session('success') }}</h3>
            <div class="flex justify-center mt-4">
                <button id="closeModal" class="bg-green-400 text-white px-6 py-2 rounded-md hover:bg-green-500 focus:outline-none">
                    OK
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Menampilkan modal pop-up jika ada pesan sukses
            const modal = document.getElementById('successModal');
            const closeModal = document.getElementById('closeModal');

            // Menutup modal ketika tombol OK diklik
            closeModal.addEventListener('click', function () {
                modal.style.display = 'none';
            });
        });
    </script>
@endif
