@extends('layouts.dashboard-peserta')

@section('content')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl uppercase font-bold mb-6 border-b-2 border-gray-300 pb-2">Detail Kursus</h2>
    <div class="flex mb-4">
        <div class="w-1/3">
            <img src="{{ asset('storage/' . $course->image_path) }}" alt="{{ $course->title }}" class="rounded-lg w-full h-auto">
        </div>
        <div class="ml-4 w-2/3 space-y-1">
            @if(!empty($course->title))
                <h2 class="text-2xl font-bold mb-2">{{ $course->title }}</h2>
            @endif
        
            @if(!empty($course->description))
                <p class="text-gray-700 mb-2">{{ $course->description }}</p>
            @endif
        
            @if(!empty($course->mentor->name))
                <p class="text-gray-600"><strong>Mentor :</strong> {{ $course->mentor->name }}</p>
            @endif
        
            @if(!empty($course->start_date))
                <p class="text-gray-600"><strong>Tanggal Mulai :</strong> {{ $course->start_date }}</p>
            @endif
        
            @if(!empty($course->duration))
                <p class="text-gray-600"><strong>Durasi :</strong> {{ $course->duration }}</p>
            @endif
        
            @if(!empty($course->price))
                <p class="text-xl rounded-md bg-green-200 inline-block p-2 font-bold text-green-600">
                    Rp. {{ number_format($course->price, 0, ',', '.') }}
                </p>
                @if(!$hasPurchased) <!-- Cek apakah kursus sudah dibeli -->
                <button class="bg-sky-300 text-white font-semibold px-4 py-2 rounded-lg hover:bg-sky-600" id="pay-now-{{ $course->id }}" data-course-id="{{ $course->id }}" data-course-price="{{ $course->price }}">
                    Beli Sekarang
                </button>
                @else
                <p class="text-red-500 mt-2">Anda sudah membeli kursus ini.</p>
                @endif
            @endif
        </div>        
    </div>

    <div class="mt-10">
        <h3 class="text-2xl uppercase font-bold mb-6 border-b-2 border-gray-300 pb-2">Materi Kursus</h3>
        <div class="space-y-6">
            @foreach($course->materi as $materi)
            <div class="bg-neutral-50 p-4 rounded-lg shadow-md">
                <div x-data="{ open: false }">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700 font-semibold mr-2">{{ sprintf('%02d', $loop->iteration) }}.</span>
                        <h4 class="text-lg font-semibold text-gray-800 flex-1">{{ $materi->judul }}</h4>
                        <button @click="open = ! open" class="text-gray-600 hover:text-gray-800">
                            <svg :class="open ? 'transform rotate-180' : ''" class="w-5 h-5 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                    </div>
    
                    <p class="text-gray-600 mb-2 mt-2" x-show="open" x-transition>{{ $materi->deskripsi }}</p>
                    
                    <div x-show="open" x-transition>
                        @if($materi->videos->count())
                        <div class="mt-4">
                            <h5 class="text-md font-semibold text-gray-800">🎥 Video</h5>
                            <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach($materi->videos as $video)
                                <li class="text-gray-700">
                                    <p>{{ $video->judul }}</p>
                                    @if($paymentStatus === 'success') <!-- Cek status transaksi -->
                                        <!-- Video dapat diakses -->
                                        <video controls class="w-full h-full object-cover mt-2">
                                            <source src="{{ asset('storage/' . $video->video_url) }}" type="video/mp4">
                                        </video>
                                    @else
                                        <!-- Video terkunci -->
                                        <div class="w-full h-40 bg-gray-300 flex items-center justify-center mt-2">
                                            <p class="text-gray-700 font-semibold">🔒 Video Terkunci</p>
                                        </div>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @else
                        <p class="text-gray-600 mt-4">Belum ada video untuk materi ini.</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    

    {{-- <div class="mt-6 flex justify-end">
        <a href="{{ route('categories-detail', $category->id) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
            Kembali
        </a>
    </div>         --}}
</div>

<script>
    document.querySelectorAll('[id^="pay-now"]').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const courseId = this.getAttribute('data-course-id');
            const amount = this.getAttribute('data-course-price');
            fetch(`/create-payment/${courseId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ amount })
            })
            .then(response => response.json())
            .then(data => {
                if (data.snapToken) {
                    snap.pay(data.snapToken, {
                        onSuccess: function(result) {
                            // Alert dan kirim permintaan ke server untuk memperbarui status
                            alert('Pembayaran berhasil');
                            fetch(`/payment-success`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                },
                                body: JSON.stringify({
                                    order_id: result.order_id,
                                    transaction_status: 'success',
                                }),
                            })
                            .then(res => res.json())
                            .then(response => {
                                alert(response.message);
                                location.reload(); // Reload halaman jika diperlukan
                            })
                            .catch(error => {
                                console.error('Error updating payment status:', error);
                            });
                        },
                        onPending: function(result) {
                            alert('Pembayaran sedang diproses');
                        },
                        onError: function(result) {
                            alert('Pembayaran gagal');
                        }
                    });
                }
            })
            .catch(error => alert('Terjadi kesalahan saat memproses pembayaran.'));
        });
    });
</script>
@endsection
