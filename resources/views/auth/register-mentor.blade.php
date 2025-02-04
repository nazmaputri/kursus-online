<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
            
            <!-- Form -->
            <form action="{{ route('register') }}" method="POST" class="space-y-6">
                @csrf
                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-sky-600 pb-2">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap"
                        class="w-full px-4 py-2 border text-sm rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 
                        @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-sky-600 pb-2">Email</label>
                    <input type="email" name="email" id="email" placeholder="Masukkan email"
                        class="w-full px-4 py-2 border text-sm rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 
                        @error('email') border-red-500 @enderror"
                        value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            
                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-sky-600 pb-2">Password</label>
                    <input type="password" name="password" id="password" placeholder="Masukkan password"
                        class="w-full px-4 py-2 border text-sm border-sky-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 
                        @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            
                <!-- Confirm Password Field -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-sky-600 pb-2">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Masukkan konfirmasi password"
                        class="w-full px-4 py-2 border text-sm border-sky-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
                </div>
            
                <!-- Phone Number Field -->
                <div>
                    <label for="phone_number" class="block text-sm font-medium text-sky-600 pb-2">Nomor Telepon</label>
                    <input type="text" name="phone_number" id="phone_number" placeholder="Masukkan nomor telepon"
                        class="w-full px-4 py-2 border text-sm border-sky-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 @error('phone_number') border-red-500 @enderror"
                        value="{{ old('phone_number') }}">
                    @error('phone_number')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            
                <!-- Profesi -->
                <div>
                    <label for="profesi" class="block text-sm font-medium text-sky-600 pb-2">Profesi</label>
                    <input type="text" name="profesi" id="profesi" placeholder="Masukkan profesi anda saat ini"
                        class="w-full px-4 py-2 border text-sm rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 @error('profesi') border-red-500 @enderror"
                        value="{{ old('profesi') }}">
                    @error('profesi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            
                <!-- LinkedIn -->
                <div>
                    <label for="linkedin" class="block text-sm font-medium text-sky-600 pb-2">LinkedIn</label>
                    <input type="text" name="linkedin" id="linkedin" placeholder="Masukkan Link URL LinkedIn"
                        class="w-full px-4 py-2 border text-sm rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 @error('linkedin') border-red-500 @enderror"
                        value="{{ old('linkedin') }}">
                    @error('linkedin')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            
                <!-- Perusahaan -->
                <div>
                    <label for="company" class="block text-sm font-medium text-sky-600 pb-2">Perusahaan</label>
                    <input type="text" name="company" id="company" placeholder="Masukkan nama perusahaan tempat bekerja"
                        class="w-full px-4 py-2 border text-sm rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 @error('company') border-red-500 @enderror"
                        value="{{ old('company') }}">
                    @error('company')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            
                <!-- Tahun Pengalaman -->
                <div>
                    <label for="years_of_experience" class="block text-sm font-medium text-sky-600 pb-2">Tahun Pengalaman</label>
                    <input type="number" name="years_of_experience" id="years_of_experience" placeholder="Masukkan tahun pengalaman bekerja"
                        class="w-full px-4 py-2 border text-sm rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 @error('years_of_experience') border-red-500 @enderror"
                        value="{{ old('years_of_experience') }}">
                    @error('years_of_experience')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            
                <!-- Deskripsi Pengalaman -->
                <div>
                    <label for="experience" class="block text-sm font-medium text-sky-600 pb-2">Deskripsi Pengalaman</label>
                    <textarea name="experience" id="experience" rows="4" placeholder="Deskripsikan pengalaman saat bekerja atau mengajar"
                        class="text-sm w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 @error('experience') border-red-500 @enderror">{{ old('experience') }}</textarea>
                    @error('experience')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            
                <!-- Hidden Role Field -->
                <input type="hidden" name="role" value="mentor">
             
                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="w-full px-4 py-2 bg-sky-600 text-white font-bold rounded-md hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2">
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
