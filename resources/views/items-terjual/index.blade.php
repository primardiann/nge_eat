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

        <!-- Judul -->
        <h1 class="text-xl font-semibold text-gray-800 mb-6">Daftar Item Terjual</h1>

        <!-- Filter -->
        <div class="flex justify-between items-center mb-6">
            <!-- Dropdown -->
            <div>
                <label for="platform" class="block mb-2 font-semibold text-gray-700">Pilih Platform:</label>
                <select name="platform" id="platform" onchange="showData()"
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
        <div id="data-container" class="bg-white rounded-xl shadow-md overflow-hidden px-6 py-4">
            <p class="text-gray-500">Silakan pilih platform terlebih dahulu.</p>
        </div>
    </main>
</div>

<script>
    const dataItems = {
        gofood: [{
                kategori: 'Rice Bowl',
                nama_menu: 'Nasi Ayam Matah',
                harga: 20000,
                item_terjual: 150
            },
            {
                kategori: 'Minuman',
                nama_menu: 'Es Teh Manis',
                harga: 8000,
                item_terjual: 300
            }
        ],
        grabfood: [{
                kategori: 'Snack',
                nama_menu: 'Burger',
                harga: 25000,
                item_terjual: 120
            },
            {
                kategori: 'Yang Nyegerin',
                nama_menu: 'Jus Jeruk',
                harga: 12000,
                item_terjual: 200
            }
        ],
        shopeefood: [{
                kategori: 'Rice Bowl',
                nama_menu: 'Nasi Ayam Geprek',
                harga: 35000,
                item_terjual: 80
            },
            {
                kategori: 'Yang Nyegerin',
                nama_menu: 'Kopi Susu',
                harga: 15000,
                item_terjual: 220
            }
        ],
    };

    function formatRupiah(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function showData() {
        const platform = document.getElementById('platform').value;
        const container = document.getElementById('data-container');

        if (!platform) {
            container.innerHTML = '<p class="text-gray-500">Silakan pilih platform terlebih dahulu.</p>';
            return;
        }

        const items = dataItems[platform] || [];

        let html = `
            <h2 class="text-lg font-semibold mb-4 text-gray-700">Data untuk platform: <span class="capitalize">${platform}</span></h2>
        `;

        if (items.length === 0) {
            html += '<p class="text-gray-500">Tidak ada data untuk platform ini.</p>';
        } else {
            html += `
              <table class="min-w-full text-center rounded-t-xl overflow-hidden">
   <thead style="background-color:  #ffd5ab;" class="text-gray-800 text-sm">

        <tr>
            <th class="px-6 py-3 font-medium">Kategori</th>
            <th class="px-6 py-3 font-medium">Nama Menu</th>
            <th class="px-6 py-3 font-medium">Harga</th>
            <th class="px-6 py-3 font-medium">Item Terjual</th>
        </tr>
    </thead>
                    <tbody class="bg-white text-gray-700 text-sm">
            `;

            items.forEach(item => {
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
            `;
        }

        container.innerHTML = html;
    }
</script>
@endsection