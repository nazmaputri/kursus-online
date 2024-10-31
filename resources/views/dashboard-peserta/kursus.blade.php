@extends('layouts.dashboard-peserta')
@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-6">Daftar Kategori Kursus</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @php
            // Data dummy kategori kursus
            $categories = [
                [
                    'name' => 'Umum',
                    'description' => 'Kursus umum untuk semua kalangan.',
                    'image' => 'https://via.placeholder.com/400x200?text=Umum',
                ],
                [
                    'name' => 'Pengembangan Diri',
                    'description' => 'Pelajari cara untuk meningkatkan diri dan keterampilan.',
                    'image' => 'https://via.placeholder.com/400x200?text=Pengembangan+Diri',
                ],
                [
                    'name' => 'IT',
                    'description' => 'Kursus terkait teknologi informasi dan komputer.',
                    'image' => 'https://via.placeholder.com/400x200?text=IT',
                ],
                [
                    'name' => 'Keterampilan Kreatif',
                    'description' => 'Kembangkan keterampilan seni dan kreatifitas.',
                    'image' => 'https://via.placeholder.com/400x200?text=Keterampilan+Kreatif',
                ],
                [
                    'name' => 'Kesehatan',
                    'description' => 'Pelajari tentang kesehatan dan kebugaran.',
                    'image' => 'https://via.placeholder.com/400x200?text=Kesehatan',
                ],
                [
                    'name' => 'Bahasa',
                    'description' => 'Kursus belajar bahasa asing dengan mudah.',
                    'image' => 'https://via.placeholder.com/400x200?text=Bahasa',
                ],
                [
                    'name' => 'Keuangan',
                    'description' => 'Pelajari tentang manajemen keuangan dan investasi.',
                    'image' => 'https://via.placeholder.com/400x200?text=Keuangan',
                ],
                [
                    'name' => 'Fotografi',
                    'description' => 'Kursus dasar hingga lanjutan fotografi.',
                    'image' => 'https://via.placeholder.com/400x200?text=Fotografi',
                ],
                [
                    'name' => 'Musik',
                    'description' => 'Pelajari teori dan praktik musik.',
                    'image' => 'https://via.placeholder.com/400x200?text=Musik',
                ],
            ];
        @endphp

        @foreach($categories as $category)
        <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">
            <img class="w-full h-48 object-cover" src="{{ $category['image'] }}" alt="{{ $category['name'] }}">
            <div class="p-4">
                <h2 class="text-xl font-semibold">{{ $category['name'] }}</h2>
                <p class="mt-2 text-gray-600">{{ $category['description'] }}</p>
                <a href="{{ route('detail-peserta') }}" class="inline-block mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Lihat Kursus</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection