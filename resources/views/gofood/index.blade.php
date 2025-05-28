@extends('layouts.navigation')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
    <div class="flex min-h-screen bg-[#FAFAFA] text-sm">
        <main class="flex-1 px-8 py-6">
            <!-- Breadcrumb -->
            <div class="text-gray-500 mb-4 flex items-center space-x-1">
                <a href="/dashboard" class="text-black font-semibold hover:underline">Dashboard</a>
                <span class="text-[#888]">></span>
                <span class="text-[#888]">Transaksi GoFood</span>
            </div>

            <!-- Add Buttons and Calendar Button -->
            <div class="flex justify-between items-center mb-6 relative">
                <div class="flex flex-col space-y-3">
                    <button class="flex items-center gap-2 px-2 py-1 text-white font-medium rounded-lg btn-tambah"
                        style="background-color: #F58220;">
                        <span class="text-lg">+</span>
                        <span>Tambah Transaksi</span>
                    </button>
                </div>

                <div class="flex flex-col space-y-3">
                    {{-- Komponen Kalender --}}
                    @include('components.kalender')
                </div>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <table class="min-w-full">
                    <thead style="background-color: #FFE5D0;" class="text-gray-700 text-left text-sm text-center">
                        <tr>
                            <th class="px-6 py-3 font-medium">ID pesanan</th>
                            <th class="px-6 py-3 font-medium">Tanggal</th>
                            <th class="px-6 py-3 font-medium">Waktu</th>
                            <th class="px-6 py-3 font-medium">Nama Pelanggan</th>
                            <th class="px-6 py-3 font-medium">Metode Pembayaran</th>
                            <th class="px-6 py-3 font-medium">Item Pemesanan</th>
                            <th class="px-6 py-3 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white text-gray-700 text-sm text-center">
                        @foreach ($transaksi as $transaction)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-6 py-3 truncate max-w-[120px]">{{ $transaction->id_pesanan }}</td>
                                <td class="px-6 py-3">{{ $transaction->tanggal->format('d-m-Y') }}</td>
                                <td class="px-6 py-3">{{ \Carbon\Carbon::parse($transaction->waktu)->format('H:i') }}</td>
                                <td class="px-6 py-3">{{ $transaction->nama_pelanggan }}</td>
                                <td class="px-6 py-3">{{ $transaction->metode_pembayaran }}</td>

                                <!-- Item Pesanan dengan Tooltip -->
                                <td class="px-6 py-3 max-w-[120px] relative group">
                                    <div class="truncate cursor-default">
                                        {{ Str::limit($transaction->item_pesanan, 25) }}
                                    </div>
                                    <!-- Tooltip -->
                                    <div
                                        class="absolute left-1/2 -translate-x-1/2 mt-2 hidden group-hover:block bg-orange-100 text-black text-xs px-3 py-2 rounded shadow-lg z-50 min-w-max text-left">
                                        <ul class="list-disc list-inside space-y-1">
                                            @foreach (explode(',', $transaction->item_pesanan) as $item)
                                                <li>{{ trim($item) }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </td>

                                <!-- Aksi -->
                                <td class="px-6 py-3">
                                    <div class="flex space-x-3">
                                        <button title="Detail"
    class="text-gray-600 hover:text-blue-500 transition btn-lihat"
    onclick="openTransactionModal(this)"
    data-id="{{ $transaction->id_pesanan }}"
    data-tanggal="{{ $transaction->tanggal->format('d-m-Y') }}"
    data-waktu="{{ \Carbon\Carbon::parse($transaction->waktu)->format('H:i') }}"
    data-nama="{{ $transaction->nama_pelanggan }}"
    data-pembayaran="{{ $transaction->metode_pembayaran }}"
    data-item="{{ $transaction->item_pesanan }}"
    data-total="Rp {{ number_format($transaction->total, 0, ',', '.') }}"
    data-status="{{ $transaction->status ? 'Sukses' : 'Gagal' }}">
    <i class="fas fa-eye"></i>
</button>

                                        <button title="Edit" class="text-gray-600 hover:text-black transition btn-edit">
                                            <i class="fas fa-pen-to-square"></i>
                                        </button>
                                        <button title="Hapus" class="text-gray-600 hover:text-red-500 transition btn-hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

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

    <!-- Modal Edit Transaksi -->
    @include('components.edit-modal')

    <!-- Modal Tambah Transaksi -->
    @include('components.tambah-modal')

    <!-- Modal Hapus -->
    @include('components.hapus-modal')

    <!-- Modal Berhasil Hapus -->
    @include('components.berhasil-hapus-modal')

    <!-- Modal Berhasil Tambah -->
    @include('components.berhasil-tambah-modal')

    <!-- Modal Detal Transaksi -->
    @include ('components.detail-modal')


    <!-- Script -->
    <script>
        // Modal Edit Transaksi
        function openEditModal() {
            document.getElementById('transactionEditModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('transactionEditModal').classList.add('hidden');
        }

        // Modal Edit Transaksi
        function openTambahModal() {
            document.getElementById('transactionTambahModal').classList.remove('hidden');
        }

        function closeTambahModal() {
            document.getElementById('transactionTambahModal').classList.add('hidden');
        }

        // Klik luar modal tutup
        window.addEventListener('click', function (e) {
            const modal = document.getElementById('transactionEditModal');
            if (e.target === modal) {
                closeEditModal();
            }
        });

        // Tombol buka modal edit
        document.querySelectorAll('.btn-tambah').forEach(button => {
            button.addEventListener('click', openTambahModal);
        });

        // Tombol buka modal edit
        document.querySelectorAll('.btn-edit').forEach(button => {
            button.addEventListener('click', openEditModal);
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
        // Modal Detail Transaksi
        function openDetailModal() {
            document.getElementById('transactionDetailModal').classList.remove('hidden');
        }

        function closeDetailModal() {
            document.getElementById('transactionDetailModal').classList.add('hidden');
        }

        // Tombol buka modal detail
       document.querySelectorAll('.btn-lihat').forEach(button => {
    button.addEventListener('click', function () {
        // Ambil data dari atribut
        const id = this.dataset.id;
        const tanggal = this.dataset.tanggal;
        const waktu = this.dataset.waktu;
        const nama = this.dataset.nama;
        const metode = this.dataset.pembayaran;
        const item = this.dataset.item;
        const total = this.dataset.total;
        const status = this.dataset.status;

        // Isi input/detail
        document.getElementById('detail-id').value = id;
        document.getElementById('detail-tanggal').value = tanggal;
        document.getElementById('detail-waktu').value = waktu;
        document.getElementById('detail-nama').value = nama;
        document.getElementById('detail-metode').value = metode;
        document.getElementById('detail-status').value = status;

        // Update daftar item pesanan (ul > li)
        const ul = document.getElementById('detail-item-list');
        ul.innerHTML = '';
        item.split(',').forEach(i => {
            const li = document.createElement('li');
            li.textContent = i.trim();
            ul.appendChild(li);
        });

        // Update total
        document.getElementById('detail-total-value').textContent = total;

        // Tampilkan modal
        openDetailModal();
    });
});

        // Klik luar modal tutup
        window.addEventListener('click', function (e) {
            const modal = document.getElementById('transactionDetailModal');
            if (e.target === modal) {
                closeDetailModal();
            }
        });
    </script>
@endsection