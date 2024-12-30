@extends('layouts.dashboard-mentor')

@section('content')
<div class="container mx-auto">
    <!-- Card Wrapper -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <!-- Judul dan Tombol Tambah Kursus -->
        <h2 class="text-2xl font-bold mb-10 text-center border-b-2 border-gray-300 pb-2 uppercase">Daftar Kursus</h2>

        <!-- Search Bar -->
        <form action="{{ route('courses.index') }}" method="GET" class="max-w-sm mx-auto">
            <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Cari</label>
            <div class="relative flex items-center">
                <!-- Input Search -->
                <input type="search" name="search" id="search" 
                    class="block w-full pl-4 pr-14 py-3 text-sm text-gray-900 border-2 border-sky-300 rounded-full bg-gray-50 focus:ring-blue-400 focus:border-blue-500" 
                    placeholder="Cari Kursus" value="{{ request('search') }}" />
                <!-- Button Search -->
                <button type="submit" 
                    class="absolute right-2.5 bottom-2 bg-sky-300 text-white hover:bg-sky-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-full text-sm px-4 py-2 flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </button>
            </div>
        </form>

        <div class="text-right p-1 md:text-right md:p-1 mt-4 md:mt-0 flex justify-center md:justify-end">
            <a href="{{ route('courses.create') }}" 
               class="inline-flex shadow-md shadow-sky-100 hover:shadow-none items-center space-x-2 text-white bg-sky-300 hover:bg-sky-600 font-bold py-2 px-4 rounded-md">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor">
                    <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM232 344l0-64-64 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l64 0 0-64c0-13.3 10.7-24 24-24s24 10.7 24 24l0 64 64 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-64 0 0 64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"/>
                </svg>
                <span>Tambah Kursus</span>
            </a>
        </div>        

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabel Kursus -->
        <div class="overflow-hidden overflow-x-auto w-full">
            <table class="min-w-full border-separate border-spacing-1 mt-4">
                <thead>
                    <tr class="bg-sky-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="border border-gray-300 px-4 py-2 rounded-md">No</th>
                        <th class="border border-gray-300 px-4 py-2 rounded-md">Judul</th>
                        <th class="border border-gray-300 px-4 py-2 rounded-md">Harga</th>
                        <th class="border border-gray-300 px-4 py-2 rounded-md">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($courses as $index => $course)
                    <tr class="bg-white hover:bg-sky-50 user-row">
                        <!-- Kolom No -->
                        <td class="border border-gray-300 px-4 py-2 rounded-md text-center">{{ $index + 1 + ($courses->currentPage() - 1) * $courses->perPage() }}</td>
                        <td class="border border-gray-300 px-4 py-2 rounded-md">{{ $course->title }}</td>
                        <td class="border border-gray-300 px-4 py-2 rounded-md">{{ $course->price ? 'Rp. ' . number_format($course->price, 0, ',', '.') : 'Gratis' }}</td>
                        <td class="py-2 px-4 text-center border border-gray-300 rounded-md">
                            <div class="flex items-center justify-center space-x-6">
                                <!-- Tombol Chat -->
                                <a href="{{ $course->chat ? route('chat.mentor', ['courseId' => $course->id]) : '#' }}" class="text-white bg-blue-500 p-1 rounded-md hover:bg-blue-800 {{ !$course->chat ? 'cursor-not-allowed opacity-50' : '' }}" id="chatButton" {{ !$course->chat ? 'disabled' : '' }} title="{{ !$course->chat ? 'Fitur Chat Tidak Aktif' : 'Fitur Chat Aktif' }}">
                                     <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" fill="currentColor" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                         <path d="M88.2 309.1c9.8-18.3 6.8-40.8-7.5-55.8C59.4 230.9 48 204 48 176c0-63.5 63.8-128 160-128s160 64.5 160 128s-63.8 128-160 128c-13.1 0-25.8-1.3-37.8-3.6c-10.4-2-21.2-.6-30.7 4.2c-4.1 2.1-8.3 4.1-12.6 6c-16 7.2-32.9 13.5-49.9 18c2.8-4.6 5.4-9.1 7.9-13.6c1.1-1.9 2.2-3.9 3.2-5.9zM208 352c114.9 0 208-78.8 208-176S322.9 0 208 0S0 78.8 0 176c0 41.8 17.2 80.1 45.9 110.3c-.9 1.7-1.9 3.5-2.8 5.1c-10.3 18.4-22.3 36.5-36.6 52.1c-6.6 7-8.3 17.2-4.6 25.9C5.8 378.3 14.4 384 24 384c43 0 86.5-13.3 122.7-29.7c4.8-2.2 9.6-4.5 14.2-6.8c15.1 3 30.9 4.5 47.1 4.5zM432 480c16.2 0 31.9-1.6 47.1-4.5c4.6 2.3 9.4 4.6 14.2 6.8C529.5 498.7 573 512 616 512c9.6 0 18.2-5.7 22-14.5c3.8-8.8 2-19-4.6-25.9c-14.2-15.6-26.2-33.7-36.6-52.1c-.9-1.7-1.9-3.4-2.8-5.1C622.8 384.1 640 345.8 640 304c0-94.4-87.9-171.5-198.2-175.8c4.1 15.2 6.2 31.2 6.2 47.8l0 .6c87.2 6.7 144 67.5 144 127.4c0 28-11.4 54.9-32.7 77.2c-14.3 15-17.3 37.6-7.5 55.8c1.1 2 2.2 4 3.2 5.9c2.5 4.5 5.2 9 7.9 13.6c-17-4.5-33.9-10.7-49.9-18c-4.3-1.9-8.5-3.9-12.6-6c-9.5-4.8-20.3-6.2-30.7-4.2c-12.1 2.4-24.8 3.6-37.8 3.6c-61.7 0-110-26.5-136.8-62.3c-16 5.4-32.8 9.4-50 11.8C279 439.8 350 480 432 480z"/>
                                     </svg>
                                </a>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const chatButton = document.getElementById('chatButton');

                                        if (chatButton && chatButton.disabled) {
                                            chatButton.addEventListener('click', function(event) {
                                                event.preventDefault(); // Mencegah aksi klik
                                            });
                                        }
                                    });
                                 </script>
                                <!-- Tombol Lihat Detail -->
                                <a href="{{ route('courses.show', $course->id) }}" class="text-white bg-gray-500 p-1 rounded-md hover:bg-gray-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </a>
                                <!-- Tombol Edit -->
                                <a href="{{ route('courses.edit', $course->id) }}" class="text-white bg-yellow-500 p-1 rounded-md hover:bg-yellow-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>
                                <!-- Form hapus kursus -->
                                <form id="deleteForm" action="{{ route('courses.destroy', $course->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="text-white bg-red-500 p-1 rounded-md hover:bg-red-800" onclick="openDeleteModal({{ $course->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </form>

                                <!-- Modal Konfirmasi Hapus -->
                                <div id="deleteModal" class="fixed inset-0  bg-gray-500 bg-opacity-50 z-10 flex justify-center items-center hidden">
                                    <div class="bg-white p-5 rounded-md">
                                        <p class="text-lg font-semibold">Apakah Anda yakin ingin menghapus kursus ini?</p>
                                        <div class="space-x-4">
                                            <form id="confirmDeleteForm" action="" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-400 font-bold text-white px-4 py-2 rounded-md hover:bg-red-500 mt-4">Ya</button>
                                            </form>
                                            <button onclick="closeDeleteModal()" class="bg-gray-200 font-bold px-4 py-2 rounded-md hover:bg-gray-300 mt-4">Batal</button>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    let deleteUrl = '';  // Variabel untuk menyimpan URL hapus

                                    // Fungsi untuk membuka modal dan mengatur URL hapus
                                    function openDeleteModal(courseId) {
                                        deleteUrl = '{{ route("courses.destroy", ":id") }}'.replace(':id', courseId);
                                        document.getElementById('confirmDeleteForm').action = deleteUrl;  // Update action form dengan URL yang benar
                                        document.getElementById('deleteModal').classList.remove('hidden');
                                    }

                                    // Fungsi untuk menutup modal
                                    function closeDeleteModal() {
                                        document.getElementById('deleteModal').classList.add('hidden');
                                    }
                                </script>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if($courses->isEmpty())
                <div class="mt-4 text-gray-400 text-center">Belum ada kursus yang ditambahkan.</div>
            @endif
        </div>

        <!-- Tampilkan Pagination -->
        <div class="mt-4">
            {{ $courses->links() }}
        </div>
    </div>
</div>
@endsection
