<!-- Price Section -->
<section id="price" class="bg-white py-16">
    <div class="container mx-auto px-6">
        <div class="mb-6 text-center">
            <h3 class="text-3xl font-bold text-sky-400">Paket Harga untuk Kursus</h3>
            <p class="text-lg text-gray-700 mt-2">Pilih kursus yang sesuai dengan kebutuhan Anda.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($courses as $course)
                <!-- Card Kursus -->
                <div class="bg-white border border-gray-300 rounded-lg shadow-md flex flex-col">
                    <!-- Judul Kursus -->
                    <h1 class="text-3xl font-semibold text-sky-400 text-center p-4 uppercase">{{ $course->title }}</h1>
                    
                    <!-- Gambar Kursus -->
                    <div class="flex justify-center items-center h-full">
                        <img src="{{ asset('storage/' . $course->image_path) }}" alt="{{ $course->title }}" class="rounded-lg w-3/4">
                    </div>
                    
                    <!-- Deskripsi Kursus -->
                    <div class="p-4 flex flex-col flex-grow">
                        <!-- Rating dan Mentor -->
                        <div class="mt-4 text-center">
                            <p class="text-lg text-gray-600">⭐ Rating: {{ $course->rating }}/5</p>
                            <p class="text-lg text-gray-600">👨‍🏫 Mentor: {{ $course->mentor_name }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
