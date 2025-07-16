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
                    <li><a href="{{ route('admin.pengguna.index') }}" class="hover:underline text-blue-600">Pengguna</a>
                    </li>
                    <li><span class="text-gray-400">></span></li>
                    <li class="text-gray-700 font-semibold">Tambah Pengguna</li>
                </ol>
                <h1 class="text-3xl font-bold text-gray-800 mt-2">Tambah Pengguna</h1>
            </nav>
        </div>

        <!-- Form Tambah Barang -->
        <div class="p-6 rounded-lg bg-white shadow-lg border border-gray-200">
            <form action="{{ route('admin.pengguna.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                <!-- Nama Pengguna -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Pengguna</label>
                    <input type="text" name="name" id="name" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Masukkan nama pengguna">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Masukkan email">
                </div>

                <!-- Alamat -->
                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <input type="texr" name="alamat" id="alamat" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Masukkan alamat">
                </div>

                <!-- Desa -->
                <div>
                    <label for="desa" class="block text-sm font-medium text-gray-700">Desa</label>
                    <input type="text" name="desa" id="desa" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Masukkan desa">
                </div>

                <!-- Nomor Telepon -->
                <div>
                    <label for="nomor_telepon" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <input type="number" name="nomor_telepon" id="nomor_telepon" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Masukkan nomor telepon">
                </div>

                {{-- <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Masukkan password">
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi
                        Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Konfirmasi password">
                </div> --}}

                <!-- Role -->
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                    <select name="role" id="role" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">Pilih Role</option>
                        <option value="gudang">Gudang</option>
                        <option value="petani">Petani</option>
                        <option value="distributor">Distributor</option>
                    </select>
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.pengguna.index') }}"
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
