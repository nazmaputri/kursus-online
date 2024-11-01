@extends('layouts.dashboard-mentor') 

@section('content')
<div class="container mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-6">Tambah Materi Baru</h2>

    <!-- Form Tambah Materi -->
    <form action="#" method="POST" enctype="multipart/form-data">
        <!-- Input untuk Judul Materi -->
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-bold mb-2">Judul Materi</label>
            <input type="text" name="title" id="title" class="w-full p-2 border rounded" placeholder="Masukkan judul materi">
        </div>

        <!-- Input untuk Deskripsi Materi -->
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-bold mb-2">Deskripsi</label>
            <textarea name="description" id="description" rows="5" class="w-full p-2 border rounded" placeholder="Masukkan deskripsi materi"></textarea>
        </div>

        <!-- Pilihan Kursus (Data Dummy) -->
        <div class="mb-4">
            <label for="course_id" class="block text-gray-700 font-bold mb-2">Kursus Terkait</label>
            <select name="course_id" id="course_id" class="w-full p-2 border rounded">
                <option value="">Pilih Kursus</option>
                <option value="1">Kursus Programming</option>
                <option value="2">Kursus Desain</option>
                <option value="3">Kursus Marketing</option>
            </select>
        </div>

        <!-- Pilihan Kategori Materi (Data Dummy) -->
        <div class="mb-4">
            <label for="category_id" class="block text-gray-700 font-bold mb-2">Kategori Materi</label>
            <select name="category_id" id="category_id" class="w-full p-2 border rounded">
                <option value="">Pilih Kategori Materi</option>
                <option value="1">Teori</option>
                <option value="2">Praktik</option>
                <option value="3">Latihan</option>
            </select>
        </div>

        <!-- Pilihan Instruktur (Data Dummy) -->
        <div class="mb-4">
            <label for="instructor_id" class="block text-gray-700 font-bold mb-2">Instruktur</label>
            <select name="instructor_id" id="instructor_id" class="w-full p-2 border rounded">
                <option value="">Pilih Instruktur</option>
                <option value="1">John Doe</option>
                <option value="2">Jane Smith</option>
            </select>
        </div>

        <!-- Input untuk File Materi -->
        <div class="mb-4">
            <label for="material_file" class="block text-gray-700 font-bold mb-2">Unggah File Materi</label>
            <input type="file" name="material_file" id="material_file" class="w-full p-2 border rounded">
            <small class="text-gray-600">Format file yang diperbolehkan: PDF, DOC, PPT</small>
        </div>

        <!-- Tombol Submit -->
        <div class="mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Tambah Materi
            </button>
        </div>
    </form>
</div>
@endsection
