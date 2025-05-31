<aside id="sidebar-admin"
    class="fixed top-0 left-0 z-40 w-64 h-screen bg-white text-gray-800 shadow-lg transform transition-transform duration-300">

    <div class="h-full py-4 overflow-y-auto">
        <a href="#" class="flex items-center mx-6 mb-8">
            <img src="{{ asset('images/logo.png') }}" class="h-10 me-3" alt="Tani Desa Logo" />
            <span class="self-center text-2xl font-bold text-green-600">Tani</span>
            <span class="self-center text-2xl font-bold text-gray-800">Desa</span>
        </a>

        <!-- Navigation Menu -->
        <ul class="space-y-3">
            @if (auth()->user()->role === 'admin')
                <li class="relative">
                    @if (request()->routeIs('admin.index'))
                        <span class="absolute left-0 top-0 bottom-0 w-1 bg-green-600 rounded-r-lg"></span>
                    @endif
                    <a href="{{ route('admin.index') }}"
                        class="flex items-center mx-6 p-3 rounded-lg group {{ request()->routeIs('admin.index') ? 'bg-green-500 text-white' : 'hover:bg-green-100' }}">

                        <svg class="shrink-0 w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path
                                d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                        </svg>
                        <span class="flex-1 ms-4 font-medium">Dashboard</span>
                    </a>
                </li>
                <li class="relative">
                    @if (request()->routeIs('admin.pengguna.index'))
                        <span class="absolute left-0 top-0 bottom-0 w-1 bg-green-600 rounded-r-lg"></span>
                    @endif
                    <a href="{{ route('admin.pengguna.index') }}"
                        class="flex mx-6 items-center p-2 rounded-lg group {{ request()->routeIs('admin.pengguna.index') ? 'bg-green-500 text-white' : 'hover:bg-green-100' }}">
                        <svg class="shrink-0 w-5 h-5 transition duration-75" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 18">
                            <path
                                d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                        </svg>
                        <span class="flex-1 ms-4 font-medium">Pengguna</span>
                    </a>
                </li>
                <li class="relative">
                    @if (request()->routeIs('admin.stok-barang.index'))
                        <span class="absolute left-0 top-0 bottom-0 w-1 bg-green-600 rounded-r-lg"></span>
                    @endif
                    <a href="{{ route('admin.stok-barang.index') }}"
                        class="flex items-center mx-6 p-2 rounded-lg group {{ request()->routeIs('admin.stok-barang.index') ? 'bg-green-500 text-white' : 'hover:bg-green-100' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="shrink-0 w-5 h-5 transition duration-75"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                            <path d="M3 9h18M9 21V9" />
                        </svg>
                        <span class="flex-1 ms-4 font-medium">Stok Barang</span>
                    </a>
                </li>
                <li class="relative">
                    @if (request()->routeIs('admin.permintaan-barang.index'))
                        <span class="absolute left-0 top-0 bottom-0 w-1 bg-green-600 rounded-r-lg"></span>
                    @endif
                    <a href="{{ route('admin.permintaan-barang.index') }}"
                        class="flex items-center mx-6 p-2 rounded-lg group {{ request()->routeIs('admin.permintaan-barang.index') ? 'bg-green-500 text-white' : 'hover:bg-green-100' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="shrink-0 w-5 h-5 transition duration-75"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <circle cx="9" cy="21" r="1" />
                            <circle cx="20" cy="21" r="1" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 001.99-1.73L23 6H6" />
                        </svg>
                        <span class="flex-1 ms-4 font-medium">Permintaan Barang</span>
                    </a>
                </li>
                <li class="relative">
                    @if (request()->routeIs('admin.distribusi-barang.index'))
                        <span class="absolute left-0 top-0 bottom-0 w-1 bg-green-600 rounded-r-lg"></span>
                    @endif
                    <a href="{{ route('admin.distribusi-barang.index') }}"
                        class="flex items-center mx-6 p-2 rounded-lg group {{ request()->routeIs('admin.distribusi-barang.index') ? 'bg-green-500 text-white' : 'hover:bg-green-100' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="shrink-0 w-5 h-5 transition duration-75"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <rect x="1" y="3" width="15" height="13" rx="2" ry="2" />
                            <path d="M16 8h4l3 3v5a2 2 0 0 1-2 2h-1.5a2 2 0 0 1-2-2v-1H16V8z" />
                            <circle cx="5.5" cy="18.5" r="1.5" />
                            <circle cx="18.5" cy="18.5" r="1.5" />
                        </svg>
                        <span class="flex-1 ms-4 font-medium">Distribusi Barang</span>
                    </a>
                </li>
                <li class="relative">
                    @if (request()->routeIs('admin.laporan.index'))
                        <span class="absolute left-0 top-0 bottom-0 w-1 bg-green-600 rounded-r-lg"></span>
                    @endif
                    <a href="{{ route('admin.laporan.index') }}"
                        class="flex items-center mx-6 p-2 rounded-lg group {{ request()->routeIs('admin.laporan.index') ? 'bg-green-500 text-white' : 'hover:bg-green-100' }}">
                        <svg class="shrink-0 w-5 h-5 transition duration-75" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.96 2.96 0 0 0 .13 5H5Z" />
                            <path
                                d="M6.737 11.061a2.961 2.961 0 0 1 .81-1.515l6.117-6.116A4.839 4.839 0 0 1 16 2.141V2a1.97 1.97 0 0 0-1.933-2H7v5a2 2 0 0 1-2 2H0v11a1.969 1.969 0 0 0 1.933 2h12.134A1.97 1.97 0 0 0 16 18v-3.093l-1.546 1.546c-.413.413-.94.695-1.513.81l-3.4.679a2.947 2.947 0 0 1-1.85-.227 2.96 2.96 0 0 1-1.635-3.257l.681-3.397Z" />
                            <path
                                d="M8.961 16a.93.93 0 0 0 .189-.019l3.4-.679a.961.961 0 0 0 .49-.263l6.118-6.117a2.884 2.884 0 0 0-4.079-4.078l-6.117 6.117a.96.96 0 0 0-.263.491l-.679 3.4A.961.961 0 0 0 8.961 16Zm7.477-9.8a.958.958 0 0 1 .68-.281.961.961 0 0 1 .682 1.644l-.315.315-1.36-1.36.313-.318Zm-5.911 5.911 4.236-4.236 1.359 1.359-4.236 4.237-1.7.339.341-1.699Z" />
                        </svg>
                        <span class="flex-1 ms-4 font-medium">Laporan</span>
                    </a>
                </li>

                {{-- Role Gudang --}}
            @elseif(auth()->user()->role === 'gudang')
                <li class="relative">
                    @if (request()->routeIs('gudang.index'))
                        <span class="absolute left-0 top-0 bottom-0 w-1 bg-green-600 rounded-r-lg"></span>
                    @endif
                    <a href="{{ route('gudang.index') }}"
                        class="flex items-center mx-6 p-2 rounded-lg group {{ request()->routeIs('gudang.index') ? 'bg-green-500 text-white' : 'hover:bg-green-100' }}">
                        <svg class="shrink-0 w-5 h-5 transition duration-75" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 18 18">
                            <path
                                d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                        </svg>
                        <span class="flex-1 ms-4 font-medium">Dashboard</span>
                    </a>
                </li>
                <li class="relative">
                    @if (request()->routeIs('gudang.stok-barang.index'))
                        <span class="absolute left-0 top-0 bottom-0 w-1 bg-green-600 rounded-r-lg"></span>
                    @endif
                    <a href="{{ route('gudang.stok-barang.index') }}"
                        class="flex items-center mx-6 p-2 rounded-lg group {{ request()->routeIs('gudang.stok-barang.index') ? 'bg-green-500 text-white' : 'hover:bg-green-100' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="shrink-0 w-5 h-5 transition duration-75"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                            <path d="M3 9h18M9 21V9" />
                        </svg>
                        <span class="flex-1 ms-4 font-medium">Stok Barang</span>
                    </a>
                </li>
                <li class="relative">
                    @if (request()->routeIs('gudang.permintaan-barang.index'))
                        <span class="absolute left-0 top-0 bottom-0 w-1 bg-green-600 rounded-r-lg"></span>
                    @endif
                    <a href="{{ route('gudang.permintaan-barang.index') }}"
                        class="flex items-center mx-6 p-2 rounded-lg group {{ request()->routeIs('gudang.permintaan-barang.index') ? 'bg-green-500 text-white' : 'hover:bg-green-100' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="shrink-0 w-5 h-5 transition duration-75"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <circle cx="9" cy="21" r="1" />
                            <circle cx="20" cy="21" r="1" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 001.99-1.73L23 6H6" />
                        </svg>
                        <span class="flex-1 ms-4 font-medium">Permintaan Barang</span>
                    </a>
                </li>
                <li class="relative">
                    @if (request()->routeIs('gudang.distribusi-barang.index'))
                        <span class="absolute left-0 top-0 bottom-0 w-1 bg-green-600 rounded-r-lg"></span>
                    @endif
                    <a href="{{ route('gudang.distribusi-barang.index') }}"
                        class="flex items-center mx-6 p-2 rounded-lg group {{ request()->routeIs('gudang.distribusi-barang.index') ? 'bg-green-500 text-white' : 'hover:bg-green-100' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="shrink-0 w-5 h-5 transition duration-75"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <rect x="1" y="3" width="15" height="13" rx="2" ry="2" />
                            <path d="M16 8h4l3 3v5a2 2 0 0 1-2 2h-1.5a2 2 0 0 1-2-2v-1H16V8z" />
                            <circle cx="5.5" cy="18.5" r="1.5" />
                            <circle cx="18.5" cy="18.5" r="1.5" />
                        </svg>
                        <span class="flex-1 ms-4 font-medium">Distribusi Barang</span>
                    </a>
                </li>

                {{-- Role Distributor --}}
            @elseif(auth()->user()->role === 'distributor')
                <li class="relative">
                    @if (request()->routeIs('distributor.index'))
                        <span class="absolute left-0 top-0 bottom-0 w-1 bg-green-600 rounded-r-lg"></span>
                    @endif
                    <a href="{{ route('distributor.index') }}"
                        class="flex items-center mx-6 p-2 rounded-lg group {{ request()->routeIs('distributor.index') ? 'bg-green-500 text-white' : 'hover:bg-green-100' }}">
                        <svg class="shrink-0 w-5 h-5 transition duration-75" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 18 18">
                            <path
                                d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                        </svg>
                        <span class="flex-1 ms-4 font-medium">Dashboard</span>
                    </a>
                </li>
                <li class="relative">
                    @if (request()->routeIs('distributor.permintaan-barang.index'))
                        <span class="absolute left-0 top-0 bottom-0 w-1 bg-green-600 rounded-r-lg"></span>
                    @endif
                    <a href="{{ route('distributor.permintaan-barang.index') }}"
                        class="flex items-center mx-6 p-2 rounded-lg group {{ request()->routeIs('distributor.permintaan-barang.index') ? 'bg-green-500 text-white' : 'hover:bg-green-100' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="shrink-0 w-5 h-5 transition duration-75"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <circle cx="9" cy="21" r="1" />
                            <circle cx="20" cy="21" r="1" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 001.99-1.73L23 6H6" />
                        </svg>
                        <span class="flex-1 ms-4 font-medium">Permintaan Barang</span>
                    </a>
                </li>
                <li class="relative">
                    @if (request()->routeIs('distributor.distribusi-barang.index'))
                        <span class="absolute left-0 top-0 bottom-0 w-1 bg-green-600 rounded-r-lg"></span>
                    @endif
                    <a href="{{ route('distributor.distribusi-barang.index') }}"
                        class="flex items-center mx-6 p-2 rounded-lg group {{ request()->routeIs('distributor.distribusi-barang.index') ? 'bg-green-500 text-white' : 'hover:bg-green-100' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="shrink-0 w-5 h-5 transition duration-75"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <rect x="1" y="3" width="15" height="13" rx="2" ry="2" />
                            <path d="M16 8h4l3 3v5a2 2 0 0 1-2 2h-1.5a2 2 0 0 1-2-2v-1H16V8z" />
                            <circle cx="5.5" cy="18.5" r="1.5" />
                            <circle cx="18.5" cy="18.5" r="1.5" />
                        </svg>
                        <span class="flex-1 ms-4 font-medium">Distribusi Barang</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</aside>
