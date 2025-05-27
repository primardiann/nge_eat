@extends('layouts.navigation')

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
            <div class="row mb-4" style="display: flex; gap: 20px;">
                <div style="flex: 1; min-width: 0;">
                    <div class="p-4 h-100" style="border: 1px solid #FCD9A3; border-radius: 12px; background-color: white;">
                        <div style="color: #1F2937; font-size: 18px; font-weight: 600; margin-bottom: 8px;">
                            Jumlah Transaksi
                        </div>
                        <div style="height: 1px; background-color: #FCD9A3; margin-bottom: 16px;"></div>
                        <div style="display: flex; align-items: baseline; color: #1F2937;">
                            <div style="font-size: 36px; font-weight: 700; line-height: 1;">113</div>
                            <div style="font-size: 16px; margin-left: 6px;">Transaksi</div>
                        </div>
                    </div>
                </div>

                <div style="flex: 1; min-width: 0;">
                    <div class="p-4 h-100" style="border: 1px solid #FCD9A3; border-radius: 12px; background-color: white;">
                        <div style="color: #1F2937; font-size: 18px; font-weight: 600; margin-bottom: 8px;">
                            Total Keseluruhan
                        </div>
                        <div style="height: 1px; background-color: #FCD9A3; margin-bottom: 16px;"></div>
                        <div style="display: flex; align-items: baseline; color: #1F2937;">
                            <div style="font-size: 36px; font-weight: 700; line-height: 1;">Rp 50.000.000</div>
                            <div style="font-size: 16px; margin-left: 6px;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Laporan Transaksi Card -->
            <div class="p-4"
                style="background-color: #fff; border-radius: 16px; box-shadow: 0px 2px 6px rgba(0,0,0,0.05); margin: 0 0 32px 0;">

                <!-- Baris Atas: Judul & Aksi -->
                <div class="flex justify-between items-center mb-4 flex-wrap gap-4">

                    <!-- Kiri: Judul -->
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
                        <button id="openFilterModal" style="border: 2px solid #F58220;"
                            class="flex items-center text-orange-500 px-4 py-1.5 rounded hover:bg-orange-50 transition">
                            <i class="fas fa-filter mr-2"></i> Filter
                        </button>

                    </div>
                </div>

                <!-- Table -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <table class="min-w-full">
                        <thead style="background-color: #FFE5D0;" class="text-gray-700 text-left text-sm">
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
                            $kategori = ['GoFood', 'GrabFood', 'ShopeeFood', 'GoFood', 'ShoopeFood'];
                        @endphp

                        <tbody class="bg-white text-gray-700 text-sm">
                            @for ($i = 0; $i < count($kategori); $i++)
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="px-4 py-3 whitespace-nowrap text-center">{{ $kategori[$i] }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-center">{{ $i + 1 }}-GF123ASD...</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-center">10-02-2025</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-center">13.40</td>
                                    <td class="px-4 py-3 text-green-600 font-medium whitespace-nowrap text-center">Sukses</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-center">Cash</td>
                                    <td class="px-4 py-3 font-semibold whitespace-nowrap text-center">Rp 23.000</td>
                                </tr>
                            @endfor
                        </tbody>

                    </table>
                </div>

                <!-- Pagination -->
                <div class="flex justify-between items-center mt-4 px-4">
                    <!-- Previous Link -->
                    <a href="#" class="text-gray-500 hover:text-orange-600 text-sm font-medium transition-colors">
                        &lt; Sebelumnya
                    </a>

                    <!-- Page Numbers -->
                    <nav class="flex items-center gap-1 mb-4">
                        <a href="#"
                            style="font-family: sans-serif !important; font-size: 16px !important; color: white !important; display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; background-color: orange; border-radius: 9999px;">
                            1
                        </a>

                        <a href="#" class="w-8 h-8 flex items-center justify-center rounded-full text-gray-700 hover:bg-gray-100 hover:text-orange-500 text-sm font-medium
                    transition-colors duration-200">
                            2
                        </a>
                        <a href="#" class="w-8 h-8 flex items-center justify-center rounded-full text-gray-700 hover:bg-gray-100 hover:text-orange-500 text-sm font-medium
                    transition-colors duration-200">
                            3
                        </a>
                    </nav>

                    <a href="#"
                        class="text-gray-500 hover:text-orange-600 text-sm font-medium transition-colors duration-200">
                        Selanjutnya &gt;
                    </a>

                </div>

            </div>

        </main>
    </div>

    <!-- Modal Filter -->
    @include('components.filter-modal')

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
        // Modal Filter
        document.getElementById('openFilterModal').addEventListener('click', function () {
            document.getElementById('filterModal').classList.remove('hidden');
        });

        // Modal Detail Transaksi
        function openTransactionModal() {
            document.getElementById('transactionDetailModal').classList.remove('hidden');
        }

        // Modal Download
        document.getElementById('openDownloadModal').addEventListener('click', function () {
            document.getElementById('DownloadModal').classList.remove('hidden');
        });

        function closeTransactionModal() {
            document.getElementById('transactionDetailModal').classList.add('hidden');
        }

        // Klik luar modal tutup
        window.addEventListener('click', function (e) {
            const modal = document.getElementById('transactionDetailModal');
            if (e.target === modal) {
                closeTransactionModal();
            }
        });

        // Tombol buka modal detail
        document.querySelectorAll('.btn-detail').forEach(button => {
            button.addEventListener('click', openTransactionModal);
        });

        // Tombol buka modal hapus
        document.querySelectorAll('.btn-hapus').forEach(button => {
            button.addEventListener('click', openHapusModal);
        });

        // Modal Hapus
        function openHapusModal() {
            document.getElementById('openHapusModal').classList.remove('hidden');
        }

        function closeHapusModal() {
            document.getElementById('openHapusModal').classList.add('hidden');
        }

        // Klik luar modal hapus
        window.addEventListener('click', function (e) {
            const modal = document.getElementById('openHapusModal');
            if (e.target === modal) {
                closeHapusModal();
            }
        });
    </script>

@endsection