@extends('layouts.dashboard-peserta')

@section('content')

<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-semibold text-gray-800 border-b-2 pb-2 mb-4">Pengaturan Akun</h2>
    <form action="{{ url('/update-peserta') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="photo" class="block text-sm font-medium text-gray-700">Foto Profil</label>
            @if($user->photo)
                <img src="{{ asset('storage/' . $user->photo) }}" alt="Foto Profil" class="w-28 h-28 rounded-full mt-2">
            @endif
            <input type="file" name="photo" id="photo" class="p-2 mt-2 block w-full border border-gray-200 rounded-md shadow-sm">
            @error('photo')
                <p class="text-red-500 text-xs">{{ $message }}</p>
            @enderror
        </div>
    
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="p-2 mt-1 block w-full border border-gray-200 rounded-md shadow-sm" required>
            @error('name')
                <p class="text-red-500 text-xs">{{ $message }}</p>
            @enderror
        </div>
    
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="p-2 mt-1 block w-full border border-gray-200 rounded-md shadow-sm" required>
            @error('email')
                <p class="text-red-500 text-xs">{{ $message }}</p>
            @enderror
        </div>
    
        <div class="mb-4 relative">
            <label for="password" class="block text-sm font-medium text-gray-700">Masukkan Password Baru</label>
            <input type="password" name="password" id="password" class="p-2 mt-1 block w-full border-gray-200 border rounded-md shadow-sm">
            @error('password')
                <p class="text-red-500 text-xs">{{ $message }}</p>
            @enderror
        </div>
    
        <div class="mb-4 relative">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="p-2 mt-1 block w-full border border-gray-200 rounded-md shadow-sm">
        </div>
    
        <div class="flex justify-end space-x-4">
            <button type="submit" class="bg-sky-300 text-white font-bold py-2 px-6 rounded-lg hover:bg-sky-600">Simpan</button>
            <a href="{{ route('welcome-peserta') }}" class="bg-red-400 text-white font-bold py-2 px-6 rounded-lg hover:bg-red-600">Batal</a>
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