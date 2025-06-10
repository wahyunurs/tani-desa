<nav class="bg-white border-b border-gray-500 w-full">
    <div class="max-w-screen-xl flex items-center justify-between mx-auto p-4">
        <button id="toggle-sidebar" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-black rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>

        <a href="{{ route('admin.index') }}" id="navbar-logo"
            class="flex items-center transition-all duration-300 hidden">
            <img src="{{ asset('images/logo.png') }}" class="h-8 me-3" alt="Tani Desa Logo">
            <span class="self-center text-2xl font-bold text-green-600">Tani</span>
            <span class="self-center text-2xl font-bold text-gray-800">Desa</span>
        </a>

        <div class="flex items-center space-x-3">
            <button type="button" class="flex text-sm rounded-full focus:ring-4 focus:ring-gray-500"
                id="user-menu-button" data-dropdown-toggle="user-dropdown">
                <div class="w-8 h-8 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 20h14v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2zm7-10a4 4 0 100-8 4 4 0 000 8z" />
                    </svg>
                </div>
            </button>

            <!-- Dropdown -->
            <div id="user-dropdown"
                class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-200 rounded-lg shadow-md">
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
                                Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
