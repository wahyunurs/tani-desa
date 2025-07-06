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
                    <li><a href="{{ route('admin.index') }}" class="hover:underline text-blue-600">Admin</a></li>
                    <li><span class="text-gray-400">></span></li>
                    <li><a href="{{ route('admin.permintaan-barang.index') }}"
                            class="hover:underline text-blue-600">Permintaan
                            Barang</a>
                    </li>
                    <li><span class="text-gray-400">></span></li>
                    <li class="text-gray-700 font-semibold">Distribusi Barang</li>
                </ol>
                <h1 class="text-3xl font-bold text-gray-800 mt-2">Distribusi Barang</h1>
            </nav>
        </div>

        <!-- Form Distribusi Barang -->
        <div class="p-6 rounded-lg bg-white shadow-lg border border-gray-200">
            <form action="{{ route('admin.permintaan-barang.distribusi.store', $permintaanBarang->id) }}" method="POST"
                enctype="multipart/form-data" class="space-y-6">
                @csrf
                <!-- Permintaan Barang -->
                <input type="hidden" name="permintaan_id" value="{{ $permintaanBarang->id }}">

                <!-- Petani id -->
                <div>
                    <label for="petani_id" class="block text-sm font-medium text-gray-700">Petani</label>
                    <input type="text" name="petani" value="{{ $permintaanBarang->user->name ?? '-' }}" disabled
                        class="block w-full p-2 mt-2 border border-gray-300 rounded-md shadow-sm bg-gray-100 text-gray-500 sm:text-sm" />
                </div>

                <!-- Nama Barang -->
                <div>
                    <label for="stok_barang_id" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                    <input type="text" name="nama_barang"
                        value="{{ $permintaanBarang->stokBarang->nama_barang ?? '-' }}" disabled
                        class="block w-full p-2 mt-4 border border-gray-300 rounded-md shadow-sm bg-gray-100 text-gray-500 sm:text-sm" />
                </div>

                <!-- Jumlah -->
                <div>
                    <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah</label>
                    <input type="number" name="jumlah" value="{{ $permintaanBarang->jumlah }}" disabled
                        class="block w-full p-2 mt-4 border border-gray-300 rounded-md shadow-sm bg-gray-100 text-gray-500 sm:text-sm" />
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <input type="text" name="status" value="{{ $permintaanBarang->status }}" disabled
                        class="block w-full p-2 mt-4 border border-gray-300 rounded-md shadow-sm bg-gray-100 text-gray-500 sm:text-sm" />
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

                <!-- Tombol Submit -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.permintaan-barang.index') }}"
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
