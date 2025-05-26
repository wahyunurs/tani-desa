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
                    <li><a href="{{ route('admin.distribusi-barang.index') }}"
                            class="hover:underline text-blue-600">Distribusi
                            Barang</a>
                    </li>
                    <li><span class="text-gray-400">></span></li>
                    <li class="text-gray-700 font-semibold">Edit Distribusi Barang</li>
                </ol>
                <h1 class="text-3xl font-bold text-gray-800 mt-2">Edit Distribusi Barang</h1>
            </nav>
        </div>

        <!-- Form Edit Distribusi Barang -->
        <div class="p-6 rounded-lg bg-white shadow-lg border border-gray-200">
            <form action="{{ route('admin.distribusi-barang.update', $distribusiBarang->id) }}" method="POST"
                enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Permintaan Barang id (disabled) -->
                <div>
                    <label for="permintaan_id" class="block text-sm font-medium text-gray-700">Permintaan Barang</label>

                    <!-- Input teks hanya untuk tampilan (readonly) -->
                    <input type="text" id="permintaan_display" readonly
                        value="{{ $distribusiBarang->permintaanBarang->user->name }} - {{ $distribusiBarang->permintaanBarang->nama_barang }} - {{ $distribusiBarang->permintaanBarang->jumlah }}"
                        class="mt-1 block w-full p-2 bg-gray-100 border border-gray-300 rounded-md shadow-sm sm:text-sm">

                    <!-- Hidden input untuk submit value ke backend -->
                    <input type="hidden" name="permintaan_id" value="{{ $distribusiBarang->permintaan_id }}">
                </div>

                <!-- Distributor id -->
                <div>
                    <label for="distributor_id" class="block text-sm font-medium text-gray-700">Distributor</label>
                    <select name="distributor_id" id="distributor_id" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">Pilih Distributor</option>
                        @foreach ($distributorList as $distributor)
                            <option value="{{ $distributor->id }}"
                                {{ old('distributor_id', $distribusiBarang->distributor_id ?? '') == $distributor->id ? 'selected' : '' }}>
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
                        <option value="Proses Pengiriman"
                            {{ old('status', $distribusiBarang->status ?? '') == 'Proses Pengiriman' ? 'selected' : '' }}>
                            Proses Pengiriman
                        </option>
                        <option value="Selesai"
                            {{ old('status', $distribusiBarang->status ?? '') == 'Selesai' ? 'selected' : '' }}>
                            Selesai
                        </option>
                        <option value="Gagal"
                            {{ old('status', $distribusiBarang->status ?? '') == 'Gagal' ? 'selected' : '' }}>
                            Gagal
                        </option>
                    </select>
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.distribusi-barang.index') }}"
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
