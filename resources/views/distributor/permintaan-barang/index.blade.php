<x-app-layout>
    <x-session-modal />

    <div class="p-4 sm">
        <!-- Heading dan Breadcrumb -->
        <div class="mb-4">
            <nav class="text-sm text-gray-500">
                <ol class="list-reset flex">
                    <li><a href="{{ route('distributor.index') }}" class="hover:underline">Distributor</a></li>
                    <li><span class="mx-2">></span></li>
                    <li class="text-gray-700"><a href="{{ route('distributor.permintaan-barang.index') }}">Permintaan
                            Barang</a>
                    </li>
                </ol>
                <h1 class="text-2xl font-bold text-black">Permintaan Barang</h1>
            </nav>
        </div>

        <div class="p-4 rounded-lg bg-white border border-gray-200">
            <!-- Filter by Status -->
            <div
                class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-4 space-y-4 sm:space-y-0 sm:space-x-4">
                <form method="GET" action="{{ route('distributor.permintaan-barang.filter') }}" id="filterForm"
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
                            <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider border-b">Jumlah
                            </th>
                            <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider border-b">Satuan
                            </th>
                            <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider border-b">Status
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($permintaanBarang as $index => $permintaan)
                            <tr class="hover:bg-green-50 hover:shadow-md transition duration-200 ease-in-out">
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">
                                    {{ $permintaan->user->name ?? 'Tidak Diketahui' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">{{ $permintaan->nama_barang }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">
                                    {{ $permintaan->jumlah }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">
                                    {{ $permintaan->stokBarang->satuan ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 text-center">{{ $permintaan->status }}</td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada permintaan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
