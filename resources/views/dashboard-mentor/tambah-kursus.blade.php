@extends('layouts.dashboard-mentor') 

@section('content')
<div class="container mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-6">Tambah Kursus Baru</h2>

    <!-- Form Tambah Kursus -->
    <form action="{{ route('courses-store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Input untuk Judul -->
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-bold mb-2">Judul Kursus</label>
            <input type="text" name="title" id="title" class="w-full p-2 border rounded @error('title') border-red-500 @enderror" placeholder="Masukkan judul kursus" value="{{ old('title') }}">
            @error('title')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Input untuk Deskripsi -->
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-bold mb-2">Deskripsi</label>
            <textarea name="description" id="description" rows="5" class="w-full p-2 border rounded @error('description') border-red-500 @enderror" placeholder="Masukkan deskripsi kursus">{{ old('description') }}</textarea>
            @error('description')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Input untuk kategori -->
        <div class="mb-4">
            <label for="category" class="block text-gray-700 font-bold mb-2">Kategori</label>
            <input type="text" name="category" id="category" class="w-full p-2 border rounded @error('category') border-red-500 @enderror" placeholder="Masukkan Kategori" value="{{ old('category') }}">
            @error('category')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Input untuk Harga -->
        <div class="mb-4">
            <label for="price" class="block text-gray-700 font-bold mb-2">Harga</label>
            <input type="number" name="price" id="price" class="w-full p-2 border rounded @error('price') border-red-500 @enderror" placeholder="Masukkan harga kursus" value="{{ old('price') }}">
            @error('price')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Input untuk Foto -->
        <div class="mb-4">
            <label for="image" class="block text-gray-700 font-bold mb-2">Foto Kursus</label>
            <input type="file" name="image" id="image" class="w-full p-2 border rounded">
            <small class="text-gray-600">Format gambar yang diperbolehkan: jpg, png, jpeg</small>
        </div>

        <!-- Tombol Submit -->
        <div class="mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Tambah Kursus
            </button>
        </div>
    </form>
</div>
@endsection
