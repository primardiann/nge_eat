<div x-show="sidebarOpen" x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 transform -translate-x-full"
    x-transition:enter-end="opacity-100 transform translate-x-0" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 transform translate-x-0"
    x-transition:leave-end="opacity-0 transform -translate-x-full"
    style="width: 250px; position: fixed; top: 0; left: 0; z-index: 45; height: 100vh; background-color: #fff; display: flex; flex-direction: column; padding: 20px 10px;">
    {{-- Logo --}}
    <div style="text-align: center; margin-bottom: 30px;">
        <a href="{{ route('dashboard') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 116px; width: 116px; margin: auto;">
        </a>
    </div>

    {{-- Menu Navigasi --}}
    <nav style="display: flex; flex-direction: column; gap: 20px;">
        <a href="{{ route('dashboard') }}"
            style="padding: 10px 20px; border-radius: 8px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; {{ request()->routeIs('dashboard') ? 'background-color: #FFE5D0; color: black; border: 2px solid #F58220;' : 'color: #333;' }}">
            <img src="{{ asset('images/dashboard.png') }}" alt="Dashboard"
                style="width: 20px; height: 20px; margin-right: 8px;">
            Dashboard
        </a>

        {{-- Transaksi GoFood --}}
        <a href="{{ route('gofood.index') }}"
            style="padding: 10px 20px; border-radius: 8px; font-weight: 600; text-decoration: none; 
                display: inline-flex; align-items: center; {{ request()->routeIs('gofood.*') ? 'background-color: #FFE5D0; color: black; border: 2px solid #F58220;' : 'color: #333;' }}">
            <img src="{{ asset('images/transaksi.png') }}" alt="Transaksi GoFood"
                style="width: 20px; height: 20px; margin-right: 8px;">
            Transaksi GoFood
        </a>

        {{-- Transaksi GrabFood --}}
        <a href="{{ route('grabfood.index') }}"
            style="padding: 10px 20px; border-radius: 8px; font-weight: 600; text-decoration: none; 
                display: inline-flex; align-items: center; {{ request()->routeIs('grabfood.*') ? 'background-color: #FFE5D0; color: black; border: 2px solid #F58220;' : 'color: #333;' }}">
            <img src="{{ asset('images/transaksi.png') }}" alt="Transaksi GrabFood"
                style="width: 20px; height: 20px; margin-right: 8px;">
            Transaksi GrabFood
        </a>

        {{-- Transaksi ShopeeFood --}}
        <a href="{{ route('shopeefood.index') }}"
            style="padding: 10px 20px; border-radius: 8px; font-weight: 600; text-decoration: none; 
                display: inline-flex; align-items: center; {{ request()->routeIs('shopeefood.*') ? 'background-color: #FFE5D0; color: black; border: 2px solid #F58220;' : 'color: #333;' }}">
            <img src="{{ asset('images/transaksi.png') }}" alt="Transaksi ShopeeFood"
                style="width: 20px; height: 20px; margin-right: 8px;">
            Transaksi ShopeeFood
        </a>

        {{-- Laporan Keuangan --}}
        <a href="{{ route('laporan.index') }}"
            style="padding: 10px 20px; border-radius: 8px; font-weight: 600; text-decoration: none; 
        display: inline-flex; align-items: center; {{ request()->routeIs('laporan.*') ? 'background-color: #FFE5D0; color: black; border: 2px solid #F58220;' : 'color: #333;' }}">
            <img src="{{ asset('images/laporan.png') }}" alt="Laporan Keuangan"
                style="width: 20px; height: 20px; margin-right: 8px;">
            Laporan Keuangan
        </a>


        {{-- Profil --}}
        <a href="{{ route('profile.edit') }}"
            style="padding: 10px 20px; border-radius: 8px; font-weight: 600; text-decoration: none; 
                display: inline-flex; align-items: center; {{ request()->routeIs('profile.edit') ? 'background-color: #FFE5D0; color: black; border: 2px solid #F58220;' : 'color: #333;' }}">
            <img src="{{ asset('images/profile.png') }}" alt="Profile"
                style="width: 20px; height: 20px; margin-right: 8px;">
            Profil
        </a>
    </nav>
</div>