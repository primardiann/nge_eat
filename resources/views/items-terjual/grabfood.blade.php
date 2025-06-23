@extends('layouts.navigation')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
<div class="flex min-h-screen bg-[#FAFAFA] text-sm">
    <main class="flex-1 px-8 py-6">

        <!-- Breadcrumb -->
        <div class="text-gray-500 mb-4 flex items-center space-x-1">
            <a href="/dashboard" class="text-black font-semibold hover:underline">Dashboard</a>
            <span class="text-[#888]">></span>
            <span class="text-[#888]">Item Terjual GrabFood</span>
        </div>

        <!-- Kalender Filter -->
        <div class="flex justify-end mb-6">
            @include('components.kalender-item-terjual')
        </div>

        <!-- Tabel Item Terjual -->
        <div class="bg-white rounded-xl shadow-md overflow-x-auto">
            <table class="min-w-full text-sm text-center">
                <thead class="bg-[#ffd5ab] text-gray-700 font-semibold">
                    <tr>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Kategori</th>
                        <th class="px-6 py-3">Nama Menu</th>
                        <th class="px-6 py-3">Harga</th>
                        <th class="px-6 py-3">Item Terjual</th>
                    </tr>
                </thead>
                <tbody class="bg-white text-gray-700">
                    @forelse ($items as $item)
                        <tr class="border-t hover:bg-gray-50" data-tanggal="{{ \Carbon\Carbon::createFromFormat('d-m-Y', $item->tanggal)->format('Y-m-d') }}">
                            <td class="px-6 py-3">{{ $item->tanggal }}</td>
                            <td class="px-6 py-3">{{ $item->kategori }}</td>
                            <td class="px-6 py-3">{{ $item->nama_menu }}</td>
                            <td class="px-6 py-3">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td class="px-6 py-3">{{ $item->item_terjual }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-gray-500 px-6 py-4">Tidak ada data.</td>
                        </tr>
                    @endforelse
                </tbody>

                <!-- Pagination -->
                <tfoot>
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center">
                            {{ $items->links('vendor.pagination.custom') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

    </main>
</div>
@endsection
