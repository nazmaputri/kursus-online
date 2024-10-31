<!-- resources/views/course-detail.blade.php -->
@extends('layouts.dashboard-admin')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <!-- Card Informasi Kursus -->
    <div class="flex mb-4">
        <div class="w-1/3">
            <img src="https://via.placeholder.com/300x200" alt="Gambar Kursus" class="rounded-lg w-full h-auto">
        </div>
        <div class="ml-4 w-2/3">
            <h2 class="text-3xl font-bold mb-2">Kursus Pemrograman Web</h2>
            <p class="text-gray-700 mb-2">Pelajari cara membuat aplikasi web dengan Laravel dan Tailwind CSS.</p>
            <p class="text-gray-600"><strong>Mentor:</strong> John Doe</p>
            <p class="text-gray-600"><strong>Tanggal Mulai:</strong> 2025-01-01</p>
            <p class="text-gray-600"><strong>Durasi:</strong> 4 minggu</p>
            <p class="text-gray-600"><strong>Biaya:</strong> Rp 1.000.000</p>
        </div>
    </div>

    <div class="mt-6">
        <h3 class="text-xl font-semibold">Informasi Kursus</h3>
        <ul class="list-disc list-inside">
            <li><strong>Silabus Kursus:</strong></li>
            <li>Pengenalan Kursus</li>
            <li>Materi Dasar</li>
            <li>Praktik dan Studi Kasus</li>
            <li>Penyelesaian dan Evaluasi</li>
        </ul>
    </div>
</div>

<!-- Tabel Peserta Terdaftar -->
<div class="mt-6 bg-white p-6 rounded-lg shadow-md">
    <h3 class="text-xl font-semibold">Peserta Terdaftar</h3>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 border-b">Nama Peserta</th>
                    <th class="py-2 px-4 border-b">Email</th>
                    <th class="py-2 px-4 border-b">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr class="hover:bg-gray-50">
                    <td class="py-2 px-4 border-b">Alice</td>
                    <td class="py-2 px-4 border-b">alice@example.com</td>
                    <td class="py-2 px-4 border-b">Aktif</td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <td class="py-2 px-4 border-b">Bob</td>
                    <td class="py-2 px-4 border-b">bob@example.com</td>
                    <td class="py-2 px-4 border-b">Aktif</td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <td class="py-2 px-4 border-b">Charlie</td>
                    <td class="py-2 px-4 border-b">charlie@example.com</td>
                    <td class="py-2 px-4 border-b">Selesai</td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <td class="py-2 px-4 border-b">Diana</td>
                    <td class="py-2 px-4 border-b">diana@example.com</td>
                    <td class="py-2 px-4 border-b">Aktif</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection

