@extends('layouts.dashboard-mentor')

@section('content')
<div class="container mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-3xl font-bold mb-6 border-b-2 border-gray-300 pb-2">Tambah Kursus</h2>

         <!-- Tampilkan pesan error umum (opsional) -->
         @if($errors->any())
         <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
             <strong>Oops! Terjadi kesalahan:</strong>
             <ul class="mt-2">
                 @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                 @endforeach
             </ul>
         </div>
     @endif

        <!-- Form Tambah Kursus -->
        <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kolom Kiri -->
                <div>
                    <!-- Input untuk Judul -->
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 font-bold mb-2">Judul Kursus</label>
                        <input type="text" name="title" id="title" class="w-full p-2 border rounded @error('title') border-red-500 @enderror" placeholder="Masukkan judul kursus" value="{{ old('title') }}" required>
                        @error('title')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Input untuk Deskripsi -->
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 font-bold mb-2">Deskripsi</label>
                        <textarea name="description" id="description" rows="4" class="w-full p-2 border rounded @error('description') border-red-500 @enderror" placeholder="Masukkan deskripsi kursus">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Input untuk Start_date -->
                    <div class="mb-4">
                        <label for="start_date" class="block text-gray-700 font-bold mb-2">Waktu Mulai</label>
                        <input type="date" name="start_date" id="start_date" class="w-full p-2 border rounded @error('start_date') border-red-500 @enderror" placeholder="Masukkan Waktu Mulai" min="{{ \Carbon\Carbon::today()->toDateString() }}">
                        <small class="text-gray-600">Jika tidak di isi maka akan ditampilkan "Akses seumur hidup"</small>
                        @error('start_date')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Input untuk End_date -->
                    <div class="mb-4">
                        <label for="end_date" class="block text-gray-700 font-bold mb-2">Waktu Selesai</label>
                        <input type="date" name="end_date" id="end_date" class="w-full p-2 border rounded @error('end_date') border-red-500 @enderror" placeholder="Masukkan Waktu Selesai" min="{{ \Carbon\Carbon::today()->toDateString() }}">
                        <small class="text-gray-600">Jika tidak di isi maka akan ditampilkan "Akses seumur hidup"</small>
                        @error('end_date')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div>
                    <!-- Input untuk Foto -->
                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 font-bold mb-2">Foto Kursus</label>
                        <input type="file" name="image" id="image" class="w-full p-2 border rounded">
                        <small class="text-gray-600">Format gambar yang diperbolehkan: jpg, png, jpeg</small>
                    </div>

                    <!-- Input untuk Harga -->
                    <div class="mb-4">
                        <label for="price" class="block text-gray-700 font-bold mb-2">Harga</label>
                        <input type="text" name="price" id="price" class="w-full p-2 border rounded @error('price') border-red-500 @enderror" placeholder="Masukkan harga kursus" value="{{ old('price') }}" required>
                        @error('price')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Input untuk Kategori -->
                    <div class="mb-4">
                        <label for="category_id" class="block text-gray-700 font-bold mb-2">Kategori</label>
                        <select name="category" id="category" class="w-full p-2 border rounded">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Input untuk Kapasitas -->
                    <div class="mb-4">
                        <label for="capacity" class="block text-gray-700 font-bold mb-2">Kapasitas</label>
                        <input type="number" name="capacity" id="capacity" class="w-full p-2 border rounded @error('capacity') border-red-500 @enderror" placeholder="Masukkan kapasitas kursus" value="{{ old('capacity') }}">
                        <small class="text-gray-600">Jika tidak di isi maka kapasitasnya tidak terbatas</small>
                        @error('capacity')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="mt-6">
                        <label for="chat-toggle" class="flex items-center cursor-pointer">
                            <span class="mr-3">Aktifkan Fitur Chat</span>
                            <!-- Toggle Switch -->
                            <div class="relative">
                                <input type="checkbox" name="chat" id="chat-toggle" class="hidden peer" {{ old('chat', $course->chat ?? false) ? 'checked' : '' }} value="1"/>
                                <div class="block bg-gray-300 w-14 h-8 rounded-full peer-checked:bg-green-500 peer-checked:justify-end"></div>
                                <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition-transform peer-checked:translate-x-6"></div>
                            </div>
                        </label>
                    
                        <!-- Pesan saat fitur chat diaktifkan -->
                        <div id="chat-status" class="mt-4 hidden">
                            <p class="text-green-500 font-bold">Fitur Chat Aktif!</p>
                        </div>
                    
                        <!-- Pesan saat fitur chat dinonaktifkan -->
                        <div id="chat-status-inactive" class="mt-4 hidden">
                            <p class="text-red-500 font-bold">Fitur Chat Dinonaktifkan!</p>
                        </div>
                    </div>
                    
                    <!-- Skrip untuk menangani pengaturan status -->
                    <script>
                        // Menambahkan event listener untuk toggle
                        document.getElementById('chat-toggle').addEventListener('change', function() {
                            var chatStatus = document.getElementById('chat-status');
                            var chatStatusInactive = document.getElementById('chat-status-inactive');
                    
                            // Menampilkan atau menyembunyikan pesan berdasarkan status toggle
                            if (this.checked) {
                                chatStatus.classList.remove('hidden');
                                chatStatusInactive.classList.add('hidden');
                            } else {
                                chatStatus.classList.add('hidden');
                                chatStatusInactive.classList.remove('hidden');
                            }
                        });
                    </script>
                </div>
            </div>

        <!-- Tombol Submit -->
        <div class="mt-6 flex justify-end space-x-2">
            <button type="submit" class="bg-sky-400 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded">
                Tambah 
            </button>
            <a href="{{ route('courses.index') }}" class="bg-red-400 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                Batal
            </a>
        </div>
        </form>
    </div>
</div>
@endsection
