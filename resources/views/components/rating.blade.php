<!-- Testimoni Section -->
<section id="rating" class="bg-white py-16">
    <div class="container mx-auto px-6">
        <div class="mb-6 text-center">
            <h3 class="text-3xl font-bold text-sky-400">
                Testimoni Pengguna
            </h3>
            <p class="text-lg text-gray-700 mt-2">
                Apa kata pengguna kami setelah mengikuti kursus di Eduflix?
            </p>
        </div>

        <div class="flex flex-wrap justify-center space-x-6">
            <!-- Testimonial 1 -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-md w-full md:w-1/3 lg:w-1/4 p-6 mt-6 mx-2 hover:shadow-lg transition-shadow duration-300 ease-in-out">
                <div class="flex items-center mb-4">
                    <img class="w-14 h-14 rounded-full object-cover" src="{{ asset('storage/avatar1.jpg') }}" alt="Testimonial User 1">
                    <div class="ml-4">
                        <h4 class="text-xl font-semibold text-sky-400">Budi Santoso</h4>
                        <p class="text-sm text-gray-600">Pengembang Web</p>
                        <div class="flex items-center mt-1">
                            <span class="text-yellow-500">&#9733;</span>
                            <span class="text-yellow-500">&#9733;</span>
                            <span class="text-yellow-500">&#9733;</span>
                            <span class="text-yellow-500">&#9733;</span>
                            <span class="text-gray-300">&#9733;</span>
                        </div>
                    </div>
                </div>
                <p class="text-gray-700 mt-2">"Kursus di Eduflix sangat bermanfaat! Saya sekarang lebih percaya diri dalam bekerja berkat kursus HTML yang sangat mudah dipahami."</p>
            </div>

            <!-- Testimonial 2 -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-md w-full md:w-1/3 lg:w-1/4 p-6 mt-6 mx-2 hover:shadow-lg transition-shadow duration-300 ease-in-out">
                <div class="flex items-center mb-4">
                    <img class="w-14 h-14 rounded-full object-cover" src="{{ asset('storage/avatar2.jpg') }}" alt="Testimonial User 2">
                    <div class="ml-4">
                        <h4 class="text-xl font-semibold text-sky-400">Sarah Pratiwi</h4>
                        <p class="text-sm text-gray-600">Data Analyst</p>
                        <div class="flex items-center mt-1">
                            <span class="text-yellow-500">&#9733;</span>
                            <span class="text-yellow-500">&#9733;</span>
                            <span class="text-yellow-500">&#9733;</span>
                            <span class="text-yellow-500">&#9733;</span>
                            <span class="text-gray-300">&#9733;</span>
                        </div>
                    </div>
                </div>
                <p class="text-gray-700 mt-2">"Materi yang disampaikan sangat lengkap. Kursus Data Science di Eduflix membuka banyak peluang karir bagi saya."</p>
            </div>

            <!-- Testimonial 3 -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-md w-full md:w-1/3 lg:w-1/4 p-6 mt-6 mx-2 hover:shadow-lg transition-shadow duration-300 ease-in-out">
                <div class="flex items-center mb-4">
                    <img class="w-14 h-14 rounded-full object-cover" src="{{ asset('storage/avatar3.jpg') }}" alt="Testimonial User 3">
                    <div class="ml-4">
                        <h4 class="text-xl font-semibold text-sky-400">Ahmad Fauzi</h4>
                        <p class="text-sm text-gray-600">UI/UX Designer</p>
                        <div class="flex items-center mt-1">
                            <span class="text-yellow-500">&#9733;</span>
                            <span class="text-yellow-500">&#9733;</span>
                            <span class="text-yellow-500">&#9733;</span>
                            <span class="text-yellow-500">&#9733;</span>
                            <span class="text-yellow-500">&#9733;</span>
                        </div>
                    </div>
                </div>
                <p class="text-gray-700 mt-2">"Saya sangat merekomendasikan Eduflix! Kursus UI/UX yang ditawarkan sangat membantu dalam mendesain aplikasi yang lebih baik."</p>
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
            <!-- Text Content -->
            <div class="lg:w-7/12 space-y-6 order-1" data-aos="fade-right">
                <!-- Title -->
                <div class="mb-6">
                    <h3 class="text-3xl font-bold text-sky-400">
                        Berikan Penilaian Anda untuk Eduflix
                    </h3>
                </div>

                <!-- Rating Form -->
                <form class="space-y-4">
                    <div>
                        <label for="rating" class="block text-lg text-gray-700">Rating:</label>
                        <select id="rating" name="rating" class="border border-gray-300 rounded-md p-2 w-full max-w-xs">
                            <option value="5">⭐️⭐️⭐️⭐️⭐️ (5/5)</option>
                            <option value="4">⭐️⭐️⭐️⭐️ (4/5)</option>
                            <option value="3">⭐️⭐️⭐️ (3/5)</option>
                            <option value="2">⭐️⭐️ (2/5)</option>
                            <option value="1">⭐️ (1/5)</option>
                        </select>
                    </div>

                    <div>
                        <label for="comment" class="block text-lg text-gray-700">Komentar:</label>
                        <textarea id="comment" name="comment" rows="4" class="border border-gray-300 rounded-md p-2 w-full" placeholder="Tulis ulasan Anda di sini..."></textarea>
                    </div>

                    <button type="submit" class="bg-sky-400 text-white px-4 py-2 rounded-md hover:bg-sky-500 focus:outline-none">
                        Kirim Ulasan
                    </button>
                </form>
            </div>

            <!-- Image Section -->
            <div class="lg:w-1/3 order-2 mb-6 lg:mb-0 flex justify-center" data-aos="fade-left">
                <img src="{{ asset('storage/eduflix-1.png') }}" alt="Gambar" class="w-4/4 h-auto">
            </div>
        </div>
    </div>
</section>
