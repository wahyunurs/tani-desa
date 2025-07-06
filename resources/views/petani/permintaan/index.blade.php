<x-guest-layout>
    <x-navbar-petani />
    <main class="min-h-screen bg-gray-100">
        <!-- Permintaan Section -->
        <section id="permintaan" class="min-h-screen bg-green-50">
            <div class="container mx-auto px-10 py-5">
                <!-- Section Header -->
                <div class="text-center mb-9">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6 mt-20">Daftar Permintaan</h2>
                </div>

                <!-- Search and Filters -->
                <div class="flex flex-wrap items-center justify-between mb-8 space-y-4 md:space-y-0">
                    <!-- Search -->
                    <form method="GET" action="{{ route('petani.permintaan.index') }}"
                        class="relative w-full md:w-3/5 mb-4 md:mb-0">
                        <input type="text" name="search" id="search" placeholder="Cari permintaan..."
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

                    <!-- Filter Jenis -->
                    <form method="GET" action="{{ route('petani.permintaan.index') }}"
                        class="flex-grow md:flex-grow-0 md:w-1/6">
                        <select name="filter_jenis" onchange="this.form.submit()"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                            <option value="all" {{ request('filter_jenis') === 'all' ? 'selected' : '' }}>Jenis
                            </option>
                            <option value="Pupuk" {{ request('filter_jenis') === 'Pupuk' ? 'selected' : '' }}>Pupuk
                            </option>
                            <option value="Bibit" {{ request('filter_jenis') === 'Bibit' ? 'selected' : '' }}>Bibit
                            </option>
                            <option value="Obat" {{ request('filter_jenis') === 'Obat' ? 'selected' : '' }}>Obat
                            </option>
                        </select>
                    </form>

                    <!-- Filter Status -->
                    <form method="GET" action="{{ route('petani.permintaan.index') }}"
                        class="flex-grow md:flex-grow-0 md:w-1/6">
                        <select name="filter_status" onchange="this.form.submit()"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                            <option value="all" {{ request('filter_status') === 'all' ? 'selected' : '' }}>Status
                            </option>
                            <option value="Masuk" {{ request('filter_status') === 'Masuk' ? 'selected' : '' }}>Masuk
                            </option>
                            <option value="Diproses" {{ request('filter_status') === 'Diproses' ? 'selected' : '' }}>
                                Diproses</option>
                            <option value="Selesai" {{ request('filter_status') === 'Selesai' ? 'selected' : '' }}>
                                Selesai</option>
                            <option value="Gagal" {{ request('filter_status') === 'Gagal' ? 'selected' : '' }}>Gagal
                            </option>
                        </select>
                    </form>
                </div>

                <!-- Permintaan Items -->
                <div class="bg-white rounded-lg shadow-md p-5">
                    @forelse ($permintaanBarangs as $permintaan)
                        <div class="flex flex-wrap items-center justify-between border-b border-gray-200 py-4">
                            <!-- Gambar Barang -->
                            <div class="flex items-center space-x-4 w-full md:w-auto mb-4 md:mb-0">
                                <img src="{{ asset('storage/foto-barang/' . $permintaan->stokBarang->foto ?? 'default.png') }}"
                                    alt="{{ $permintaan->nama_barang }}" class="w-20 h-20 object-cover rounded-lg">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900">{{ $permintaan->nama_barang }}</h3>
                                    <!-- Status -->
                                    <span
                                        class="px-3 py-1 rounded-full text-sm font-semibold 
                        {{ $permintaan->status === 'Masuk' ? 'bg-blue-100 text-blue-600' : '' }}
                        {{ $permintaan->status === 'Diproses' ? 'bg-yellow-100 text-yellow-600' : '' }}
                        {{ $permintaan->status === 'Selesai' ? 'bg-green-100 text-green-600' : '' }}
                        {{ $permintaan->status === 'Gagal' ? 'bg-red-100 text-red-600' : '' }}">
                                        {{ $permintaan->status }}
                                    </span>
                                </div>
                            </div>

                            <!-- Input Jumlah dan Tombol -->
                            <div class="flex items-center space-x-4 w-full md:w-auto mb-4 md:mb-0">
                                <!-- Input Jumlah -->
                                <div class="flex items-center space-x-2">
                                    <button onclick="decreaseQuantity({{ $permintaan->id }})"
                                        class="text-gray-900 px-3 py-2 rounded-lg hover:bg-gray-300 transition duration-300">
                                        -
                                    </button>
                                    <input id="quantity-{{ $permintaan->id }}" name="jumlah" type="text"
                                        value="{{ $permintaan->jumlah }}"
                                        class="w-16 text-center border border-gray-300 rounded-lg" readonly>
                                    <button onclick="increaseQuantity({{ $permintaan->id }})"
                                        class="text-gray-900 px-3 py-2 rounded-lg hover:bg-gray-300 transition duration-300">
                                        +
                                    </button>
                                </div>

                                <!-- Tombol Edit -->
                                <form method="POST" action="{{ route('petani.permintaan.update', $permintaan->id) }}"
                                    onsubmit="return syncQuantityBeforeSubmit({{ $permintaan->id }})">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="jumlah" id="jumlah-hidden-{{ $permintaan->id }}">
                                    <button type="submit"
                                        class="bg-yellow-400 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition duration-300 {{ $permintaan->status !== 'Masuk' ? 'opacity-50 cursor-not-allowed' : '' }}"
                                        {{ $permintaan->status !== 'Masuk' ? 'disabled' : '' }}>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536M9 11l6.364-6.364a2 2 0 012.828 0l1.172 1.172a2 2 0 010 2.828L13 15l-4 1 1-4z" />
                                        </svg>
                                    </button>
                                </form>

                                <!-- Tombol Hapus -->
                                <button type="submit" data-id="{{ $permintaan->id }}"
                                    data-url="{{ route('petani.permintaan.destroy', $permintaan->id) }}"
                                    class="deleteButton bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-300 {{ $permintaan->status !== 'Masuk' ? 'opacity-50 cursor-not-allowed' : '' }}"
                                    {{ $permintaan->status !== 'Masuk' ? 'disabled' : '' }}>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3m5 0H6" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-600">Permintaan barang tidak ditemukan.</p>
                    @endforelse
                </div>
            </div>
        </section>
    </main>

    <!-- Modal Konfirmasi Hapus -->
    @include('petani.permintaan.delete')

    <script>
        function increaseQuantity(id) {
            const quantityElement = document.getElementById(`quantity-${id}`);
            let currentQuantity = parseInt(quantityElement.value);
            quantityElement.value = currentQuantity + 1;
        }

        function decreaseQuantity(id) {
            const quantityElement = document.getElementById(`quantity-${id}`);
            let currentQuantity = parseInt(quantityElement.value);
            if (currentQuantity > 1) {
                quantityElement.value = currentQuantity - 1;
            }
        }

        function syncQuantityBeforeSubmit(id) {
            const quantityValue = document.getElementById(`quantity-${id}`).value;
            document.getElementById(`jumlah-hidden-${id}`).value = quantityValue;
            return true;
        }
    </script>

</x-guest-layout>
