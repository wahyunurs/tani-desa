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
                    <li><a href="{{ url('/admin') }}" class="hover:underline text-blue-600">Admin</a></li>
                    <li><span class="text-gray-400">></span></li>
                    <li class="text-gray-700 font-semibold">Dashboard</li>
                </ol>
                <h1 class="text-3xl font-bold text-gray-800 mt-2">Admin Dashboard</h1>
            </nav>
        </div>

        <div class="p-6 rounded-lg bg-white shadow-lg border border-gray-200">
            <!-- Total User Berdasarkan Role -->
            <div class="grid grid-cols-3 gap-6 mb-6">
                <div
                    class="flex flex-col items-center justify-center h-28 rounded-lg bg-gradient-to-r from-green-300 to-green-500 text-white shadow-md hover:shadow-lg hover:scale-105 transition duration-300 ease-in-out">
                    <a href="{{ route('pengguna.index') }}" class="text-center">
                        <p class="text-lg font-semibold">Gudang</p>
                        <p class="text-3xl font-bold">{{ $gudangCount }}</p>
                    </a>
                </div>
                <div
                    class="flex flex-col items-center justify-center h-28 rounded-lg bg-gradient-to-r from-yellow-300 to-yellow-500 text-white shadow-md hover:shadow-lg hover:scale-105 transition duration-300 ease-in-out">
                    <a href="{{ route('pengguna.index') }}" class="text-center">
                        <p class="text-lg font-semibold">Petani</p>
                        <p class="text-3xl font-bold">{{ $petaniCount }}</p>
                    </a>
                </div>
                <div
                    class="flex flex-col items-center justify-center h-28 rounded-lg bg-gradient-to-r from-red-300 to-red-500 text-white shadow-md hover:shadow-lg hover:scale-105 transition duration-300 ease-in-out">
                    <a href="{{ route('pengguna.index') }}" class="text-center">
                        <p class="text-lg font-semibold">Distributor</p>
                        <p class="text-3xl font-bold">{{ $distributorCount }}</p>
                    </a>
                </div>
            </div>

            <!-- Diagram Lingkaran dan Permintaan Barang Terbaru -->
            <div class="grid grid-cols-2 gap-6 mb-6">
                <a href="{{ route('stok-barang.index') }}">
                    <div
                        class="rounded-lg bg-white shadow-md border border-gray-200 p-6 hover:shadow-lg hover:scale-105 transition duration-300 ease-in-out">
                        <h2 class="text-lg font-semibold text-gray-700 mb-4">Total Barang Berdasarkan Jenis</h2>
                        <div class="flex items-center justify-center h-64">
                            <canvas id="barangChart" class="w-3/4 h-3/4"></canvas>
                        </div>
                    </div>
                </a>

                <div
                    class="rounded-lg bg-white shadow-md border border-gray-200 p-6 hover:shadow-lg hover:scale-105 transition duration-300 ease-in-out">
                    <a href="{{ route('permintaan-barang.index') }}">
                        <h2 class="text-lg font-semibold text-gray-700 mb-4">Permintaan Barang Terbaru</h2>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500">
                                <tbody>
                                    @forelse ($permintaanBarang as $permintaan)
                                        <tr
                                            class="border-b hover:bg-gray-100 hover:shadow-sm transition duration-200 ease-in-out">
                                            <td class="px-4 py-2 text-gray-900">
                                                {{ $permintaan->user->name ?? 'Tidak Diketahui' }}
                                            </td>
                                            <td class="px-4 py-2">
                                                {{ $permintaan->stokBarang->nama_barang ?? 'Tidak Diketahui' }}
                                            </td>
                                            <td class="px-4 py-2">
                                                {{ $permintaan->jumlah }}
                                            </td>
                                            <td class="px-4 py-2 text-gray-500">
                                                {{ $permintaan->status }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-4 py-2 text-center text-gray-500">Belum ada
                                                permintaan
                                                barang.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Distribusi Barang Terbaru -->
            <div
                class="rounded-lg bg-white shadow-md border border-gray-200 p-6 mb-6 hover:shadow-lg hover:scale-105 transition duration-300 ease-in-out">
                <a href="{{ route('distribusi-barang.index') }}">
                    <h2 class="text-lg font-semibold text-gray-700 mb-4">Distribusi Barang Terbaru</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead>
                                <tr class="border-b bg-gray-100">
                                    <th class="px-4 py-2 text-gray-700">Distributor</th>
                                    <th class="px-4 py-2 text-gray-700">Permintaan</th>
                                    <th class="px-4 py-2 text-gray-700">Status</th>
                                    <th class="px-4 py-2 text-gray-700">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($distribusiBarang as $distribusi)
                                    <tr
                                        class="border-b hover:bg-gray-100 hover:shadow-sm transition duration-200 ease-in-out">
                                        <td class="px-4 py-2 text-gray-900">
                                            {{ $distribusi->distributor->name ?? 'Tidak Diketahui' }}
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $distribusi->permintaanBarang->nama_barang ?? 'Tidak Diketahui' }}
                                        </td>
                                        <td class="px-4 py-2 text-gray-500">
                                            {{ ucfirst($distribusi->status) }}
                                        </td>
                                        <td class="px-4 py-2 text-gray-500">
                                            {{ $distribusi->created_at->format('d M Y') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-2 text-center text-gray-500">Belum ada
                                            distribusi
                                            barang.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Script untuk Diagram Lingkaran -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('barangChart').getContext('2d');
        const barangChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Pupuk', 'Bibit', 'Obat'],
                datasets: [{
                    label: 'Total Barang',
                    data: [{{ $pupukCount }}, {{ $bibitCount }}, {{ $obatCount }}],
                    backgroundColor: ['#4CAF50', '#FFC107', '#F44336'],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#333'
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
