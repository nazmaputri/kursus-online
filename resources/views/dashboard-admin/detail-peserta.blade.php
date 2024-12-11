@extends('layouts.dashboard-admin')

@section('content')
<div class="container mx-auto">
    <!-- Card Detail User -->
    <div class="bg-white shadow-lg rounded-lg border border-gray-200 p-6 mb-6">
        <!-- Judul Card -->
        <div class="text-left mb-6">
            <h2 class="text-2xl font-bold mb-4 border-b-2 border-gray-300 pb-2">Detail User : {{ $user->name }} </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Kolom Kiri: Foto Profil, Email, Role, No Telepon -->
            <div class="flex flex-col items-center mb-6 space-y-4">
             <!-- Foto Profil -->
            <div class="w-48 h-48 rounded-full overflow-hidden border-4 border-gray-300 flex justify-center items-center">
                @if($user->profile_photo_url)
                    <img src="{{ $user->profile_photo_url }}" alt="Foto Profil" class="object-cover w-full h-full">
                @else
                    <!-- SVG sebagai ikon default -->
                    <svg class="w-48 h-48 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M399 384.2C376.9 345.8 335.4 320 288 320l-64 0c-47.4 0-88.9 25.8-111 64.2c35.2 39.2 86.2 63.8 143 63.8s107.8-24.7 143-63.8zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm256 16a72 72 0 1 0 0-144 72 72 0 1 0 0 144z"/>
                    </svg>
                @endif
            </div>

        
                <!-- Email -->
                <div class="border p-4 rounded-lg shadow-sm w-full">
                    <h4 class="text-gray-500 font-medium">Email:</h4>
                    <p class="text-gray-700">{{ $user->email }}</p>
                </div>
        
                <!-- Role -->
                <div class="border p-4 rounded-lg shadow-sm w-full">
                    <h4 class="text-gray-500 font-medium">Role:</h4>
                    <p class="text-gray-700">{{ ucfirst($user->role) }}</p>
                </div>
            </div>
        
            <!-- Kolom Kanan: Informasi Lainnya -->
            <div class="flex flex-col space-y-4">
                <!-- No Telepon -->
                <div class="border p-4 rounded-lg shadow-sm w-full">
                    <h4 class="text-gray-500 font-medium">No Telepon:</h4>
                    <p class="text-gray-700">{{ $user->phone_number ?? '-' }}</p>
                </div>

                <!-- Status -->
                <div class="border p-4 rounded-lg shadow-sm">
                    <h4 class="text-gray-500 font-medium">Status:</h4>
                    <p class="text-gray-700">{{ ucfirst($user->status) ?? '-' }}</p>
                </div>
        
                <!-- Tanggal Registrasi -->
                <div class="border p-4 rounded-lg shadow-sm">
                    <h4 class="text-gray-500 font-medium">Tanggal Registrasi:</h4>
                    <p class="text-gray-700">{{ $user->created_at->format('d M Y') }}</p>
                </div>
        
                <!-- Email Verified At -->
                <div class="border p-4 rounded-lg shadow-sm">
                    <h4 class="text-gray-500 font-medium">Email Terverifikasi:</h4>
                    <p class="text-gray-700">{{ $user->email_verified_at ? $user->email_verified_at->format('d M Y H:i') : 'Belum Terverifikasi' }}</p>
                </div>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="text-right">
            <a href="{{ route('datapeserta-admin') }}" class="bg-sky-400 hover:bg-sky-600 text-white font-semibold py-2 px-6 rounded-lg shadow-md shadow-blue-100 hover:shadow-none">
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection
