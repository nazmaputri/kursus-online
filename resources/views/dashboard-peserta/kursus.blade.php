@extends('layouts.dashboard-peserta')
@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-6">Daftar Kategori Kursus</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($categories as $category)
            <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">
                <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}">
                <div class="p-4">
                    <h2 class="text-xl font-semibold">{{ $category->name }}</h2>
                    <p class="mt-2 text-gray-600">{{ $category->description }}</p>
                    <a href="{{ route('detail-peserta', ['id' => $category->id]) }}" class="inline-block mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Lihat Kursus</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
