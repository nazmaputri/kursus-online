@extends('layouts.dashboard-peserta')

@section('title', 'Kursus Terdaftar')

@section('content')
  <h2 class="text-3xl font-semibold mb-6 text-center text-blue-600">Kursus yang Terdaftar</h2>
  
  <div class="overflow-x-auto">
    <table class="min-w-full bg-white shadow-md rounded-lg">
      <thead>
        <tr class="bg-blue-500 text-white text-left">
          <th class="px-6 py-4 font-semibold">No</th>
          <th class="px-6 py-4 font-semibold">Judul Kursus</th>
          <th class="px-6 py-4 font-semibold">Deskripsi</th>
          <th class="px-6 py-4 font-semibold">Aksi</th>
        </tr>
      </thead>
      <tbody class="text-gray-700">
        <!-- Data Dummy Kursus 1 -->
        <tr class="border-b hover:bg-blue-100 transition duration-150">
          <td class="px-6 py-4">1</td>
          <td class="px-6 py-4 font-medium">Kursus Memasak Dasar</td>
          <td class="px-6 py-4">Pelajari dasar-dasar memasak dari pemilihan bahan hingga teknik memasak sederhana.</td>
          <td class="px-6 py-4">
            <a href="{{ route('detail-peserta') }}" 
               class="bg-blue-600 text-white py-2 rounded-full hover:bg-blue-700 transition duration-150">
              Lihat Detail
            </a>
          </td>
        </tr>
        
        <!-- Data Dummy Kursus 2 -->
        <tr class="border-b hover:bg-blue-100 transition duration-150">
          <td class="px-6 py-4">2</td>
          <td class="px-6 py-4 font-medium">Kursus Masakan Italia</td>
          <td class="px-6 py-4">Belajar memasak hidangan khas Italia seperti pasta dan pizza.</td>
          <td class="px-6 py-4">
            <a href="{{ route('detail-peserta') }}" 
               class="bg-blue-600 text-white  px-1 rounded-full hover:bg-blue-700 transition duration-150">
              Lihat Detail
            </a>
          </td>
        </tr>
        
        <!-- Data Dummy Kursus 3 -->
        <tr class="hover:bg-blue-100 transition duration-150">
          <td class="px-6 py-4">3</td>
          <td class="px-6 py-4 font-medium">Kursus Masakan Jepang</td>
          <td class="px-6 py-4">Pelajari cara membuat sushi, ramen, dan masakan khas Jepang lainnya.</td>
          <td class="px-6 py-4">
            <a href="{{ route('detail-peserta') }}" 
               class="bg-blue-600 text-white py-1 px-1 rounded-full hover:bg-blue-700 transition duration-150">
              Lihat Detail
            </a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
@endsection
