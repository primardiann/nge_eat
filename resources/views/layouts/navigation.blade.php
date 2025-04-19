<!DOCTYPE html>
<html lang="en">
    <head>
        {{-- Bagian head berisi metadata dan link ke file CSS --}}
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name', 'Dashboard') }}</title>

        {{-- Link ke file CSS utama yang sudah di-generate oleh Laravel --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        {{-- Menggunakan Vite untuk menyertakan file app.js --}}
        @vite('resources/js/app.js')

        {{-- Stack untuk menambahkan style tambahan per halaman --}}
        @stack('styles')
    </head>
    <body style="margin: 0; font-family: Arial, sans-serif;" x-data="{ sidebarOpen: true }">

        {{-- Bagian layout utama dengan Flexbox --}}
        <div style="display: flex; height: 100vh; overflow: hidden;">

            {{-- Sidebar navigasi --}}
            <aside
                x-show="sidebarOpen"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform -translate-x-full"
                x-transition:enter-end="opacity-100 transform translate-x-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform translate-x-0"
                x-transition:leave-end="opacity-0 transform -translate-x-full"
                style="width: 250px; position: fixed; top: 0; left: 0; z-index: 100; height: 100vh; background-color: #fff; display: flex; flex-direction: column; padding: 20px 10px;">

                {{-- Logo yang ada di sidebar --}}
                <div style="text-align: center; margin-bottom: 30px;">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 116px; width: 116px; margin: auto;">
                    </a>
                </div>

                {{-- Navigasi menu di sidebar --}}
                <nav style="display: flex; flex-direction: column; gap: 20px;">
                    {{-- Link ke halaman Dashboard --}}
                    <a href="{{ route('dashboard') }}" 
                       style="padding: 10px 20px; border-radius: 8px; {{ request()->routeIs('dashboard') ? 'background-color: #FFE5D0; color: black; border: 2px solid #F58220;' : 'color: #333;' }} font-weight: 600; text-decoration: none;">
                        Dashboard
                    </a>
                    {{-- Link ke halaman Transaksi GoFood --}}
                    <a href="{{ route('dashboard') }}" 
                       style="padding: 10px 20px; border-radius: 8px; {{ request()->routeIs('gofood.*') ? 'background-color: #FFE5D0; color: black; border: 2px solid #F58220;' : 'color: #333;' }} font-weight: 600; text-decoration: none;">
                        Transaksi GoFood
                    </a>
                    {{-- Link ke halaman Transaksi GrabFood --}}
                    <a href="{{ route('dashboard') }}" 
                       style="padding: 10px 20px; border-radius: 8px; {{ request()->routeIs('grabfood.*') ? 'background-color: #FFE5D0; color: black; border: 2px solid #F58220;' : 'color: #333;' }} font-weight: 600; text-decoration: none;">
                        Transaksi GrabFood
                    </a>
                    {{-- Link ke halaman Transaksi ShopeeFood --}}
                    <a href="{{ route('dashboard') }}" 
                       style="padding: 10px 20px; border-radius: 8px; {{ request()->routeIs('shopeefood.*') ? 'background-color: #FFE5D0; color: black; border: 2px solid #F58220;' : 'color: #333;' }} font-weight: 600; text-decoration: none;">
                        Transaksi ShopeeFood
                    </a>
                    {{-- Link ke halaman Profil --}}
                    <a href="{{ route('profile.edit') }}" 
                       style="padding: 10px 20px; border-radius: 8px; {{ request()->routeIs('profile.edit') ? 'background-color: #FFE5D0; color: black; border: 2px solid #F58220;' : 'color: #333;' }} font-weight: 600; text-decoration: none;">
                        Profil
                    </a>
                </nav>

            </aside>

            {{-- Main Content Area --}}
            <div :style="{ marginLeft: sidebarOpen ? '250px' : '0px' }"
                 style="flex-grow: 1; display: flex; flex-direction: column; transition: margin-left 0.3s ease;">

                {{-- Topbar Section --}}
                <header style="height: 64px; background-color: #fff; border-bottom: 1px solid #ddd; display: flex; align-items: center; justify-content: space-between; padding: 0 20px;">

                    {{-- Tombol untuk toggle Sidebar --}}
                    <button @click="sidebarOpen = !sidebarOpen" style="font-size: 24px; cursor: pointer; background: none; border: none;">
                        ☰
                    </button>

                    {{-- Info User dan tombol logout --}}
                    <div style="display: flex; align-items: center; gap: 20px;">
                        <div style="text-align: right;">
                            <div style="font-size: 14px; font-weight: 600;">{{ Auth::user()->name }}</div>
                            <div style="font-size: 12px; color: #666;">{{ Auth::user()->email }}</div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" style="display: flex; align-items: center; gap: 8px;">
                            @csrf
                            <button type="submit" style="cursor: pointer; background: none; border: none; color: #333; display: flex; align-items: center; gap: 8px; font-weight: 600;">
                                {{-- Icon Logout --}}
                                <svg xmlns="http://www.w3.org/2000/svg" style="height: 20px; width: 20px; fill: currentColor;" viewbox="0 0 24 24">
                                    <path d="M16 17v-2h-4v-2h4v-2l5 3-5 3zm-2-14c1.103 0 2 .897 2 2v3h-2v-3h-10v14h10v-3h2v3c0 1.103-.897 2-2 2h-10c-1.103 0-2-.897-2-2v-14c0-1.103.897-2 2-2h10z"/>
                                </svg>
                                Keluar
                            </button>
                        </form>
                    </div>

                </header>

                {{-- Konten Halaman --}}
                <main style="flex-grow: 1; padding: 24px; background-color: #FAFAFA; overflow-y: auto;">
                    @yield('content')
                    {{-- Tempat konten dari halaman lain --}}
                </main>

            </div>

        </div>

        {{-- Stack untuk menambahkan script tambahan per halaman --}}
        @stack('scripts')

    </body>
</html>
