<!-- Price Section -->
<section id="price" class="bg-white py-16">
    <div class="container mx-auto px-6">
        <div class="mb-6 text-center">
            <h3 class="text-3xl font-bold text-sky-400" data-aos="fade-down">Rekomendasi Kursus EduFlix</h3>
            <p class="text-lg text-gray-700 mt-2" data-aos="fade-down">Pilih kursus yang sesuai dengan kebutuhan Anda.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($courses as $course)
                <a href="{{ route('kursus.detail', $course->id) }}" class="block rounded-lg  transition-transform transform hover:scale-105 duration-300">
                    <!-- Card Kursus -->
                    <div class="bg-white border border-gray-300 rounded-lg shadow-md  hover:shadow-lg  flex flex-col overflow-hidden" data-aos="zoom-in">
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
                      
                            <!-- Harga Kursus -->
                            <p class="inline-flex items-center text-xl mt-2 rounded-2xl font-bold">
                                <span class="text-green-600 bg-green-300 inline-flex items-center text-xl p-3 rounded-2xl font-bold">Rp. {{ number_format($course->price, 0, ',', '.') }}</span>
                            </p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
