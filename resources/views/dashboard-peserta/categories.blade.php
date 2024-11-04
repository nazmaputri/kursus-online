@extends('layouts.dashboard-peserta')
@section('content')
<div class="container mx-auto">
    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold mb-4 text-gray-800">Daftar Kategori Kursus</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($categories as $category)
                <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden flex flex-col items-center">
                    <img class="w-40 h-40 object-cover" src="{{ asset('storage/' .$category->image_path) }}" alt="{{ $category->name }}">
                    <div class="p-3 text-center">
                        <h2 class="text-lg font-semibold text-gray-800">{{ $category->name }}</h2>
                        <a href="{{ route('kursus-peserta') }}" class="inline-block mt-3 bg-sky-300 text-white px-4 py-2 rounded-md hover:bg-sky-600">Lihat Kursus</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
