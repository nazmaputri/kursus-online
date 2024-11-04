@extends('layouts.dashboard-admin')

@section('content')
    <div class="bg-white border border-gray-300 rounded-lg shadow-md p-3 mb-4">
        <h2 class="text-3xl font-bold text-gray-800 text-center">Detail Kursus</h2>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md">
            <!-- Card Informasi Kursus -->
            <div class="flex mb-4">
                <div class="w-1/3">
                    <img src="{{ asset('storage/' . $course->image_path) }}" alt="{{ $course->title }}" class="rounded-lg w-full h-auto">
                </div>
                <div class="ml-4 w-2/3">
                    <h2 class="text-3xl font-bold mb-2">{{ $course->title }}</h2>
                    <p class="text-gray-700 mb-2">{{ $course->description }}</p>
                    <p class="text-gray-600"><strong>Mentor:</strong> {{ $course->mentor->name }}</p>
                    <p class="text-gray-600"><strong>Tanggal Mulai:</strong> {{ $course->start_date }}</p>
                    <p class="text-gray-600"><strong>Durasi:</strong> {{ $course->duration }}</p>
                    <p class="text-gray-600"><strong>Biaya:</strong> Rp {{ number_format($course->price, 0, ',', '.') }}</p>
                </div>
            </div>    
    </div>

    <!-- Tabel Peserta Terdaftar -->
    <div class="mt-6 bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-bold mb-6 text-left border-b-2 border-gray-300 pb-2">Peserta Terdaftar</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full border-separate border-spacing-1" id="courseTable">
                <thead>
                    <tr class="bg-sky-100">
                        <th class="border border-gray-300 py-2 px-4 rounded-md">Nama Peserta</th>
                        <th class="border border-gray-300 py-2 px-4 rounded-md">Email</th>
                        <th class="border border-gray-300 py-2 px-4 rounded-md">Status</th>
                    </tr>
                </thead>
                {{-- <tbody>
                    @foreach($participants as $participant)
                    <tr class="hover:bg-gray-50">
                        <td class="py-2 px-4 border-b">{{ $participant->user->name }}</td> <!-- Nama peserta -->
                        <td class="py-2 px-4 border-b">{{ $participant->user->email }}</td> <!-- Email peserta -->
                        <td class="py-2 px-4 border-b">{{ $participant->status }}</td> <!-- Status peserta -->
                    </tr>
                    @endforeach
                </tbody> --}}
            </table>
        </div>
    </div>

@endsection
