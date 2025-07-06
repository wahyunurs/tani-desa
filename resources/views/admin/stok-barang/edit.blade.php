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
                    <li><a href="{{ route('admin.stok-barang.index') }}" class="hover:underline text-blue-600">Stok
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
            <form action="{{ route('admin.stok-barang.update', $stokBarang->id) }}" method="POST"
                enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Gudang id -->
                <div>
                    <label for="gudang_id" class="block text-sm font-medium text-gray-700">Gudang</label>
                    <select name="gudang_id" id="gudang_id" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">Pilih Gudang</option>
                        @foreach ($gudangList as $gudang)
                            <option value="{{ $gudang->gudang_id }}"
                                {{ old('gudang_id', $stokBarang->gudang_id) == $gudang->gudang_id ? 'selected' : '' }}>
                                {{ $gudang->user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

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
                        placeholder="Masukkan nama barang" value="{{ old('nama_barang', $stokBarang->nama_barang) }}">
                </div>

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

                <!-- Tambah Stok dan Kurang Stok -->
                <div>
                    <div class="flex space-x-4">
                        <div class="w-1/2">
                            <label for="tambah_stok" class="block text-sm font-medium text-gray-700">Tambah Stok</label>
                            <input type="number" name="tambah_stok" id="tambah_stok" min="0"
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                placeholder="Masukkan jumlah tambah stok" value="{{ old('tambah_stok', '') }}">
                        </div>
                        <div class="w-1/2">
                            <label for="kurang_stok" class="block text-sm font-medium text-gray-700">Kurang Stok</label>
                            <input type="number" name="kurang_stok" id="kurang_stok" min="0"
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                placeholder="Masukkan jumlah kurang stok" value="{{ old('kurang_stok', '') }}">
                        </div>
                    </div>
                    <p class="text-sm italic text-gray-500 mt-1">Stok Saat Ini: <span
                            class="font-semibold">{{ $stokBarang->jumlah ?? 0 }} {{ $stokBarang->satuan }}</span></p>
                    <p class="text-xs text-amber-600 mt-1">
                        <strong>Catatan:</strong> Isi salah satu field saja (Tambah Stok ATAU Kurang Stok), jangan
                        keduanya.
                    </p>
                </div>

                <!-- Satuan -->
                <div>
                    <label for="satuan" class="block text-sm font-medium text-gray-700">Satuan</label>
                    <select name="satuan" id="satuan" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">Pilih Satuan</option>
                        <option value="Kg" {{ old('satuan', $stokBarang->satuan) == 'Kg' ? 'selected' : '' }}>
                            Kg</option>
                        <option value="Liter" {{ old('satuan', $stokBarang->satuan) == 'Liter' ? 'selected' : '' }}>
                            Liter</option>
                        <option value="Pcs" {{ old('satuan', $stokBarang->satuan) == 'Pcs' ? 'selected' : '' }}>Pcs
                        </option>
                    </select>
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.stok-barang.index') }}"
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

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <script>
            let errorMessages = [];
            @foreach ($errors->all() as $error)
                errorMessages.push("{{ $error }}");
            @endforeach
            alert("Error:\n" + errorMessages.join("\n"));
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tambahStokInput = document.getElementById('tambah_stok');
            const kurangStokInput = document.getElementById('kurang_stok');

            // Fungsi untuk clear field yang lain ketika salah satu diisi
            tambahStokInput.addEventListener('input', function() {
                if (this.value && this.value > 0) {
                    kurangStokInput.value = '';
                }
            });

            kurangStokInput.addEventListener('input', function() {
                if (this.value && this.value > 0) {
                    tambahStokInput.value = '';
                }
            });

            // Validasi sebelum submit
            document.querySelector('form').addEventListener('submit', function(e) {
                const tambahStok = parseInt(tambahStokInput.value) || 0;
                const kurangStok = parseInt(kurangStokInput.value) || 0;
                const stokSaatIni = {{ $stokBarang->jumlah ?? 0 }};

                if (tambahStok > 0 && kurangStok > 0) {
                    e.preventDefault();
                    alert('Tidak boleh mengisi kedua field Tambah Stok dan Kurang Stok secara bersamaan!');
                    return false;
                }

                if (kurangStok > stokSaatIni) {
                    e.preventDefault();
                    alert('Kurang stok tidak boleh lebih dari stok saat ini (' + stokSaatIni + ')!');
                    return false;
                }
            });
        });
    </script>
</x-app-layout>
