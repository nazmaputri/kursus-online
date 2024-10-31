@extends('layouts.dashboard-admin')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4 text-gray-800">Laporan Perkembangan Eduflix</h1>

    <!-- Grafik Perkembangan -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Perkembangan Pengguna Bulanan</h2>
        <div style="position: relative; height: 300px; width: 100%;">
            <canvas id="userGrowthChart"></canvas>
        </div>
    </div>

    <!-- Catatan dan Rekomendasi -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-700">Catatan dan Rekomendasi</h2>
        <p class="text-gray-500">
            - Tingkatkan promosi kursus untuk menarik lebih banyak pengguna baru.<br>
            - Pertimbangkan penambahan kursus baru berdasarkan umpan balik pengguna.<br>
            - Adakan webinar untuk meningkatkan engagement dengan pengguna.
        </p>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('userGrowthChart').getContext('2d');
        const userGrowthChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Pengguna Baru',
                    data: [30, 50, 70, 90, 120, 150, 200, 250, 300, 350, 400, 450],
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
        });
    });
</script>
@endsection
