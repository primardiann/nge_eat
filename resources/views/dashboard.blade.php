@extends('layouts.navigation')

@section('content')
    <div class="p-6 space-y-6">
        <h1 class="text-xl font-semibold">Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Kartu Transaksi -->
            <div class="bg-white rounded-lg p-6 flex flex-col items-center justify-center space-y-2 shadow-sm"
                style="border: 2px solid #F58220;">
                <img src="{{ asset('images/transaksi.png') }}" alt="GoFood" class="w-10 h-10">
                <span class="text-center font-medium">Transaksi GoFood</span>
            </div>

            <div class="bg-white rounded-lg p-6 flex flex-col items-center justify-center space-y-2 shadow-sm"
                style="border: 2px solid #F58220;">
                <img src="{{ asset('images/transaksi.png') }}" alt="GrabFood" class="w-10 h-10">
                <span class="text-center font-medium">Transaksi GrabFood</span>
            </div>

            <div class="bg-white rounded-lg p-6 flex flex-col items-center justify-center space-y-2 shadow-sm"
                style="border: 2px solid #F58220;">
                <img src="{{ asset('images/transaksi.png') }}" alt="ShoopeFood" class="w-10 h-10">
                <span class="text-center font-medium">Transaksi ShoopeFood</span>
            </div>
        </div>

        <!-- Grafik Pendapatan -->
        <div class="bg-white rounded-lg p-6"
            style="border: 2px solid #F58220;">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h2 class="font-bold text-lg">Pendapatan</h2>
                    <p class="text-sm text-gray-600">Pendapatan store kuliner anda!</p>
                </div>
                <select class="border-2 rounded px-2 py-1 text-sm" style="border-color: #F58220;">
                    <option selected>2019</option>
                    <option selected>2020</option>
                    <option selected>2021</option>
                    <option selected>2022</option>
                    <option selected>2023</option>
                    <option selected>2024</option>
                    <option selected>2025</option>
                    <!-- Tambahan tahun lain jika diperlukan -->
                </select>
            </div>
            <!-- Placeholder chart -->
            <div class="w-full h-48 rounded mb-4 flex items-center justify-center">
    <img src="{{ asset('images/grafik.png') }}" alt="Grafik Pendapatan" class="h-full object-contain">
</div>

            <p class="text-sm font-semibold">Pendapatan <span class="text-black text-base">Rp.30.000.000</span></p>
        </div>
    </div>
@endsection