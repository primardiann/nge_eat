@extends('layouts.navigation')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
<div class="p-6 space-y-6">
    <h1 class="text-xl font-semibold mb-4">Dashboard</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
        <!-- Kartu Transaksi GoFood  -->
        <a href="{{ route('gofood.index') }}" 
           class="block bg-white rounded-lg p-4 flex flex-col items-center justify-center space-y-3"
           style="border: 1px solid #F58220;">
            <span class="font-medium text-center">Transaksi GoFood</span>
            <img src="{{ asset('images/transaksi.png') }}" alt="Transaksi GoFood" class="w-12 h-12">
            <span
                class="bg-orange-500 hover:bg-orange-600 text-white text-xs px-4 py-1.5 rounded-full inline-flex items-center justify-between space-x-2 shadow-md transition duration-300 font-semibold cursor-pointer">
                <span>Selengkapnya</span>
                <span class="bg-white rounded-full p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-orange-500" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </span>
        </a>

        <!-- Kartu Transaksi GrabFood -->
        <a href="{{ route('grabfood.index') }}" 
           class="block bg-white rounded-lg p-4 flex flex-col items-center justify-center space-y-3"
           style="border: 1px solid #F58220;">
            <span class="font-medium text-center">Transaksi GrabFood</span>
            <img src="{{ asset('images/transaksi.png') }}" alt="Transaksi GrabFood" class="w-12 h-12">
            <span
                class="bg-orange-500 hover:bg-orange-600 text-white text-xs px-4 py-1.5 rounded-full inline-flex items-center justify-between space-x-2 shadow-md transition duration-300 font-semibold cursor-pointer">
                <span>Selengkapnya</span>
                <span class="bg-white rounded-full p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-orange-500" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </span>
        </a>

        <!-- Kartu Transaksi Shopeefood -->
        <a href="{{ route('shopeefood.index') }}" 
           class="block bg-white rounded-lg p-4 flex flex-col items-center justify-center space-y-3"
           style="border: 1px solid #F58220;">
            <span class="font-medium text-center">Transaksi ShopeeFood</span>
            <img src="{{ asset('images/transaksi.png') }}" alt="Transaksi GoFood" class="w-12 h-12">
            <span
                class="bg-orange-500 hover:bg-orange-600 text-white text-xs px-4 py-1.5 rounded-full inline-flex items-center justify-between space-x-2 shadow-md transition duration-300 font-semibold cursor-pointer">
                <span>Selengkapnya</span>
                <span class="bg-white rounded-full p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-orange-500" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </span>
        </a>

        <!-- Kartu Laporan Transaksi -->
        <a href="{{ route('laporan.index') }}" 
           class="block bg-white rounded-lg p-4 flex flex-col items-center justify-center space-y-3"
           style="border: 1px solid #F58220;">
            <span class="font-medium text-center">Laporan Transaksi</span>
            <img src="{{ asset('images/laporan.png') }}" alt="Laporan Transaksi" class="w-12 h-12">
            <span
                class="bg-orange-500 hover:bg-orange-600 text-white text-xs px-4 py-1.5 rounded-full inline-flex items-center justify-between space-x-2 shadow-md transition duration-300 font-semibold cursor-pointer">
                <span>Selengkapnya</span>
                <span class="bg-white rounded-full p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-orange-500" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </span>
        </a>
    </div>

    <!-- Grafik Pendapatan -->
    <div class="bg-white rounded-lg p-6 mt-6" style="border: 1px solid #F58220;">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h2 class="font-bold text-lg">Pendapatan</h2>
                <p class="text-sm text-gray-600">Pendapatan store kuliner anda!</p>
            </div>
            <select class="border rounded px-3 py-1 text-sm font-medium" style="border-color: #F58220;">
                <option>2019</option>
                <option>2020</option>
                <option>2021</option>
                <option>2022</option>
                <option>2023</option>
                <option selected>2024</option>
                <option>2025</option>
            </select>
        </div>
        <div class="w-full h-48 rounded mb-4">
            <img src="{{ asset('images/grafik.png') }}" alt="Grafik Pendapatan" class="h-full w-full object-contain" />
        </div>

        <p class="text-sm font-semibold">Pendapatan <span class="text-black text-base">Rp.30.000.000</span></p>
    </div>
</div>
@endsection
