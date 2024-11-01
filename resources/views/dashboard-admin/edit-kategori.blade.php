@extends('layouts.dashboard-admin')

@section('content')
<div class="container mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-6">Edit Kategori</h2>

    <form action="{{ route('kategori-update', $category->id) }}" method="PUT" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">Nama Kategori</label>
            <input type="text" name="name" id="name" class="w-full p-2 border rounded @error('name') border-red-500 @enderror" placeholder="Masukkan nama kategori" value="{{ old('name', $category->name) }}">
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-bold mb-2">Deskripsi</label>
            <textarea name="description" id="description" class="w-full p-2 border rounded @error('description') border-red-500 @enderror" placeholder="Masukkan deskripsi kategori">{{ old('description', $category->description) }}</textarea>
            @error('description')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="image" class="block text-gray-700 font-bold mb-2">Gambar</label>
            <input type="file" name="image" id="image" class="w-full p-2 border rounded @error('image') border-red-500 @enderror">
            @error('image')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        @if($category->image_path)
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Gambar Saat Ini</label>
                <img src="{{ asset('storage/' . $category->image_path) }}" alt="{{ $category->name }}" class="w-32 h-32 object-cover">
            </div>
        @endif

        <div class="mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Perbarui Kategori
            </button>
        </div>
    </form>
</div>
@endsection
