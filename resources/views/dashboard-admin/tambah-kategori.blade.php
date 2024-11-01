@extends('layouts.dashboard-admin')

@section('content')
<div class="container mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-6">Tambah Kategori</h2>

    <form action="{{ route('kategori-store') }}" method="POST" enctype="multipart/form-data">
        @csrf

         <!-- Gambar Kategori -->
         <div class="mb-4">
            <label for="image" class="block text-gray-700 font-bold mb-2">Gambar Kategori</label>
            <input type="file" name="image" id="image" class="w-full p-2 border rounded @error('image') border-red-500 @enderror">
            @error('image')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Nama Kategori -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">Nama Kategori</label>
            <input type="text" name="name" id="name" class="w-full p-2 border rounded @error('name') border-red-500 @enderror" placeholder="Masukkan nama kategori" value="{{ old('name') }}">
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Deskripsi Kategori -->
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-bold mb-2">Deskripsi</label>
            <textarea name="description" id="description" class="w-full p-2 border rounded @error('description') border-red-500 @enderror" placeholder="Masukkan deskripsi kategori">{{ old('description') }}</textarea>
            @error('description')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Tombol Submit -->
        <div class="mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Tambah Kategori
            </button>
        </div>
    </form>
</div>
@endsection
