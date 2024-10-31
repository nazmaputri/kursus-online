@extends('layouts.dashboard-admin')
@section('content')

<div class="container mx-auto px-4">
    <h2 class="text-3xl font-semibold mb-6 pl-1 text-gray-800">Daftar Kursus</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Course Card 1: Bahasa Inggris -->
        <div class="course-card bg-white border border-gray-300 rounded-lg shadow-md overflow-hidden flex-none w-80 flex-shrink-0 flex flex-col transition-transform duration-300 ease-in-out">
            <div class="flex justify-center mt-5">
                <img src="{{ asset('storage/english.png') }}" alt="Kursus Bahasa Inggris" class="w-40 h-36">
            </div>
            <div class="p-4 flex flex-col flex-grow">
                <h4 class="text-xl font-semibold text-sky-400 text-center">Kursus Bahasa Inggris</h4>
                <div class="mt-2 text-center">
                    <p class="text-gray-600">Harga: Rp 200.000</p>
                    <p class="text-gray-600">Kuota: 50 Peserta</p>
                </div>
                <div class="mt-4">
                    <a href="{{ route('detailkursus-admin') }}" class="inline-block w-full bg-sky-400 text-white px-4 py-2 rounded-md hover:bg-sky-500 text-center">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>

        <!-- Course Card 2: HTML -->
        <div class="course-card bg-white border border-gray-300 rounded-lg shadow-md overflow-hidden flex-none w-80 flex-shrink-0 flex flex-col transition-transform duration-300 ease-in-out">
            <div class="flex justify-center mt-5">
                <img src="{{ asset('storage/html.png') }}" alt="Kursus HTML" class="w-40 h-36">
            </div>
            <div class="p-4 flex flex-col flex-grow">
                <h4 class="text-xl font-semibold text-sky-400 text-center">Kursus HTML</h4>
                <div class="mt-2 text-center">
                    <p class="text-gray-600">Harga: Rp 150.000</p>
                    <p class="text-gray-600">Kuota: 30 Peserta</p>
                </div>
                <div class="mt-4">
                    <a href="{{ route('detailkursus-admin') }}" class="inline-block w-full bg-sky-400 text-white px-4 py-2 rounded-md hover:bg-sky-500 text-center">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>

        <!-- Course Card 3: Matematika Dasar -->
        <div class="course-card bg-white border border-gray-300 rounded-lg shadow-md overflow-hidden flex-none w-80 flex-shrink-0 flex flex-col transition-transform duration-300 ease-in-out">
            <div class="flex justify-center mt-5">
                <img src="{{ asset('storage/math.png') }}" alt="Kursus Matematika" class="w-40 h-36">
            </div>
            <div class="p-4 flex flex-col flex-grow">
                <h4 class="text-xl font-semibold text-sky-400 text-center">Kursus Matematika Dasar</h4>
                <div class="mt-2 text-center">
                    <p class="text-gray-600">Harga: Rp 100.000</p>
                    <p class="text-gray-600">Kuota: 40 Peserta</p>
                </div>
                <div class="mt-4">
                    <a href="{{ route('detailkursus-admin') }}" class="inline-block w-full bg-sky-400 text-white px-4 py-2 rounded-md hover:bg-sky-500 text-center">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>

        <!-- Course Card 4: Data Science -->
        <div class="course-card bg-white border border-gray-300 rounded-lg shadow-md overflow-hidden flex-none w-80 flex-shrink-0 flex flex-col transition-transform duration-300 ease-in-out">
            <div class="flex justify-center mt-5">
                <img src="{{ asset('storage/data.png') }}" alt="Kursus Data Science" class="w-40 h-36">
            </div>
            <div class="p-4 flex flex-col flex-grow">
                <h4 class="text-xl font-semibold text-sky-400 text-center">Kursus Data Science</h4>
                <div class="mt-2 text-center">
                    <p class="text-gray-600">Harga: Rp 500.000</p>
                    <p class="text-gray-600">Kuota: 25 Peserta</p>
                </div>
                <div class="mt-4">
                    <a href="{{ route('detailkursus-admin') }}" class="inline-block w-full bg-sky-400 text-white px-4 py-2 rounded-md hover:bg-sky-500 text-center">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>

        <!-- Course Card 5: UI/UX Design -->
        <div class="course-card bg-white border border-gray-300 rounded-lg shadow-md overflow-hidden flex-none w-80 flex-shrink-0 flex flex-col transition-transform duration-300 ease-in-out">
            <div class="flex justify-center mt-5">
                <img src="{{ asset('storage/uiux.png') }}" alt="Kursus UI UX" class="w-40 h-36">
            </div>
            <div class="p-4 flex flex-col flex-grow">
                <h4 class="text-xl font-semibold text-sky-400 text-center">Kursus UI UX</h4>
                <div class="mt-2 text-center">
                    <p class="text-gray-600">Harga: Rp 300.000</p>
                    <p class="text-gray-600">Kuota: 20 Peserta</p>
                </div>
                <div class="mt-4">
                    <a href="{{ route('detailkursus-admin') }}" class="inline-block w-full bg-sky-400 text-white px-4 py-2 rounded-md hover:bg-sky-500 text-center">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>

        <!-- Course Card 6: Masakan Nusantara -->
        <div class="course-card bg-white border border-gray-300 rounded-lg shadow-md overflow-hidden flex-none w-80 flex-shrink-0 flex flex-col transition-transform duration-300 ease-in-out">
            <div class="flex justify-center mt-5">
                <img src="{{ asset('storage/masak.png') }}" alt="Kursus Masakan Nusantara" class="w-40 h-36">
            </div>
            <div class="p-4 flex flex-col flex-grow">
                <h4 class="text-xl font-semibold text-sky-400 text-center">Kursus Masakan Nusantara</h4>
                <div class="mt-2 text-center">
                    <p class="text-gray-600">Harga: Rp 250.000</p>
                    <p class="text-gray-600">Kuota: 15 Peserta</p>
                </div>
                <div class="mt-4">
                    <a href="{{ route('detailkursus-admin') }}" class="inline-block w-full bg-sky-400 text-white px-4 py-2 rounded-md hover:bg-sky-500 text-center">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
