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
             <div class="w-48 h-48 rounded-full overflow-hidden border-4 border-gray-300 flex justify-center items-center bg-gray-100">
                <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('path/to/default-photo.jpg') }}" alt="Foto Profil" class="object-cover w-full h-full">
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
