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
                    <li class="text-gray-700 font-semibold">Tambah Barang</li>
                </ol>
                <h1 class="text-3xl font-bold text-gray-800 mt-2">Tambah Barang</h1>
            </nav>
        </div>

        <!-- Form Tambah Barang -->
        <div class="p-6 rounded-lg bg-white shadow-lg border border-gray-200">
            <form action="{{ route('gudang.stok-barang.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf

                <!-- Foto -->
                <div>
                    <label for="foto" class="block text-sm font-medium text-gray-700">Foto Barang</label>
                    <input type="file" name="foto" id="foto" accept="image/*"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <p class="text-sm italic text-gray-500 mt-1">Format yang diperbolehkan: jpeg, png, jpg.
                        Maksimal
                        ukuran: 5MB.</p>
                </div>

                <!-- Nama Barang -->
                <div>
                    <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                    <input type="text" name="nama_barang" id="nama_barang" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Masukkan nama barang">
                </div>

                <!-- Jenis -->
                <div>
                    <label for="jenis" class="block text-sm font-medium text-gray-700">Jenis</label>
                    <select name="jenis" id="jenis" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">Pilih Jenis</option>
                        <option value="Pupuk">Pupuk</option>
                        <option value="Bibit">Bibit</option>
                        <option value="Obat">Obat</option>
                    </select>
                </div>

                <!-- Jumlah -->
                <div>
                    <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah</label>
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
                        <option value="Kg">Kg</option>
                        <option value="Liter">Liter</option>
                        <option value="Pcs">Pcs</option>
                    </select>
                </div>

                <!-- Hidden Status -->
                <input type="hidden" name="status" value="masuk">

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
