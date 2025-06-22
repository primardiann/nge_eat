@extends('layouts.navigation')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
<div class="flex min-h-screen bg-[#FAFAFA] text-sm">
    <main class="flex-1 px-8 py-6">

        <!-- Breadcrumb -->
        <div class="text-gray-500 mb-4 flex items-center space-x-1">
            <a href="/dashboard" class="text-black font-semibold hover:underline">Dashboard</a>
            <span class="text-[#888]">></span>
            <span class="text-[#888]">Item Terjual Shopeefood</span>
        </div>

        <!-- Filter -->
        <form method="GET" class="flex flex-wrap justify-end mb-6 gap-2">
            <select name="day" class="border rounded-lg px-3 py-2">
                <option value="">Hari</option>
                @for ($i = 1; $i <= 31; $i++)
                    <option value="{{ $i }}" {{ $selectedDay == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>

            <select name="week" class="border rounded-lg px-3 py-2">
                <option value="">Minggu</option>
                @foreach ($weeksInMonth as $week)
                    <option value="{{ $week['number'] }}" {{ $selectedWeek == $week['number'] ? 'selected' : '' }}>
                        {{ $week['label'] }}
                    </option>
                @endforeach
            </select>

            <select name="month" class="border rounded-lg px-3 py-2">
                @foreach (range(1, 12) as $month)
                    <option value="{{ $month }}" {{ $selectedMonth == $month ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }}
                    </option>
                @endforeach
            </select>

            <select name="year" class="border rounded-lg px-3 py-2">
                @for ($y = now()->year; $y >= 2023; $y--)
                    <option value="{{ $y }}" {{ $selectedYear == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>

            <button type="submit"
                class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition duration-200">
                Filter
            </button>
        </form>

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
                        <tr class="border-t hover:bg-gray-50">
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

                <!-- Pagination dalam tabel -->
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
