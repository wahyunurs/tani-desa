<x-app-layout>
    <x-session-modal />

    <div class="p-4 sm">
        <!-- Heading dan Breadcrumb -->
        <div class="mb-4">
            <nav class="text-sm text-gray-500">
                <ol class="list-reset flex">
                    <li><a href="{{ route('distributor.index') }}" class="hover:underline">Distributor</a></li>
                    <li><span class="mx-2">></span></li>
                    <li class="text-gray-700"><a href="{{ route('gudang.distribusi-barang.index') }}">Distribusi
                            Barang</a>
                    </li>
                </ol>
                <h1 class="text-2xl font-bold text-black">Distribusi Barang</h1>
            </nav>
        </div>

        <div class="p-4 rounded-lg bg-white border border-gray-200">
            <!-- Filter by Status -->
            <div
                class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-4 space-y-4 sm:space-y-0 sm:space-x-4">
                <form method="GET" action="{{ route('distributor.distribusi-barang.filter') }}" id="filterForm"
                    class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-4 w-full">
                    <!-- Filter Status -->
                    <div class="w-full sm:w-auto">
                        <select name="status" id="status" onchange="document.getElementById('filterForm').submit()"
                            class="mt-1 block w-full sm:w-48 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="">Status</option>
                            <option value="Proses Pengiriman"
                                {{ request('status') == 'Proses Pengiriman' ? 'selected' : '' }}>Proses Pengiriman
                            </option>
                            <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai
                            </option>
                            <option value="Gagal" {{ request('status') == 'Gagal' ? 'selected' : '' }}>Gagal</option>
                        </select>
                    </div>
                </form>

                <!-- Button Tambah -->
                <a href="{{ route('distributor.distribusi-barang.create') }}"
                    class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 flex items-center justify-center w-full sm:w-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah
                </a>
            </div>

            <!-- Tabel Distribusi Barang -->
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
                            <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider border-b">Id
                                Permintaan
                            </th>
                            <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider border-b">
                                Status
                            </th>
                            <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider border-b">
                                Update
                                Status
                            </th>
                            <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider border-b">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($distribusiBarang as $index => $distribusi)
                            <tr class="hover:bg-green-50 hover:shadow-md transition duration-200 ease-in-out">
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">
                                    {{ $distribusi->permintaanBarang->user->name ?? 'Tidak Diketahui' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">
                                    {{ $distribusi->permintaanBarang->nama_barang ?? 'Tidak Diketahui' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">
                                    {{ $distribusi->permintaanBarang->jumlah ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">
                                    {{ $distribusi->permintaanBarang->stokBarang->satuan ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">
                                    {{ $distribusi->permintaan_id }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">{{ $distribusi->status }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">
                                    <button type="button"
                                        class="updateStatusButton text-blue-500 hover:text-blue-700 transition duration-200 ease-in-out"
                                        data-url="{{ route('distributor.distribusi-barang.update-status', $distribusi->id) }}"
                                        data-status="{{ $distribusi->status }}">
                                        <div class="flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                            </svg>
                                            Update Status
                                        </div>
                                    </button>
                                </td>
                                <td class="px-6 py-4 text-center text-sm text-gray-700 flex justify-center space-x-4">
                                    <!-- Tombol Delete -->
                                    <button type="button" data-id="{{ $distribusi->id }}"
                                        data-url="{{ route('distributor.distribusi-barang.destroy', $distribusi->id) }}"
                                        class="deleteButton text-red-500 hover:text-red-700 transition duration-200 ease-in-out">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3m5 0H6" />
                                        </svg>
                                    </button>

                                    <!-- Tombol Show -->
                                    <button type="submit"
                                        class="text-gray-500 hover:text-gray-700 transition duration-200 ease-in-out">
                                        <a
                                            href="{{ route('distributor.distribusi-barang.index', ['id' => $distribusi->id]) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.522 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7s-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-6 py-4 text-center text-gray-500">Belum ada distribusi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    @include('distributor.distribusi-barang.delete')

    <!-- Modal Update Status -->
    @include('distributor.distribusi-barang.update-status')

    <!-- Modal Detail -->
    @include('distributor.distribusi-barang.show')
</x-app-layout>
