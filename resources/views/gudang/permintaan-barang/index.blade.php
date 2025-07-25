<x-app-layout>
    <x-session-modal />

    <div class="p-4 sm">
        <!-- Heading dan Breadcrumb -->
        <div class="mb-4">
            <nav class="text-sm text-gray-500">
                <ol class="list-reset flex">
                    <li><a href="{{ route('gudang.index') }}" class="hover:underline">Gudang</a></li>
                    <li><span class="mx-2">></span></li>
                    <li class="text-gray-700"><a href="{{ route('gudang.permintaan-barang.index') }}">Permintaan
                            Barang</a>
                    </li>
                </ol>
                <h1 class="text-2xl font-bold text-black">Permintaan Barang</h1>
            </nav>
        </div>

        <div class="p-4 rounded-lg bg-white border border-gray-200">
            <div
                class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-4 space-y-4 sm:space-y-0 sm:space-x-4">
                <!-- Form Filter -->
                <form method="GET" action="{{ route('gudang.permintaan-barang.filter') }}" id="filterForm"
                    class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-4 w-full">
                    <!-- Filter Status -->
                    <div class="w-full sm:w-auto">
                        <select name="status" id="status" onchange="document.getElementById('filterForm').submit()"
                            class="mt-1 block w-full sm:w-48 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="">Status</option>
                            <option value="Masuk" {{ request('status') == 'Masuk' ? 'selected' : '' }}>Masuk</option>
                            <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Diproses
                            </option>
                            <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai
                            </option>
                            <option value="Gagal" {{ request('status') == 'Gagal' ? 'selected' : '' }}>Gagal</option>
                        </select>
                    </div>
                </form>

                <!-- Button Tambah -->
                <a href="{{ route('gudang.permintaan-barang.create') }}"
                    class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 flex items-center justify-center w-full sm:w-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah
                </a>
            </div>

            <!-- Tabel Permintaan Barang -->
            <div class="overflow-x-auto mb-4">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
                    <thead class="bg-gradient-to-r from-green-400 to-green-600 text-white">
                        <tr>
                            <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider border-b">No
                            </th>
                            <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider border-b">Nama
                                Petani
                            </th>
                            <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider border-b">Nama
                                Barang
                            </th>
                            <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider border-b">
                                Jumlah
                            </th>
                            <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider border-b">
                                Satuan
                            </th>
                            <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider border-b">
                                Status
                            </th>
                            <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider border-b">
                                Distribusi
                            </th>
                            <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider border-b">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($permintaanBarang as $permintaan)
                            <tr class="hover:bg-green-50 hover:shadow-md transition duration-200 ease-in-out">
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">
                                    {{ $permintaan->user->name ?? 'Tidak Diketahui' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">{{ $permintaan->nama_barang }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">
                                    {{ $permintaan->jumlah }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">
                                    {{ $permintaan->stokBarang->satuan ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">{{ $permintaan->status }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">
                                    @if ($permintaan->status == 'Masuk')
                                        <form
                                            action="{{ route('gudang.permintaan-barang.distribusi', $permintaan->id) }}"
                                            method="GET">
                                            <button type="submit"
                                                class="text-blue-500 hover:text-blue-700 transition duration-200 ease-in-out">
                                                Distribusi
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-500">Sudah didistribusi</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center text-sm text-gray-700 flex justify-center space-x-4">
                                    <!-- Tombol Edit -->
                                    <form action="{{ route('gudang.permintaan-barang.edit', $permintaan->id) }}"
                                        method="GET">
                                        @if ($permintaan->status === 'Masuk')
                                            <button type="submit"
                                                class="text-yellow-500 hover:text-yellow-700 transition duration-200 ease-in-out">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536M9 11l6.364-6.364a2 2 0 012.828 0l1.172 1.172a2 2 0 010 2.828L13 15l-4 1 1-4z" />
                                                </svg>
                                            </button>
                                        @else
                                            <button type="button" disabled
                                                class="text-gray-400 cursor-not-allowed transition duration-200 ease-in-out">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536M9 11l6.364-6.364a2 2 0 012.828 0l1.172 1.172a2 2 0 010 2.828L13 15l-4 1 1-4z" />
                                                </svg>
                                            </button>
                                        @endif
                                    </form>

                                    <!-- Tombol Delete -->
                                    <button type="button" data-id="{{ $permintaan->id }}"
                                        data-url="{{ route('gudang.permintaan-barang.destroy', $permintaan->id) }}"
                                        class="deleteButton text-red-500 hover:text-red-700 transition duration-200 ease-in-out">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3m5 0H6" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500">Belum ada permintaan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    @include('gudang.permintaan-barang.delete')
</x-app-layout>
