<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

     <!-- Custom Style -->
     <style>
        body {
            font-family: "Quicksand", sans-serif !important;
        }
    </style>
</head>
<body class="bg-sky-50">
    <div class="flex justify-center items-center min-h-screen px-4">
        <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-lg">
            <!-- Logo and Website Name -->
            <div class="flex flex-col items-center justify-center space-y-2">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('storage/eduflix-1.png') }}" alt="Logo" class="w-18 h-16">
                    <h1 class="text-3xl font-bold text-sky-600">Eduflix</h1>
                </div>
                <h4 class="text-center text-sky-600">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-blue-900 underline">Daftar</a>
                </h4>
            </div>         
            
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif
        
            <!-- Form -->
            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf

               <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-sky-600 pb-2">Email Address</label>
                    <input type="email" name="email" id="email"
                        class="w-full px-4 py-2 border text-sm rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 
                        @error('email') border-red-500 @enderror" placeholder="Masukkan email">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-sky-600 pb-2">Password</label>
                    <input type="password" name="password" id="password"
                        class="w-full px-4 py-2 border text-sm rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 
                        @error('password') border-red-500 @enderror" placeholder="Masukkan password">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <!-- Submit Button -->
                <div>
                    <button type="submit" class="w-full px-4 py-2 bg-sky-600 text-white font-bold rounded-md hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
