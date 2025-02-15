@extends('layouts.dashboard-peserta')

@section('content')

<div class="container mx-auto">
    <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6 mb-6">
        <!-- Detail Kategori -->
        <h2 class="text-2xl uppercase font-bold mb-6 text-center border-b-2 border-gray-300 pb-2">
            Daftar Kursus : {{ $category->name }}
        </h2>
        
        @if($courses->isEmpty())
            <!-- Pesan jika tidak ada kursus -->
            <div class="text-center text-gray-600">
                <p class="text-md">Kategori ini belum memiliki kursus.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
                @foreach($courses as $course)
                    @php
                        // Cek apakah user sudah membeli kursus ini
                        $isPurchased = $course->payments()
                            ->where('user_id', auth()->id())
                            ->where('transaction_status', 'success') // Atau 'success' sesuai dengan Midtrans
                            ->exists();
                    @endphp

                    <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">
                        <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $course->image_path) }}" alt="{{ $course->title }}">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $course->title }}</h3>
                            <p class="text-sm mt-2 text-gray-600 mb-2">Mentor : {{ $course->mentor->name }}</p>
                            <p class="text-xl font-bold text-green-800 bg-green-300 rounded-md inline-block p-2" id="course-price-{{ $course->id }}">
                                Rp. {{ number_format($course->price, 0, ',', '.') }}
                            </p>
                            
                            <div class="flex justify-between items-center mt-4">
                                <div class="flex">
                                    @for ($i = 0; $i < 5; $i++)
                                        @if ($i < floor($course->average_rating)) 
                                            <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927a1 1 0 011.902 0l1.715 4.993 5.274.406a1 1 0 01.593 1.75l-3.898 3.205 1.473 4.74a1 1 0 01-1.516 1.11L10 15.347l-4.692 3.783a1 1 0 01-1.516-1.11l1.473-4.74-3.898-3.205a1 1 0 01.593-1.75l5.274-.406L9.049 2.927z"></path>
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927a1 1 0 011.902 0l1.715 4.993 5.274.406a1 1 0 01.593 1.75l-3.898 3.205 1.473 4.74a1 1 0 01-1.516 1.11L10 15.347l-4.692 3.783a1 1 0 01-1.516-1.11l1.473-4.74-3.898-3.205a1 1 0 01.593-1.75l5.274-.406L9.049 2.927z"></path>
                                            </svg>
                                        @endif
                                    @endfor
                                    <span class="ml-2 text-gray-600 text-sm">({{ number_format($course->average_rating, 1) }} / 5)</span>
                                </div>
                                
                                <div class="flex items-center">
                                    @if (!$isPurchased)
                                        <!-- Tombol Keranjang -->
                                        <form action="{{ route('cart.add', ['id' => $course->id]) }}" method="POST" class="mr-5">
                                            @csrf
                                            <button type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-6 h-6">
                                                    <path d="M0 24C0 10.7 10.7 0 24 0L69.5 0c22 0 41.5 12.8 50.6 32l411 0c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3l-288.5 0 5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5L488 336c13.3 0 24 10.7 24 24s-10.7 24-24 24l-288.3 0c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5L24 48C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    @else
                                        <!-- Label Kursus Sudah Dibeli -->
                                        <span class="text-sm mr-3 font-bold text-red-700 bg-red-200 px-3 py-1 rounded">
                                            Sudah dibeli
                                        </span>
                                    @endif
                                    
                                    <!-- Tombol Lihat Detail -->
                                    <a href="{{ route('kursus-peserta', ['id' => $course->id, 'categoryId' => $category->id]) }}" class="bg-sky-300 text-white px-4 py-2 rounded-lg hover:bg-sky-600">
                                        Lihat Detail
                                    </a>
                                </div>
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
