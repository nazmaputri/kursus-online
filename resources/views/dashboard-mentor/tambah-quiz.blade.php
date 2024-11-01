@extends('layouts.dashboard-mentor')

@section('content')
<div class="container mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-6">Tambah Kuis Baru</h2>

    <!-- Form Tambah Kuis -->
    <form action="#" method="POST">
        <!-- Input untuk Judul Kuis -->
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-bold mb-2">Judul Kuis</label>
            <input type="text" name="title" id="title" class="w-full p-2 border rounded" placeholder="Masukkan judul kuis">
        </div>

        <!-- Input untuk Deskripsi Kuis -->
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-bold mb-2">Deskripsi</label>
            <textarea name="description" id="description" rows="5" class="w-full p-2 border rounded" placeholder="Masukkan deskripsi kuis"></textarea>
        </div>

        <!-- Pilihan Kursus Terkait (Data Dummy) -->
        <div class="mb-4">
            <label for="course_id" class="block text-gray-700 font-bold mb-2">Kursus Terkait</label>
            <select name="course_id" id="course_id" class="w-full p-2 border rounded">
                <option value="">Pilih Kursus</option>
                <option value="1">Kursus Programming</option>
                <option value="2">Kursus Desain</option>
                <option value="3">Kursus Marketing</option>
            </select>
        </div>

        <!-- Input untuk Waktu Pengerjaan Kuis -->
        <div class="mb-4">
            <label for="duration" class="block text-gray-700 font-bold mb-2">Durasi (menit)</label>
            <input type="number" name="duration" id="duration" class="w-full p-2 border rounded" placeholder="Masukkan durasi kuis (menit)">
        </div>

        <!-- Daftar Soal Dinamis -->
        <div id="questions-container" class="mb-6">
            <h3 class="text-xl font-semibold mb-4">Soal dan Jawaban</h3>

            <!-- Soal Template (untuk cloning) -->
            <template id="question-template">
                <div class="question-item border p-4 mb-4 rounded">
                    <!-- Input Pertanyaan -->
                    <div class="mb-3">
                        <label class="block text-gray-700 font-bold mb-2">Soal</label>
                        <input type="text" name="questions[][question]" class="w-full p-2 border rounded" placeholder="Masukkan teks soal">
                    </div>

                    <!-- Input Jawaban Pilihan Ganda -->
                    <div class="answers-container">
                        <label class="block text-gray-700 font-bold mb-2">Jawaban Pilihan Ganda</label>
                        @for ($i = 0; $i < 4; $i++)
                            <div class="flex items-center mb-2">
                                <input type="radio" name="questions[][correct_answer]" value="{{ $i }}" class="mr-2">
                                <input type="text" name="questions[][answers][]" class="w-full p-2 border rounded" placeholder="Masukkan jawaban">
                            </div>
                        @endfor
                    </div>

                    <!-- Tombol Hapus Soal -->
                    <button type="button" onclick="removeQuestion(this)" class="text-red-600 hover:text-red-800 font-semibold mt-2">Hapus Soal</button>
                </div>
            </template>

            <!-- Container untuk Soal-soal -->
            <div id="question-list"></div>

            <!-- Tombol Tambah Soal -->
            <button type="button" onclick="addQuestion()" class="mt-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Tambah Soal
            </button>
        </div>

        <!-- Tombol Submit -->
        <div class="mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Simpan Kuis
            </button>
        </div>
    </form>
</div>

<script>
    // Fungsi untuk menambahkan soal baru
    function addQuestion() {
        const template = document.getElementById('question-template').content.cloneNode(true);
        document.getElementById('question-list').appendChild(template);
    }

    // Fungsi untuk menghapus soal
    function removeQuestion(element) {
        element.closest('.question-item').remove();
    }
</script>
@endsection
