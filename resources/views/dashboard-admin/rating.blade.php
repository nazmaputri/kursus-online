@extends('layouts.dashboard-admin')  

@section('content')
    <div class="container mx-auto">
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h1 class="text-3xl font-bold mb-8 inline-block border-b-2 border-gray-300 pb-2 uppercase">Daftar Penilaian</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($ratings as $rating)
                    <div class="bg-white p-5 rounded-lg shadow-lg border">
                        <h2 class="text-xl font-semibold">{{ $rating->nama }}</h2>
                        <p class="text-md">{{ $rating->email }}</p>
                        <div class="flex items-center space-x-2 mt-2">
                            @for ($i = 0; $i < 5; $i++)
                                <span class="{{ $i < $rating->rating ? 'text-yellow-500' : 'text-gray-300' }}">&starf;</span>
                            @endfor
                        </div>
                        <p class="text-sm mt-2">"{{ $rating->comment }}"</p>
                        <div class="mt-4">
                            <p class="text-sm">
                                <strong>Status :</strong> 
                                <span class="{{ $rating->display ? 'text-green-500' : 'text-red-500' }}">
                                    {{ $rating->display ? 'Tampil' : 'Tidak Tampil' }}
                                </span>
                            </p>
                            <div class="mt-6">
                                <!-- Tombol untuk menampilkan atau menyembunyikan rating di landing page -->
                                <a href="{{ route('toggle.display', $rating->id) }}" 
                                   class="text-white bg-sky-300 font-bold hover:bg-sky-600 rounded-md p-2">
                                    {{ $rating->display ? 'Sembunyikan' : 'Tampilkan' }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Links -->
            <div class="mt-6">
                {{ $ratings->links() }}
            </div>
        </div>
    </div>
@endsection
