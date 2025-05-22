@extends('layouts.navigation')

@section('content')
    <div class="flex min-h-screen bg-[#FAFAFA] text-sm">
        <main class="flex-1 px-8 py-6">
            <!-- Breadcrumb -->
            <div class="text-gray-500 mb-4">
                <a href="/dashboard" class="text-black font-semibold hover:underline">Dashboard</a>
                <span class="text-[#888]">Transaksi GoFood</span>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col items-end space-y-3 mb-6 relative">
                {{-- Komponen Kalender --}}
                @include('components.kalender')

                <div class="flex space-x-3">
                    <button id ="openDownloadModal"
                            style="border: 2px solid #F58220;"
                            class="flex items-center text-orange-500 px-4 py-1.5 rounded hover:bg-orange-50 transition">
                        <i class="fas fa-download mr-2"></i> Unduh
                    </button>

                    <button id="openFilterModal"
                        style="border: 2px solid #F58220;"
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
                            <th class="px-6 py-3 font-medium">Tanggal</th>
                            <th class="px-6 py-3 font-medium">Waktu</th>
                            <th class="px-6 py-3 font-medium">ID pesanan</th>
                            <th class="px-6 py-3 font-medium">Status</th>
                            <th class="px-6 py-3 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white text-gray-700 text-sm">
                        @for ($i = 0; $i < 5; $i++)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-6 py-3">10-02-2025</td>
                                <td class="px-6 py-3">13.40</td>
                                <td class="px-6 py-3 truncate max-w-[120px]">5-GF123ASD...</td>
                                <td class="px-6 py-3 text-green-600 font-medium">Sukses</td>
                                <td class="px-6 py-3">
                                    <div class="flex space-x-3">
                                        <button title="Lihat" class="text-gray-600 hover:text-black transition btn-detail">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button title="Hapus" class="text-gray-600 hover:text-red-500 transition btn-hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
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
