<!-- Home Section -->
<section id="home" class="flex items-center min-h-screen bg-sky-50 text-sky-600 rounded-b-[75px]" data-aos="fade-up">
    <div class="container mx-auto px-16 py-12">
        <div class="flex flex-col-reverse lg:flex-row items-center">
            <!-- Text Content -->
            <div class="w-full lg:w-1/2 flex flex-col justify-center space-y-6 pt-8 lg:pt-0">
                <h1 class="text-4xl md:text-5xl font-bold leading-tight">EduFlix</h1>
                <h2 class="text-lg md:text-xl">
                    EduFlix adalah platform kursus online yang menawarkan pembelajaran melalui video serta <strong> fitur konsultasi via chat dengan mentor.  </strong>
                </h2>
                <div class="flex space-x-4 mt-4">
                    <a href="#about" class="px-6 py-3 bg-sky-600 border border-sky-600 text-white font-bold rounded-full hover:bg-white hover:text-sky-600 transition duration-300 z-20">
                        Mulai!
                    </a>
                </div>
            </div>
            <!-- Image Content -->
            <div class="w-full lg:w-1/2 flex justify-center">
                <img src="{{ asset('storage/eduflix-1.png') }}" alt="Hero Image" class="w-full h-auto lg:max-w-md transform hover:scale-105 transition-transform duration-500 animate-smallbounce">
            </div>
        </div>
    </div>
</section>

<!-- Card Section -->
<div class="relative z-10 -mt-20 pb-10 lg:pb-20">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
            <!-- Card 1 -->
            <div class="bg-white shadow-lg rounded-xl overflow-hidden transform transition-transform hover:scale-105">
                <div class="flex justify-center py-4">
                    <img src="{{ asset('storage/quiz.png') }}" alt="Card Image" class="w-28 h-28 object-cover">
                </div>
                <div class="p-4 pt-1 text-center">
                    <h3 class="font-bold text-lg text-sky-600">Quiz</h3>
                    <p class="text-gray-600 text-sm">Uji pemahaman Anda dengan quiz yang ada setelah belajar.</p>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="bg-white shadow-lg rounded-xl overflow-hidden transform transition-transform hover:scale-105">
                <div class="flex justify-center py-4">
                    <img src="{{ asset('storage/video.png') }}" alt="Card Image" class="w-28 h-28 object-cover">
                </div>
                <div class="p-4 pt-1 text-center">
                    <h3 class="font-bold text-lg text-sky-600">Video Pembelajaran</h3>
                    <p class="text-gray-600 text-sm">Pelajari materi lengkap lewat video yang disediakan oleh mentor.</p>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="bg-white shadow-lg rounded-xl overflow-hidden transform transition-transform hover:scale-105">
                <div class="flex justify-center py-4">
                    <img src="{{ asset('storage/sertifikat.png') }}" alt="Card Image" class="w-28 h-28 object-cover">
                </div>
                <div class="p-4 pt-1 text-center">
                    <h3 class="font-bold text-lg text-sky-600">Sertifikat</h3>
                    <p class="text-gray-600 text-sm">Dapatkan sertifikat setelah menyelesaikan kursus.</p>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="bg-white shadow-lg rounded-xl overflow-hidden transform transition-transform hover:scale-105">
                <div class="flex justify-center py-4">
                    <img src="{{ asset('storage/24.png') }}" alt="Card Image" class="w-28 h-28 object-cover">
                </div>
                <div class="p-4 pt-1 text-center">
                    <h3 class="font-bold text-lg text-sky-600">Materi 24 jam</h3>
                    <p class="text-gray-600 text-sm">Akses materi belajar kapan saja, 24 jam penuh.</p>
                </div>
            </div>
            <!-- Card 5 -->
            <div class="bg-white shadow-lg rounded-xl overflow-hidden transform transition-transform hover:scale-105">
                <div class="flex justify-center py-4">
                    <img src="{{ asset('storage/chat.png') }}" alt="Card Image" class="w-28 h-28 object-cover">
                </div>
                <div class="p-4 pt-1 text-center">
                    <h3 class="font-bold text-lg text-sky-600">Chat dengan Mentor</h3>
                    <p class="text-gray-600 text-sm">Konsultasi langsung dengan mentor via chat.</p>
                </div>
            </div>
        </div>
    </div>
</div>
