<x-app-layout>
    @if (session('error'))
        <script>
            alert("{{ session('error') }}");
        </script>
    @endif
    <div class="p-6 sm">
        <!-- Heading dan Breadcrumb -->
        <div class="mb-6">
            <nav class="text-sm text-gray-500">
                <ol class="list-reset flex items-center space-x-2">
                    <li><a href="{{ route('gudang.index') }}" class="hover:underline text-blue-600">Gudang</a></li>
                    <li><span class="text-gray-400">></span></li>
                    <li><a href="{{ route('gudang.distribusi-barang.index') }}"
                            class="hover:underline text-blue-600">Distribusi
                            Barang</a>
                    </li>
                    <li><span class="text-gray-400">></span></li>
                    <li class="text-gray-700 font-semibold">Tambah Distribusi Barang</li>
                </ol>
                <h1 class="text-3xl font-bold text-gray-800 mt-2">Tambah Barang</h1>
            </nav>
        </div>

        <!-- Form Tambah Distribusi Barang -->
        <div class="p-6 rounded-lg bg-white shadow-lg border border-gray-200">
            <form action="{{ route('gudang.distribusi-barang.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                <!-- Permintaan Barang id -->
                <div>
                    <label for="permintaan_id" class="block text-sm font-medium text-gray-700">Permintaan Barang</label>
                    <select name="permintaan_id" id="permintaan_id" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">Pilih Permintaan</option>
                        @foreach ($permintaanList as $permintaan)
                            <option value="{{ $permintaan->id }}">
                                {{ $permintaan->user->name }} - {{ $permintaan->nama_barang }} -
                                {{ $permintaan->jumlah }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Distributor id -->
                <div>
                    <label for="distributor_id" class="block text-sm font-medium text-gray-700">Distributor</label>
                    <select name="distributor_id" id="distributor_id" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">Pilih Distributor</option>
                        @foreach ($distributorList as $distributor)
                            <option value="{{ $distributor->id }}">
                                {{ $distributor->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">Pilih Status</option>
                        <option value="Proses Pengiriman">Proses Pengiriman</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Gagal">Gagal</option>
                    </select>
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('gudang.stok-barang.index') }}"
                        class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition duration-200">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700 transition duration-200">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
