<x-guest-layout>
    <x-navbar-petani />
    <main class="min-h-screen">
        <x-session-modal />

        <!-- Barang Section -->
        <section id="barang" class="min-h-screen bg-green-50">
            <div class="container mx-auto px-5 py-5">
                <!-- Section Header -->
                <div class="text-center mb-9">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6 mt-20">Daftar Barang</h2>
                </div>

                <!-- Search and Tabs -->
                <div class="flex flex-col md:flex-row items-center justify-between mb-8">
                    <!-- Search -->
                    <form method="GET" action="{{ route('petani.barang.index') }}"
                        class="relative w-full md:w-2/3 mb-4 md:mb-0">
                        <input type="text" name="search" id="search" placeholder="Cari barang..."
                            value="{{ request('search') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        <button type="submit" class="absolute right-2 top-2 text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </form>

                    <!-- Tabs -->
                    <div class="flex space-x-1">
                        <a href="{{ route('petani.barang.index', ['filter' => 'all', 'search' => request('search')]) }}"
                            class="px-6 py-2 {{ request('filter') === 'all' || !request('filter') ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-600' }} rounded-full hover:bg-green-600 transition duration-300">
                            Semua
                        </a>
                        <a href="{{ route('petani.barang.index', ['filter' => 'pupuk', 'search' => request('search')]) }}"
                            class="px-6 py-2 {{ request('filter') === 'pupuk' ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-600' }} rounded-full hover:bg-green-600 transition duration-300">
                            Pupuk
                        </a>
                        <a href="{{ route('petani.barang.index', ['filter' => 'bibit', 'search' => request('search')]) }}"
                            class="px-6 py-2 {{ request('filter') === 'bibit' ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-600' }} rounded-full hover:bg-green-600 transition duration-300">
                            Bibit
                        </a>
                        <a href="{{ route('petani.barang.index', ['filter' => 'obat', 'search' => request('search')]) }}"
                            class="px-6 py-2 {{ request('filter') === 'obat' ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-600' }} rounded-full hover:bg-green-600 transition duration-300">
                            Obat
                        </a>
                    </div>
                </div>

                <div id="barang-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @forelse ($stokBarang as $barang)
                        <div
                            class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300 item {{ $barang->jenis }} {{ $barang->jumlah === 0 ? 'opacity-50 cursor-not-allowed' : '' }}">
                            <!-- Gambar Barang -->
                            <div class="relative">
                                <img src="{{ asset('storage/foto-barang/' . $barang->foto) }}" alt="{{ $barang->nama_barang }}"
                                    class="w-full h-52 object-cover">
                                <p class="text-xs text-gray-500 px-2 py-1 bg-white bg-opacity-80 absolute bottom-0 left-0">{{ $barang->foto }}</p>
                            </div>

                            <!-- Konten Card -->
                            <div class="p-4">
                                <h3 class="text-lg font-bold text-gray-900 mb-3">{{ $barang->nama_barang }}</h3>
                                <p class="text-sm font-bold text-green-500">Gudang:
                                    {{ $barang->user->name ?? 'Tidak Diketahui' }}</p>
                                <p class="text-sm text-gray-600">{{ $barang->jenis }}</p>
                                <div class="flex items-center justify-between mb-2">
                                    <p class="text-sm font-bold text-gray-700">Stok: {{ $barang->jumlah }}
                                        {{ $barang->satuan }}</p>
                                </div>
                                <div class="flex items-center justify-between mb-4">
                                    <!-- Input Jumlah -->
                                    <form method="POST" action="{{ route('petani.barang.store') }}">
                                        @csrf
                                        <input type="hidden" name="stok_barang_id" value="{{ $barang->id }}">
                                        <input type="hidden" name="nama_barang" value="{{ $barang->nama_barang }}">
                                        <div class="flex items-center space-x-2">
                                            <button type="button" onclick="decreaseQuantity({{ $barang->id }})"
                                                class="text-gray-900 px-3 py-2 rounded-lg hover:bg-gray-300 transition duration-300"
                                                {{ $barang->jumlah === 0 ? 'disabled' : '' }}>-</button>
                                            <input id="quantity-{{ $barang->id }}" name="jumlah" type="text"
                                                value="1"
                                                class="w-12 text-center border border-gray-300 rounded-lg" readonly>
                                            <button type="button" onclick="increaseQuantity({{ $barang->id }})"
                                                class="text-gray-900 px-3 py-2 rounded-lg hover:bg-gray-300 transition duration-300"
                                                {{ $barang->jumlah === 0 ? 'disabled' : '' }}>+</button>
                                        </div>
                                        <!-- Tombol Pesan -->
                                        <button type="submit"
                                            class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300 flex items-center mt-4"
                                            {{ $barang->jumlah === 0 ? 'disabled' : '' }}>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 001.99-1.73L23 6H6" />
                                            </svg>
                                            Pesan
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600">Tidak ada barang yang ditemukan.</p>
                    @endforelse
                </div>
            </div>
        </section>
    </main>

    <script>
        function increaseQuantity(id) {
            const quantityElement = document.getElementById(`quantity-${id}`);
            let currentQuantity = parseInt(quantityElement.value); // Ambil nilai dari input
            quantityElement.value = currentQuantity + 1; // Perbarui nilai input
        }

        function decreaseQuantity(id) {
            const quantityElement = document.getElementById(`quantity-${id}`);
            let currentQuantity = parseInt(quantityElement.value); // Ambil nilai dari input
            if (currentQuantity > 1) {
                quantityElement.value = currentQuantity - 1; // Perbarui nilai input
            }
        }
    </script>
</x-guest-layout>
