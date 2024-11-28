<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peserta</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Transition efek buka-tutup sidebar */
        #logo-sidebar {
            transition: width 0.3s;
        }
        #logo {
            transition: transform 0.3s;
        }
        .hidden {
    display: none;
}
    </style>
</head>
<body class="bg-sky-300/15">
    <div class="flex flex-col min-h-screen">

         <!-- Sidebar -->
        <aside id="logo-sidebar" class="fixed top-4 left-4 z-40 w-64 h-[calc(100vh-2rem)] bg-white shadow-md dark:bg-gray-800 dark:border-gray-700 p-4 rounded-xl" aria-label="Sidebar">
            <!-- Tombol Hamburger -->
            <button id="hamburger-button" class="absolute top-4 right-3 z-50 p-2 bg-sky-300 text-gray-700 hover:bg-sky-500 rounded-md">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <div class="flex flex-col items-center justify-center h-32 bg-white dark:bg-gray-800">
                <!-- Logo di tengah -->
                <img src="{{ asset('storage/eduflix-1.png') }}" class="h-32" alt="Eduflix Logo" />
            </div>
            <div class="h-full px-3 pb-4 overflow-y-auto dark:bg-gray-800">
                <ul class="space-y-3 font-medium">
                    <li class="border-l-2 {{ Request::routeIs('welcome-peserta') ? 'border-sky-500' : 'border-transparent hover:border-sky-500' }}">
                        <a href="{{ route('welcome-peserta') }}" class="flex items-center p-2 text-gray-900 rounded-sm dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                <path d="M575.8 255.5c0 18-15 32.1-32 32.1l-32 0 .7 160.2c0 2.7-.2 5.4-.5 8.1l0 16.2c0 22.1-17.9 40-40 40l-16 0c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1L416 512l-24 0c-22.1 0-40-17.9-40-40l0-24 0-64c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32l0 64 0 24c0 22.1-17.9 40-40 40l-24 0-31.9 0c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2l-16 0c-22.1 0-40-17.9-40-40l0-112c0-.9 0-1.9 .1-2.8l0-69.7-32 0c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/>
                            </svg>
                            <span class="ms-3">Dashboard</span>
                        </a>
                    </li>
                    <li class="border-l-2 {{ Request::routeIs('kategori-peserta') ? 'border-sky-500' : 'border-transparent hover:border-sky-500' }}">
                        <a href="{{ route('kategori-peserta') }}" class="flex items-center p-2 text-gray-900 rounded-sm dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M40 48C26.7 48 16 58.7 16 72l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24L40 48zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L192 64zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zM16 232l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24l-48 0c-13.3 0-24 10.7-24 24zM40 368c-13.3 0-24 10.7-24 24l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24l-48 0z"/>
                            </svg>
                            <span class="ms-3">Daftar Kursus</span>
                        </a>
                    </li>
                    <li class="relative">
                        <div class="border-l-2 border-sky-500 border-transparent hover:border-sky-500 ">
                            <button onclick="toggleDropdown()" class="flex items-center p-2 text-gray-900 rounded-sm dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 w-full">

                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M160 96a96 96 0 1 1 192 0A96 96 0 1 1 160 96zm80 152l0 264-48.4-24.2c-20.9-10.4-43.5-17-66.8-19.3l-96-9.6C12.5 457.2 0 443.5 0 427L0 224c0-17.7 14.3-32 32-32l30.3 0c63.6 0 125.6 19.6 177.7 56zm32 264l0-264c52.1-36.4 114.1-56 177.7-56l30.3 0c17.7 0 32 14.3 32 32l0 203c0 16.4-12.5 30.2-28.8 31.8l-96 9.6c-23.2 2.3-45.9 8.9-66.8 19.3L272 512z"/>
                                </svg>
                                <span class="ms-3">Belajar</span>
                                <!-- Panah dropdown -->
                                <svg class="ml-auto w-4 h-4 transition-transform duration-200 {{ Request::routeIs('datamentor-admin', 'datapeserta-admin') ? 'rotate-180' : '' }}" id="dropdown-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                    <path d="M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z"/>
                                </svg>
                            </button>
                        </div>
                    
                        <!-- Submenu -->
                        <ul id="dropdown-menu" class="{{ Request::routeIs('study-peserta', 'video-peserta', 'quiz-peserta') ? '' : 'hidden' }} ml-4 space-y-1 mt-2 dark:bg-gray-700 rounded-sm p-2">
                            <li class="border-l-2 {{ Request::routeIs('study-peserta') ? 'border-sky-500' : 'border-transparent hover:border-sky-500' }}">
                                <a href="{{ route('study-peserta') }}" class="flex items-center gap-2 p-2 text-gray-700 rounded-sm dark:text-white hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <img width="20" height="20" src="https://img.icons8.com/ios-filled/50/courses.png" alt="courses"/>
                                    Kursus
                                </a>
                            </li>
                            <li class="border-l-2 {{ Request::routeIs('video-peserta') ? 'border-sky-500' : 'border-transparent hover:border-sky-500' }}">
                                <a href="{{ route('video-peserta') }}" class="flex items-center gap-2 p-2 text-gray-700 rounded-sm dark:text-white hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <!-- Ikon SVG -->
                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                        <path d="M549.7 124.1c-6.3-23.7-24.8-42.3-48.3-48.6C458.8 64 288 64 288 64S117.2 64 74.6 75.5c-23.5 6.3-42 24.9-48.3 48.6-11.4 42.9-11.4 132.3-11.4 132.3s0 89.4 11.4 132.3c6.3 23.7 24.8 41.5 48.3 47.8C117.2 448 288 448 288 448s170.8 0 213.4-11.5c23.5-6.3 42-24.2 48.3-47.8 11.4-42.9 11.4-132.3 11.4-132.3s0-89.4-11.4-132.3zm-317.5 213.5V175.2l142.7 81.2-142.7 81.2z"/>
                                    </svg>
                                    Video 
                                </a>
                            </li>
                            <li class="border-l-2 {{ Request::routeIs('datamentor-admin') ? 'border-sky-500' : 'border-transparent hover:border-sky-500' }}">
                                <a href="{{ route('datamentor-admin') }}" class="flex items-center gap-2 p-2 text-gray-700 rounded-sm dark:text-white hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <!-- Ikon SVG -->
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path d="M96 0C43 0 0 43 0 96L0 416c0 53 43 96 96 96l288 0 32 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l0-64c17.7 0 32-14.3 32-32l0-320c0-17.7-14.3-32-32-32L384 0 96 0zm0 384l256 0 0 64L96 448c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16l192 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-192 0c-8.8 0-16-7.2-16-16zm16 48l192 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-192 0c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
                                    </svg>
                                    Materi
                                </a>
                            </li>
                            <li class="border-l-2 {{ Request::routeIs('quiz-peserta') ? 'border-sky-500' : 'border-transparent hover:border-sky-500' }}">
                                <a href="{{ route('quiz-peserta') }}" class="flex items-center gap-2 p-2 text-gray-700 rounded-sm dark:text-white hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <img width="20" height="20" src="https://img.icons8.com/material-outlined/24/documents--v2.png" alt="documents--v2"/>
                                    Quiz
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <script>
                        function toggleDropdown() {
                            const dropdownMenu = document.getElementById('dropdown-menu');
                            const dropdownArrow = document.getElementById('dropdown-arrow');
                            
                            if (!dropdownMenu.classList.contains('hidden')) {
                                dropdownMenu.classList.add('hidden');
                                dropdownArrow.classList.remove('rotate-180');
                            } else {
                                dropdownMenu.classList.remove('hidden');
                                dropdownArrow.classList.add('rotate-180');
                            }
                        }
                    </script>

                     
                    <li>
                        <a href="" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                <path d="M208 352c114.9 0 208-78.8 208-176S322.9 0 208 0S0 78.8 0 176c0 38.6 14.7 74.3 39.6 103.4c-3.5 9.4-8.7 17.7-14.2 24.7c-4.8 6.2-9.7 11-13.3 14.3c-1.8 1.6-3.3 2.9-4.3 3.7c-.5 .4-.9 .7-1.1 .8l-.2 .2s0 0 0 0s0 0 0 0C1 327.2-1.4 334.4 .8 340.9S9.1 352 16 352c21.8 0 43.8-5.6 62.1-12.5c9.2-3.5 17.8-7.4 25.2-11.4C134.1 343.3 169.8 352 208 352zM448 176c0 112.3-99.1 196.9-216.5 207C255.8 457.4 336.4 512 432 512c38.2 0 73.9-8.7 104.7-23.9c7.5 4 16 7.9 25.2 11.4c18.3 6.9 40.3 12.5 62.1 12.5c6.9 0 13.1-4.5 15.2-11.1c2.1-6.6-.2-13.8-5.8-17.9c0 0 0 0 0 0s0 0 0 0l-.2-.2c-.2-.2-.6-.4-1.1-.8c-1-.8-2.5-2-4.3-3.7c-3.6-3.3-8.5-8.1-13.3-14.3c-5.5-7-10.7-15.4-14.2-24.7c24.9-29 39.6-64.7 39.6-103.4c0-92.8-84.9-168.9-192.6-175.5c.4 5.1 .6 10.3 .6 15.5z"/>
                            </svg>
                            <span class="ms-3">Chat</span>
                        </a>
                    </li>                                 
                </ul>
            </div>
        </aside>

        <!-- Script untuk menutup sidebar dan memperlebar konten -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const sidebar = document.getElementById("logo-sidebar");
                const content = document.getElementById("content");
                const hamburgerButton = document.getElementById("hamburger-button");
                const logo = document.getElementById("logo");
                const svgImage = document.getElementById("svg-image");
        
                hamburgerButton.addEventListener("click", () => {
                    sidebar.classList.toggle("w-64");
                    sidebar.classList.toggle("w-16");
                    content.classList.toggle("ml-64");
                    content.classList.toggle("ml-16");
        
                    // Ubah ukuran logo dan tampilkan/hide SVG saat sidebar ditutup
                    if (sidebar.classList.contains("w-16")) {
                        logo.classList.add("transform", "scale-75");
                        svgImage.classList.remove("hidden"); // Tampilkan gambar SVG
                    } else {
                        logo.classList.remove("transform", "scale-75");
                        svgImage.classList.add("hidden"); // Sembunyikan gambar SVG
                    }
        
                    // Tambahkan log untuk debugging
                    console.log("Sidebar width:", sidebar.classList.contains("w-16"));
                    console.log("SVG visibility:", svgImage.classList.contains("hidden"));
                });
            });
        </script>
        
        <!-- Main Content -->
        <div id="content" class="flex-1 ml-64 transition-all duration-300 p-4">
           <!-- Header -->
           <div class="flex items-center justify-between">
            <!-- Search Bar di Kiri -->
            <form class="max-w-sm flex-1 ml-4 mr-4">   
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="search" id="default-search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-200 rounded-lg bg-white focus:ring-blue-500 focus:border-sky-500 dark:bg-sky-700 dark:border-sky-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" required />
                    <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-sky-300 hover:bg-sky-700 focus:ring-4 focus:outline-none focus:ring-sky-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-sky-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                </div>
            </form>
        
            <!-- User Profile di Kanan -->
            <div class="flex items-center mr-4 relative">
                <!-- Pengecekan gambar profil -->
                @if(Auth::user()->profile_photo_url)
                <img src="#" alt="User Profile" class="rounded-full" width="40" height="40">
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
                                    <a href="#" class="block flex items-center px-2 py-2 text-sm text-gray-700 hover:bg-gray-100">
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
            <div class="p-4 mt-2">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
