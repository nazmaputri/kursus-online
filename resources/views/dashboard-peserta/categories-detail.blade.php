@extends('layouts.dashboard-peserta')

@section('content')

<div class="container mx-auto">
    <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6 mb-6">
        <!-- Detail Kategori -->
        <h2 class="text-2xl uppercase font-bold mb-6 text-center border-b-2 border-gray-300 pb-2">Daftar Kursus : {{ $category->name }}</h2>
        
        @if($courses->isEmpty())
            <!-- Pesan jika tidak ada kursus -->
            <div class="text-center text-gray-600">
                <p class="text-md">Kategori ini belum memiliki kursus.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
                @foreach($courses as $course)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">
                        <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $course->image_path) }}" alt="{{ $course->title }}">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $course->title }}</h3>
                            <p class="text-sm mt-2 text-gray-600 mb-2">Mentor : {{ $course->mentor->name }}</p>
                            <p class="text-xl font-bold text-green-800 bg-green-300 rounded-md inline-block p-2" id="course-price-{{ $course->id }}">Rp. {{ number_format($course->price, 0, ',', '.') }}</p>
                            <div class="flex justify-between items-center mt-4">
                                <div class="flex">
                                    @for ($i = 0; $i < 5; $i++)
                                        @if ($i < floor($course->average_rating)) <!-- Rating Penuh -->
                                            <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927a1 1 0 011.902 0l1.715 4.993 5.274.406a1 1 0 01.593 1.75l-3.898 3.205 1.473 4.74a1 1 0 01-1.516 1.11L10 15.347l-4.692 3.783a1 1 0 01-1.516-1.11l1.473-4.74-3.898-3.205a1 1 0 01.593-1.75l5.274-.406L9.049 2.927z"></path>
                                            </svg>
                                        @elseif ($i < ceil($course->average_rating)) <!-- Rating Setengah -->
                                            <svg class="w-4 h-4" viewBox="0 0 20 20">
                                                <defs>
                                                    <linearGradient id="half-star-{{ $i }}">
                                                        <stop offset="50%" stop-color="rgb(234,179,8)" /> <!-- Kuning -->
                                                        <stop offset="50%" stop-color="rgb(209,213,219)" /> <!-- Abu-abu -->
                                                    </linearGradient>
                                                </defs>
                                                <path fill="url(#half-star-{{ $i }})" d="M9.049 2.927a1 1 0 011.902 0l1.715 4.993 5.274.406a1 1 0 01.593 1.75l-3.898 3.205 1.473 4.74a1 1 0 01-1.516 1.11L10 15.347l-4.692 3.783a1 1 0 01-1.516-1.11l1.473-4.74-3.898-3.205a1 1 0 01.593-1.75l5.274-.406L9.049 2.927z"></path>
                                            </svg>
                                        @else <!-- Rating Kosong -->
                                            <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927a1 1 0 011.902 0l1.715 4.993 5.274.406a1 1 0 01.593 1.75l-3.898 3.205 1.473 4.74a1 1 0 01-1.516 1.11L10 15.347l-4.692 3.783a1 1 0 01-1.516-1.11l1.473-4.74-3.898-3.205a1 1 0 01.593-1.75l5.274-.406L9.049 2.927z"></path>
                                            </svg>
                                        @endif
                                    @endfor
                                      <!-- Jumlah Rating -->
                                      <span class="ml-2 text-gray-600 text-sm">({{ number_format($course->average_rating, 1) }} / 5)</span>
                                </div>
                                <!-- Tombol Lihat Detail -->
                                <a href="{{ route('kursus-peserta', $course->id) }}" class="bg-sky-300 text-white px-4 py-2 rounded-lg hover:bg-sky-600">
                                    Lihat Detail
                                </a>
                            </div> 
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        <div class="mt-6 flex justify-end">
            <a href="{{ route('kategori-peserta') }}" class="bg-sky-300 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded">
                Kembali
            </a>
        </div>
    </div>
</div>

@endsection
