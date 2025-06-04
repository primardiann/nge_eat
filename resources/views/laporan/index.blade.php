@extends('layouts.navigation')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
<div class="flex min-h-screen bg-[#FAFAFA] text-sm">
    <main class="flex-1 px-8 py-6">

        <!-- Breadcrumb -->
        <div class="text-gray-500 mb-4 flex items-center space-x-1">
            <a href="/dashboard" class="text-black font-semibold hover:underline">Dashboard</a>
            <span class="text-[#888]">></span>
            <span class="text-[#888]">Laporan Transaksi</span>
        </div>
        <!-- Info Cards -->
        <div class="row mb-4" style="display: flex; gap: 20px; flex-wrap: wrap;">
            <!-- Card 1: Item Terjual -->
            <div style="flex: 1; min-width: 280px; max-width: 350px; position: relative;">
                <div class="p-5 h-full rounded-lg bg-white border border-[#FCD9A3] shadow-sm relative">
                    <div class="text-[#1F2937] text-lg font-semibold mb-1 flex items-center justify-between">
                        <span>Item Terjual</span>

                        <!-- Icon info dengan tooltip -->
                        <div class="relative group cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hover:text-orange-500 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 18a6 6 0 110-12 6 6 0 010 12z" />
                            </svg>
                            <!-- Tooltip -->
                            <div class="absolute bottom-full mb-2 left-1/2 transform -translate-x-1/2 w-48 bg-gray-800 text-white text-xs rounded px-3 py-2 opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity z-50">
                                <strong>Rincian Kategori:</strong><br>
                                • GoFood: 120 item<br>
                                • GrabFood: 100 item<br>
                                • ShopeeFood: 100 item
                            </div>
                        </div>
                    </div>

                    <div class="text-sm text-gray-500 mb-3">Bulan Ini</div>
                    <div class="h-[1px] bg-[#FCD9A3] mb-4"></div>
                    <div class="flex items-baseline text-[#1F2937] mb-2">
                        <div class="text-4xl font-extrabold leading-none">320</div>
                        <div class="text-base ml-2">Item</div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="w-full bg-gray-200 rounded-full h-3 mb-3">
                        <div class="bg-orange-400 h-3 rounded-full" style="width: 64%;"></div>
                    </div>
                </div>
            </div>

            <!-- Card 2: Jumlah Transaksi -->
            <div style="flex: 1; min-width: 280px; max-width: 350px;">
                <div class="p-4 h-full rounded-lg bg-white border border-[#FCD9A3] shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="text-[#1F2937] text-lg font-semibold mb-1">Jumlah Transaksi</div>
                        <div class="text-sm text-gray-500 mb-4">Total transaksi yang berhasil diproses selama periode ini.</div>
                        <div class="h-[1px] bg-[#FCD9A3] mb-4"></div>
                        <div class="flex items-baseline text-[#1F2937]">
                            <div class="text-4xl font-extrabold leading-none">113</div>
                            <div class="text-base ml-2">Transaksi</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3: Total Keseluruhan -->
            <div style="flex: 1; min-width: 280px; max-width: 350px;">
                <div class="p-4 h-full rounded-lg bg-white border border-[#FCD9A3] shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="text-[#1F2937] text-lg font-semibold mb-1">Total Keseluruhan</div>
                        <div class="text-sm text-gray-500 mb-4">Jumlah pendapatan yang diperoleh dari seluruh transaksi.</div>
                        <div class="h-[1px] bg-[#FCD9A3] mb-4"></div>
                        <div class="flex items-baseline text-[#1F2937]">
                            <div class="text-4xl font-extrabold leading-none">Rp 50.000.000</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Laporan Transaksi Card -->
        <div class="p-4" style="background-color: #fff; border-radius: 16px; box-shadow: 0px 2px 6px rgba(0,0,0,0.05); margin: 0 0 32px 0;">
            <div class="flex justify-between items-center mb-4 flex-wrap gap-4">
                <h5 class="mb-0 fw-bold" style="color: #1F2937; font-size: 24px; font-weight: 700;">
                    Laporan Transaksi
                </h5>

                <!-- Kanan: Kalender + Tombol Unduh & Filter -->
                <div class="flex items-center space-x-4">
                    <!-- Komponen Kalender -->
                    <div class="flex items-center">
                        @include('components.kalender')
                    </div>

                    <!-- Tombol Unduh -->
                    <button id="openDownloadModal" style="border: 2px solid #F58220;"
                        class="flex items-center text-orange-500 px-4 py-1.5 rounded hover:bg-orange-50 transition">
                        <i class="fas fa-download mr-2"></i> Unduh
                    </button>

                    <!-- Tombol Filter -->
                    <!-- <button id="openFilterModal" style="border: 2px solid #F58220;"
                            class="flex items-center text-orange-500 px-4 py-1.5 rounded hover:bg-orange-50 transition">
                            <i class="fas fa-filter mr-2"></i> Filter
                        </button> -->

                    <!-- Dropdown Filter Platform -->
                    <form method="GET" action="" class="relative">
                        <select name="platform"
                            onchange="this.form.submit()"
                            class="appearance-none border-2 border-orange-400 text-orange-500 px-4 py-1.5 rounded hover:bg-orange-50 transition cursor-pointer bg-white pr-8">
                            <option value="">Filter</option>
                            <option value="gofood" {{ request('platform') === 'gofood' ? 'selected' : '' }}>GoFood</option>
                            <option value="grabfood" {{ request('platform') === 'grabfood' ? 'selected' : '' }}>GrabFood</option>
                            <option value="shopeefood" {{ request('platform') === 'shopeefood' ? 'selected' : '' }}>ShopeeFood</option>
                        </select>
                    </form>
                </div>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <table class="min-w-full">
                    <thead style="background-color: #ffd5ab;" class="text-gray-700 text-left text-sm">
                        <tr>
                            <th class="px-4 py-3 font-medium text-center">Kategori</th>
                            <th class="px-4 py-3 font-medium text-center">ID pesanan</th>
                            <th class="px-4 py-3 font-medium text-center">Tanggal</th>
                            <th class="px-4 py-3 font-medium text-center">Waktu</th>
                            <th class="px-4 py-3 font-medium text-center">Status</th>
                            <th class="px-4 py-3 font-medium text-center">Metode Pembayaran</th>
                            <th class="px-4 py-3 font-medium text-center">Total</th>
                        </tr>
                    </thead>

                    @php
                    $kategori = ['GoFood', 'GrabFood', 'ShopeeFood', 'GoFood', 'ShopeeFood'];
                    $filteredKategori = request('platform')
                    ? array_values(array_filter($kategori, function ($item) {
                    return strtolower($item) === request('platform');
                    }))
                    : $kategori;
                    @endphp

                    <tbody class="bg-white text-gray-700 text-sm">
                        @foreach ($filteredKategori as $i => $item)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-3 whitespace-nowrap text-center">{{ $item }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-center">{{ $i + 1 }}-GF123ASD...</td>
                            <td class="px-4 py-3 whitespace-nowrap text-center">10-02-2025</td>
                            <td class="px-4 py-3 whitespace-nowrap text-center">13.40</td>
                            <td class="px-4 py-3 text-green-600 font-medium whitespace-nowrap text-center">Sukses</td>
                            <td class="px-4 py-3 whitespace-nowrap text-center">Cash</td>
                            <td class="px-4 py-3 font-semibold whitespace-nowrap text-center">Rp 23.000</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="flex justify-between items-center mt-4 px-4">
                <a href="#" class="text-gray-500 hover:text-orange-600 text-sm font-medium transition-colors">
                    &lt; Sebelumnya
                </a>
                <nav class="flex items-center gap-1 mb-4">
                    <a href="#"
                        style="font-family: sans-serif !important; font-size: 16px !important; color: white !important; display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; background-color: orange; border-radius: 9999px;">
                        1
                    </a>
                    <a href="#" class="w-8 h-8 flex items-center justify-center rounded-full text-gray-700 hover:bg-gray-100 hover:text-orange-500 text-sm font-medium transition-colors duration-200">
                        2
                    </a>
                    <a href="#" class="w-8 h-8 flex items-center justify-center rounded-full text-gray-700 hover:bg-gray-100 hover:text-orange-500 text-sm font-medium transition-colors duration-200">
                        3
                    </a>
                </nav>
                <a href="#" class="text-gray-500 hover:text-orange-600 text-sm font-medium transition-colors duration-200">
                    Selanjutnya &gt;
                </a>
            </div>
        </div>
    </main>
</div>

<!-- Modal Detail Transaksi -->
@include('components.detail-modal')

<!-- Modal Detail Download -->
@include('components.download-modal')

<!-- Modal Hapus -->
@include('components.hapus-modal')

<!-- Modal Berhasil Hapus -->
@include('components.berhasil-hapus-modal')

<!-- Modal Berhasil Unduh -->
@include('components.berhasil-unduh-modal')

<!-- Script -->
<script>
    document.getElementById('openDownloadModal').addEventListener('click', function() {
        document.getElementById('DownloadModal').classList.remove('hidden');
    });

    function openTransactionModal() {
        document.getElementById('transactionDetailModal').classList.remove('hidden');
    }

    function closeTransactionModal() {
        document.getElementById('transactionDetailModal').classList.add('hidden');
    }

    window.addEventListener('click', function(e) {
        const modal = document.getElementById('transactionDetailModal');
        if (e.target === modal) {
            closeTransactionModal();
        }
    });

    document.querySelectorAll('.btn-detail').forEach(button => {
        button.addEventListener('click', openTransactionModal);
    });

    document.querySelectorAll('.btn-hapus').forEach(button => {
        button.addEventListener('click', openHapusModal);
    });

    function openHapusModal() {
        document.getElementById('openHapusModal').classList.remove('hidden');
    }

    function closeHapusModal() {
        document.getElementById('openHapusModal').classList.add('hidden');
    }

    window.addEventListener('click', function(e) {
        const modal = document.getElementById('openHapusModal');
        if (e.target === modal) {
            closeHapusModal();
        }
    });
</script>

@endsection