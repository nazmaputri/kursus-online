<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peserta</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
   <style>
        body {
            font-family: 'IBM Plex Sans', sans-serif;
        }
        
        /* CSS tambahan untuk memastikan ikon tetap terlihat */
        #svg-image {
            display: inline-block;
            width: 1.25rem; /* Menyesuaikan ukuran ikon saat sidebar kecil */
            height: 1.25rem;
        }

        #dashboard-svg,
        #kategori-svg,
        #belajar-svg {
            width: 1.25rem; /* Ukuran default ikon */
            height: 1.25rem;
        }

        @media (max-width: 1024px) {
            #dashboard-svg,
            #kategori-svg,
            #belajar-svg {
                width: 1rem; /* Ukuran kecil ikon saat sidebar kecil */
                height: 1rem;
            }
        }
    </style>
</head>
<body class="bg-sky-300/15">
    <div class="flex flex-col min-h-screen">
            <!-- Sidebar -->
            <aside id="logo-sidebar" class="fixed top-4 left-4 w-64 h-[calc(100vh-2rem)] bg-white border border-gray-300 dark:bg-gray-800 dark:border-gray-700 p-4 rounded-xl transition-all transform lg:w-64 md:w-16" aria-label="Sidebar">
                <!-- Tombol Hamburger -->
                <button id="hamburger-button" class="absolute top-4 z-50 p-1 bg-sky-300 text-gray-700 hover:bg-sky-500 rounded-md md:hidden">
                    <svg id="hamburger-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <div class="flex flex-col items-center m-4 justify-center h-32 bg-white dark:bg-gray-800">
                    <!-- Logo di tengah -->
                    <img id="logo" src="{{ asset('storage/eduflix-1.png') }}" class="h-32" alt="Eduflix Logo" />
                </div>
                <div class="h-full px-3 pb-4 mt-2 overflow-y-auto dark:bg-gray-800">
                    <ul class="space-y-2 font-medium">
                        <li class="border-l-2 {{ Request::routeIs('welcome-peserta') ? 'border-sky-500' : 'border-transparent hover:border-sky-500' }}">
                            <a href="{{ route('welcome-peserta') }}" class="flex items-center p-2 text-gray-900 rounded-sm dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <svg id="dashboard-svg" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <path d="M575.8 255.5c0 18-15 32.1-32 32.1l-32 0 .7 160.2c0 2.7-.2 5.4-.5 8.1l0 16.2c0 22.1-17.9 40-40 40l-16 0c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1L416 512l-24 0c-22.1 0-40-17.9-40-40l0-24 0-64c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32l0 64 0 24c0 22.1-17.9 40-40 40l-24 0-31.9 0c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2l-16 0c-22.1 0-40-17.9-40-40l0-112c0-.9 0-1.9 .1-2.8l0-69.7-32 0c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/>
                                </svg>
                                <span id="dashboard-text" class="ms-3">Dashboard</span>
                            </a>
                        </li>
                        <li class="border-l-2 {{ Request::routeIs('kategori-peserta', 'categories-detail', 'kursus-peserta') ? 'border-sky-500' : 'border-transparent hover:border-sky-500' }}">
                            <a href="{{ route('kategori-peserta') }}" class="flex items-center p-2 text-gray-900 rounded-sm dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <svg id="kategori-svg" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M40 48C26.7 48 16 58.7 16 72l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24L40 48zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L192 64zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zM16 232l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24l-48 0c-13.3 0-24 10.7-24 24zM40 368c-13.3 0-24 10.7-24 24l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24l-48 0z"/>
                                </svg>
                                <span class="ms-3">Daftar Kategori</span>
                            </a>
                        </li>
                        <li class="border-l-2 {{ Request::routeIs('daftar-kursus', 'detail-kursus', 'study-peserta', 'chat.student', 'quiz.show', 'quiz.result') ? 'border-sky-500' : 'border-transparent hover:border-sky-500' }}">
                            <a href="{{ route('daftar-kursus') }}" class="flex items-center p-2 text-gray-900 rounded-sm dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <svg id="belajar-svg" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                    <path d="M128 32C92.7 32 64 60.7 64 96l0 256 64 0 0-256 384 0 0 256 64 0 0-256c0-35.3-28.7-64-64-64L128 32zM19.2 384C8.6 384 0 392.6 0 403.2C0 445.6 34.4 480 76.8 480l486.4 0c42.4 0 76.8-34.4 76.8-76.8c0-10.6-8.6-19.2-19.2-19.2L19.2 384z"/>
                                </svg>
                                <span class="ms-3">Belajar</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </aside>            
            <!-- Script untuk menutup sidebar dan memperlebar konten -->
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                        // Mengambil elemen yang diperlukan
                        const sidebar = document.getElementById("logo-sidebar");
                        const content = document.getElementById("content");
                        const header = document.getElementById("header");
                        const hamburgerButton = document.getElementById("hamburger-button");
                        const logo = document.getElementById("logo");
                        const svgImage = document.getElementById("svg-image");
                        const dashboardText = document.getElementById("dashboard-text");
                        const kategoriText = document.getElementById("kategori-text");
                        const belajarText = document.getElementById("belajar-text");
                        const dashboardSvg = document.getElementById("dashboard-svg");
                        const kategoriSvg = document.getElementById("kategori-svg");
                        const belajarSvg = document.getElementById("belajar-svg");

                        // Fungsi untuk mengubah tampilan saat sidebar diperkecil atau diperbesar
                        function toggleSidebar() {
                            // Toggle lebar sidebar antara w-64 dan w-16
                            sidebar.classList.toggle("w-64");
                            sidebar.classList.toggle("w-16");

                            // Toggle margin pada konten utama
                            content.classList.toggle("ml-64");
                            content.classList.toggle("ml-16");

                            // Toggle margin pada header
                            header.classList.toggle("ml-64");
                            header.classList.toggle("ml-16");

                            // Mengatur ukuran logo dan ikon SVG
                            if (sidebar.classList.contains("w-16")) {
                                logo.classList.add("transform", "scale-75"); // Mengurangi ukuran logo
                                dashboardText.classList.add("hidden"); // Sembunyikan teks dashboard
                                kategoriText.classList.add("hidden"); // Sembunyikan teks kategori
                                belajarText.classList.add("hidden"); // Sembunyikan teks belajar
                                dashboardSvg.classList.remove("w-5"); // Ukuran kecil untuk ikon
                                kategoriSvg.classList.remove("w-5"); // Ukuran kecil untuk ikon
                                belajarSvg.classList.remove("w-5"); // Ukuran kecil untuk ikon
                            } else {
                                logo.classList.remove("transform", "scale-75"); // Kembalikan ukuran logo
                                dashboardText.classList.remove("hidden"); // Tampilkan teks dashboard
                                kategoriText.classList.remove("hidden"); // Tampilkan teks kategori
                                belajarText.classList.remove("hidden"); // Tampilkan teks belajar
                                dashboardSvg.classList.add("w-5"); // Ukuran besar untuk ikon
                                kategoriSvg.classList.add("w-5"); // Ukuran besar untuk ikon
                                belajarSvg.classList.add("w-5"); // Ukuran besar untuk ikon
                            }
                        }

                        // Event klik pada tombol hamburger untuk mengubah ukuran sidebar
                        hamburgerButton.addEventListener("click", toggleSidebar);

                        // Mengatur tampilan sidebar sesuai dengan ukuran layar
                        window.addEventListener("resize", function() {
                            if (window.innerWidth >= 1024) {
                                // Pada layar besar (desktop), tampilkan sidebar penuh
                                sidebar.classList.add("w-64");
                                sidebar.classList.remove("w-16");
                                content.classList.add("ml-64");
                                content.classList.remove("ml-16");
                                header.classList.add("ml-64");
                                header.classList.remove("ml-16");
                                logo.classList.remove("transform", "scale-75");
                                dashboardText.classList.remove("hidden");
                                kategoriText.classList.remove("hidden");
                                belajarText.classList.remove("hidden");
                                dashboardSvg.classList.add("w-5");
                                kategoriSvg.classList.add("w-5");
                                belajarSvg.classList.add("w-5");
                            } else {
                                // Pada layar kecil (mobile), sembunyikan teks dan tampilkan ikon SVG
                                sidebar.classList.remove("w-64");
                                sidebar.classList.add("w-16");
                                content.classList.remove("ml-64");
                                content.classList.add("ml-16");
                                header.classList.remove("ml-64");
                                header.classList.add("ml-16");
                                logo.classList.add("transform", "scale-75");
                                dashboardText.classList.add("hidden");
                                kategoriText.classList.add("hidden");
                                belajarText.classList.add("hidden");
                                dashboardSvg.classList.remove("w-5");
                                kategoriSvg.classList.remove("w-5");
                                belajarSvg.classList.remove("w-5");
                            }
                        });

                        // Inisialisasi tampilan sesuai ukuran layar saat pertama kali dimuat
                        if (window.innerWidth >= 1024) {
                            sidebar.classList.add("w-64");
                            sidebar.classList.remove("w-16");
                            content.classList.add("ml-64");
                            content.classList.remove("ml-16");
                            header.classList.add("ml-64");
                            header.classList.remove("ml-16");
                            logo.classList.remove("transform", "scale-75");
                            dashboardText.classList.remove("hidden");
                            kategoriText.classList.remove("hidden");
                            belajarText.classList.remove("hidden");
                            dashboardSvg.classList.add("w-5");
                            kategoriSvg.classList.add("w-5");
                            belajarSvg.classList.add("w-5");
                        } else {
                            sidebar.classList.remove("w-64");
                            sidebar.classList.add("w-16");
                            content.classList.remove("ml-64");
                            content.classList.add("ml-16");
                            header.classList.remove("ml-64");
                            header.classList.add("ml-16");
                            logo.classList.add("transform", "scale-75");
                            dashboardText.classList.add("hidden");
                            kategoriText.classList.add("hidden");
                            belajarText.classList.add("hidden");
                            dashboardSvg.classList.remove("w-5");
                            kategoriSvg.classList.remove("w-5");
                            belajarSvg.classList.remove("w-5");
                        }
                    });
            </script>
        <!-- Main Content -->
        <div id="content" class="flex-1 ml-64 transition-all duration-300 p-4 relative">
            <!-- Header -->
            <div id="header" class="flex items-center justify-between top-4 fixed left-8 right-8 border border-gray-300 bg-white w-3/4 p-2 rounded-xl">           
                <!-- User Profile di Kanan -->
                <div class="flex items-center ml-auto mr-4 relative"> <!-- Perbaikan: Menggunakan ml-auto untuk menempatkan di sebelah kanan -->
                    <!-- Pengecekan gambar profil -->
                    @if(Auth::user()->photo)
                    <!-- Tampilkan gambar profil jika ada -->
                    <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="User Profile" class="rounded-full" width="40" height="40">
                    @else
                    <!-- SVG sebagai ikon default -->
                    <svg class="w-9 h-9" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M399 384.2C376.9 345.8 335.4 320 288 320l-64 0c-47.4 0-88.9 25.8-111 64.2c35.2 39.2 86.2 63.8 143 63.8s107.8-24.7 143-63.8zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm256 16a72 72 0 1 0 0-144 72 72 0 1 0 0 144z"/>
                    </svg>
                    @endif
                    <div class="ml-2 flex items-center">
                        <div>
                            <!-- Memeriksa apakah pengguna sudah login -->
                            @if(Auth::check())
                                <p class="text-gray-800 font-semibold mr-2">{{ Auth::user()->name }}</p>
                                <p class="text-gray-600 text-sm">{{ Auth::user()->role }}</p> <!-- Menampilkan role pengguna -->
                            @else
                                <p class="text-gray-800 font-semibold mr-2">Guest</p>
                                <p class="text-gray-600 text-sm">Not logged in</p>
                            @endif
                        </div>
                        <div class="relative">
                            <button id="dropdown-button" class="text-gray-600 focus:outline-none">
                                <img width="22" height="22" src="https://img.icons8.com/windows/32/circled-chevron-down.png" alt="circled-chevron-down"/>
                            </button>
                            <div id="dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg z-10">
                                <ul class="py-1" aria-labelledby="dropdown-button">
                                    <li>
                                        <a href="{{ route('settings-student') }}" class="block flex items-center px-2 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4 m-2">
                                                <path d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z"/>
                                            </svg>
                                            Profile Settings
                                        </a>
                                    </li>
                                    <li>
                                        <a class="block flex items-center px-2 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4 m-2">
                                                <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/>
                                            </svg>
                                            <form action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="w-full text-left py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                                            </form>
                                        </a>
                                    </li>
                                </ul>                            
                            </div>
                        </div>
                    </div>
                </div>  
        </div>

        <!-- Script untuk Menangani Dropdown -->
        <script>
            const dropdownButton = document.getElementById('dropdown-button');
            const dropdown = document.getElementById('dropdown');
            const dropdownIcon = document.getElementById('dropdown-button');
        
            dropdownButton.addEventListener('click', () => {
                dropdown.classList.toggle('hidden');
                dropdownIcon.classList.toggle('rotate-180'); // Mengubah posisi ikon saat dropdown terbuka
            });
        
            // Menutup dropdown jika klik di luar
            window.addEventListener('click', (event) => {
                if (!dropdownButton.contains(event.target) && !dropdown.contains(event.target)) {
                    dropdown.classList.add('hidden');
                    dropdownIcon.classList.remove('rotate-90');
                }
            });
        </script>

        <!-- Isi Content -->
            <div class="p-4 mt-16">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
