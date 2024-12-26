<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Landing Page</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Custom Style -->
    <style>
        body {
            font-family: "Quicksand", sans-serif !important;
        }
    </style>
</head>
<body class="font-sans dark:bg-black dark:text-white/50">
    @include('components.navbar')
    @include('components.home')
    @include('components.about')
    @include('components.course')
    @include('components.price')
    @include('components.rating')
    @include('components.footer')

    <!-- AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        // Initialize AOS animation
        AOS.init({
            duration: 1000,   // Durasi animasi dalam milidetik
            once: false,      // Animasi dapat dipicu ulang setiap kali elemen terlihat
            mirror: true,     // Animasi juga dipicu saat menggulir ke atas
        });

        // Reinitialize AOS on window resize (optional, untuk memastikan animasi tetap responsif)
        window.addEventListener('resize', () => {
            AOS.refresh();
        });
    </script>
</body>
</html>
