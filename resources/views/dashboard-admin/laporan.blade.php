@extends('layouts.dashboard-admin')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4 text-gray-800">Laporan Eduflix</h1>
    
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-700">Daftar Pengguna</h2>
        <table class="min-w-full border-separate border-spacing-1">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2 rounded-tl-sm">ID</th>
                    <th class="border border-gray-300 px-4 py-2">Nama</th>
                    <th class="border border-gray-300 px-4 py-2">Email</th>
                    <th class="border border-gray-300 px-4 py-2 rounded-tr-sm">Tanggal Bergabung</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="bg-white hover:bg-gray-50">
                        <td class="border border-gray-300 px-4 py-2 rounded-sm">{{ $user->id }}</td>
                        <td class="border border-gray-300 px-4 py-2 rounded-sm">{{ $user->name }}</td>
                        <td class="border border-gray-300 px-4 py-2 rounded-sm">{{ $user->email }}</td>
                        <td class="border border-gray-300 px-4 py-2 rounded-sm">{{ $user->created_at->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-700">Daftar Kursus</h2>
        <table class="min-w-full border-separate border-spacing-1">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2 rounded-tl-sm">ID</th>
                    <th class="border border-gray-300 px-4 py-2">Judul Kursus</th>
                    <th class="border border-gray-300 px-4 py-2">Pengajar</th>
                    <th class="border border-gray-300 px-4 py-2 rounded-tr-sm">Tanggal Mulai</th>
                </tr>
            </thead>
            {{-- <tbody>
                @foreach ($courses as $course)
                    <tr class="bg-white hover:bg-gray-50">
                        <td class="border border-gray-300 px-4 py-2 rounded-sm">{{ $course->id }}</td>
                        <td class="border border-gray-300 px-4 py-2 rounded-sm">{{ $course->judul_kursus }}</td>
                        <td class="border border-gray-300 px-4 py-2 rounded-sm">{{ $course->pengajar }}</td>
                        <td class="border border-gray-300 px-4 py-2 rounded-sm">{{ $course->tanggal_mulai->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
            </tbody> --}}
        </table>
    </div>
</div>
@endsection
