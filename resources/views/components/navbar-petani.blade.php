<!-- Navbar -->
<header class="fixed top-0 left-0 right-0 z-50 bg-white shadow-sm">
    <nav class="flex items-center justify-between p-6 bg-white shadow-md">
        <div class="flex items-center">
            <img src="{{ asset('images/logo.png') }}" class="h-8 w-8" alt="Logo">
            <span class="ml-2 text-2xl font-bold text-green-800">Tani Desa</span>
        </div>
        <ul class="flex gap-6 text-sm">
            <li>
                <a href="{{ route('petani.index') }}"
                    class="{{ request()->routeIs('petani.index') ? 'text-green-600 border-b-2 border-green-600' : 'hover:text-green-600' }} pb-1">
                    Beranda
                </a>
            </li>
            <li>
                <a href="{{ route('petani.barang.index') }}"
                    class="{{ request()->routeIs('petani.barang.index') ? 'text-green-600 border-b-2 border-green-600' : 'hover:text-green-600' }} pb-1">
                    Produk
                </a>
            </li>
            <li>
                <a href="{{ route('petani.permintaan.index') }}"
                    class="{{ request()->routeIs('petani.permintaan.index') ? 'text-green-600 border-b-2 border-green-600' : 'hover:text-green-600' }} pb-1">
                    Permintaan
                </a>
            </li>
        </ul>
        <!-- User Menu -->
        <div class="flex items-center md:order-2 space-x-3">
            <button type="button" class="flex text-sm rounded-full focus:ring-4 focus:ring-gray-300"
                id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                data-dropdown-placement="bottom">
                <span class="sr-only">Open user menu</span>
                <div class="w-8 h-8 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-black" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 20h14v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2zm7-10a4 4 0 100-8 4 4 0 000 8z"></path>
                    </svg>
                </div>
            </button>
            <!-- Dropdown menu -->
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-200 rounded-lg shadow-md"
                id="user-dropdown">
                <div class="px-4 py-3 bg-gray-100 rounded-t-lg">
                    <span class="block text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</span>
                    <span class="block text-sm text-gray-500 truncate">{{ Auth::user()->email }}</span>
                </div>
                <ul class="py-2 bg-white rounded-b-lg">
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-red-100 hover:text-red-700 transition duration-200">
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
