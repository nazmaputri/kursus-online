@extends('layouts.dashboard-peserta')

@section('content')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>

<div class="container mx-auto">
    <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6 mb-6">
        <!-- Detail Kategori -->
        <h2 class="text-2xl uppercase font-bold mb-6 text-center border-b-2 border-gray-300 pb-2">Daftar Kursus : {{ $category->name }}</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($courses as $course)
                <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">
                    <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $course->image_path) }}" alt="{{ $course->title }}">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $course->title }}</h3>
                        <p class="text-gray-600">{{ Str::limit($course->description, 100) }}</p>
                        <div class="flex justify-between items-center mt-4">
                            <p class="text-xl font-bold text-gray-800" id="course-price-{{ $course->id }}">Rp {{ number_format($course->price, 0, ',', '.') }}</p>
                            <button class="bg-sky-300 text-white px-4 py-2 rounded-lg hover:bg-sky-600" id="pay-now-{{ $course->id }}" data-course-id="{{ $course->id }}" data-course-price="{{ $course->price }}">
                                Beli Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('[id^="pay-now"]').forEach(button => {
         button.addEventListener('click', function(e) {
             e.preventDefault();
 
             const courseId = this.getAttribute('data-course-id');
             const amount = this.getAttribute('data-course-price'); // Mengambil harga kursus dari atribut data
 
             // Request untuk mendapatkan snap token
             fetch(`/create-payment/${courseId}`, {
                 method: 'POST',
                 headers: {
                     'Content-Type': 'application/json',
                     'X-CSRF-TOKEN': '{{ csrf_token() }}',
                 },
                 body: JSON.stringify({
                     amount: amount
                 })
             })
             .then(response => response.json())
             .then(data => {
                 if (data.snapToken) {
                     snap.pay(data.snapToken, {
                         onSuccess: function(result) {
                             alert('Pembayaran berhasil');
                             console.log(result);
                         },
                         onPending: function(result) {
                             alert('Pembayaran sedang diproses');
                             console.log(result);
                         },
                         onError: function(result) {
                             alert('Pembayaran gagal');
                             console.log(result);
                         }
                     });
                 } else {
                     alert('Snap token tidak ditemukan. Periksa kembali konfigurasi atau coba lagi nanti.');
                     console.error('Snap token tidak ditemukan');
                 }
             })
             .catch(error => {
                 alert('Terjadi kesalahan saat memproses pembayaran');
                 console.error('Error:', error);
             });
         });
     });
 </script>
 

@endsection
