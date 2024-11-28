@extends('layouts.dashboard-peserta') <!-- Pastikan layout ini sesuai dengan layout proyek Anda -->

@section('content')
<div class="container mx-auto">
    <!-- Card Container -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-3xl font-bold mb-8 text-center border-b-2 border-gray-300 pb-4">Detail Kursus : Kursus Pemrograman Web</h2>
        <div class="flex flex-col md:flex-row mb-6">
            <!-- Foto Mentor -->
            <div class="mb-4 md:mb-0 md:w-1/4">
                <img src="https://via.placeholder.com/150" alt="Foto Mentor" class="rounded-sm w-full h-auto" />
            </div>
            <!-- Informasi Kursus -->
            <div class="md:w-3/4 md:ml-6 space-y-4">
                <h3 class="text-lg font-bold">Nama Mentor : John Doe</h3>
                <p><strong>Jam Konsultasi  :</strong> 10:00 - 12:00</p>
                <p><strong>Tanggal Mulai   :</strong> 1 November 2024</p>
                <p><strong>Tanggal Berakhir :</strong> 30 November 2024</p>
            </div>
        </div>

        <!-- Section Video Pembelajaran -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Video Pembelajaran</h2>
            <a href="#" class="text-sky-500 hover:underline">View All</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
            <!-- Card Video Dummy -->
            @foreach([1, 2, 3] as $index)
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <video controls class="w-full h-40">
                    <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4"> <!-- URL video dummy -->
                    Your browser does not support the video tag.
                </video>
                <div class="p-4">
                    <h3 class="text-md font-semibold text-gray-800">Judul Video {{ $index }}</h3>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Section Materi PDF -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Materi PDF</h2>
            <a href="#" class="text-sky-500 hover:underline">View All</a>
        </div>
        <div class="overflow-x-auto mb-8">
            <table class="min-w-full bg-white shadow-md rounded-lg">
                <thead>
                    <tr class="bg-sky-300 text-white">
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Judul Materi</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach([['title' => 'Materi Dasar HTML', 'content' => 'Konten Materi HTML ...'], 
                              ['title' => 'Materi Dasar CSS', 'content' => 'Konten Materi CSS ...'], 
                              ['title' => 'Materi Dasar JavaScript', 'content' => 'Konten Materi JavaScript ...']] as $index => $pdf)
                    <tr class="border-b">
                        <td class="px-4 py-2 text-center">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">{{ $pdf['title'] }}</td>
                        <td class="px-4 py-2 text-center">
                            <!-- Button untuk membuka modal -->
                            <button onclick="showModal({{ $index }})" class="bg-sky-300 text-white px-4 py-1 rounded hover:bg-sky-500">Buka Materi</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Section Quiz -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Quiz</h2>
            <a href="#" class="text-sky-500 hover:underline">View All</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4 mb-8">
            <!-- Card Quiz Dummy -->
            @foreach([1, 2 ] as $index)
            <div class="bg-white shadow-md rounded-lg p-4">
                <h3 class="text-lg font-semibold text-gray-800">Quiz {{ $index }}</h3>
                <p class="text-gray-600 mb-4">Uji pemahaman Anda dalam materi ini.</p>
                <a href="#" class="block text-center bg-green-400 text-white px-4 py-2 rounded hover:bg-green-600 transition duration-300">Mulai Quiz</a>
            </div>
            @endforeach
        </div>

        <!-- Button Kembali -->
        <div class="flex justify-end">
            <a href="{{ route('study-peserta') }}" class="bg-sky-300 text-white text-semibold px-4 py-2 rounded hover:bg-sky-600">Kembali</a>
        </div>

        <!-- Modal -->
        <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white w-11/12 md:w-1/2 lg:w-1/3 rounded-lg shadow-lg p-6 relative">
                <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-600 hover:text-gray-800">✕</button>
                <h3 id="modalTitle" class="text-lg font-bold mb-4"></h3>
                <p id="modalContent" class="text-gray-700"></p>
            </div>
        </div>
    </div>
</div>

<script>
    // Data konten materi dalam JavaScript untuk ditampilkan di modal
    const materiData = [
        { title: 'Materi Dasar HTML', content: 'Konten Materi HTML ...' },
        { title: 'Materi Dasar CSS', content: 'Konten Materi CSS ...' },
        { title: 'Materi Dasar JavaScript', content: 'Konten Materi JavaScript ...' },
    ];

    // Fungsi untuk menampilkan modal dan mengisi kontennya
    function showModal(index) {
        document.getElementById('modalTitle').innerText = materiData[index].title;
        document.getElementById('modalContent').innerText = materiData[index].content;
        document.getElementById('modal').classList.remove('hidden');
    }

    // Fungsi untuk menutup modal
    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }
</script>
@endsection
