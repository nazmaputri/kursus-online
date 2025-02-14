@extends('layouts.dashboard-peserta')

@section('content')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>

    <div class="bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl uppercase font-bold mb-6 border-b-2 border-gray-300 pb-2">Keranjang Saya</h2>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('warning'))
            <div class="bg-yellow-500 text-white p-3 mb-4 rounded-lg shadow-md">
                {{ session('warning') }}
            </div>
        @endif

        <!-- Pemberitahuan Diskon (Tetap Ada di Atas Keranjang) -->
        @if ($activeDiscount)
        <div class="bg-yellow-100 text-yellow-800 p-4 mb-4 rounded-lg">
            <h3 class="font-bold text-lg">🎉 Diskon Aktif: <span class="uppercase">{{ $activeDiscount->coupon_code }}</span></h3>
            <p>Diskon sebesar <strong>{{ $activeDiscount->discount_percentage }}%</strong> berlaku hingga <span id="discount-end">{{ $activeDiscount->end_date }} {{ $activeDiscount->end_time }}</span>.</p>
            <div class="text-red-600 font-semibold text-lg mt-2" id="countdown-timer"></div>
        </div>
        @endif
        <!-- Tambahkan Countdown Timer -->
        <script>
            function startCountdown(endDate) {
                let countDownDate = new Date(endDate).getTime();

                let x = setInterval(function() {
                    let now = new Date().getTime();
                    let distance = countDownDate - now;

                    if (distance < 0) {
                        clearInterval(x);
                        document.getElementById("countdown-timer").innerHTML = "⏳ Diskon telah berakhir.";
                        return;
                    }

                    let days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    let seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    document.getElementById("countdown-timer").innerHTML = `⏳ Berakhir dalam: ${days} hari, ${hours} jam, ${minutes} menit, ${seconds} detik`;
                }, 1000);
            }

            let discountEnd = document.getElementById("discount-end")?.textContent;
            if (discountEnd) startCountdown(discountEnd);
        </script>

        @if ($carts->count() > 0)
            <div class="bg-white shadow-lg rounded-lg p-6">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700">
                            <th class="px-4 py-3 text-left">Nama Kursus</th>
                            <th class="px-4 py-3 text-center">Harga</th>
                            <th class="px-4 py-3 text-center">Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($carts as $cart)
                            @php
                                $total += $cart->course->price;
                            @endphp
                            <tr class="border-t">
                                <td class="px-4 py-4">
                                    <div class="flex items-center">
                                        <img src="{{ asset('storage/' . $cart->course->image_path) }}" alt="Course Image"
                                            class="w-16 h-16 rounded-lg object-cover mr-4">
                                        <span class="font-semibold text-gray-800">{{ $cart->course->title }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-center text-gray-700">Rp
                                    {{ number_format($cart->course->price, 0, ',', '.') }}</td>
                                <td class="px-4 py-4 text-center">
                                    <form action="{{ route('cart.remove', $cart->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-500 font-bold text-lg hover:text-red-700">×</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Input Kupon -->
                <div class="mt-6">
                    <input type="text" id="coupon-code"
                        class="border border-gray-300 rounded-lg p-2 w-full sm:w-3/4 md:w-1/2"
                        placeholder="Masukkan Kode Kupon" value="{{ $couponCode ?? '' }}">
                    <button id="apply-coupon"
                        class="bg-green-500 text-white px-4 py-2 rounded-lg mt-2 hover:bg-green-600">Gunakan Kupon</button>
                </div>

                <!-- Total Harga -->
                <div class="flex justify-between items-center mt-6 flex-wrap">
                    <h3 class="text-xl font-semibold text-gray-800">
                        Total: <span id="total-price">Rp {{ number_format($totalPriceAfterDiscount, 0, ',', '.') }}</span>
                    </h3>
                    <button class="bg-sky-300 text-white font-semibold px-4 py-2 rounded-lg hover:bg-sky-600" 
                        id="pay-now" 
                        data-total-price="{{ $totalPriceAfterDiscount }}">
                        Bayar Sekarang
                    </button>
                </div>

                <script>
                    document.getElementById('pay-now').addEventListener('click', function(e) {
                        e.preventDefault();

                        const totalPrice = this.getAttribute('data-total-price');
                        if (!totalPrice || isNaN(totalPrice)) {
                            alert('Harga tidak valid');
                            return;
                        }

                        fetch('/create-payment', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify({ amount: totalPrice })
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data); // Periksa data yang diterima
                            if (data.snapToken) {
                                snap.pay(data.snapToken, {
                                    onSuccess: function(result) {
                                        alert('Pembayaran berhasil');
                                        fetch('/payment-success', {
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
                                            location.reload();
                                        })
                                        .catch(error => console.error('Error updating payment status:', error));
                                    },
                                    onPending: function(result) {
                                        alert('Pembayaran sedang diproses');
                                    },
                                    onError: function(result) {
                                        alert('Pembayaran gagal');
                                    }
                                });
                            } else {
                                alert('Gagal mendapatkan token pembayaran');
                            }
                        })
                        .catch(error => alert('Terjadi kesalahan saat memproses pembayaran.'));
                    });

                </script>                

                <!-- Tambahkan JavaScript -->
                <script>
                    document.getElementById('apply-coupon').addEventListener('click', function() {
                        let couponCode = document.getElementById('coupon-code').value;
                        if (couponCode) {
                            window.location.href = "{{ route('cart.index') }}?coupon=" + couponCode;
                        } else {
                            alert("Masukkan kode kupon terlebih dahulu!");
                        }
                    });
                </script>
            </div>
        @else
            <div class="text-center py-10">
                <p class="text-gray-500 text-lg">Keranjang Anda masih kosong. Yuk, pilih kursus favorit Anda!</p>
                <a href="{{ route('kategori-peserta') }}"
                    class="mt-4 font-bold inline-block bg-sky-300 text-white px-6 py-3 rounded-lg hover:bg-sky-600 transition shadow-lg">
                    Jelajahi Kursus
                </a>
            </div>
        @endif

    </div>
@endsection


