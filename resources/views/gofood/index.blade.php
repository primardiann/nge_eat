{{-- 
    Nama File: gofood/index.blade.php
    Deskripsi: Halaman ini menampilkan daftar transaksi GoFood, lengkap dengan fitur tambah, edit, lihat detail, dan hapus transaksi.
    Dibuat oleh: Masda Naswa - NIM: 3312301005
    Tanggal: 19 April 2025
--}}

@extends('layouts.navigation') {{-- Memanggil layout utama --}}
@vite(['resources/css/app.css', 'resources/js/app.js']) {{-- Load CSS & JS --}}

@section('content')
<main class="flex-1 px-4 md:px-8 py-6 max-w-screen-xl mx-auto">

    <!-- Breadcrumb navigasi halaman -->
    <div class="text-gray-500 mb-4 flex items-center space-x-1">
        <a href="/dashboard" class="text-black font-semibold hover:underline">Dashboard</a>
        <span class="text-[#888]">></span>
        <span class="text-[#888]">Transaksi GoFood</span>
    </div>

    <!-- Tombol Tambah & Kalender -->
    <div class="flex justify-between items-center mb-6 relative">
        <!-- Tombol Tambah Transaksi -->
        <div class="flex flex-col space-y-3">
            <button
                class="flex items-center gap-2 px-2 py-1 text-white font-medium rounded-lg btn-tambah"
                style="background-color: #F58220;">
                <span class="text-lg">+</span>
                <span>Tambah Transaksi</span>
            </button>
        </div>
        <!-- Komponen Kalender -->
        <div class="flex flex-col space-y-3">
            @include('components.kalender')
        </div>
    </div>

    <!-- Tabel Daftar Transaksi -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <table class="min-w-full table-auto">
            <!-- Header Tabel -->
            <thead class="bg-[#ffd5ab] text-gray-700 text-center text-sm font-semibold select-none">
                <tr>
                    <th class="px-6 py-3">ID Pesanan</th>
                    <th class="px-6 py-3">Tanggal</th>
                    <th class="px-6 py-3">Waktu</th>
                    <th class="px-6 py-3">Nama Pelanggan</th>
                    <th class="px-6 py-3">Metode Pembayaran</th>
                    <th class="px-6 py-3 max-w-[150px]">Item Pemesanan</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>

            <!-- Body Tabel -->
            <tbody class="text-gray-700 text-center text-sm">
                @if ($transaksi->isEmpty())
                    <!-- Jika tidak ada transaksi -->
                    <tr>
                        <td colspan="7" class="text-center py-4 text-gray-500 italic">
                            Belum ada transaksi untuk tanggal ini.
                        </td>
                    </tr>
                @else
                    <!-- Loop setiap transaksi -->
                    @foreach ($transaksi as $transaction)
                    @php
                        // Buat array item pesanan (nama x jumlah)
                        $itemList = $transaction->items->map(function($item) {
                            return $item->menu->name . ' x ' . $item->jumlah;
                        })->toArray();
                    @endphp
                    <tr class="border-t hover:bg-gray-50" data-tanggal="{{ $transaction->tanggal->format('Y-m-d') }}">
                        <td class="px-6 py-3 truncate max-w-[120px]">{{ $transaction->id_pesanan }}</td>
                        <td class="px-6 py-3">{{ $transaction->tanggal->format('d-m-Y') }}</td>
                        <td class="px-6 py-3">{{ \Carbon\Carbon::parse($transaction->waktu)->format('H:i') }}</td>
                        <td class="px-6 py-3">{{ $transaction->nama_pelanggan }}</td>
                        <td class="px-6 py-3">{{ $transaction->metode_pembayaran }}</td>

                        <!-- Tampilkan item pemesanan dengan tooltip -->
                        <td class="px-6 py-3 max-w-[150px] relative group cursor-default">
                            <div class="truncate">
                                {{ implode(', ', $itemList) }}
                            </div>
                            <div class="absolute left-1/2 -translate-x-1/2 mt-2 hidden group-hover:block bg-orange-100 text-black text-xs px-3 py-2 rounded shadow-lg z-50 min-w-max text-left whitespace-normal max-w-xs">
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach ($itemList as $item)
                                    <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </td>

                        <!-- Aksi: Lihat, Edit, Hapus -->
                        <td class="px-6 py-3">
                            <div class="flex justify-center items-center space-x-4 text-gray-500">
                                <!-- Tombol Lihat -->
                                <button
                                    class="btn-lihat flex items-center justify-center hover:text-yellow-600 transition"
                                    title="Lihat Detail"
                                    data-id="{{ $transaction->id_pesanan }}"
                                    data-tanggal="{{ $transaction->tanggal->format('d-m-Y') }}"
                                    data-waktu="{{ \Carbon\Carbon::parse($transaction->waktu)->format('H:i') }}"
                                    data-nama="{{ $transaction->nama_pelanggan }}"
                                    data-pembayaran="{{ $transaction->metode_pembayaran }}"
                                    data-item='@json($itemList)'
                                    data-total="{{ $transaction->total ?? '' }}"
                                    data-status="{{ $transaction->status ?? '' }}"
                                >
                                    <i class="fas fa-eye"></i>
                                </button>

                                <!-- Tombol Edit -->
                                <button
                                    class="btn-edit flex items-center justify-center text-blue-600 hover:text-blue-800 transition"
                                    title="Edit"
                                    onclick="openEditModal({{ $transaction->id }})">
                                    <i class="fas fa-pen-to-square"></i>
                                </button>

                                <!-- Tombol Hapus -->
                                <form action="{{ route('gofood.destroy', $transaction->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')" class="flex items-center justify-center m-0 p-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="flex items-center justify-center text-red-600 hover:text-red-800 transition" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <!-- Pagination custom -->
        <div class="p-4">
            {{ $transaksi->links('vendor.pagination.custom') }}
        </div>
    </div>
