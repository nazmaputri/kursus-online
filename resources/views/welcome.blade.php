<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        @include('components.navbar')
        @include('components.home')
        @include('components.about')
        @include('components.course')
        @include('components.price')
        @include('components.rating')
        @include('components.footer')
    </body>
</html>
