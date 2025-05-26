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
                    <li><a href="{{ route('gudang.stok-barang.index') }}" class="hover:underline text-blue-600">Stok
                            Barang</a>
                    </li>
                    <li><span class="text-gray-400">></span></li>
                    <li class="text-gray-700 font-semibold">Edit Barang</li>
                </ol>
                <h1 class="text-3xl font-bold text-gray-800 mt-2">Edit Barang</h1>
            </nav>
        </div>

        <!-- Form Edit Barang -->
        <div class="p-6 rounded-lg bg-white shadow-lg border border-gray-200">
            <form action="{{ route('gudang.stok-barang.update', $stokBarang->id) }}" method="POST"
                enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Jenis -->
                <div>
                    <label for="jenis" class="block text-sm font-medium text-gray-700">Jenis</label>
                    <select name="jenis" id="jenis" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">Pilih Jenis</option>
                        <option value="Pupuk" {{ old('jenis', $stokBarang->jenis) == 'Pupuk' ? 'selected' : '' }}>Pupuk
                        </option>
                        <option value="Bibit" {{ old('jenis', $stokBarang->jenis) == 'Bibit' ? 'selected' : '' }}>Bibit
                        </option>
                        <option value="Obat" {{ old('jenis', $stokBarang->jenis) == 'Obat' ? 'selected' : '' }}>Obat
                        </option>
                    </select>
                </div>

                <!-- Nama Barang -->
                <div>
                    <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                    <input type="text" name="nama_barang" id="nama_barang" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Masukkan nama barang" value="{{ old('nama_barang', $stokBarang->nama_barang) }}">
                </div>

                <!-- Tipe -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="masuk" {{ old('tipe') == 'masuk' ? 'selected' : '' }}>Tambah</option>
                        <option value="keluar" {{ old('tipe') == 'keluar' ? 'selected' : '' }}>Kurang</option>
                    </select>
                </div>

                <!-- Jumlah Penambahan/Pengurangan -->
                <div>
                    <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah
                        Penambahan/Pengurangan</label>
                    <input type="number" name="jumlah" id="jumlah" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Masukkan jumlah barang">
                </div>

                <!-- Satuan -->
                <div>
                    <label for="satuan" class="block text-sm font-medium text-gray-700">Satuan</label>
                    <select name="satuan" id="satuan" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">Pilih Satuan</option>
                        <option value="kg" {{ old('satuan', $stokBarang->satuan) == 'kg' ? 'selected' : '' }}>
                            Kilogram</option>
                        <option value="liter" {{ old('satuan', $stokBarang->satuan) == 'liter' ? 'selected' : '' }}>
                            Liter</option>
                        <option value="pcs" {{ old('satuan', $stokBarang->satuan) == 'pcs' ? 'selected' : '' }}>Pcs
                        </option>
                    </select>
                </div>

                <!-- Batas Minimal -->
                <div>
                    <label for="batas_minimal" class="block text-sm font-medium text-gray-700">Batas Minimal</label>
                    <input type="number" name="batas_minimal" id="batas_minimal" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Masukkan batas minimal barang"
                        value="{{ old('batas_minimal', $stokBarang->batas_minimal) }}">
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