</main>
</div>

<!-- Modal Tambah Transaksi -->
@include('components.tambah-modal')

<!-- Modal Edit Transaksi -->
@include('components.edit-modal')

<!-- Modal Detail Transaksi -->
@include('components.detail-modal')

{{-- Script interaksi: modal, tombol edit, tombol lihat --}}
<script>
function openEditModal(transactionId) {
    // Ambil data transaksi lewat fetch
    fetch(`/gofood/${transactionId}/edit-json`)
        .then(response => response.json())
        .then(data => {
            showEditModal(data); // panggil modal edit
            document.getElementById('formEditTransaksi').action = `/gofood/update/${transactionId}`;
        })
        .catch(err => {
            alert('Gagal mengambil data transaksi');
            console.error(err);
        });
    
    const currentPage = new URLSearchParams(window.location.search).get('page') || 1;
    document.getElementById('formEditTransaksi').action = `/gofood/${transactionId}?page=${currentPage}`;
}

function openTambahModal() {
    document.getElementById('transactionTambahModal').classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('transactionEditModal').classList.add('hidden');
}

function closeTambahModal() {
    document.getElementById('transactionTambahModal').classList.add('hidden');
}

function openDetailModal() {
    document.getElementById('transactionDetailModal').classList.remove('hidden');
}

function closeDetailModal() {
    document.getElementById('transactionDetailModal').classList.add('hidden');
}

// Tutup modal kalau klik luar area modal
window.addEventListener('click', function (e) {
    const modalEdit = document.getElementById('transactionEditModal');
    if (e.target === modalEdit) closeEditModal();

    const modalTambah = document.getElementById('transactionTambahModal');
    if (e.target === modalTambah) closeTambahModal();

    const modalDetail = document.getElementById('transactionDetailModal');
    if (e.target === modalDetail) closeDetailModal();
});

// Event handler tombol Tambah
document.querySelectorAll('.btn-tambah').forEach(btn => btn.addEventListener('click', openTambahModal));

// Event handler tombol Edit
document.querySelectorAll('.btn-edit').forEach(btn => btn.addEventListener('click', function() {
    openEditModal(this.closest('tr').querySelector('.btn-edit').getAttribute('onclick').match(/\d+/)[0]);
}));

// Event handler tombol Lihat Detail
document.querySelectorAll('.btn-lihat').forEach(button => {
    button.addEventListener('click', function () {
        const id = this.dataset.id;
        const tanggal = this.dataset.tanggal;
        const waktu = this.dataset.waktu;
        const nama = this.dataset.nama;
        const metode = this.dataset.pembayaran;
        const items = JSON.parse(this.dataset.item || '[]');
        const total = this.dataset.total;
        const status = this.dataset.status;

        // Isi data ke modal
        document.getElementById('detail-id_pesanan').value = id;
        document.getElementById('detail-tanggal').value = tanggal;
        document.getElementById('detail-waktu').value = waktu;
        document.getElementById('detail-nama').value = nama;
        document.getElementById('detail-metode').value = metode;

        // Tampilkan status
        const statusField = document.getElementById('detail-status');
        if (status == 1 || status == '1' || status == 'sukses' || status == 'Sukses') {
            statusField.value = '✔️';
            statusField.classList.remove('text-red-600');
            statusField.classList.add('text-green-600');
        } else {
            statusField.value = '❌';
            statusField.classList.remove('text-green-600');
            statusField.classList.add('text-red-600');
        }

        // List item pesanan
        const ul = document.getElementById('detail-item-list');
        ul.innerHTML = '';
        items.forEach(i => {
            const li = document.createElement('li');
            li.textContent = i;
            ul.appendChild(li);
        });

        document.getElementById('detail-total-value').textContent = 'Rp ' + parseInt(total).toLocaleString('id-ID');
        openDetailModal();
    });
});
</script>
@endsection
