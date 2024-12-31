@extends('layouts.dashboard-admin')  

@section('content')
    <div class="container mx-auto">
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h1 class="text-2xl font-bold mb-8 inline-block border-b-2 border-gray-300 pb-2 uppercase">Daftar Penilaian</h1>
            @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
                </div>
            @endif
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($ratings as $rating)
                    <div class="bg-white p-5 rounded-lg shadow-lg border">
                        <h2 class="text-xl font-semibold">{{ $rating->nama }}</h2>
                        <p class="text-md">{{ $rating->email }}</p>
                        <div class="flex items-center space-x-2 mt-2">
                            @for ($i = 0; $i < 5; $i++)
                                <span class="{{ $i < $rating->rating ? 'text-yellow-500' : 'text-gray-300' }}">&starf;</span>
                            @endfor
                        </div>
                        <p class="text-sm mt-2">"{{ $rating->comment }}"</p>
                        <div class="mt-4">
                            <p class="text-sm">
                                <strong>Status :</strong> 
                                <span class="{{ $rating->display ? 'text-green-500' : 'text-red-500' }}">
                                    {{ $rating->display ? 'Tampil' : 'Tidak Tampil' }}
                                </span>
                            </p>
                            <div class="mt-6 flex items-center space-x-4">
                                <!-- Tombol untuk menampilkan atau menyembunyikan rating di landing page -->
                                <a href="{{ route('toggle.display', $rating->id) }}" 
                                   class="text-white bg-sky-300 font-bold hover:bg-sky-600 rounded-md p-2">
                                    {{ $rating->display ? 'Sembunyikan' : 'Tampilkan' }}
                                </a>
                               <!-- Form untuk menghapus rating -->
                                <form id="deleteForm-{{ $rating->id }}" action="{{ route('ratings.destroy', $rating->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="text-white bg-red-500 p-2 rounded-md hover:bg-red-800" onclick="openDeleteModal({{ $rating->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </form>

                                <!-- Modal Konfirmasi Hapus -->
                                <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 hidden z-50">
                                    <div class="bg-white p-6 rounded-lg shadow-lg">
                                        <h3 class="text-md font-medium">Apakah Anda yakin ingin menghapus rating ini?</h3>
                                        <div class="mt-4 flex justify-center space-x-4">
                                            <button onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-500 text-white rounded-md">Batal</button>
                                            <button id="confirmDeleteButton" class="px-4 py-2 bg-red-500 text-white rounded-md">Hapus</button>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    let currentFormId = null;

                                    // Menampilkan modal konfirmasi
                                    function openDeleteModal(ratingId) {
                                        currentFormId = `deleteForm-${ratingId}`;
                                        document.getElementById('deleteModal').classList.remove('hidden');
                                    }

                                    // Menutup modal konfirmasi
                                    function closeDeleteModal() {
                                        currentFormId = null;
                                        document.getElementById('deleteModal').classList.add('hidden');
                                    }

                                    // Mengirimkan form setelah konfirmasi
                                    document.getElementById('confirmDeleteButton').addEventListener('click', function () {
                                        if (currentFormId) {
                                            document.getElementById(currentFormId).submit();
                                        }
                                    });
                                </script>
                            </div>                            
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Links -->
            <div class="mt-6">
                {{ $ratings->links() }}
            </div>
        </div>
    </div>
@endsection
