@extends('layouts.dashboard-mentor')

@section('content')
<div class="container mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-6">Daftar Kursus</h2>

    <!-- Tombol Tambah Kursus -->
    <div class="mb-4">
        <a href="{{ route('tambahkursus-mentor') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Tambah Kursus
        </a>
    </div>

    <!-- Tabel Kursus -->
    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Judul</th>
                <th class="py-3 px-6 text-left">Deskripsi</th>
                <th class="py-3 px-6 text-left">Kategori</th>
                <th class="py-3 px-6 text-left">Harga</th>
                <th class="py-3 px-6 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @foreach ($courses as $course)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6">{{ $course->title }}</td>
                    <td class="py-3 px-6">{{ Str::limit($course->description, 50) }}</td>
                    <td class="py-3 px-6">{{ $course->category }}</td>
                    <td class="py-3 px-6">{{ $course->price ? 'Rp. ' . number_format($course->price, 0, ',', '.') : 'Gratis' }}</td>
                    <td class="py-3 px-6">
                        <a href="{{ route('courses.edit', $course->id) }}" class="text-blue-500 hover:underline">Edit</a>
                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($courses->isEmpty())
        <div class="mt-4 text-center">Belum ada kursus yang ditambahkan.</div>
    @endif
</div>
@endsection
