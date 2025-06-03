@extends('layouts.navigation')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
<div class="p-6 space-y-6">
    <h1 class="text-xl font-semibold mb-4">Dashboard</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        <!-- Kartu Transaksi GoFood -->
        <a href="{{ route('gofood.index') }}"
            class="block bg-white rounded-lg p-4 flex flex-col items-center justify-center space-y-3"
            style="border: 1px solid #F58220;">
            <span class="font-medium text-center">Transaksi GoFood</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-14 h-14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3v18h18M9 17V9m4 8v-6m4 6V5" />
            </svg>
            <span
                class="bg-orange-500 hover:bg-orange-600 text-white text-xs px-4 py-1.5 rounded-full inline-flex items-center justify-between space-x-2 shadow-md transition duration-300 font-semibold cursor-pointer">
                <span>Selengkapnya</span>
                <span class="bg-white rounded-full p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-orange-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </span>
        </a>

        <!-- Kartu Transaksi GrabFood -->
        <a href="{{ route('grabfood.index') }}"
            class="block bg-white rounded-lg p-4 flex flex-col items-center justify-center space-y-3"
            style="border: 1px solid #F58220;">
            <span class="font-medium text-center">Transaksi GrabFood</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="w-14 h-14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3v18h18M9 17V9m4 8v-6m4 6V5" />
            </svg>
            <span
                class="bg-orange-500 hover:bg-orange-600 text-white text-xs px-4 py-1.5 rounded-full inline-flex items-center justify-between space-x-2 shadow-md transition duration-300 font-semibold cursor-pointer">
                <span>Selengkapnya</span>
                <span class="bg-white rounded-full p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-orange-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </span>
        </a>

        <!-- Kartu Transaksi ShopeeFood -->
        <a href="{{ route('shopeefood.index') }}"
            class="block bg-white rounded-lg p-4 flex flex-col items-center justify-center space-y-3"
            style="border: 1px solid #F58220;">
            <span class="font-medium text-center">Transaksi ShopeeFood</span>
           <svg xmlns="http://www.w3.org/2000/svg" class="w-14 h-14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3v18h18M9 17V9m4 8v-6m4 6V5" />
            </svg>
            <span
                class="bg-orange-500 hover:bg-orange-600 text-white text-xs px-4 py-1.5 rounded-full inline-flex items-center justify-between space-x-2 shadow-md transition duration-300 font-semibold cursor-pointer">
                <span>Selengkapnya</span>
                <span class="bg-white rounded-full p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-orange-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </span>
        </a>

        <!-- Kartu Laporan Transaksi -->
        <a href="{{ route('laporan.index') }}"
            class="block bg-white rounded-lg p-4 flex flex-col items-center justify-center space-y-3"
            style="border: 1px solid #F58220;">
            <span class="font-medium text-center">Laporan Transaksi</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-14 h-14 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-4h6v4m-7 4h8a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
            </svg>
            <span
                class="bg-orange-500 hover:bg-orange-600 text-white text-xs px-4 py-1.5 rounded-full inline-flex items-center justify-between space-x-2 shadow-md transition duration-300 font-semibold cursor-pointer">
                <span>Selengkapnya</span>
                <span class="bg-white rounded-full p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-orange-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </span>
        </a>

        <!-- Kartu menu -->
        <a href="{{ route('menus.index') }}"
            class="block bg-white rounded-lg p-4 flex flex-col items-center justify-center space-y-3"
            style="border: 1px solid #F58220;">
            <span class="font-medium text-center">Menu</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-14 h-14">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 2.25h6M9 2.25a1.5 1.5 0 00-1.5 1.5v.75H6A2.25 2.25 0 003.75 6v12A2.25 2.25 0 006 20.25h12a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0018 3.75h-1.5v-.75A1.5 1.5 0 0015 2.25M9 7.5h6M9 11.25h6M9 15h4.5" />
            </svg>
            <span
                class="bg-orange-500 hover:bg-orange-600 text-white text-xs px-4 py-1.5 rounded-full inline-flex items-center justify-between space-x-2 shadow-md transition duration-300 font-semibold cursor-pointer">
                <span>Selengkapnya</span>
                <span class="bg-white rounded-full p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-orange-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </span>
        </a>

        <!-- Kartu item terjual -->
        <a href="{{ route('items-terjual.index') }}"
            class="block bg-white rounded-lg p-4 flex flex-col items-center justify-center space-y-3"
            style="border: 1px solid #F58220;">
            <span class="font-medium text-center">Item Terjual</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-14 h-14 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2l4 -4M12 21a9 9 0 1 1 0 -18a9 9 0 0 1 0 18z" />
            </svg>
            <span
                class="bg-orange-500 hover:bg-orange-600 text-white text-xs px-4 py-1.5 rounded-full inline-flex items-center justify-between space-x-2 shadow-md transition duration-300 font-semibold cursor-pointer">
                <span>Selengkapnya</span>
                <span class="bg-white rounded-full p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-orange-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </span>
        </a>

    </div>


    <!-- Grafik Pendapatan -->
    <div class="bg-white rounded-lg p-6 mt-6" style="border: 1px solid #F58220;">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h2 class="font-bold text-lg">Pendapatan</h2>
                <p class="text-sm text-gray-600">Pendapatan store kuliner anda!</p>
            </div>
            <select class="border rounded px-3 py-1 text-sm font-medium" style="border-color: #F58220;">
                <option>2019</option>
                <option>2020</option>
                <option>2021</option>
                <option>2022</option>
                <option>2023</option>
                <option selected>2024</option>
                <option>2025</option>
            </select>
        </div>

        <div class="w-full h-64 rounded mb-4 overflow-x-auto flex justify-center items-center">
            <canvas id="pendapatanChart" style="width: 1200px; height: 100%;"></canvas>
        </div>

        <p class="text-sm font-semibold">Pendapatan <span class="text-black text-base">Rp.30.000.000</span></p>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('pendapatanChart').getContext('2d');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                    datasets: [{
                        label: 'Pendapatan (Juta Rp)',
                        data: [2, 3, 2.5, 4, 5, 4.5, 6, 7, 6.5, 8, 7.5, 9],
                        borderColor: '#F58220',
                        backgroundColor: 'rgba(245, 130, 32, 0.3)',
                        fill: true,
                        tension: 0.3,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return value + ' jt';
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            labels: {
                                color: '#333',
                                font: {
                                    size: 14
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `Rp ${context.parsed.y} juta`;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</div>

<style>
    /* Tambahan untuk memperbaiki tampilan tombol "Selengkapnya" di mobile */
    @media (max-width: 640px) {
        .inline-flex.items-center.justify-between.space-x-2 {
            flex-direction: column;
            gap: 0.25rem;
        }
    }

    /* Supaya canvas chart tidak meluber di layar kecil */
    @media (max-width: 768px) {
        #pendapatanChart {
            width: 100% !important;
            height: auto !important;
        }
    }

    /* Kartu transaksi agar tidak terlalu kecil di layar sempit */
    @media (max-width: 480px) {
        .grid>a {
            padding: 1rem !important;
        }

        .grid>a img {
            width: 2.5rem;
            height: 2.5rem;
        }
    }
</style>

@endsection