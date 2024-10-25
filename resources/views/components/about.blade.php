<!-- About Section -->
<section id="about" class="bg-white py-16">
    <div class="container mx-auto px-6">
        <div class="flex flex-col lg:flex-row lg:space-x-12 items-center">

            <!-- Image Section -->
            <div class="md:w-1/3 order-1 lg:order-1 mb-6 lg:mb-0 flex justify-center" data-aos="fade-left">
                <img src="{{ asset('storage/online-course.png') }}" alt="Gambar" class="w-3/4 h-auto">
            </div>            

            <!-- Text Content -->
            <div class="lg:w-7/12 space-y-6 order-2 lg:order-2" data-aos="fade-right">
                <!-- Title -->
                <div class="mb-6">
                    <h3 class="text-3xl font-bold text-sky-400">
                        Keunggulan-keunggulan Eduflix
                    </h3>
                </div>

                <!-- Description -->
                <p class="text-lg text-gray-700">
                    Eduflix menawarkan berbagai keunggulan yang dapat membantu Anda dalam proses pembelajaran dan pengelolaan pendidikan. Dengan platform kami, Anda dapat mengakses materi pembelajaran yang berkualitas dan fitur-fitur inovatif yang mendukung kemajuan belajar Anda.
                </p>

                <!-- Accordion -->
                <div class="space-y-4" id="accordion">
                    <!-- Card 1 -->
                    <div class="card bg-white border-2 border-gray-300 rounded-lg transition-all duration-300 ease-in-out" data-aos="fade-up">
                        <button class="flex justify-between w-full px-4 py-3 text-lg text-left text-gray-700 font-semibold focus:outline-none"
                            onclick="toggleFeature(this)">
                            <span>01. Akses Materi Pembelajaran Terlengkap</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 transition-transform duration-300 transform rotate-0">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div class="feature-content max-h-0 overflow-hidden transition-all duration-300 ease-in-out p-4 bg-white rounded-lg opacity-0">
                            <p class="text-gray-600">
                                Eduflix menyediakan akses ke berbagai materi pembelajaran dari berbagai bidang studi yang memungkinkan siswa untuk belajar dengan cara yang lebih terstruktur dan efektif. Anda bisa menemukan video, kuis, dan bahan bacaan yang relevan untuk mendukung proses belajar.
                            </p>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="card bg-white border-2 border-gray-300 rounded-lg transition-all duration-300 ease-in-out" data-aos="fade-up">
                        <button class="flex justify-between w-full px-4 py-3 text-lg text-left text-gray-700 font-semibold focus:outline-none"
                            onclick="toggleFeature(this)">
                            <span>02. Pembelajaran Interaktif dan Menyenangkan</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 transition-transform duration-300 transform rotate-0">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div class="feature-content max-h-0 overflow-hidden transition-all duration-300 ease-in-out p-4 bg-white rounded-lg opacity-0">
                            <p class="text-gray-600">
                                Dengan fitur pembelajaran interaktif, Eduflix menjadikan proses belajar lebih menyenangkan dan tidak membosankan. Siswa dapat berinteraksi dengan materi melalui kuis, forum diskusi, dan proyek kolaboratif yang membuat mereka lebih terlibat dalam proses belajar.
                            </p>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="card bg-white border-2 border-gray-300 rounded-lg transition-all duration-300 ease-in-out" data-aos="fade-up">
                        <button class="flex justify-between w-full px-4 py-3 text-lg text-left text-gray-700 font-semibold focus:outline-none"
                            onclick="toggleFeature(this)">
                            <span>03. Fasilitas untuk Guru dan Siswa</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 transition-transform duration-300 transform rotate-0">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div class="feature-content max-h-0 overflow-hidden transition-all duration-300 ease-in-out p-4 bg-white rounded-lg opacity-0">
                            <p class="text-gray-600">
                                Eduflix tidak hanya menyediakan fasilitas untuk siswa, tetapi juga untuk guru. Guru dapat menggunakan platform ini untuk membuat materi ajar, melacak kemajuan siswa, dan memberikan umpan balik secara real-time, sehingga menciptakan pengalaman belajar yang lebih efektif.
                            </p>
                        </div>
                    </div>
                </div>

                <script>
                    function toggleFeature(button) {
                        const card = button.closest('.card');
                        const content = card.querySelector('.feature-content');
                        const svg = button.querySelector('svg');
                        const isOpen = content.classList.contains('max-h-[200px]');
                
                        // Tutup semua card
                        document.querySelectorAll('.feature-content').forEach(c => {
                            c.classList.remove('max-h-[200px]', 'opacity-100');
                            c.classList.add('max-h-0', 'opacity-0');
                        });
                
                        // Hapus border-sky-400 dari semua card
                        document.querySelectorAll('.card').forEach(c => {
                            c.classList.remove('border-sky-400');
                        });
                
                        // Jika belum terbuka, buka konten yang diklik
                        if (!isOpen) {
                            content.classList.remove('max-h-0', 'opacity-0');
                            content.classList.add('max-h-[200px]', 'opacity-100'); // Sesuaikan max-height dengan tinggi konten
                            card.classList.add('border-sky-400');
                            svg.classList.add('rotate-180');
                        } else {
                            svg.classList.remove('rotate-180');
                        }
                    }
                </script>
            </div>
        </div>
    </div>
</section>