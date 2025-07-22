<x-app-layout>
    <x-session-modal />

    <div class="p-4 sm">
        <!-- Heading dan Breadcrumb -->
        <div class="mb-4">
            <nav class="text-sm text-gray-500">
                <ol class="list-reset flex">
                    <li><a href="{{ route('admin.index') }}" class="hover:underline">Admin</a></li>
                    <li><span class="mx-2">></span></li>
                    <li class="text-gray-700">Laporan</li>
                </ol>
                <h1 class="text-2xl font-bold text-black">Laporan</h1>
            </nav>
        </div>

        <div class="p-4 rounded-lg bg-white border border-gray-200 mb-4">
            <!-- Form Filter -->
            <div
                class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-4 space-y-4 sm:space-y-0 sm:space-x-4">
                <form method="GET" action="{{ route('admin.laporan.filter') }}" id="filterForm"
                    class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-4 w-full">
                    <!-- Filter Status -->
                    <div class="w-full sm:w-auto">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status :</label>
                        <select name="status" id="status" onchange="document.getElementById('filterForm').submit()"
                            class="mt-1 block w-full sm:w-48 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="">Semua</option>
                            <option value="masuk" {{ request('status') == 'masuk' ? 'selected' : '' }}>Masuk</option>
                            <option value="keluar" {{ request('status') == 'keluar' ? 'selected' : '' }}>Keluar</option>
                        </select>
                    </div>

                    <!-- Filter Bulan -->
                    <div class="w-full sm:w-auto">
                        <label for="bulan" class="block text-sm font-medium text-gray-700">Bulan :</label>
                        <input type="month" name="bulan" id="bulan"
                            onchange="document.getElementById('filterForm').submit()"
                            class="mt-1 block w-full sm:w-48 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            value="{{ request('bulan') }}">
                    </div>
                </form>

                <!-- Button Ekspor -->
                <a href="{{ route('admin.laporan.export', ['status' => request('status'), 'bulan' => request('bulan')]) }}"
                    class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 flex items-center justify-center w-full sm:w-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        class="lucide lucide-arrow-up-from-line-icon lucide-arrow-up-from-line w-4 h-4 mr-1">
                        <path d="m18 9-6-6-6 6" />
                        <path d="M12 3v14" />
                        <path d="M5 21h14" />
                    </svg>
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
