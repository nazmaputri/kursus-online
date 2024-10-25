<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-sky-50">
    <div class="flex justify-center items-center min-h-screen">
        <div class="w-full max-w-md p-5 space-y-6 bg-white rounded-lg shadow-lg">
            <!-- Logo and Website Name -->
            <div class="flex flex-col items-center justify-center space-y-2">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('storage/eduflix-1.png') }}" alt="Logo" class="w-18 h-16">
                    <h1 class="text-3xl font-bold text-sky-600">Eduflix</h1>
                </div>
                <h4 class="text-center text-sky-600">
                    Klik disini untuk daftar sebagai mentor! 
                    <a href="{{ route('register') }}" class="text-blue-900 underline">Daftar</a>
                </h4>
            </div>            
           
            <!-- Form -->
            <form action="{{ route('register') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-sky-600 pb-2">Nama Lengkap</label>
                    <input type="text" name="name" id="name" class="w-full px-4 py-2 border border-sky-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500" required>
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-sky-600 pb-2">Email</label>
                    <input type="email" name="email" id="email" class="w-full px-4 py-2 border border-sky-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500" required autofocus>
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-sky-600 pb-2">Password</label>
                    <input type="password" name="password" id="password" class="w-full px-4 py-2 border border-sky-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500" required>
                </div>

                <!-- Phone Number Field -->
                <div>
                    <label for="phone_number" class="block text-sm font-medium text-sky-600 pb-2">Nomor Telepon</label>
                    <input type="text" name="phone_number" id="phone_number" class="w-full px-4 py-2 border border-sky-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500" required>
                </div>

                <!-- Hidden Role Field -->
                <input type="hidden" name="role" value="student"> <!-- Automatically set role to student -->

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="w-full px-4 py-2 bg-sky-600 text-white font-bold rounded-md hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2">
                        Daftar
                    </button>
                </div>

                <h4 class="text-center text-sky-600">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="text-blue-900 underline">Login</a>
                </h4>
            </form>
        </div>
    </div>
</body>
</html>
