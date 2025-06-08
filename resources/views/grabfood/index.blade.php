@extends('layouts.navigation')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content') < div class = "flex min-h-screen bg-[#FAFAFA] text-sm" > <main class="flex-1 px-8 py-6">
    <!-- Breadcrumb -->
    <div class="text-gray-500 mb-4 flex items-center space-x-1">
        <a href="/dashboard" class="text-black font-semibold hover:underline">Dashboard</a>
        <span class="text-[#888]">></span>
        <span class="text-[#888]">Transaksi GrabFood</span>
    </div>

    <!-- Add Buttons and Calendar Button -->
    <div class="flex justify-between items-center mb-6 relative">
        <div class="flex flex-col space-y-3">
            <button
                class="flex items-center gap-2 px-2 py-1 text-white font-medium rounded-lg btn-tambah"
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
            <thead
                class="bg-[#ffd5ab] text-gray-700 text-center text-sm font-semibold select-none">
                <tr>
                    <th class="px-6 py-3">ID Pesanan</th>
                    <th class="px-6 py-3">Tanggal</th>
                    <th class="px-6 py-3">Waktu</th>
                    <th class="px-6 py-3">Nama Pelanggan</th>
                    <th class="px-6 py-3">Metode Pembayaran</th>
                    <th class="px-6 py-3">Item Pemesanan</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white text-gray-700 text-sm text-center">
                @foreach ($transaksi as $transaction)
                <tr
                    class="border-t hover:bg-gray-50"
                    data-tanggal="{{ $transaction->tanggal->format('Y-m-d') }}">
                    <td class="px-6 py-3 truncate max-w-[120px]">{{ $transaction->id_pesanan }}</td>
                    <td class="px-6 py-3">{{ $transaction->tanggal->format('d-m-Y') }}</td>
                    <td class="px-6 py-3">{{ \Carbon\Carbon::parse($transaction->waktu)->format('H:i') }}</td>
                    <td class="px-6 py-3">{{ $transaction->nama_pelanggan }}</td>
                    <td class="px-6 py-3">{{ $transaction->metode_pembayaran }}</td>

                    <!-- Item Pesanan dengan Tooltip -->
                    <td class="px-6 py-3 max-w-[150px] relative group cursor-default">
                        <div class="truncate">
                            {{ Str::limit($transaction->item_pesanan, 25) }}
                        </div>
                        <div
                            class="absolute left-1/2 -translate-x-1/2 mt-2 hidden group-hover:block bg-orange-100 text-black text-xs px-3 py-2 rounded shadow-lg z-50 min-w-max text-left whitespace-normal max-w-xs">
                            <ul class="list-disc list-inside space-y-1">
                                @foreach (explode(',', $transaction->item_pesanan) as $item)
                                <li>{{ trim($item) }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </td>

                    <!-- Aksi -->
                    <td class="px-6 py-3">
                        <div class="flex justify-center space-x-4 text-gray-600">
                            <button
                                class="btn-lihat hover:text-orange-600 transition"
                                title="Lihat Detail"
                                data-id="{{ $transaction->id_pesanan }}"
                                data-tanggal="{{ $transaction->tanggal->format('d-m-Y') }}"
                                data-waktu="{{ \Carbon\Carbon::parse($transaction->waktu)->format('H:i') }}"
                                data-nama="{{ $transaction->nama_pelanggan }}"
                                data-pembayaran="{{ $transaction->metode_pembayaran }}"
                                data-item="{{ $transaction->item_pesanan }}"
                                data-total="{{ $transaction->total ?? '' }}"
                                data-status="{{ $transaction->status ?? '' }}">
                                <i class="fas fa-eye"></i>
                            </button>

                            <button
                                class="btn-edit text-blue-600 hover:text-blue-800 transition"
                                title="Edit"
                                data-id="{{ $transaction->id }}">
                                <i class="fas fa-pen-to-square"></i>
                            </button>

                            <button
                                class="btn-hapus text-red-600 hover:text-red-800 transition"
                                title="Hapus"
                                onclick="openHapusModal('{{ $transaction->id }}')"
                                data-id="{{ $transaction->id }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach

            </tbody>

        </table>

        <!-- Pagination -->
        <div
            class="flex justify-between items-center mt-4 px-6 py-3 bg-white rounded-b-xl shadow-inner">
            <a
                href="#"
                class="text-gray-500 hover:text-orange-600 text-sm font-medium transition-colors">
                &lt; Sebelumnya
            </a>

            <nav class="flex items-center gap-2">
                <a
                    href="#"
                    class="inline-flex items-center justify-center w-8 h-8 text-white bg-orange-500 rounded-full font-semibold"
                    aria-current="page">
                    1
                </a>
                <a
                    href="#"
                    class="w-8 h-8 flex items-center justify-center rounded-full text-gray-700 hover:bg-gray-100 hover:text-orange-500 text-sm font-medium transition-colors duration-200">
                    2
                </a>
                <a
                    href="#"
                    class="w-8 h-8 flex items-center justify-center rounded-full text-gray-700 hover:bg-gray-100 hover:text-orange-500 text-sm font-medium transition-colors duration-200">
                    3
                </a>
            </nav>

            <a
                href="#"
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
// Modal functions
function openEditModal() {
    document
        .getElementById('transactionEditModal')
        .classList
        .remove('hidden');
}
function closeEditModal() {
    document
        .getElementById('transactionEditModal')
        .classList
        .add('hidden');
}

function openTambahModal() {
    document
        .getElementById('transactionTambahModal')
        .classList
        .remove('hidden');
}
function closeTambahModal() {
    document
        .getElementById('transactionTambahModal')
        .classList
        .add('hidden');
}

function openHapusModal(id) {
    const modal = document.getElementById('openHapusModal');
    modal
        .classList
        .remove('hidden');
    const confirmBtn = document.getElementById('confirmDeleteBtn');
    confirmBtn.setAttribute('data-id', id);
}
function closeHapusModal() {
    document
        .getElementById('openHapusModal')
        .classList
        .add('hidden');
}

function openDetailModal() {
    document
        .getElementById('transactionDetailModal')
        .classList
        .remove('hidden');
}
function closeDetailModal() {
    document
        .getElementById('transactionDetailModal')
        .classList
        .add('hidden');
}

// Close modal when clicking outside modal content
window.addEventListener('click', function (e) {
    const modalEdit = document.getElementById('transactionEditModal');
    if (e.target === modalEdit) 
        closeEditModal();
    
    const modalTambah = document.getElementById('transactionTambahModal');
    if (e.target === modalTambah) 
        closeTambahModal();
    
    const modalHapus = document.getElementById('openHapusModal');
    if (e.target === modalHapus) 
        closeHapusModal();
    
    const modalDetail = document.getElementById('transactionDetailModal');
    if (e.target === modalDetail) 
        closeDetailModal();
    }
);

// Event listeners for buttons
document
    .querySelectorAll('.btn-tambah')
    .forEach(btn => btn.addEventListener('click', openTambahModal));
document
    .querySelectorAll('.btn-edit')
    .forEach(btn => btn.addEventListener('click', openEditModal));

// Detail modal open with data attributes
document
    .querySelectorAll('.btn-lihat')
    .forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            const tanggal = this.dataset.tanggal;
            const waktu = this.dataset.waktu;
            const nama = this.dataset.nama;
            const metode = this.dataset.pembayaran;
            const item = this.dataset.item;
            const total = this.dataset.total;
            const status = this.dataset.status;

            document
                .getElementById('detail-id_pesanan')
                .value = id;
            document
                .getElementById('detail-tanggal')
                .value = tanggal;
            document
                .getElementById('detail-waktu')
                .value = waktu;
            document
                .getElementById('detail-nama')
                .value = nama;
            document
                .getElementById('detail-metode')
                .value = metode;
            document
                .getElementById('detail-status')
                .value = status;

            const ul = document.getElementById('detail-item-list');
            ul.innerHTML = '';

            // Split item berdasarkan koma dan tampilkan
            item
                .split(',')
                .forEach(i => {
                    const li = document.createElement('li');
                    li.textContent = i.trim();
                    ul.appendChild(li);
                });

            document
                .getElementById('detail-total-value')
                .textContent = 'Rp ' + parseInt(total).toLocaleString('id-ID');
            openDetailModal();
        });
    });
</script>
@endsection