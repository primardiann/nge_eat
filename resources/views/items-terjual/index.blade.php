@extends('layouts.navigation')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
<div class="flex min-h-screen bg-[#FAFAFA] text-sm">
    <main class="flex-1 px-8 py-6">
        <!-- Breadcrumb -->
        <div class="text-gray-500 mb-4 flex items-center space-x-1">
            <a href="/dashboard" class="text-black font-semibold hover:underline">Dashboard</a>
            <span class="text-[#888]">></span>
            <span class="text-[#888]">Item Terjual</span>
        </div>

        <!-- Filter -->
        <div class="flex justify-between items-center mb-6">
            <!-- Dropdown -->
            <div>
                <label for="platform" class="block mb-2 font-semibold text-gray-700">Pilih Platform:</label>
                <select
                    name="platform"
                    id="platform"
                    onchange="showData()"
                    class="border border-orange-500 rounded-lg px-4 py-2 w-48 focus:outline-none focus:ring-2 focus:ring-orange-300">
                    <option value="">-- Pilih Platform --</option>
                    <option value="gofood">GoFood</option>
                    <option value="grabfood">GrabFood</option>
                    <option value="shopeefood">ShopeeFood</option>
                </select>
            </div>

            <!-- Kalender -->
            <div>
                @include('components.kalender')
            </div>
        </div>

        <!-- Kontainer Data -->
        <div id="data-container">
            <p class="text-gray-500">Silakan pilih platform terlebih dahulu.</p>
        </div>
    </main>
</div>

<script>
const dataItems = {
    gofood: [
        { kategori: 'Rice Bowl', nama_menu: 'Nasi Ayam Matah', harga: 20000, item_terjual: 150 },
        { kategori: 'Minuman', nama_menu: 'Es Teh Manis', harga: 8000, item_terjual: 300 },
        { kategori: 'Snack', nama_menu: 'Keripik', harga: 10000, item_terjual: 50 },
        { kategori: 'Dessert', nama_menu: 'Es Krim', harga: 15000, item_terjual: 80 },
        { kategori: 'Rice Bowl', nama_menu: 'Nasi Goreng', harga: 22000, item_terjual: 120 },
        { kategori: 'Minuman', nama_menu: 'Jus Alpukat', harga: 15000, item_terjual: 90 },
    ],
    grabfood: [
        { kategori: 'Snack', nama_menu: 'Burger', harga: 25000, item_terjual: 120 },
        { kategori: 'Yang Nyegerin', nama_menu: 'Jus Jeruk', harga: 12000, item_terjual: 200 }
    ],
    shopeefood: [
        { kategori: 'Rice Bowl', nama_menu: 'Nasi Ayam Geprek', harga: 35000, item_terjual: 80 },
        { kategori: 'Yang Nyegerin', nama_menu: 'Kopi Susu', harga: 15000, item_terjual: 220 }
    ]
};

const rowsPerPage = 3;
let currentPage = 1;

function formatRupiah(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function showData(page = 1) {
    const platform = document.getElementById('platform').value;
    const container = document.getElementById('data-container');

    if (!platform) {
        container.innerHTML = '<p class="text-gray-500">Silakan pilih platform terlebih dahulu.</p>';
        return;
    }

    currentPage = page;
    const items = dataItems[platform] || [];
    let html = `
        <h2 class="text-lg font-semibold mb-4 text-gray-700">Data untuk platform: <span class="capitalize">${platform}</span></h2>
    `;

    if (items.length === 0) {
        html += '<p class="text-gray-500">Tidak ada data untuk platform ini.</p>';
    } else {
        const totalPages = Math.ceil(items.length / rowsPerPage);
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        const pageItems = items.slice(start, end);

        html += `
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <table class="min-w-full text-center">
                    <thead class="bg-[#ffd5ab] text-gray-700 text-sm font-semibold select-none">
                        <tr>
                            <th class="px-6 py-3">Kategori</th>
                            <th class="px-6 py-3">Nama Menu</th>
                            <th class="px-6 py-3">Harga</th>
                            <th class="px-6 py-3">Item Terjual</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white text-gray-700 text-sm">
        `;

        pageItems.forEach(item => {
            html += `
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-6 py-3">${item.kategori}</td>
                    <td class="px-6 py-3">${item.nama_menu}</td>
                    <td class="px-6 py-3">Rp ${formatRupiah(item.harga)}</td>
                    <td class="px-6 py-3">${item.item_terjual}</td>
                </tr>
            `;
        });

        html += `
                    </tbody>
                </table>

                <!-- Pagination di dalam container tabel -->
                <div class="flex justify-between items-center mt-4 px-4">
                    <button
                        onclick="showData(${page - 1})"
                        class="text-gray-500 hover:text-orange-600 text-sm font-medium transition-colors duration-200"
                        ${page === 1 ? 'disabled class="opacity-50 cursor-not-allowed"' : ''}>
                        &lt; Sebelumnya
                    </button>

                    <nav class="flex items-center gap-1 mb-4" aria-label="Pagination">
        `;

        for(let i = 1; i <= totalPages; i++) {
            html += `
                <button
                    onclick="showData(${i})"
                    aria-current="${i === page ? 'page' : undefined}"
                    class="w-8 h-8 flex items-center justify-center rounded-full text-sm font-medium transition-colors duration-200
                    ${i === page ? 'bg-orange-500 text-white' : 'text-gray-700 hover:bg-gray-100 hover:text-orange-500'}"
                    style="${i === page ? 'font-family: sans-serif !important; font-size: 16px !important;' : ''}">
                    ${i}
                </button>
            `;
        }

        html += `
                    </nav>

                    <button
                        onclick="showData(${page + 1})"
                        class="text-gray-500 hover:text-orange-600 text-sm font-medium transition-colors duration-200"
                        ${page === totalPages ? 'disabled class="opacity-50 cursor-not-allowed"' : ''}>
                        Selanjutnya &gt;
                    </button>
                </div>
            </div>
        `;
    }

    container.innerHTML = html;
}
</script>
@endsection
