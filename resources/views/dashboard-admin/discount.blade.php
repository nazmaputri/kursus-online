@extends('layouts.dashboard-admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Wrapper div dengan background putih dan padding -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Diskon</h2>
        <a href="{{ route('discount-tambah') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">Tambah Diskon</a>

        <!-- Tabel dengan responsivitas -->
        <div class="overflow-x-auto mt-6">
            <table class="table-auto w-full">
                <thead>
                    <tr class="border-b">
                        <th class="py-2 px-4 text-left">Kode Kupon</th>
                        <th class="py-2 px-4 text-left">Diskon (%)</th>
                        <th class="py-2 px-4 text-left">Tanggal</th>
                        <th class="py-2 px-4 text-left">Jam</th>
                        <th class="py-2 px-4 text-left">Kursus</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($discounts as $discount)
                        <tr class="border-b">
                            <td class="py-2 px-4">{{ $discount->coupon_code }}</td>
                            <td class="py-2 px-4">{{ $discount->discount_percentage }}%</td>
                            <td class="py-2 px-4">{{ $discount->start_date }} - {{ $discount->end_date }}</td>
                            <td class="py-2 px-4">{{ $discount->start_time }} - {{ $discount->end_time }}</td>
                            <td class="py-2 px-4">
                                @if($discount->apply_to_all)
                                    <span class="inline-block px-3 py-1 text-white bg-green-500 rounded-full">Semua Kursus</span>
                                @else
                                    @foreach($discount->courses as $course)
                                        <span class="inline-block px-3 py-1 text-white bg-blue-500 rounded-full mr-2">{{ $course->name }}</span>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
