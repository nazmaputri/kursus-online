@extends('layouts.dashboard-admin')

@section('content')
<div class="container mx-auto bg-white rounded-lg p-5">
    <h2 class="text-2xl font-bold mb-6 text-center border-b-2 border-gray-300 pb-2 uppercase">Daftar Kategori</h2>

    <!-- Tombol Tambah Kategori -->
    <div class="mb-6 p-1 space-x-2 justify-between">
        <button class="text-white bg-sky-300 hover:bg-sky-600 font-bold py-2 px-4 rounded-md">
            Tampilkan Semua Kursus 
        </button>
        <a href="{{ route('categories.create') }}" class="text-white bg-sky-300 hover:bg-sky-600 font-bold py-2 px-4 rounded-md">
            Tambah Kategori
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success text-green-400 mb-4 pl-2">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel Kategori -->
    <div class="overflow-hidden overflow-x-auto w-full">
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
                                <!-- Tombol Lihat Detail -->
                                <a href="{{ route('categories.show', $category->name) }}" class="text-white bg-gray-500 p-1 rounded-md hover:bg-gray-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </a>
                                <!-- Tombol Edit dengan SVG -->
                                <a href="{{ route('categories.edit', $category->id) }}" class="text-white bg-blue-500 p-1 rounded-md  hover:bg-blue-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>
                                <!-- Form hapus kategori -->
                                <button type="button" 
                                    class="text-white bg-red-500 p-1 rounded-md hover:bg-red-800" onclick="openDeleteModal('{{ route('categories.destroy', $category->id) }}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                                <!-- Modal Pop-Up -->
                                <div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                                    <div class="bg-white p-6 rounded-lg shadow-lg w-auto">
                                        <p class="text-md font-semibold text-gray-600 mb-6">Apakah Anda yakin ingin menghapus kategori ini?</p>
                                        <form id="deleteForm" method="POST" class="flex justify-center space-x-4">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" 
                                                class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md font-semibold hover:bg-gray-300" 
                                                onclick="closeDeleteModal()">Batal</button>
                                            <button type="submit" 
                                                class="bg-red-400 text-white px-4 py-2 font-semibold rounded-md hover:bg-red-600">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- JavaScript -->
                                <script>
                                    function openDeleteModal(actionUrl) {
                                        // Set the form action dynamically
                                        document.getElementById('deleteForm').action = actionUrl;
                                        // Show the modal
                                        document.getElementById('deleteModal').classList.remove('hidden');
                                    }

                                    function closeDeleteModal() {
                                        // Hide the modal
                                        document.getElementById('deleteModal').classList.add('hidden');
                                    }
                                </script>
                            </td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
            @if($categories->isEmpty())
                    <div class="mt-4 text-gray-400 text-center">Belum ada kategori yang ditambahkan.</div>
            @endif
    </div>
        <!-- Pagination -->
        <div class="mt-4">
            {{ $categories->links() }} 
        </div>
    </div>
</div>
@endsection
