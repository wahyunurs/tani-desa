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
                    <li class="text-gray-700 font-semibold">Tambah Permintaan</li>
                </ol>
                <h1 class="text-3xl font-bold text-gray-800 mt-2">Tambah Permintaan</h1>
            </nav>
        </div>

        <!-- Form Tambah Barang -->
        <div class="p-6 rounded-lg bg-white shadow-lg border border-gray-200">
            <form action="{{ route('admin.permintaan-barang.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf

                <!-- Petani id -->
                <div>
                    <label for="petani_id" class="block text-sm font-medium text-gray-700">Petani</label>
                    <select name="petani_id" id="petani_id" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">Pilih Petani</option>
                        @foreach ($petaniList as $petani)
                            <option value="{{ $petani->petani_id }}"
                                {{ request('petani_id') == $petani->petani_id ? 'selected' : '' }}>
                                {{ $petani->user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Nama Barang -->
                <div>
                    <label for="stok_barang_id" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                    <select name="stok_barang_id" id="stok_barang_id" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">Pilih Barang</option>
                        @foreach ($barangList as $baranglist)
                            <option value="{{ $baranglist->id }}"
                                {{ request('stok_barang_id') == $baranglist->id ? 'selected' : '' }}>
                                {{ $baranglist->nama_barang }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Jumlah -->
                <div>
                    <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Masukkan jumlah barang">
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
