<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
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
    <style>
        body {
            font-family: 'Noto', sans-serif;
        }
    </style>
</head>
<body class="bg-sky-300/15">
    <div class="flex flex-col min-h-screen">

        <!-- Sidebar -->
        <aside id="logo-sidebar" class="fixed top-4 left-4 w-64 h-[calc(100vh-2rem)] bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700 p-4 rounded-xl transition-all transform" aria-label="Sidebar">
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
                <ul class="space-y-2 font-medium">
                    <li class="border-l-2 {{ Request::routeIs('welcome-admin') ? 'border-sky-500' : 'border-transparent hover:border-sky-500' }}">
                        <a href="{{ route('welcome-admin') }}" class="flex items-center p-2 text-gray-900 rounded-sm dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <svg class="w-5 h-5 icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                <path d="M575.8 255.5c0 18-15 32.1-32 32.1l-32 0 .7 160.2c0 2.7-.2 5.4-.5 8.1l0 16.2c0 22.1-17.9 40-40 40l-16 0c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1L416 512l-24 0c-22.1 0-40-17.9-40-40l0-24 0-64c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32l0 64 0 24c0 22.1-17.9 40-40 40l-24 0-31.9 0c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2l-16 0c-22.1 0-40-17.9-40-40l0-112c0-.9 0-1.9 .1-2.8l0-69.7-32 0c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/>
                            </svg>
                            <span class="ms-3">Dashboard</span>
                        </a>
                    </li>
                    <li class="relative">
                        <div class="border-l-2 border-sky-500 border-transparent hover:border-sky-500 ">
                            <button onclick="toggleDropdown()" class="flex items-center p-2 text-gray-900 rounded-sm dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 w-full">

                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                    <path d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192l42.7 0c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0L21.3 320C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7l42.7 0C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3l-213.3 0zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352l117.3 0C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7l-330.7 0c-14.7 0-26.7-11.9-26.7-26.7z"/>
                                </svg>
                                <span class="ms-3">Data User</span>
                                <!-- Panah dropdown -->
                                <svg class="ml-auto w-4 h-4 transition-transform duration-200 {{ Request::routeIs('datamentor-admin', 'datapeserta-admin', 'detaildata-mentor', 'detaildata-peserta') ? 'rotate-180' : '' }}" id="dropdown-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                    <path d="M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z"/>
                                </svg>
                            </button>
                        </div>
                    
                        <!-- Submenu -->
                        <ul id="dropdown-menu" class="{{ Request::routeIs('datamentor-admin', 'datapeserta-admin', 'detaildata-mentor', 'detaildata-peserta') ? '' : 'hidden' }} ml-4 space-y-1 mt-2 dark:bg-gray-700 rounded-sm p-2">
                            <li class="border-l-2 {{ Request::routeIs('datamentor-admin', 'detaildata-mentor') ? 'border-sky-500' : 'border-transparent hover:border-sky-500' }}">
                                <a href="{{ route('datamentor-admin') }}" class="flex items-center gap-2 p-2 text-gray-700 rounded-sm dark:text-white hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <!-- Ikon SVG -->
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/>
                                    </svg>
                                    Data Mentor
                                </a>
                            </li>
                            <li class="border-l-2 {{ Request::routeIs('datapeserta-admin', 'detaildata-peserta') ? 'border-sky-500' : 'border-transparent hover:border-sky-500' }}">
                                <a href="{{ route('datapeserta-admin') }}" class="flex items-center gap-2 p-2 text-gray-700 rounded-sm dark:text-white hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <!-- Ikon SVG -->
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/>
                                    </svg>
                                    Data Peserta
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

                    <li class="border-l-2 {{ Request::routeIs('categories.index', 'categories.create', 'categories.show', 'categories.edit', 'detail-kursus') ? 'border-sky-500' : 'border-transparent hover:border-sky-500' }}">
                        <a href="{{ route('categories.index') }}" class="flex items-center gap-2 p-2 text-gray-700 rounded-sm dark:text-white hover:bg-gray-100 dark:hover:bg-gray-600">
                            <!-- Ikon SVG -->
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                <path d="M264.5 5.2c14.9-6.9 32.1-6.9 47 0l218.6 101c8.5 3.9 13.9 12.4 13.9 21.8s-5.4 17.9-13.9 21.8l-218.6 101c-14.9 6.9-32.1 6.9-47 0L45.9 149.8C37.4 145.8 32 137.3 32 128s5.4-17.9 13.9-21.8L264.5 5.2zM476.9 209.6l53.2 24.6c8.5 3.9 13.9 12.4 13.9 21.8s-5.4 17.9-13.9 21.8l-218.6 101c-14.9 6.9-32.1 6.9-47 0L45.9 277.8C37.4 273.8 32 265.3 32 256s5.4-17.9 13.9-21.8l53.2-24.6 152 70.2c23.4 10.8 50.4 10.8 73.8 0l152-70.2zm-152 198.2l152-70.2 53.2 24.6c8.5 3.9 13.9 12.4 13.9 21.8s-5.4 17.9-13.9 21.8l-218.6 101c-14.9 6.9-32.1 6.9-47 0L45.9 405.8C37.4 401.8 32 393.3 32 384s5.4-17.9 13.9-21.8l53.2-24.6 152 70.2c23.4 10.8 50.4 10.8 73.8 0z"/>
                            </svg>
                            Kategori
                        </a>
                    </li>     
                    <li class="border-l-2 {{ Request::routeIs('rating-admin') ? 'border-sky-500' : 'border-transparent hover:border-sky-500' }}">
                        <a href="{{ route('rating-admin') }}" class="flex items-center p-2 text-gray-900 rounded-sm dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/>
                            </svg>
                            <span class="ms-3">Penilaian</span>
                        </a>
                    </li>              
                    <li class="border-l-2 {{ Request::routeIs('laporan-admin') ? 'border-sky-500' : 'border-transparent hover:border-sky-500' }}">
                        <a href="{{ route('laporan-admin') }}" class="flex items-center p-2 text-gray-900 rounded-sm dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <svg class="w-5 h-5"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M32 32c17.7 0 32 14.3 32 32l0 336c0 8.8 7.2 16 16 16l400 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L80 480c-44.2 0-80-35.8-80-80L0 64C0 46.3 14.3 32 32 32zM160 224c17.7 0 32 14.3 32 32l0 64c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32zm128-64l0 160c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-160c0-17.7 14.3-32 32-32s32 14.3 32 32zm64 32c17.7 0 32 14.3 32 32l0 96c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-96c0-17.7 14.3-32 32-32zM480 96l0 224c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-224c0-17.7 14.3-32 32-32s32 14.3 32 32z"/>
                            </svg>
                            <span class="ms-3">Laporan</span>
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
                const header = document.getElementById("header");
                const hamburgerButton = document.getElementById("hamburger-button");
                const logo = document.getElementById("logo");
                const svgImage = document.getElementById("svg-image");
        
                // Event klik pada tombol hamburger
                hamburgerButton.addEventListener("click", () => {
                    // Toggle lebar sidebar
                    sidebar.classList.toggle("w-64");
                    sidebar.classList.toggle("w-16");
        
                    // Toggle margin pada konten utama
                    content.classList.toggle("ml-64");
                    content.classList.toggle("ml-16");
        
                    // Toggle margin pada header
                    header.classList.toggle("ml-64");
                    header.classList.toggle("ml-16");
        
                    // Atur ukuran logo dan SVG
                    if (sidebar.classList.contains("w-16")) {
                        logo.classList.add("transform", "scale-75");
                        svgImage.classList.remove("hidden"); // Tampilkan SVG
                    } else {
                        logo.classList.remove("transform", "scale-75");
                        svgImage.classList.add("hidden"); // Sembunyikan SVG
                    }
                });
            });
        </script>

         <!-- Main Content -->
         <div id="content" class="flex-1 ml-64 transition-all duration-300 p-4 relative">
            <!-- Header -->
            <div id="header" class="flex items-center justify-between top-4 fixed left-0 ml-64 right-0 px-4 transition-all duration-300">
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
                @if(Auth::user()->photo)
                <!-- Tampilkan gambar profil jika ada -->
                <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="User Profile" class="rounded-full" width="40" height="40">
                @else
                <!-- SVG sebagai ikon default -->
                <svg class="w-9 h-9" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor">
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
                                     <a href="/settings" class="block flex items-center px-2 py-2 text-sm text-gray-700 hover:bg-gray-100">
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
</body>
</html>
