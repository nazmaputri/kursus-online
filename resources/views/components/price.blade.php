<!-- Price Section -->
<section id="price" class="bg-white py-16">
    <div class="container mx-auto px-6">
        <div class="mb-6 text-center">
            <h3 class="text-3xl font-bold text-sky-400" data-aos="fade-down">Rekomendasi Kursus EduFlix</h3>
            <p class="text-lg text-gray-700 mt-2" data-aos="fade-down">Pilih kursus yang sesuai dengan kebutuhan Anda.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($courses as $course)
                <a href="{{ route('kursus.detail', $course->id) }}" class="block bg-white rounded-lg shadow-md hover:shadow-lg  transition-transform transform hover:scale-105 duration-300">
                    <!-- Card Kursus -->
                    <div class="bg-white border border-gray-300 rounded-lg shadow-md flex flex-col overflow-hidden" data-aos="zoom-in">
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
            @endforeach
        </div>
    </div>
</section>
