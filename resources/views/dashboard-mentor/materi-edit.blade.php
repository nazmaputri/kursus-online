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
                            <div class="text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Video Materi -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Video Materi</label>
                        <div id="video-upload">
                            @foreach($materi->videos as $video)
                                <div class="mb-4" id="video-{{ $video->id }}">
                                    <video controls class="w-full rounded border mb-2">
                                        <source src="{{ asset('storage/' . $video->video_url) }}" type="video/mp4">
                                        Browser Anda tidak mendukung pemutar video.
                                    </video>
                                    <input type="text" class="w-full p-2 border rounded bg-gray-100" value="{{ basename($video->video_url) }}" disabled>
                                    <div class="flex mt-2 justify-between">
                                        <a href="{{ asset('storage/' . $video->video_url) }}" target="_blank" class="bg-blue-500 text-white p-2 rounded">Unduh</a>
                                        <!-- Tombol Hapus Video -->
                                        <button type="button" class="ml-2 bg-red-500 text-white p-2 rounded" onclick="removeVideo({{ $video->id }}, '{{ $video->video_url }}')">Hapus</button>
                                    </div>
                                </div>
                            @endforeach
                            <div class="flex">
                                <input type="file" name="videos[]" class="w-full p-2 border rounded">
                                <button type="button" onclick="addVideoInput()" class="ml-2 bg-green-500 text-white p-2 rounded">Tambah Video</button>
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
                            <div class="text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- File Materi PDF -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">File Materi</label>
                        <div id="pdf-upload">
                            @foreach($materi->pdfs as $pdf)
                                <div class="mb-4" id="pdf-{{ $pdf->id }}">
                                    <iframe src="{{ asset('storage/' . $pdf->pdf_file) }}" class="w-full h-96 border rounded mb-2"></iframe>
                                    <input type="text" class="w-full p-2 border rounded bg-gray-100" value="{{ basename($pdf->pdf_file) }}" disabled>
                                    <div class="flex mt-2 justify-between">
                                        <a href="{{ asset('storage/' . $pdf->pdf_file) }}" target="_blank" class="bg-blue-500 text-white p-2 rounded">Unduh</a>
                                        <!-- Tombol Hapus PDF -->
                                        <button type="button" class="ml-2 bg-red-500 text-white p-2 rounded" onclick="removePdf({{ $pdf->id }}, '{{ $pdf->pdf_file }}')">Hapus</button>
                                    </div>
                                </div>
                            @endforeach
                            <div class="flex">
                                <input type="file" name="material_files[]" class="w-full p-2 border rounded">
                                <button type="button" onclick="addPdfInput()" class="ml-2 bg-green-500 text-white p-2 rounded">Tambah PDF</button>
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
                <a href="{{ route('materi.index') }}" class="bg-red-400 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    function removeVideo(videoId, videoUrl) {
        // Membuat konfirmasi penghapusan video
        if (confirm("Apakah Anda yakin ingin menghapus video ini?")) {
            // Mengirim permintaan AJAX untuk menghapus video
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
                // Jika berhasil, menghapus elemen video dari halaman
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
        // Membuat konfirmasi penghapusan PDF
        if (confirm("Apakah Anda yakin ingin menghapus PDF ini?")) {
            // Mengirim permintaan AJAX untuk menghapus PDF
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
                // Jika berhasil, menghapus elemen PDF dari halaman
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

    function addVideoInput() {
        const videoInput = document.createElement('div');
        videoInput.classList.add('flex', 'mt-2');
        videoInput.innerHTML = ` 
            <input type="file" name="videos[]" class="w-full p-2 border rounded">
            <button type="button" onclick="removeInput(this)" class="ml-2 bg-red-500 text-white p-2 rounded">Hapus</button>
        `;
        document.getElementById('video-upload').appendChild(videoInput);
    }

    function addPdfInput() {
        const pdfInput = document.createElement('div');
        pdfInput.classList.add('flex', 'mt-2');
        pdfInput.innerHTML = ` 
            <input type="file" name="material_files[]" class="w-full p-2 border rounded">
            <button type="button" onclick="removeInput(this)" class="ml-2 bg-red-500 text-white p-2 rounded">Hapus</button>
        `;
        document.getElementById('pdf-upload').appendChild(pdfInput);
    }

    function removeInput(button) {
        button.parentElement.remove();
    }
</script>
@endsection
