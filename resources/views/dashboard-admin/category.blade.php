@extends('layouts.dashboard-admin')

@section('content')
<div class="container mx-auto bg-white rounded-lg p-5">
    <h2 class="text-2xl font-bold mb-6 text-center border-b-2 border-gray-300 pb-2 uppercase">Daftar Kategori</h2>

    <!-- Tombol Tambah Kategori -->
    <div class="mb-6 p-1 flex justify-between items-center">
        <!-- Tombol untuk menampilkan kursus -->
        <button id="showCoursesButton" class="bg-sky-300 shadow-md shadow-sky-100 hover:shadow-none text-white px-2 py-2 rounded-md font-semibold hover:bg-sky-600 flex items-center space-x-2">
            <!-- Gambar Ikon -->
            <img id="toggleIcon" class="w-6 h-6" style="filter: invert(1);" src="https://img.icons8.com/ios-glyphs/30/fine-print--v1.png" alt="fine-print--v1"/>
            <!-- Teks Tombol -->
            <span id="buttonText">Tampilkan Semua Kursus</span>
        </button>        
        
        <!-- Tambah Kategori -->
        <a href="{{ route('categories.create') }}" class="inline-flex shadow-md shadow-sky-100 hover:shadow-none items-center space-x-2 text-white bg-sky-300 hover:bg-sky-600 font-bold py-2 px-4 rounded-md">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor">
                <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM232 344l0-64-64 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l64 0 0-64c0-13.3 10.7-24 24-24s24 10.7 24 24l0 64 64 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-64 0 0 64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"/>
            </svg>
            <span>Tambah Kategori</span>
        </a>
    </div>
    
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel Kategori -->
    <div id="categoriesTable" class="overflow-hidden overflow-x-auto w-full">
        <table class="min-w-full border-separate border-spacing-1">
            <thead>
                <tr class="bg-sky-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="border border-gray-300 py-2 px-2 rounded-md text-center">No</th>
                    <th class="border border-gray-300 py-2 px-2 rounded-md text-center">Nama Kategori</th>
                    <th class="border border-gray-300 py-2 px-2 rounded-md text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @php
                $startNumber = ($categories->currentPage() - 1) * $categories->perPage() + 1;
            @endphp
                    @foreach($categories as $index => $category)
                        <tr class="bg-white hover:bg-sky-50 user-row">
                            <td class="border border-gray-300 px-2 py-3 rounded-md text-center">{{ $startNumber + $index }}</td>
                            <td class="border border-gray-300  py-3 px-2 rounded-md">{{ $category->name }}</td>
                            <td class="border border-gray-300 py-3 px-2 rounded-md flex justify-center space-x-6">
                                <a href="{{ route('categories.show', $category->name) }}" class="text-white bg-gray-500 p-1 rounded-md hover:bg-gray-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </a>
                                <a href="{{ route('categories.edit', $category->id) }}" class="text-white bg-blue-500 p-1 rounded-md  hover:bg-blue-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>
                                <button type="button" class="text-white bg-red-500 p-1 rounded-md hover:bg-red-800" onclick="openDeleteModal('{{ route('categories.destroy', $category->id) }}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
        <!-- Pagination untuk kursus -->
        <div class="mt-4">
            {{ $categories->links() }} 
        </div>

        @if($categories->isEmpty())
            <div class="mt-4 text-gray-400 text-center">Belum ada kategori yang ditambahkan.</div>
        @endif
    </div>

   <!-- Daftar Kursus (Awalnya disembunyikan) -->
    <div id="coursesList" class="hidden mt-6">
        <table class="min-w-full border-separate border-spacing-1">
            <thead>
                <tr class="bg-sky-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="border border-gray-300 px-2 py-2 rounded-md">No</th>
                    <th class="border border-gray-300 px-4 py-2 rounded-md">Kursus</th>
                    <th class="border border-gray-300 px-4 py-2 rounded-md">Kategori</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $index => $course)
                <tr>
                    <td class="border border-gray-300 py-4 px-4 text-center rounded-md">{{ $index + 1 }}</td>
                    <td class="border border-gray-300 px-4 py-2 rounded-md">{{ $course->title }}</td>
                    <td class="border border-gray-300 px-4 py-2 rounded-md">{{ $course->category }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination untuk kursus -->
        <div class="mt-4">
            {{ $courses->links() }} 
        </div>
    </div>

</div>

<!-- JavaScript -->
<script>
    const showCoursesButton = document.getElementById('showCoursesButton');
const coursesList = document.getElementById('coursesList');
const categoriesTable = document.getElementById('categoriesTable');
const buttonText = document.getElementById('buttonText');
const toggleIcon = document.getElementById('toggleIcon');

// Menyembunyikan elemen yang tidak perlu setiap kali halaman berpindah
function handlePagination() {
    if (coursesList.classList.contains('hidden')) {
        // Tampilkan kategori, sembunyikan kursus
        coursesList.classList.add('hidden');
        categoriesTable.classList.remove('hidden');
    } else {
        // Tampilkan kursus, sembunyikan kategori
        coursesList.classList.remove('hidden');
        categoriesTable.classList.add('hidden');
    }
}

// Menangani perubahan tampilan saat tombol diklik
showCoursesButton.addEventListener('click', function() {
    if (coursesList.classList.contains('hidden')) {
        coursesList.classList.remove('hidden');
        categoriesTable.classList.add('hidden');
        buttonText.innerText = 'Tampilkan Semua Kategori';
        toggleIcon.src = 'https://img.icons8.com/ios-glyphs/30/fine-print--v1.png';  // Ikon untuk kursus
    } else {
        coursesList.classList.add('hidden');
        categoriesTable.classList.remove('hidden');
        buttonText.innerText = 'Tampilkan Semua Kursus';
        toggleIcon.src = 'https://img.icons8.com/ios-glyphs/30/fine-print--v1.png';  // Ikon untuk kategori
    }
});

// Menambahkan event listener untuk menangani perubahan halaman setelah klik pagination
document.querySelectorAll('.pagination a').forEach(function(link) {
    link.addEventListener('click', function(event) {
        event.preventDefault();
        // Dapatkan link pagination yang diklik
        const url = this.href;

        // Panggil AJAX atau reload konten untuk memuat ulang tabel sesuai dengan halaman yang dipilih
        fetch(url)
            .then(response => response.text())
            .then(data => {
                // Ganti konten tabel kursus dan kategori berdasarkan data baru
                document.getElementById('categoriesTable').innerHTML = data.match(/<table[^>]*>([\s\S]*)<\/table>/)[0];
                document.getElementById('coursesList').innerHTML = data.match(/<table[^>]*>([\s\S]*)<\/table>/)[1];

                // Menangani visibilitas setelah memuat konten baru
                handlePagination();
            })
            .catch(error => console.error('Error:', error));
    });
});

</script>
@endsection
