<!-- Courses Section -->
<section id="course" class="bg-white py-16">
    <div class="container mx-auto px-6">
        <div class="mb-6 text-center">
            <h3 class="text-3xl font-bold text-sky-400">
                Kursus yang Tersedia di Eduflix
            </h3>
            <p class="text-lg text-gray-700 mt-2">
                Temukan berbagai kursus menarik dan berkualitas untuk meningkatkan keterampilan Anda.
            </p>
        </div>

        <div class="overflow-x-auto hide-scrollbar"> <!-- Menyembunyikan scrollbar -->
            <div class="flex space-x-6 m-7">
                <!-- Course Card 1: Bahasa Inggris -->
                <div class="course-card bg-white border border-gray-300 rounded-lg shadow-md overflow-hidden flex-none w-80 flex-shrink-0 flex flex-col transition-transform duration-300 ease-in-out">
                    <div class="flex justify-center mt-5">
                        <img src="{{ asset('storage/english.png') }}" alt="Kursus Bahasa Inggris" class="w-40 h-36">
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h4 class="text-xl font-semibold text-sky-400 text-center">Kursus Bahasa Inggris</h4> <!-- Text-center untuk judul -->
                        <p class="text-gray-600 mt-2 flex-grow text-center">Gabung dan tingkatkan keterampilan komunikasi bahasa Inggris Anda!</p>                                
                        <div class="mt-4">
                            <a href="#" class="inline-block w-full bg-sky-400 text-white px-4 py-2 rounded-md hover:bg-sky-500 text-center">
                                Pelajari Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Course Card 2: HTML -->
                <div class="course-card bg-white border border-gray-300 rounded-lg shadow-md overflow-hidden flex-none w-80 flex-shrink-0 flex flex-col transition-transform duration-300 ease-in-out">
                    <div class="flex justify-center mt-5">
                        <img src="{{ asset('storage/html.png') }}" alt="Kursus HTML" class="w-40 h-36"> 
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h4 class="text-xl font-semibold text-sky-400 text-center">Kursus HTML</h4>
                        <p class="text-gray-600 mt-2 flex-grow text-center">Pelajari dan kuasai dasar-dasar HTML untuk menjadi programmer di masa depan.</p>
                        <div class="mt-4">
                            <a href="#" class="inline-block w-full bg-sky-400 text-white px-4 py-2 rounded-md hover:bg-sky-500 text-center">
                                Pelajari Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Course Card 3: Matematika Dasar -->
                <div class="course-card bg-white border border-gray-300 rounded-lg shadow-md overflow-hidden flex-none w-80 flex-shrink-0 flex flex-col transition-transform duration-300 ease-in-out">
                    <div class="flex justify-center mt-5">
                        <img src="{{ asset('storage/math.png') }}" alt="Kursus Matematika" class="w-40 h-36"> 
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h4 class="text-xl font-semibold text-sky-400 text-center">Kursus Matematika Dasar</h4>
                        <p class="text-gray-600 mt-2 flex-grow text-center">Pelajari konsep dasar matematika, mulai dari aritmetika hingga aljabar.</p>
                        <div class="mt-4">
                            <a href="#" class="inline-block w-full bg-sky-400 text-white px-4 py-2 rounded-md hover:bg-sky-500 text-center">
                                Pelajari Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Course Card 4: Kursus Data Science -->
                <div class="course-card bg-white border border-gray-300 rounded-lg shadow-md overflow-hidden flex-none w-80 flex-shrink-0 flex flex-col transition-transform duration-300 ease-in-out">
                    <div class="flex justify-center mt-5">
                        <img src="{{ asset('storage/data.png') }}" alt="Kursus Data Science" class="w-40 h-36">
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h4 class="text-xl font-semibold text-sky-400 text-center">Kursus Data Science</h4>
                        <p class="text-gray-600 mt-2 flex-grow text-center">Pelajari analisis data dan pembelajaran mesin untuk mendapatkan wawasan dari data.</p>
                        <div class="mt-4">
                            <a href="#" class="inline-block w-full bg-sky-400 text-white px-4 py-2 rounded-md hover:bg-sky-500 text-center">
                                Pelajari Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Course Card 5: Kursus UI UX -->
                <div class="course-card bg-white border border-gray-300 rounded-lg shadow-md overflow-hidden flex-none w-80 flex-shrink-0 flex flex-col transition-transform duration-300 ease-in-out">
                    <div class="flex justify-center mt-5">
                        <img src="{{ asset('storage/uiux.png') }}" alt="Kursus UI UX" class="w-40 h-36">
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h4 class="text-xl font-semibold text-sky-400 text-center">Kursus UI UX</h4>
                        <p class="text-gray-600 mt-2 flex-grow text-center">Pelajari cara menciptakan pengalaman pengguna yang menarik dan intuitif melalui desain UI/UX.</p>
                        <div class="mt-4">
                            <a href="#" class="inline-block w-full bg-sky-400 text-white px-4 py-2 rounded-md hover:bg-sky-500 text-center">
                                Pelajari Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Course Card 6: Masak -->
                <div class="course-card bg-white border border-gray-300 rounded-lg shadow-md overflow-hidden flex-none w-80 flex-shrink-0 flex flex-col transition-transform duration-300 ease-in-out">
                    <div class="flex justify-center mt-5">
                        <img src="{{ asset('storage/masak.png') }}" alt="Kursus UI UX" class="w-40 h-36">
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h4 class="text-xl font-semibold text-sky-400 text-center">Kursus Masakan Nusantara</h4>
                        <p class="text-gray-600 mt-2 flex-grow text-center">Ayo buka usaha masakan nusantara dengan bergabung kursus ini!</p>
                        <div class="mt-4">
                            <a href="#" class="inline-block w-full bg-sky-400 text-white px-4 py-2 rounded-md hover:bg-sky-500 text-center">
                                Pelajari Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        /* Tailwind Custom CSS untuk menyembunyikan scrollbar */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Animasi hover untuk card */
        .course-card:hover {
            transform: scale(1.05); 
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
    </style>
</section>
