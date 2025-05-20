<!-- filepath: d:\laragon\www\pupuk-tani-desa\resources\views\admin\stok-barang\create.blade.php -->
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
                    <li><a href="{{ url('/admin') }}" class="hover:underline text-blue-600">Admin</a></li>
                    <li><span class="text-gray-400">></span></li>
                    <li><a href="{{ route('stok-barang.index') }}" class="hover:underline text-blue-600">Stok Barang</a>
                    </li>
                    <li><span class="text-gray-400">></span></li>
                    <li class="text-gray-700 font-semibold">Tambah Barang</li>
                </ol>
                <h1 class="text-3xl font-bold text-gray-800 mt-2">Tambah Barang</h1>
            </nav>
        </div>

        <!-- Form Tambah Barang -->
        <div class="p-6 rounded-lg bg-white shadow-lg border border-gray-200">
            <form action="{{ route('stok-barang.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                <!-- Gudang id -->
                <div>
                    <label for="gudang_id" class="block text-sm font-medium text-gray-700">Gudang</label>
                    <select name="gudang_id" id="gudang_id" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">Pilih Gudang</option>
                        @foreach ($gudangList as $gudang)
                            <option value="{{ $gudang->gudang_id }}">
                                {{ $gudang->user->name }}
                            </option>
                        @endforeach
                    </select>
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

                <!-- Nama Barang -->
                <div>
                    <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                    <input type="text" name="nama_barang" id="nama_barang" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Masukkan nama barang">
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
                        <option value="kg">Kilogram</option>
                        <option value="liter">Liter</option>
                        <option value="pcs">Pcs</option>
                    </select>
                </div>

                <!-- Batas Minimal -->
                <div>
                    <label for="batas_minimal" class="block text-sm font-medium text-gray-700">Batas Minimal</label>
                    <input type="number" name="batas_minimal" id="batas_minimal" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Masukkan batas minimal barang">
                </div>

                <!-- Hidden Status -->
                <input type="hidden" name="status" value="masuk">

                <!-- Tombol Submit -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('stok-barang.index') }}"
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
