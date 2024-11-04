@extends('layouts.dashboard-admin')
@section('content')

<div class="container mx-auto ">
    <div class="bg-white border border-gray-300 rounded-lg shadow-md p-4 mb-6">
        <h2 class="text-3xl font-bold text-gray-800 text-center">Daftar Kursus</h2>
    </div>
    
    <div class="overflow-x-auto hide-scrollbar"> 
        <div class="flex space-x-6">
            @foreach($courses as $course)
                <div class="course-card bg-white border border-gray-300 rounded-lg shadow-md overflow-hidden flex-none w-80 flex-shrink-0 flex flex-col transition-transform duration-300 ease-in-out">
                    <div class="flex justify-center mt-5">
                        <img src="{{ asset('storage/' . $course->image_path) }}" alt="{{ $course->name }}" class="w-40 h-36">
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h4 class="text-xl font-semibold text-sky-600 text-center">{{ $course->title }}</h4>
                        <div class="mt-2 text-center">
                            <p class="text-gray-600">Harga: Rp {{ number_format($course->price, 0, ',', '.') }}</p>
                            <p class="text-gray-600">Kuota: {{ $course->quota }} Peserta</p>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('detailkursus-admin', $course->id) }}" class="inline-block w-full bg-sky-400 text-white px-4 py-2 rounded-md hover:bg-sky-500 text-center">
                                Lihat Detail
                            </a>
                        </div>                        
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
