@extends('layouts.dashboard-peserta')

@section('title', 'Kursus Terdaftar')

@section('content')
<div class="container mx-auto ">
  <div class="bg-white border border-gray-300 rounded-lg shadow-sm p-4 mb-4">
      <h2 class="text-3xl font-bold text-gray-800 text-center">Kursus yang terdaftar</h2>
  </div>

  <!-- Tabel Kursus -->
  <div class="overflow-x-auto hide-scrollbar"> 
    <table class="min-w-full border-separate border-spacing-1" id="courseTable">
      <thead>
        <tr class="bg-sky-300 text-white">
          <th class="border border-gray-300 px-4 py-2 rounded-md">No</th>
          <th class="border border-gray-300 px-4 py-2 rounded-md">Judul Kursus</th>
          <th class="border border-gray-300 px-4 py-2 rounded-md">Mentor</th> 
          <th class="border border-gray-300 px-4 py-2 rounded-md">Aksi</th>
        </tr>
      </thead>
      <tbody class="text-gray-700">
        <!-- Data Dummy Kursus 1 -->
        <tr class="bg-white hover:bg-sky-50">
          <td class="border border-gray-300 px-4 py-2 rounded-md text-center">1</td>
          <td class="border border-gray-300 px-4 py-2 rounded-md">Kursus Memasak Dasar</td>
          <td class="border border-gray-300 px-4 py-2 rounded-md truncate max-w-xs">Wulan</td>
          <td class="border border-gray-300 px-4 py-2 rounded-md text-center">
            <a href="{{ route('detail-peserta') }}" 
               class="bg-sky-300 text-white py-2 px-4 rounded-full hover:bg-sky-600 transition duration-150 inline-block">
              Lihat Detail
            </a>
          </td>
        </tr>
      </tbody>
    </table>
    
  </div>
</div>
@endsection
