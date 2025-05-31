@extends('layouts.navigation')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
<div class="flex min-h-screen bg-[#FAFAFA] text-sm">
    <main class="flex-1 px-8 py-6">
        <!-- Breadcrumb -->
        <div class="text-gray-500 mb-4 flex items-center space-x-1">
            <a href="/dashboard" class="text-black font-semibold hover:underline">Dashboard</a>
            <span class="text-[#888]">></span>
            <span class="text-[#888]">Daftar Menu</span>
        </div>

        <!-- Judul dan Tombol Tambah -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-xl font-semibold text-gray-800">Daftar Menu</h1>

            <button
                type="button"
                class="flex items-center gap-2 px-3 py-1 text-white font-medium rounded-lg"
                style="background-color: #F58220;"
                onclick="openModal()">
                <span class="text-lg">+</span>
                <span>Tambah Menu</span>
            </button>
        </div>

        <!-- Tabel Daftar Menu -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <table class="min-w-full text-center">
                <thead style="background-color: #FFE5D0;" class="text-gray-700 text-sm">
                    <tr>
                        <th class="px-6 py-3 font-medium">Nama Menu</th>
                        <th class="px-6 py-3 font-medium">Kategori</th>
                        <th class="px-6 py-3 font-medium">Harga GoFood</th>
                        <th class="px-6 py-3 font-medium">Harga GrabFood</th>
                        <th class="px-6 py-3 font-medium">Harga ShopeeFood</th>
                        <th class="px-6 py-3 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white text-gray-700 text-sm">
                    @foreach ($menus as $menu)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-6 py-3 truncate max-w-xs">{{ $menu->name }}</td>
                        <td class="px-6 py-3">{{ $menu->category ? $menu->category->name : '-' }}</td>

                        @php
                        $gofoodPrice = $menu->prices->firstWhere('platform.name', 'GoFood');
                        $grabfoodPrice = $menu->prices->firstWhere('platform.name', 'GrabFood');
                        $shopeefoodPrice = $menu->prices->firstWhere('platform.name', 'ShopeeFood');
                        @endphp

                        <td class="px-6 py-3">
                            {{ $gofoodPrice ? 'Rp ' . number_format($gofoodPrice->price, 0, ',', '.') : '-' }}
                        </td>
                        <td class="px-6 py-3">
                            {{ $grabfoodPrice ? 'Rp ' . number_format($grabfoodPrice->price, 0, ',', '.') : '-' }}
                        </td>
                        <td class="px-6 py-3">
                            {{ $shopeefoodPrice ? 'Rp ' . number_format($shopeefoodPrice->price, 0, ',', '.') : '-' }}
                        </td>

                        <td class="px-6 py-3 flex justify-center space-x-4">
                            <!-- Edit -->
                            <a href="{{ route('menus.edit', $menu->id) }}" class="text-blue-600 hover:text-blue-800" title="Edit">
                                <i class="fas fa-pen-to-square text-lg"></i>
                            </a>

                            <!-- Hapus -->
                            <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus menu ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800" title="Hapus">
                                    <i class="fas fa-trash-alt text-lg"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                    @if($menus->isEmpty())
                    <tr>
                        <td colspan="6" class="py-6 text-center text-gray-500">Belum ada data menu.</td>
                    </tr>
                    @endif
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="flex justify-between items-center mt-4 px-4">
                {{ $menus->links('pagination::tailwind') }}
            </div>
        </div>
    </main>
</div>

<!-- Modal Tambah Menu -->
<div id="modalTambahMenu" class="fixed inset-0 bg-black bg-opacity-40 hidden justify-center items-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative">
        <h2 class="text-xl font-semibold mb-4">Tambah Menu Baru</h2>

        {{-- Panggil komponen form --}}
        <x-menu-form :categories="$categories" :platforms="$platforms" />

        <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 text-xl font-bold">&times;</button>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('modalTambahMenu').classList.remove('hidden');
        document.getElementById('modalTambahMenu').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('modalTambahMenu').classList.remove('flex');
        document.getElementById('modalTambahMenu').classList.add('hidden');
    }
</script>
@endsection
