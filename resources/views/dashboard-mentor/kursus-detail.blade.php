@extends('layouts.dashboard-mentor')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-3xl font-bold mb-8 border-b-2 border-gray-300 pb-2 uppercase">Detail Kursus</h2>
            <!-- Card Informasi Kursus -->
            <div class="flex flex-col lg:flex-row mb-4">
                <div class="w-full lg:w-1/3 mb-4 lg:mb-0">
                    <img src="{{ asset('storage/' . $course->image_path) }}" alt="{{ $course->title }}" class="rounded-lg w-full h-auto">
                </div>
                <div class="ml-4 w-2/3 space-y-3">
                    <h2 class="text-2xl font-bold capitalize">{{ $course->title }}</h2>
                    <p class="text-gray-700">{{ $course->description }}</p>
                    <p class="text-gray-600"><strong>Mentor :</strong> {{ $course->mentor->name }}</p>
                    <p class="text-gray-600"><strong>Biaya :</strong> Rp {{ number_format($course->price, 0, ',', '.') }}</p>
                    @if($course->start_date && $course->end_date)
                        <p class="text-gray-600"><strong>Tanggal Mulai :</strong> {{ \Carbon\Carbon::parse($course->start_date)->format('d F Y') }} - {{ \Carbon\Carbon::parse($course->end_date)->format('d F Y') }}</p>
                    @endif
                    @if($course->duration)
                        <p class="text-gray-600"><strong>Durasi :</strong> {{ $course->duration }}</p>
                    @endif
                    @if($course->capacity)
                        <p class="text-gray-600"><strong>Kapasitas :</strong> {{ $course->capacity }}</p>
                    @endif
                    <p class="text-gray-600 capitalize"><strong>Status :</strong> {{ $course->status }}</p>
                </div>
            </div>          
                <div class="mb-4 flex items-center justify-between p-1 border-t-2">
                    <h2 class="text-2xl font-bold border-gray-300 uppercase pt-2">
                        Materi Kursus
                    </h2>
                    <!-- Tombol untuk menambahkan materi -->
                    <a href="{{ route('materi.create', ['courseId' => $course->id]) }}" class="bg-sky-300 hover:bg-sky-600 text-white font-bold mt-3 py-2 px-4 rounded">
                        Tambah Materi
                    </a>
                </div>
        
                @if (session('success'))
                    <div class="alert alert-success text-green-400">
                        {{ session('success') }}
                    </div>
                @endif
        
                <!-- Tabel Materi -->
                <div class="overflow-hidden overflow-x-auto w-full">
                    <table class="min-w-full border-separate border-spacing-1">
                        <thead>
                            <tr class="bg-sky-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="border border-gray-300 px-4 py-2 rounded-md">No</th>
                                <th class="border border-gray-300 px-4 py-2 rounded-md">Judul</th>
                                <th class="border border-gray-300 px-4 py-2 rounded-md">Kursus</th>
                                <th class="border border-gray-300 px-4 py-2 rounded-md">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @php
                                $startNumber = ($materi->currentPage() - 1) * $materi->perPage() + 1;
                            @endphp
                            @foreach ($materi as $index => $materiItem) 
                                @if ($materiItem->courses_id == $course->id) 
                                <tr class="bg-white hover:bg-sky-50 user-row">
                                    <td class="border border-gray-300 px-4 py-2 rounded-md text-center">{{ $startNumber + $index }}</td>
                                    <td class="border border-gray-300 px-4 py-2 rounded-md">{{ $materiItem->judul }}</td>
                                    <td class="border border-gray-300 px-4 py-2 rounded-md">
                                        {{ $materiItem->course->title ?? 'Kursus tidak ditemukan' }}
                                    </td>
                                    <td class="py-2 px-4 text-center border border-gray-300 rounded-md">
                                        <div class="flex items-center justify-center space-x-6">
                                            <a href="{{ route('materi.show', ['courseId' => $course->id, $materiItem->id]) }}" class="text-white bg-gray-500 p-1 rounded-md hover:bg-gray-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('materi.edit', ['courseId' => $course->id, $materiItem->id]) }}" class="text-white bg-blue-500 p-1 rounded-md hover:bg-blue-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>
                                            </a>
                                            <!-- Tombol untuk membuka modal -->
                                            <form id="deleteForm" action="{{ route('materi.destroy', ['courseId' => $course->id, 'materiId' => $materiItem->id]) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="openDeleteModal('{{ $materiItem->id }}')" class="text-white bg-red-500 p-1 rounded-md hover:bg-red-800">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>
                                                </button>
                                            </form>

                                            <!-- Modal Konfirmasi Hapus -->
                                            <div id="deleteModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 z-10 flex justify-center items-center hidden">
                                                <div class="bg-white p-5 rounded-md w-full max-w-md">
                                                    <p class="text-lg font-semibold">Apakah Anda yakin ingin menghapus materi ini?</p>
                                                    <form id="confirmDeleteForm" action="" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="bg-red-400 font-bold text-white px-4 py-2 rounded-md hover:bg-red-500 mt-4">Ya</button>
                                                    </form>
                                                    <button onclick="closeDeleteModal()" class="bg-gray-200 font-bold px-4 py-2 rounded-md hover:bg-gray-300 mt-4">Batal</button>
                                                </div>
                                            </div>

                                            <script>
                                                let deleteUrl = '';  // Variabel untuk menyimpan URL hapus

                                                // Fungsi untuk membuka modal dan mengatur URL hapus
                                                function openDeleteModal(materiId) {
                                                    // Set deleteUrl ke route yang benar dengan materiId
                                                    deleteUrl = '{{ route('materi.destroy', ['courseId' => $course->id, 'materiId' => '__materiId__']) }}'.replace('__materiId__', materiId);
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
                                @endif
                            @endforeach
                            @if ($materi->isEmpty())
                                <tr>
                                    <td colspan="4" class="text-center text-gray-500 py-4">Belum ada materi untuk kursus ini.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $materi->links() }}
                </div>
    </div>

   <!-- Tabel Peserta Terdaftar -->
    <div class="mt-6 bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-bold mb-6 text-left border-b-2 border-gray-300 pb-2 uppercase">Peserta Terdaftar</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full border-separate border-spacing-1" id="courseTable">
                <thead>
                    <tr class="bg-sky-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="border border-gray-300 py-2 px-2 rounded-md">No</th>
                        <th class="border border-gray-300 py-2 px-4 rounded-md">Nama Peserta</th>
                        <th class="border border-gray-300 py-2 px-4 rounded-md">Email</th>
                        <th class="border border-gray-300 py-2 px-4 rounded-md">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($participants as $index => $participant)
                    <tr class="hover:bg-gray-50">
                        <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                        <td class="py-2 px-4 border-b">{{ $participant->user->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $participant->user->email }}</td>
                        <td class="py-2 px-4 border-b">{{ $participant->transaction_status }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-4 text-center text-gray-500">Belum ada peserta terdaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">
                {{ $participants->links() }}
            </div>
        </div>
          <div class="mt-6 flex justify-end">
        <a href="{{ route('courses.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
            Kembali
        </a>
    </div>        
    </div>

@endsection
