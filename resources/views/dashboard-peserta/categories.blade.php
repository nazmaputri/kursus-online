@extends('layouts.dashboard-peserta')

@section('content')
<div class="container mx-auto">
    <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-2xl font-bold mb-6 text-center border-b-2 border-gray-300 uppercase pb-2">Daftar Kategori</h2>

        <!-- Grid Kategori -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
            @foreach($categories as $category)
                <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden flex">
                    <!-- Gambar di sisi kiri -->
                    <img class="p-5 w-40 h-full" src="{{ asset('storage/' . $category->image_path) }}" alt="{{ $category->name }}">

                    <!-- Konten teks di sisi kanan -->
                    <div class="p-4 flex flex-col justify-between flex-grow">
                        <h2 class="text-lg font-semibold text-gray-800 capitalize">{{ $category->name }}</h2>
                        <div class="flex justify-end mt-4">
                            <a href="{{ route('categories-detail', ['id' => $category->id]) }}" class="mt-auto bg-sky-300 text-white px-4 py-2 rounded-lg hover:bg-sky-600">
                                Lihat Kursus
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $categories->links('pagination::tailwind') }}
        </div>
    </div>
</div>
@endsection
