@extends('layouts.dashboard-mentor')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4 text-gray-800">Laporan Pendapatan Eduflix</h1>

    <!-- Grafik Pendapatan -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Pendapatan Bulanan</h2>
        <div style="position: relative; height: 300px; width: 100%;">
            <canvas id="revenueChart"></canvas>
        </div>
    </div>

    <!-- Catatan dan Rekomendasi -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-700">Catatan dan Rekomendasi</h2>
        <p class="text-gray-500">
            - Tingkatkan promosi untuk memaksimalkan pendapatan.<br>
            - Evaluasi harga kursus untuk meningkatkan keuntungan.<br>
            - Perluas metode pembayaran untuk mempermudah pengguna.
        </p>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const revenueData = @json($revenueData); // Data dari controller
        const months = @json($months); // Label bulan

        const ctx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: revenueData,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
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
                            text: 'Pendapatan (Rp)'
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
    });
</script>
@endsection
