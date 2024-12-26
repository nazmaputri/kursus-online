@extends('layouts.dashboard-peserta')

@section('content')
    <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-2xl font-bold mb-6 text-center border-b-2 border-gray-300 uppercase pb-2">Daftar Kategori</h2>

        <!-- Grid Kategori dengan scroll horizontal pada mode mobile dan iPad -->
        <div class="overflow-x-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-1 lg:grid-cols-2 gap-6">
                @foreach($categories as $category)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden flex flex-col sm:flex-row">
                        <!-- Gambar di atas pada mode mobile, di kiri pada mode desktop -->
                        <img class="p-5 w-full h-auto object-cover sm:w-1/3 sm:h-full" src="{{ asset('storage/' . $category->image_path) }}" alt="{{ $category->name }}">

                        <!-- Konten teks di bawah gambar pada mode mobile, di kanan pada mode desktop -->
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
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $categories->links('pagination::tailwind') }}
        </div>
    </div>
@endsection
