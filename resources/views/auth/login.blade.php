<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-sky-50">
    <div class="flex justify-center items-center min-h-screen">
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
        
            <!-- Form -->
            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-sky-600 pb-2">Email Address</label>
                    <input type="email" name="email" id="email" class="w-full px-4 py-2 border border-sky-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500" required autofocus autocomplete="email">
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-sky-600 pb-2">Password</label>
                    <input type="password" name="password" id="password" class="w-full px-4 py-2 border border-sky-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500" required autocomplete="current-password">
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-sky-600 focus:ring-sky-500 border-sky-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-sky-600">Remember me</label>
                    </div>

                    <div class="text-sm">
                        <a href="#" class="font-medium text-sky-600 hover:text-sky-500">Forgot your password?</a>
                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="w-full px-4 py-2 bg-sky-600 text-white font-bold rounded-md hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2">
                        Login
                    </button>
                </div>

                @if($errors->any())
                    <div class="text-red-500">
                        {{ $errors->first() }}
                    </div>
                @endif
            </form>
        </div>
    </div>
</body>
</html>
