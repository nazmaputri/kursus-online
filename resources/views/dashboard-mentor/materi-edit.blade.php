@extends('layouts.dashboard-mentor')

@section('content')
<div class="container mx-auto">
    <!-- Judul Utama -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-3xl font-bold mb-6 border-b-2 border-gray-300 pb-2">Edit Materi</h2>

        <!-- Form Edit Materi -->
        <form action="{{ route('materi.update', ['courseId' => $course->id, 'materiId' => $materi->id]) }}" method="POST" enctype="multipart/form-data" class="w-full">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Kiri: Input Judul dan Deskripsi -->
                <div>
                    <!-- Input untuk Judul Materi -->
                    <div class="mb-4">
                        <label for="judul" class="block text-gray-700 font-bold mb-2">Judul Materi</label>
                        <input type="text" name="judul" id="judul" class="w-full p-2 border rounded" placeholder="Masukkan judul materi" value="{{ old('judul', $materi->judul) }}">
                        @error('judul')
                            <div class="text-red-400">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Video Materi -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Video Materi</label>
                        <div id="video-upload">
                            @foreach($materi->videos as $video)
                                <div class="mb-4" id="video-{{ $video->id }}">
                                    <!-- Video Player -->
                                    <video controls class="w-full rounded border mb-2">
                                        <source src="{{ asset('storage/' . $video->video_url) }}" type="video/mp4">
                                        Browser Anda tidak mendukung pemutar video.
                                    </video>

                                    <!-- Input Judul Video -->
                                    <input type="text" name="video_titles[{{ $video->id }}]" value="{{ basename($video->judul) }}" class="w-full p-2 border rounded bg-gray-100 mb-2" placeholder="Masukkan judul video">

                                    <div class="flex mt-2 justify-end">
                                        <a href="{{ asset('storage/' . $video->video_url) }}" target="_blank" class="flex items-center space-x-2 font-bold bg-blue-400 text-white p-2 rounded">
                                             <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="currentColor" stroke="currentColor" viewBox="0 0 512 512">
                                                 <path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 242.7-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7 288 32zM64 352c-35.3 0-64 28.7-64 64l0 32c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-32c0-35.3-28.7-64-64-64l-101.5 0-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352 64 352zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/>
                                             </svg>
                                             <span>Unduh</span>
                                         </a>
                                         
                                        <!-- Tombol Hapus Video -->
                                        <button type="button" class="flex items-center space-x-2 font-bold ml-2 bg-red-400 text-white p-2 rounded" onclick="removeVideo({{ $video->id }}, '{{ $video->video_url }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                            {{-- <span>Hapus</span> --}}
                                        </button>

                                    </div>
                                </div>
                            @endforeach

                            <!-- Form Input untuk Video Baru -->
                            <div class="mt-4">
                                <div class="items-center space-x-2">
                                    <label class="block text-gray-700 font-bold mb-2">Unggah Video Materi</label>
                                    <input type="text" name="video_titles[]" class="w-full p-2 border rounded mb-2" placeholder="Masukkan judul video">
                                    <input type="file" name="videos[]" class="w-full p-2 border rounded">
                                    <button type="button" onclick="addVideoInput()" class="font-bold mt-2 bg-green-400 text-white p-2 rounded">Tambah Video</button>
                                    <small class="text-gray-600">Format video yang diperbolehkan: mp4, avi, mkv</small>
                                    @error('videos')
                                        <div class="text-red-600">{{ $message }}</div>
                                    @enderror
                                    @error('video_titles')
                                        <div class="text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Kanan: Input Deskripsi dan File PDF -->
                <div>
                    <div class="mb-4">
                        <label for="deskripsi" class="block text-gray-700 font-bold mb-2">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4" class="w-full p-2 border rounded" placeholder="Masukkan deskripsi materi">{{ old('deskripsi', $materi->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="text-red-400">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- File Materi PDF -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">File Materi</label>
                        <div id="pdf-upload">
                            @foreach($materi->pdfs as $pdf)
                                <div class="mb-4" id="pdf-{{ $pdf->id }}">
                                    <!-- Menampilkan PDF -->
                                    <iframe src="{{ asset('storage/' . $pdf->pdf_file) }}" class="w-full h-96 border rounded mb-2"></iframe>

                                    <!-- Input untuk Judul PDF -->
                                    <input type="text" id="material_titles[]" name="material_titles[{{ $pdf->id }}]" value="{{ basename($pdf->judul) }}" class="w-full p-2 border rounded bg-gray-100 mb-2" placeholder="Masukkan judul PDF">

                                    <div class="flex mt-2 justify-end">
                                        <a href="{{ asset('storage/' . $pdf->pdf_file) }}" target="_blank" class="flex items-center space-x-2 font-bold bg-blue-400 text-white p-2 rounded">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="currentColor" stroke="currentColor" viewBox="0 0 512 512">
                                                <path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 242.7-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7 288 32zM64 352c-35.3 0-64 28.7-64 64l0 32c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-32c0-35.3-28.7-64-64-64l-101.5 0-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352 64 352zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/>
                                            </svg>
                                            <span>Unduh</span>
                                        </a>
                                        <!-- Tombol Hapus PDF -->
                                        <button type="button" class="font-bold ml-2 bg-red-400 text-white p-2 rounded" onclick="removePdf({{ $pdf->id }}, '{{ $pdf->pdf_file }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Form Input untuk PDF Baru -->
                            <div class="mt-4">
                                <!-- Kontainer Flex untuk Input Judul dan File dengan Tombol -->
                                <div class="items-center space-x-2">
                                    <label class="block text-gray-700 font-bold mb-2">Unggah File Materi</label>
                                    <input type="text" name="material_titles[]" class="w-full p-2 border rounded mb-2" placeholder="Masukkan judul PDF">
                                    <input type="file" name="material_files[]" class="w-full p-2 border rounded">
                                    <button type="button" onclick="addPdfInput()" class="font-bold mt-2 bg-green-400 text-white p-2 rounded">Tambah PDF</button>
                                    <small class="text-gray-600">Format file yang diperbolehkan: PDF, DOC, PPT</small>
                                    @error('material_files')
                                        <div class="text-red-600">{{ $message }}</div>
                                    @enderror
                                    @error('material_titles')
                                        <div class="text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="mt-6 flex justify-end space-x-2">
                <button type="submit" class="bg-sky-400 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded">
                    Simpan
                </button>
                <a href="{{ route('courses.show', $course->id) }}" class="bg-red-400 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    function removeVideo(videoId, videoUrl) {
        if (confirm("Apakah Anda yakin ingin menghapus video ini?")) {
            fetch("{{ url('video') }}/" + videoId, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    video_url: videoUrl
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('video-' + videoId).remove();
                    alert('Video berhasil dihapus!');
                } else {
                    alert('Gagal menghapus video!');
                }
            })
            .catch(error => alert('Terjadi kesalahan: ' + error));
        }
    }

    function removePdf(pdfId, pdfFile) {
        if (confirm("Apakah Anda yakin ingin menghapus PDF ini?")) {
            fetch("{{ url('pdf') }}/" + pdfId, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    pdf_file: pdfFile
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('pdf-' + pdfId).remove();
                    alert('PDF berhasil dihapus!');
                } else {
                    alert('Gagal menghapus PDF!');
                }
            })
            .catch(error => alert('Terjadi kesalahan: ' + error));
        }
    }

     // Menambahkan input video baru
     function addVideoInput() {
        const videoInput = document.createElement('div');
        videoInput.classList.add('mt-2');
        videoInput.innerHTML = ` 
            <label class="block text-gray-700 font-bold mb-2">Unggah Video</label>
            <input type="text" name="video_titles[]" class="w-full p-2 border rounded mb-2" placeholder="Masukkan judul video">
            <input type="file" name="videos[]" class="w-full p-2 border rounded">
            <button type="button" onclick="removeInput(this)" class="mt-2 bg-red-500 text-white p-2 rounded">Hapus</button>
        `;
        document.getElementById('video-upload').appendChild(videoInput);
    }

     // Menambahkan input PDF baru
     function addPdfInput() {
        const pdfInput = document.createElement('div');
        pdfInput.classList.add('mt-2');
        pdfInput.innerHTML = ` 
            <label class="block text-gray-700 font-bold mb-2">Unggah PDF</label>
            <input type="text" name="material_titles[]" class="w-full p-2 border rounded mb-2" placeholder="Masukkan judul PDF">
            <input type="file" name="material_files[]" class="w-full p-2 border rounded">
            <button type="button" onclick="removeInput(this)" class="mt-2 bg-red-500 text-white p-2 rounded">Hapus</button>
        `;
        document.getElementById('pdf-upload').appendChild(pdfInput);
    }

    // Menghapus input
    function removeInput(button) {
        button.parentElement.remove();
    }
</script>
@endsection
