<!-- filepath: d:\laragon\www\pupuk-tani-desa\resources\views\admin\laporan\index.blade.php -->
<x-app-layout>
    <div class="p-4 sm">
        <!-- Heading dan Breadcrumb -->
        <div class="mb-4">
            <nav class="text-sm text-gray-500">
                <ol class="list-reset flex">
                    <li><a href="{{ url('/admin') }}" class="hover:underline">Admin</a></li>
                    <li><span class="mx-2">></span></li>
                    <li class="text-gray-700">Laporan</li>
                </ol>
                <h1 class="text-2xl font-bold text-black">Laporan</h1>
            </nav>
        </div>

        <div class="p-4 rounded-lg bg-white border border-gray-200 mb-4">
            <div class="flex items-center justify-between mb-4">
                <!-- Form Filter -->
                <form method="GET" action="{{ route('laporan.filter') }}" class="flex items-center space-x-4">
                    <!-- Filter Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status"
                            class="mt-1 block w-48 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="">Semua</option>
                            <option value="masuk" {{ request('status') == 'masuk' ? 'selected' : '' }}>Masuk</option>
                            <option value="keluar" {{ request('status') == 'keluar' ? 'selected' : '' }}>Keluar</option>
                        </select>
                    </div>

                    <!-- Filter Bulan -->
                    <div>
                        <label for="bulan" class="block text-sm font-medium text-gray-700">Bulan</label>
                        <input type="month" name="bulan" id="bulan"
                            class="mt-1 block w-48 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            value="{{ request('bulan') }}">
                    </div>

                    <!-- Tombol Filter -->
                    <div class="flex self-end">
                        <button type="submit"
                            class="px-3 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-200">
                            Filter
                        </button>
                    </div>
                </form>

                <!-- Button Ekspor -->
                <a href="{{ route('laporan.export') }}"
                    class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 flex items-center">
                    Ekspor Laporan
                </a>
            </div>

            <!-- Tabel Laporan -->
            <div class="overflow-x-auto mb-4">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
                    <thead class="bg-gradient-to-r from-green-400 to-green-600 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider border-b">ID
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider border-b">Nama
                                Barang
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider border-b">Jumlah
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider border-b">Status
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider border-b">
                                Tanggal
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($laporan as $item)
                            <tr class="hover:bg-green-50 hover:shadow-md transition duration-200 ease-in-out">
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $item->id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $item->nama_barang }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $item->jumlah }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700 capitalize">{{ $item->status }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $item->updated_at->translatedFormat('d F Y') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data laporan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
