{{-- filepath: d:\laravel\nge_eat\resources\views\laporan\index.blade.php --}}
@extends('layouts.navigation')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
<div class="flex min-h-screen bg-[#FAFAFA] text-sm">
    <main class="flex-1 px-8 py-6">

        <!-- Breadcrumb -->
        <nav class="text-gray-500 mb-4 flex items-center space-x-1" aria-label="Breadcrumb">
            <a href="/dashboard" class="text-black font-semibold hover:underline">Dashboard</a>
            <span class="text-[#888]">></span>
            <span class="text-[#888]">Laporan Transaksi</span>
        </nav>

        <!-- Info Cards -->
        <div class="flex gap-5 flex-wrap mb-4">
            <!-- Card 1: Item Terjual -->
            <div class="flex-1 min-w-[280px] max-w-[350px] relative">
                <div class="p-5 h-full rounded-lg bg-white border border-[#FCD9A3] shadow-sm">
                    <div class="bg-white shadow rounded-xl p-5">
                        <div class="text-[#1F2937] text-lg font-semibold mb-1 flex items-center justify-between">
                            <span>Item Terjual</span>
                            <!-- Tooltip Icon -->
                            <div class="relative group cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hover:text-orange-500 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 18a6 6 0 110-12 6 6 0 010 12z"/>
                                </svg>
                                <div class="absolute bottom-full mb-2 left-1/2 transform -translate-x-1/2 w-48 bg-gray-800 text-white text-xs rounded px-3 py-2 opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity z-50">
                                    <strong>Rincian:</strong><br>
                                    • GoFood: {{ $totalGoFood }} item<br>
                                    • GrabFood: {{ $totalGrabFood }} item<br>
                                    • ShopeeFood: {{ $totalShopeeFood }} item
                                </div>
                            </div>
                        </div>
                        <div class="text-sm text-gray-500 mb-3">Bulan Ini</div>
                        <div class="h-[1px] bg-[#FCD9A3] mb-4"></div>
                        <div class="flex items-baseline text-[#1F2937] mb-2">
                            <div class="text-4xl font-extrabold leading-none">{{ $totalAll }}</div>
                            <div class="text-base ml-2">Item</div>
                        </div>
                        <!-- Progress Bar Gabungan -->
                        <div class="mb-2">
                            <div class="text-sm text-gray-600 mb-1 flex justify-between">
                                <span>Distribusi Pesanan</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden flex">
                                <div class="bg-orange-400 h-4" style="width: {{ $percentageGoFood }}%"></div>
                                <div class="bg-green-400 h-4" style="width: {{ $percentageGrabFood }}%"></div>
                                <div class="bg-pink-400 h-4" style="width: {{ $percentageShopeeFood }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           <!-- Card 2: Jumlah Transaksi -->
            <div class="flex-1 min-w-[280px] max-w-[350px] relative">
                <div class="p-5 h-full rounded-lg bg-white border border-[#FCD9A3] shadow-sm">
                    <div class="bg-white shadow rounded-xl p-5">
                        <div class="text-[#1F2937] text-lg font-semibold mb-1 flex items-center justify-between">
                            <span>Jumlah Transaksi</span>
                            <!-- Tooltip Icon -->
                            <div class="relative group cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hover:text-orange-500 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 18a6 6 0 110-12 6 6 0 010 12z"/>
                                </svg>
                                <div class="absolute bottom-full mb-2 left-1/2 transform -translate-x-1/2 w-48 bg-gray-800 text-white text-xs rounded px-3 py-2 opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity z-50">
                                    <strong>Rincian:</strong><br>
                                    • GoFood: {{ $totalTransaksiGoFood }} transaksi<br>
                                    • GrabFood: {{ $totalTransaksiGrabFood }} transaksi<br>
                                    • ShopeeFood: {{ $totalTransaksiShopeeFood }} transaksi
                                </div>
                            </div>
                        </div>
                        <div class="text-sm text-gray-500 mb-3">Bulan Ini</div>
                        <div class="h-[1px] bg-[#FCD9A3] mb-4"></div>
                        <div class="flex items-baseline text-[#1F2937] mb-2">
                            <div class="text-4xl font-extrabold leading-none">{{ $totalTransaksi }}</div>
                            <div class="text-base ml-2">Transaksi</div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Card 3: Total Keseluruhan -->
            <div class="flex-1 min-w-[280px] max-w-[350px] relative">
                <div class="p-5 h-full rounded-lg bg-white border border-[#FCD9A3] shadow-sm">
                    <div class="bg-white shadow rounded-xl p-5">
                        <div class="text-[#1F2937] text-lg font-semibold mb-1 flex items-center justify-between">
                            <span>Total Keseluruhan</span>
                            <!-- Tooltip Icon -->
                            <div class="relative group cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hover:text-orange-500 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 18a6 6 0 110-12 6 6 0 010 12z"/>
                                </svg>
                                <div class="absolute bottom-full mb-2 left-1/2 transform -translate-x-1/2 w-52 bg-gray-800 text-white text-xs rounded px-3 py-2 opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity z-50">
                                    <strong>Rincian:</strong><br>
                                    • GoFood: Rp {{ number_format($totalPendapatanGoFood, 0, ',', '.') }}<br>
                                    • GrabFood: Rp {{ number_format($totalPendapatanGrabFood, 0, ',', '.') }}<br>
                                    • ShopeeFood: Rp {{ number_format($totalPendapatanShopeeFood, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                        <div class="text-sm text-gray-500 mb-3">Bulan Ini</div>
                        <div class="h-[1px] bg-[#FCD9A3] mb-4"></div>
                        <div class="flex items-baseline text-[#1F2937] mb-2">
                            <div class="text-2xl sm:text-4xl font-extrabold leading-none">
                                Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Laporan Transaksi Card -->
        <div class="p-4 bg-white rounded-2xl shadow-md mb-8">
            <div class="flex justify-between items-center mb-4 flex-wrap gap-4">
                <h5 class="mb-0 fw-bold text-[#1F2937] text-2xl font-bold">Laporan Transaksi</h5>
                
                                <!-- Kanan: Kalender + Tombol Unduh & Filter -->
                <div class="flex items-center flex-wrap gap-3">
                    <!-- Komponen Kalender -->
                    <div class="flex items-center space-x-2">
                        @include('components.kalender-laporan')
                        <button onclick="window.location.href='{{ route('laporan.index') }}'" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm">
                            Reset Filter
                        </button>
                    </div>

                    <!-- Tombol Unduh (Trigger Modal) -->
                    <div class="flex">
                        <button onclick="openModal()" style="border: 2px solid #F58220;" class="flex items-center px-4 py-1.5 rounded hover:bg-orange-50 transition">
                            <i class="fas fa-file-download mr-2 text-orange-500"></i> Unduh Laporan
                        </button>
                    </div>

                    <!-- Dropdown Filter Platform -->
                    <form method="GET" action="" class="flex items-center m-0 p-0">
                        <select name="platform" onchange="this.form.submit()"
                            class="appearance-none border-2 border-orange-400 px-4 py-1.5 rounded hover:bg-orange-50 transition cursor-pointer bg-white pr-8 min-h-[38px] leading-none">
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
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-[#ffd5ab] text-center font-semibold select-none">
                        <tr>
                            <th class="px-4 py-3">Kategori</th>
                            <th class="px-4 py-3">ID Pesanan</th>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Waktu</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Metode Pembayaran</th>
                            <th class="px-4 py-3">Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @forelse ($transaksi as $t)
                            <tr class="border-t hover:bg-gray-50 text-center" data-tanggal="{{ $t->tanggal }}">
                                <td class="px-4 py-3">{{ $t->kategori }}</td>
                                <td class="px-4 py-3">{{ $t->id_pesanan }}</td>
                                <td class="px-4 py-3">{{ \Carbon\Carbon::parse($t->tanggal)->format('d-m-Y') }}</td>
                                <td class="px-4 py-3">{{ \Carbon\Carbon::parse($t->waktu)->format('H:i') }}</td>
                                <td class="px-4 py-3 text-green-600 font-medium">{{ $t->status ? 'Sukses' : 'Gagal' }}</td>
                                <td class="px-4 py-3">{{ $t->metode_pembayaran }}</td>
                                <td class="px-4 py-3 font-semibold">Rp {{ number_format($t->total, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-6 text-gray-400 italic text-center">
                                    Tidak ada data transaksi.
                                </td>
                            </tr>
                    @endforelse
                           {{--  <tr>
                                <td colspan="7" class="px-4 py-3 text-gray-500 text-center">
                                    Menampilkan {{ $transaksi->count() }} dari {{ $transaksi->total() }} transaksi.
                                </td>
                            </tr> --}}

                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="p-4">
                {{ $transaksi->links('vendor.pagination.custom') }}
            </div>
        </div>
    </main>
</div>

<!-- Modal Unduh -->
<div id="DownloadModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-md shadow-md p-6 w-full max-w-xl">
        <h2 class="text-xl text-center font-semibold mb-4 border-b pb-2 text-gray-700" style="border-color: #C0C0C0;">Unduh Laporan Transaksi</h2>
        <div class="flex flex-col sm:flex-row justify-center gap-4 mt-6">
            <a href="{{ route('laporan.download.excel', request()->all()) }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm text-center block w-full sm:w-auto">
                <i class="fas fa-file-excel mr-1"></i> Unduh Excel
            </a>
            <a href="{{ route('laporan.download.pdf', request()->all()) }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm text-center block w-full sm:w-auto">
                <i class="fas fa-file-pdf mr-1"></i> Unduh PDF
            </a>
        </div>
        <div class="text-center mt-6">
            <button id="closeDownloadModal" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-1 rounded">Tutup</button>
        </div>
    </div>
</div>

<!-- Modals -->
@include('components.detail-modal')
@include('components.download-modal')
@include('components.hapus-modal')
@include('components.berhasil-hapus-modal')
@include('components.berhasil-unduh-modal')

<!-- Script -->
<script>
    function openModal() {
        document.getElementById('DownloadModal').classList.remove('hidden');
    }
    function closeModal() {
        document.getElementById('DownloadModal').classList.add('hidden');
    }
    document.getElementById('closeDownloadModal').addEventListener('click', closeModal);

    function openTransactionModal() {
        document.getElementById('transactionDetailModal').classList.remove('hidden');
    }
    function closeTransactionModal() {
        document.getElementById('transactionDetailModal').classList.add('hidden');
    }
    window.addEventListener('click', function (e) {
        const modal = document.getElementById('transactionDetailModal');
        if (e.target === modal) {
            closeTransactionModal();
        }
        const hapusModal = document.getElementById('openHapusModal');
        if (e.target === hapusModal) {
            closeHapusModal();
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
</script>
@endsection