@extends('layouts.dashboard-admin')

@section('content')
<div class="container mx-auto">
    <!-- Grafik Perkembangan -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4 text-center border-b-2 pb-2">Laporan Perkembangan Pengguna Bulanan</h2>
        <div style="position: relative; height: 300px; width: 100%;">
            <canvas id="userGrowthChart"></canvas>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('userGrowthChart').getContext('2d');
    const userGrowthChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($monthNames),  // Menggunakan nama bulan
            datasets: [{
                label: 'Pengguna Baru',
                data: @json($userGrowthData),  // Mengambil data jumlah pengguna
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 2,
                fill: true,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // Membuat grafik dapat mengisi ruang
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
    });  // Menutup Chart
}); 
</script>
@endsection
