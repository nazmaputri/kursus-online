@extends('layouts.dashboard-admin')

@section('content')
<div class="container mx-auto">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-3xl font-bold mb-6 border-b-2 border-gray-300 pb-2">Edit Kategori</h2>
        
        <!-- Form untuk edit kategori -->
        <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- Wrapper kiri untuk nama dan deskripsi -->
            <div class="flex flex-wrap">
                <div class="w-full md:w-1/2 pr-4 mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Nama Kategori</label>
                    <input type="text" name="name" id="name" class="w-full p-2 border rounded @error('name') border-red-500 @enderror" placeholder="Masukkan nama kategori" value="{{ old('name', $category->name) }}">
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror

                    <label for="description" class="block text-gray-700 font-bold mt-6 mb-2">Deskripsi</label>
                    <textarea name="description" id="description" class="w-full p-2 border rounded @error('description') border-red-500 @enderror" placeholder="Masukkan deskripsi kategori">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Kolom kanan khusus untuk gambar -->
                <div class="w-full md:w-1/2 pl-4 mb-4">
                    <label for="image" class="block text-gray-700 font-bold mb-2">Unggah Gambar Baru</label>
                    <input type="file" name="image" id="image" class="w-full p-2 border rounded @error('image') border-red-500 @enderror">
                    @error('image')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror

                    <!-- Menampilkan gambar saat ini jika ada -->
                    @if($category->image_path)
                        <div class="mt-6">
                            <label class="block text-gray-700 font-bold mb-2">Gambar Saat Ini</label>
                            <img src="{{ asset('storage/' . $category->image_path) }}" alt="{{ $category->name }}" class="w-32 h-32 object-cover rounded">
                        </div>
                    @endif
                </div>
            </div>

            <!-- Tombol submit -->
            <div class="mt-6 text-right">
                <button type="submit" class="bg-sky-400 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded">
                    Update
                </button>
                <button type="submit" class="bg-red-400 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
