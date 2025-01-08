@extends('layouts.dashboard-mentor')

@section('content')
<div class="container mx-auto">
    @php
        $currentYear = date('Y');
        $years = range($currentYear, $currentYear - 2); // Tahun saat ini hingga 5 tahun terakhir
    @endphp
    <!-- Grafik Pendapatan -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <div class="flex flex-col items-center mb-4">
            <div class="flex items-center space-x-4">
                <h2 class="text-xl font-semibold text-gray-700">
                    Laporan Pendapatan Bulanan
                </h2>
                <select id="yearFilter" class="p-1.5 border rounded-md focus:outline-none focus:ring focus:ring-sky-200" onchange="filterByYear()">
                    @foreach ($years as $availableYear)
                        <option value="{{ $availableYear }}" {{ $availableYear == request('year', $currentYear) ? 'selected' : '' }}>
                            {{ $availableYear }}
                        </option>
                    @endforeach
                </select>                
                <script>
                    function filterByYear() {
                        const year = document.getElementById('yearFilter').value;
                        const url = new URL(window.location.href);
                        url.searchParams.set('year', year); // Tambahkan parameter 'year' ke URL
                        window.location.href = url.toString(); // Redirect ke URL dengan parameter tahun
                    }
                </script>
            </div>
            <div class="border-b-2 w-full mt-2"></div>
        </div>  
        <div style="position: relative; height: 300px; width: 100%;">
            <canvas id="revenueChart"></canvas>
        </div>
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
