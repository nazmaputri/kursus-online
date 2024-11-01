@extends('layouts.dashboard-admin')

@section('content')
<div class="container mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-6">Daftar Kategori</h2>

    <!-- Tombol Tambah Kategori -->
    <div class="mb-4">
        <a href="{{ route('kategori-create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Tambah Kategori
        </a>
    </div>

    <!-- Tabel Kategori -->
    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">ID</th>
                <th class="py-2 px-4 border-b">Gambar</th> 
                <th class="py-2 px-4 border-b">Nama Kategori</th>
                <th class="py-2 px-4 border-b">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $category->id }}</td>
                    <td class="py-2 px-4 border-b">
                        <img src="{{ asset('storage/' .$category->image_path) }}" alt="{{ $category->name }}" class="w-16 h-16 object-cover"> <!-- Menampilkan Gambar -->
                    </td>
                    <td class="py-2 px-4 border-b">{{ $category->name }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('kategori-edit', $category->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                        <form action="{{ route('kategori-delete', $category->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
