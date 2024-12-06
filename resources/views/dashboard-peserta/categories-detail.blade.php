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
                            <p class="text-xl font-bold text-gray-800" id="course-price-{{ $course->id }}">Rp. {{ number_format($course->price, 0, ',', '.') }}</p>
                            <div class="flex justify-between items-center mt-4">
                                <div class="flex items-center mt-4">
                                    @for ($i = 0; $i < 5; $i++)
                                        @if ($i < floor($course->rating))
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10 15l-5.45 3.18 1.04-6.06L.45 7.64l6.09-.88L10 1l2.46 5.72 6.09.88-4.64 4.48 1.04 6.06L10 15z" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10 15l-5.45 3.18 1.04-6.06L.45 7.64l6.09-.88L10 1l2.46 5.72 6.09.88-4.64 4.48 1.04 6.06L10 15z" />
                                            </svg>
                                        @endif
                                    @endfor
                                    <span class="ml-2 text-gray-600">({{ $course->rating }} / 5)</span>
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
