@extends('layouts.dashboard-admin')

@section('content')

<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-3xl font-bold mb-8 border-b-2 border-gray-300 pb-2 uppercase">Detail Kategori</h2>

    <!-- Detail Kategori -->
    <div class="flex mb-4">
        <div class="w-1/3 p-6">
            @if ($category->image_path)
                <img src="{{ asset('storage/' . $category->image_path) }}" alt="{{ $category->name }}" class="rounded-lg w-full h-auto">
            @else
                <div class="bg-gray-200 text-gray-500 flex items-center justify-center rounded-lg w-full h-48">
                    <span>Gambar tidak tersedia</span>
                </div>
            @endif
        </div>
        <div class="ml-4 w-2/3 space-y-4">
            <h2 class="text-2xl font-bold mb-2">{{ $category->name }}</h2>
            <p class="text-gray-700 mb-2">{{ $category->description }}</p>
            <p class="text-gray-600"><strong>Total Kursus :</strong> {{ $category->courses->count() }}</p>
        </div>
    </div>
</div>

<div class="mt-6 bg-white p-6 rounded-lg shadow-md">
    <h3 class="text-xl font-bold mb-6 text-left border-b-2 border-gray-300 pb-2 uppercase">Daftar Kursus</h3>
    <table class="min-w-full border-separate border-spacing-1">
        <thead>
            <tr class="bg-sky-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="border border-gray-300 px-2 py-2 rounded-md">No</th>
                <th class="border border-gray-300 px-4 py-2 rounded-md">Judul</th>
                <th class="border border-gray-300 px-4 py-2 rounded-md">Harga</th>
                <th class="border border-gray-300 px-4 py-2 rounded-md">Aksi</th>
            </tr>
        </thead>
        <!-- Notifikasi -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif
        <tbody class="text-gray-600 text-sm font-light">
            @forelse ($category->courses as $index => $course)
                <tr class="bg-white hover:bg-sky-50">
                    <td class="border border-gray-300 px-2 py-2 rounded-md text-center">{{ $index + 1 }}</td>
                    <td class="border border-gray-300 px-4 py-2 rounded-md">{{ $course->title }}</td>
                    <td class="border border-gray-300 px-4 py-2 rounded-md">Rp {{ number_format($course->price, 0, ',', '.') }}</td>
                    <td class="border border-gray-300 py-4 px-4 rounded-md flex justify-center space-x-6">
                        <!-- Tombol Lihat Detail -->
                        <a href="{{ route('detail-kursus', $course->id) }}" class="text-white bg-gray-500 p-1 rounded-md hover:bg-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </a>
                        <!-- Tombol Edit dengan SVG -->
                        <a href="{{ route('categories.edit', $category->id) }}" class="text-white bg-blue-500 p-1 rounded-md  hover:bg-blue-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                        </a>
                        <!-- Form hapus kategori -->
                        <form id="deleteForm" action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="text-white bg-red-500 p-1 rounded-md  hover:bg-red-800" onclick="openDeleteModal()">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-gray-500 py-4">Belum ada kursus dalam kategori ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
