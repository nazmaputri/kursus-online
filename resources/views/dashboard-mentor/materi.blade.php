@extends('layouts.dashboard-mentor')

@section('content')
<div class="container mx-auto">
    <!-- Card Wrapper -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <!-- Judul dan Tombol Tambah Kursus -->
        <h2 class="text-2xl font-bold mb-6 text-center border-b-2 border-gray-300 pb-2 uppercase">Tabel Materi Kursus</h2>

        <div class="mb-4 text-right p-1">
            <a href="{{ route('materi.create') }}" class="bg-sky-300 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded">
                Tambah Materi
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success text-green-400">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabel Kursus -->
        <table class="min-w-full border-separate border-spacing-1">
            <thead>
                <tr class="bg-sky-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="border border-gray-300 px-4 py-2 rounded-md">No</th>
                    <th class="border border-gray-300 px-4 py-2 rounded-md">Judul</th>
                    <th class="border border-gray-300 px-4 py-2 rounded-md">Kursus</th>
                    <th class="border border-gray-300 px-4 py-2 rounded-md">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach ($materi as $index => $materiItem) 
                <tr class="bg-white hover:bg-sky-50 user-row">
                    <td class="border border-gray-300 px-4 py-2 rounded-md text-center">{{ $index + 1 }}</td> <!-- Menampilkan nomor urut -->
                    <td class="border border-gray-300 px-4 py-2 rounded-md">{{ $materiItem->judul }}</td>
                    <td class="border border-gray-300 px-4 py-2 rounded-md">
                        @if($materiItem->course)
                            {{ $materiItem->course->title }}  
                        @else
                            <span class="text-gray-500">Kursus tidak ditemukan</span>
                        @endif
                    </td>
                    <!-- Kolom Tombol Aksi -->
                    <td class="py-2 px-4 text-center border border-gray-300 rounded-md">
                        <div class="flex items-center justify-center space-x-6">
                            <!-- Tombol Lihat Detail -->
                            <a href="{{ route('materi.show', $materiItem->id) }}" class="text-white bg-gray-500 p-1 rounded-md hover:bg-gray-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </a>
                            <!-- Tombol Edit -->
                            <a href="{{ route('materi.edit', $materiItem->id) }}" class="text-white bg-blue-500 p-1 rounded-md hover:bg-blue-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </a>
                            <!-- Form hapus kategori -->
                            <form id="deleteForm" action="{{ route('materi.destroy', $materiItem->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-white bg-red-500 p-1 rounded-md hover:bg-red-800" onclick="return confirm('Apakah Anda yakin ingin menghapus materi ini?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- @if($materi->isEmpty())
            <div class="mt-4 text-center">Belum ada materi yang ditambahkan.</div>
        @endif --}}
    </div>
</div>
@endsection
