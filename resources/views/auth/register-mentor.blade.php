<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-sky-50">
    <div class="flex justify-center items-center min-h-screen">
        <div class="w-full max-w-md p-5 space-y-6 bg-white rounded-lg shadow-lg m-10">
            <!-- Logo and Website Name -->
            <div class="flex flex-col items-center justify-center space-y-2">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('storage/eduflix-1.png') }}" alt="Logo" class="w-18 h-16">
                    <h1 class="text-3xl font-bold text-sky-600">Eduflix</h1>
                </div>
                <h4 class="text-center text-sky-600">
                    Ayo daftar dan menjadi bagian mentor di EduFlix!
                </h4>
            </div>  

           
            <!-- Notifikasi Sukses -->
            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
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
                    <input type="email" name="email" id="email" class="w-full px-4 py-2 border border-sky-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500" required>
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-sky-600 pb-2">Password</label>
                    <input type="password" name="password" id="password" class="w-full px-4 py-2 border border-sky-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500" required>
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-sky-600 pb-2">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-4 py-2 border border-sky-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500" required>
                </div>

                <!-- Phone Number Field -->
                <div>
                    <label for="phone_number" class="block text-sm font-medium text-sky-600 pb-2">Nomor Telepon</label>
                    <input type="text" name="phone_number" id="phone_number" class="w-full px-4 py-2 border border-sky-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
                </div>

                <!-- Kategori -->
                <div>
                    <label for="course" class="block text-sm font-medium text-sky-600 pb-2">Kategori</label>
                    <select name="course" id="course" class="w-full px-4 py-2 border border-sky-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 text-gray-400">
                        <option class="text-gray-400" value="" disabled selected hidden>Pilih Kategori</option>
                        <option value="teknologi" class="text-black">Teknologi</option>
                        <option value="bisnis" class="text-black">Bisnis</option>
                        <option value="desain" class="text-black">Desain</option>
                        <option value="bahasa" class="text-black">Bahasa</option>
                        <option value="umum" class="text-black">Umum</option>
                        <option value="pengembangan-diri" class="text-black">Pengembangan Diri</option>
                    </select>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="experience" class="block text-sm font-medium text-sky-600 pb-2">Deskripsi Pengalaman</label>
                    <textarea name="experience" id="experience" rows="4" placeholder="Deskripsikan pengalaman anda saat menjadi pengajar atau motivator" class="text-sm w-full px-4 py-2 border border-sky-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500"></textarea>
                </div>

                <!-- Hidden Role Field -->
                <input type="hidden" name="role" value="mentor">

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="w-full px-4 py-2 bg-sky-600 text-white font-bold rounded-md hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2">
                        Daftar
                    </button>
                </div>

                <h4 class="text-center text-sky-600">
                    Sudah punya akun? 
                    <a href="/login" class="text-blue-900 underline">Login</a>
                </h4>
            </form>
        </div>
    </div>
</body>
</html>
