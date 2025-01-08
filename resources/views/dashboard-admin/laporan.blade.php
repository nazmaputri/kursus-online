@extends('layouts.dashboard-admin')

@section('content')
<div class="container mx-auto">
    @php
        $currentYear = date('Y');
        $years = range($currentYear, $currentYear - 2); // Tahun saat ini hingga 5 tahun terakhir
    @endphp
    <!-- Grafik Perkembangan -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <div class="flex flex-col items-center mb-4">
            <div class="flex items-center space-x-4">
                <h2 class="text-xl font-semibold text-gray-700">
                    Laporan Perkembangan Pengguna Bulanan
                </h2>
                <select id="yearFilter" class="p-1.5 border rounded-md focus:outline-none focus:ring focus:ring-sky-200">
                    @foreach ($years as $availableYear)
                        <option value="{{ $availableYear }}" {{ $availableYear == $year ? 'selected' : '' }}>
                            {{ $availableYear }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="border-b-2 w-full mt-2"></div>
        </div>               
        <div style="position: relative; height: 300px; width: 100%;">
            <canvas id="userGrowthChart"></canvas>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('userGrowthChart').getContext('2d');
    
        // Data awal dari server
        const userGrowthChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($monthNames),
                datasets: [{
                    label: 'Pengguna Baru',
                    data: @json($userGrowthData),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Pengguna'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Bulan'
                        }
                    }
                }
            }
        });
    
        // Update grafik saat tahun dipilih
        document.getElementById('yearFilter').addEventListener('change', function () {
            const selectedYear = this.value;
            window.location.href = `?year=${selectedYear}`; // Reload halaman dengan parameter tahun
        });
    });
</script>    
@endsection
