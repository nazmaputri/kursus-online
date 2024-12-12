@extends('layouts.dashboard-mentor')
@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-8 border-b-2 border-gray-300 pb-2 uppercase">Daftar Kursus</h2>
    
    <!-- Daftar Kursus -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-6">
        @foreach ($courses as $course)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg hover:shadow-sky-100">
            <!-- Gambar Kursus -->
            <a href="{{ route('rating-detail', $course->id) }}" class="block">
                <img src="{{ asset('storage/' . $course->image_path) }}" alt="{{ $course->title }}" class="w-full h-40 object-cover">
            </a>
            
            <!-- Informasi Kursus -->
            <div class="p-4">
                <a href="{{ route('rating-detail', $course->id) }}" class="text-lg capitalize font-semibold text-gray-800 hover:text-sky-300 block">
                    {{ $course->title }}
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection