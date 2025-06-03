@extends('layouts.navigation')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
<div>
    <h1 class="text-2xl font-bold mb-4">Daftar Item Terjual</h1>

    {{-- Container Flex untuk dropdown + kalender --}}
    <div class="flex items-center space-x-6 mb-6">
        {{-- Dropdown Pilih Platform --}}
        <div>
            <label for="platform" class="block mb-2 font-semibold">Pilih Platform:</label>
            <select name="platform" id="platform" onchange="showData()"
                class="border-2 border-orange-500 rounded px-3 py-2 w-48 focus:outline-none focus:ring-2 focus:ring-orange-300">
                <option value="">-- Pilih Platform --</option>
                <option value="gofood">GoFood</option>
                <option value="grabfood">GrabFood</option>
                <option value="shopeefood">ShopeeFood</option>
            </select>
        </div>

        {{-- Kalender --}}
        <div>
            @include('components.kalender')
        </div>
    </div>

    {{-- Table Item --}}
    <div id="data-container">
        <p>Silakan pilih platform terlebih dahulu.</p>
    </div>
</div>

<script>
    const dataItems = {
        gofood: [
            { kategori: 'Makanan', nama_menu: 'Nasi Goreng', harga: 20000, item_terjual: 150 },
            { kategori: 'Minuman', nama_menu: 'Es Teh Manis', harga: 8000, item_terjual: 300 }
        ],
        grabfood: [
            { kategori: 'Makanan', nama_menu: 'Burger', harga: 25000, item_terjual: 120 },
            { kategori: 'Minuman', nama_menu: 'Jus Jeruk', harga: 12000, item_terjual: 200 }
        ],
        shopeefood: [
            { kategori: 'Makanan', nama_menu: 'Sushi', harga: 35000, item_terjual: 80 },
            { kategori: 'Minuman', nama_menu: 'Kopi Susu', harga: 15000, item_terjual: 220 }
        ],
    };

    function formatRupiah(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function showData() {
        const platform = document.getElementById('platform').value;
        const container = document.getElementById('data-container');

        if (!platform) {
            container.innerHTML = '<p>Silakan pilih platform terlebih dahulu.</p>';
            return;
        }

        const items = dataItems[platform] || [];

        let html = `<h2 class="text-xl mb-2">Data untuk platform: <strong>${platform.charAt(0).toUpperCase() + platform.slice(1)}</strong></h2>`;

        if (items.length === 0) {
            html += '<p>Tidak ada data untuk platform ini.</p>';
        } else {
            html += `
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 px-4 py-2">Kategori</th>
                            <th class="border border-gray-300 px-4 py-2">Nama Menu</th>
                            <th class="border border-gray-300 px-4 py-2">Harga (Rp)</th>
                            <th class="border border-gray-300 px-4 py-2">Item Terjual</th>
                        </tr>
                    </thead>
                    <tbody>
            `;

            items.forEach(item => {
                html += `
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">${item.kategori}</td>
                        <td class="border border-gray-300 px-4 py-2">${item.nama_menu}</td>
                        <td class="border border-gray-300 px-4 py-2">${formatRupiah(item.harga)}</td>
                        <td class="border border-gray-300 px-4 py-2">${item.item_terjual}</td>
                    </tr>
                `;
            });

            html += `
                    </tbody>
                </table>
            `;
        }

        container.innerHTML = html;
    }
</script>
@endsection
