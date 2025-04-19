<div x-show="sidebarOpen"
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0 transform -translate-x-full"
     x-transition:enter-end="opacity-100 transform translate-x-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 transform translate-x-0"
     x-transition:leave-end="opacity-0 transform -translate-x-full"
     style="width: 250px; position: fixed; top: 0; left: 0; z-index: 100; height: 100vh; background-color: #fff; display: flex; flex-direction: column; padding: 20px 10px;">
    {{-- Logo --}}
    <div style="text-align: center; margin-bottom: 30px;">
        <a href="{{ route('dashboard') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 116px; width: 116px; margin: auto;">
        </a>
    </div>

    {{-- Menu Navigasi --}}
    <nav style="display: flex; flex-direction: column; gap: 20px;">
        <a href="{{ route('dashboard') }}" 
           style="padding: 10px 20px; border-radius: 8px; {{ request()->routeIs('dashboard') ? 'background-color: #FFE5D0; color: black; border: 2px solid #F58220;' : 'color: #333;' }} font-weight: 600; text-decoration: none;">
            Dashboard
        </a>
        <a href="{{ route('dashboard') }}" 
           style="padding: 10px 20px; border-radius: 8px; {{ request()->routeIs('gofood.*') ? 'background-color: #FFE5D0; color: black; border: 2px solid #F58220;' : 'color: #333;' }} font-weight: 600; text-decoration: none;">
            Transaksi GoFood
        </a>
        <a href="{{ route('dashboard') }}" 
           style="padding: 10px 20px; border-radius: 8px; {{ request()->routeIs('grabfood.*') ? 'background-color: #FFE5D0; color: black; border: 2px solid #F58220;' : 'color: #333;' }} font-weight: 600; text-decoration: none;">
            Transaksi GrabFood
        </a>
        <a href="{{ route('dashboard') }}" 
           style="padding: 10px 20px; border-radius: 8px; {{ request()->routeIs('shopeefood.*') ? 'background-color: #FFE5D0; color: black; border: 2px solid #F58220;' : 'color: #333;' }} font-weight: 600; text-decoration: none;">
            Transaksi ShopeeFood
        </a>
        <a href="{{ route('profile.edit') }}" 
           style="padding: 10px 20px; border-radius: 8px; {{ request()->routeIs('profile.edit') ? 'background-color: #FFE5D0; color: black; border: 2px solid #F58220;' : 'color: #333;' }} font-weight: 600; text-decoration: none;">
            Profil
        </a>
    </nav>
</div>
