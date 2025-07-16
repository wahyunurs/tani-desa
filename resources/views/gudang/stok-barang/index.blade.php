<x-app-layout>
    <x-session-modal />

    <div class="p-4 sm">
        <!-- Heading dan Breadcrumb -->
        <div class="mb-4">
            <nav class="text-sm text-gray-500">
                <ol class="list-reset flex">
                    <li><a href="{{ route('gudang.index') }}" class="hover:underline">Gudang</a></li>
                    <li><span class="mx-2">></span></li>
                    <li class="text-gray-700"><a href="{{ route('gudang.stok-barang.index') }}">Stok Barang</a></li>
                </ol>
                <h1 class="text-2xl font-bold text-black">Stok Barang</h1>
            </nav>
        </div>

        <div class="p-4 rounded-lg bg-white border border-gray-200 mb-4">
            <div
                class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-4 space-y-4 sm:space-y-0 sm:space-x-4">
                <!-- Form Filter -->
                <form method="GET" action="{{ route('gudang.stok-barang.filter') }}" id="filterForm"
                    class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-4 w-full">
                    <!-- Filter Jenis -->
                    <div class="w-full sm:w-auto">
                        <label for="jenis" class="block text-sm font-medium text-gray-700">Jenis Barang</label>
                        <select name="jenis" id="jenis" onchange="document.getElementById('filterForm').submit()"
                            class="mt-1 block w-full sm:w-48 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="">Semua</option>
                            <option value="Pupuk" {{ request('jenis') == 'Pupuk' ? 'selected' : '' }}>Pupuk</option>
                            <option value="Bibit" {{ request('jenis') == 'Bibit' ? 'selected' : '' }}>Bibit</option>
                            <option value="Obat" {{ request('jenis') == 'Obat' ? 'selected' : '' }}>Obat</option>
                        </select>
                    </div>
                </form>

                <!-- Button Tambah -->
                <a href="{{ route('gudang.stok-barang.create') }}"
                    class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 flex items-center justify-center w-full sm:w-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah
                </a>
            </div>

            <!-- Tabel Stok Barang -->
            <div class="overflow-x-auto mb-4">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
                    <thead class="bg-gradient-to-r from-green-400 to-green-600 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider border-b">
                                No
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider border-b">Foto
                                Barang
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider border-b">Nama
                                Barang
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider border-b">Jenis
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider border-b">Jumlah
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider border-b">Satuan
                            </th>
                            <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider border-b">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($stokBarang as $barang)
                            <tr
                                class="@if ($barang->jumlah <= 10) bg-red-400/20 hover:bg-red-400/70 @else hover:bg-green-50 @endif hover:shadow-md transition duration-200 ease-in-out">
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <img src="{{ asset('storage/foto-barang/' . $barang->foto) }}"
                                        alt="{{ $barang->nama_barang }}" class="w-12 h-12 rounded-full">
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $barang->nama_barang }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $barang->jenis }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $barang->jumlah }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $barang->satuan }}</td>
                                </td>
                                <td
                                    class="px-6 py-4 text-center text-sm text-gray-700"
                                    style="vertical-align: middle;">
                                    <div class="flex justify-center items-center space-x-4">
                                        <!-- Tombol Edit -->
                                        <form action="{{ route('gudang.stok-barang.edit', $barang->id) }}" method="GET">
                                            <button type="submit"
                                                class="text-yellow-500 hover:text-yellow-700 transition duration-200 ease-in-out">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536M9 11l6.364-6.364a2 2 0 012.828 0l1.172 1.172a2 2 0 010 2.828L13 15l-4 1 1-4z" />
                                                </svg>
                                            </button>
                                        </form>

                                        <!-- Tombol Delete -->
                                        <button type="button" data-id="{{ $barang->id }}"
                                            data-url="{{ route('gudang.stok-barang.destroy', $barang->id) }}"
                                            class="deleteButton text-red-500 hover:text-red-700 transition duration-200 ease-in-out">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3m5 0H6" />
                                            </svg>
                                        </button>

                                        {{-- <!-- Tombol Show -->
                                        <form action="{{ route('gudang.stok-barang.show', $barang->id) }}" method="GET">
                                            <button type="submit"
                                                class="text-gray-500 hover:text-gray-700 transition duration-200 ease-in-out">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.522 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7s-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>
                                        </form> --}}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500">Belum ada barang.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    @include('gudang.stok-barang.delete')
</x-app-layout>
