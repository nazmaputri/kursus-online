@extends('layouts.dashboard-admin')

@section('content')

<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-semibold text-gray-800 border-b-2 pb-2 mb-4">Pengaturan Akun</h2>
    <form action="{{ url('/settings') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="photo" class="block text-sm font-medium text-gray-700">Foto Profil</label>
            @if($user->photo)
                <img src="{{ Storage::url($user->photo) }}" alt="Foto Profil" class="w-28 h-28 rounded-full mt-2">
            @endif
            <input type="file" name="photo" id="photo" class="p-2 mt-2 block w-full border border-gray-200 rounded-md shadow-sm">
            @error('photo')
                <p class="text-red-500 text-xs">{{ $message }}</p>
            @enderror
        </div>

        <!-- Nama -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="p-2 mt-1 block w-full border border-gray-200 rounded-md shadow-sm" required>
            @error('name')
                <p class="text-red-500 text-xs">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="p-2 mt-1 block w-full border border-gray-200 rounded-md shadow-sm" required>
            @error('email')
                <p class="text-red-500 text-xs">{{ $message }}</p>
            @enderror
        </div>

    <!-- Password -->
        <div class="mb-4 relative">
            <label for="password" class="block text-sm font-medium text-gray-700">Masukkan Password Baru</label>
            <input type="password" name="password" id="password" class="p-2 mt-1 block w-full border-gray-200 border rounded-md shadow-sm">
            <span class="absolute top-1/2 right-3 transform -translate-x-1/2 cursor-pointer text-gray-500" id="togglePassword">
                <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="20" height="20">
                    <path id="eyePath" d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/>
                </svg>
            </span>
            @error('password')
                <p class="text-red-500 text-xs">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-4 relative">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="p-2 mt-1 block w-full border border-gray-200 rounded-md shadow-sm">
            <span class="absolute top-1/2 right-3 transform -translate-x-1/2 cursor-pointer text-gray-500" id="toggleConfirmPassword">
                <svg id="eyeConfirmIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="20" height="20">
                    <path id="eyeConfirmPath" d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/>
                </svg>
            </span>
        </div>
        <div class="flex justify-end space-x-4">
            <!-- Tombol Simpan -->
            <button type="submit" class="bg-sky-300 text-white font-bold py-2 px-6 rounded-lg hover:bg-sky-600">Simpan</button>
            
            <!-- Tombol Batal -->
            <a href="{{ route('welcome-admin') }}" class="bg-red-400 text-white font-bold py-2 px-6 rounded-lg hover:bg-red-600">Batal</a>
        </div>              
    </form>

    <script>
        // Toggle password visibility for password field
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('password');
    
        togglePassword.addEventListener('click', function() {
            const type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = type;
        });
    
        // Toggle password visibility for confirm password field
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmPasswordField = document.getElementById('password_confirmation');
    
        toggleConfirmPassword.addEventListener('click', function() {
            const type = confirmPasswordField.type === 'password' ? 'text' : 'password';
            confirmPasswordField.type = type;
        });
    </script>
</div>

@endsection