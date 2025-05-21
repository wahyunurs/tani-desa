<nav class="bg-green-600 border-b border-green-500">
    <div class="max-w-screen-xl flex items-center justify-between mx-auto p-4">
        <!-- Button Open Sidebar Menu -->
        <button id="toggle-sidebar" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-white rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
            <span class="sr-only">Open Sidebar Menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>

        <!-- Logo -->
        <a href="{{ route('admin.index') }}" id="navbar-logo"
            class="flex items-center transition-all duration-300 hidden">
            <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 me-3" alt="Tani Desa Logo">
            <span class="self-center text-xl font-semibold text-white">Tani Desa</span>
        </a>

        <!-- User Menu -->
        <div class="flex items-center md:order-2 space-x-3">
            <button type="button" class="flex text-sm bg-green-600 rounded-full focus:ring-4 focus:ring-green-500"
                id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                data-dropdown-placement="bottom">
                <span class="sr-only">Open user menu</span>
                @if (Auth::user()->foto_profil)
                    <img class="w-8 h-8 rounded-full" src="{{ asset(Auth::user()->foto_profil) }}" alt="user photo">
                @else
                    <div class="w-8 h-8 rounded-full flex items-center justify-center bg-green-500">
                        <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 20h14v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2zm7-10a4 4 0 100-8 4 4 0 000 8z"></path>
                        </svg>
                    </div>
                @endif
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
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-100 hover:text-green-700 transition duration-200">
                            Profil
                        </a>
                    </li>
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
    </div>
</nav>
