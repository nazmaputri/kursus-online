@extends('layouts.dashboard-peserta')

@section('content')
<div class="container mx-auto">
    <div class="bg-white p-8 rounded-lg shadow-md relative">
        <h2 class="text-2xl font-bold mb-8 border-b-2 border-gray-300 pb-2 uppercase">Detail Kursus</h2>
        <!-- Card Informasi Kursus -->
        <div class="flex flex-col lg:flex-row mb-4">
            <div class="w-full lg:w-1/3 mb-4 lg:mb-0">
                @if($course && $course->image_path)
                    <img src="{{ asset('storage/' . $course->image_path) }}" alt="{{ $course->title }}" class="rounded-lg w-full h-auto">
                @else
                    <img src="https://via.placeholder.com/400x300" alt="Default Course Image" class="rounded-lg w-full h-auto">
                @endif
            </div>
            <div class="ml-4 w-2/3 space-y-3">
                <h2 class="text-2xl font-bold capitalize">{{ $course->title }}</h2>
                <p class="text-gray-700 text-sm">{{ $course->description }}</p>
                <p class="text-gray-600"><strong>Mentor :</strong> {{ $course->mentor->name }}</p>
                <p class="text-gray-600"><strong>Biaya :</strong> Rp {{ number_format($course->price, 0, ',', '.') }}</p>
                @if($course->start_date && $course->end_date)
                    <p class="text-gray-600"><strong>Tanggal Mulai :</strong> {{ \Carbon\Carbon::parse($course->start_date)->format('d F Y') }} - {{ \Carbon\Carbon::parse($course->end_date)->format('d F Y') }}</p>
                @endif
                @if($course->duration)
                    <p class="text-gray-600"><strong>Durasi :</strong> {{ $course->duration }}</p>
                @endif
                @if($course->capacity)
                    <p class="text-gray-600"><strong>Kapasitas :</strong> {{ $course->capacity }}</p>
                @endif
            </div>
        </div> 
        <!-- Tombol Kembali di pojok kanan bawah -->
        <a href="{{ route('daftar-kursus') }}" class="bg-sky-300 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded absolute bottom-0 right-0 mb-4 mr-4">
            Kembali
        </a>        
    </div>
</div>
@endsection
