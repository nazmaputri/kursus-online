<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Landing Page</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

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
    </body>
</html>
