<x-app-layout>
    <x-session-modal />

    <div class="p-6 sm">
        <!-- Heading dan Breadcrumb -->
        <div class="mb-6">
            <nav class="text-sm text-gray-500">
                <ol class="list-reset flex items-center space-x-2">
                    <li><a href="{{ route('gudang.index') }}" class="hover:underline text-blue-600">Gudang</a></li>
                    <li><span class="text-gray-400">></span></li>
                    <li class="text-gray-700 font-semibold">Dashboard</li>
                </ol>
                <h1 class="text-3xl font-bold text-gray-800 mt-2">Petugas Gudang Dashboard</h1>
            </nav>
        </div>

        <div class="p-6 rounded-lg bg-white shadow-lg border border-gray-200">
            <!-- Diagram Lingkaran dan Permintaan Barang Terbaru -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Diagram Lingkaran -->
                <div
                    class="relative rounded-lg bg-white shadow-md border border-gray-200 p-6 hover:shadow-lg hover:scale-105 transition duration-300 ease-in-out">
                    <a href="{{ route('gudang.stok-barang.index') }}">
                        <h2 class="text-lg font-semibold text-gray-700 mb-4 text-center">Total Barang Berdasarkan Jenis
                        </h2>
                    </a>
                    <div class="flex flex-col items-center justify-center h-48">
                        <div class="relative w-40 h-40 mx-auto">
                            <canvas id="barangChart" width="160" height="160"></canvas>
                            <!-- Label Tengah -->
                            <div
                                class="absolute inset-0 flex flex-col items-center justify-center text-center pointer-events-none gap-y-1">
                                <p class="text-2xl font-bold text-gray-800 leading-none">
                                    {{ number_format($totalStokBarang) }}</p>
                                <p class="text-xs text-gray-500 leading-none">Total Barang</p>
                            </div>
                        </div>
                        <!-- Legend Manual -->
                        <div class="mt-4 flex justify-center space-x-6 text-xs text-gray-700">
                            <div class="flex items-center space-x-2">
                                <span class="inline-block w-3 h-3 rounded-full bg-[#66BB6A]"></span>
                                <span>Pupuk ({{ number_format($pupukCount) }})</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="inline-block w-3 h-3 rounded-full bg-[#FFCA28]"></span>
                                <span>Bibit ({{ number_format($bibitCount) }})</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="inline-block w-3 h-3 rounded-full bg-[#EF5350]"></span>
                                <span>Obat ({{ number_format($obatCount) }})</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Permintaan Barang Terbaru -->
                <div
                    class="rounded-lg bg-white shadow-md border border-gray-200 p-6 hover:shadow-lg hover:scale-105 transition duration-300 ease-in-out">
                    <a href="{{ route('gudang.permintaan-barang.index') }}">
                        <h2 class="text-lg font-semibold text-gray-700 mb-4">Permintaan Barang Terbaru</h2>
                    </a>
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
                                            permintaan barang.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Diagram Permintaan Barang -->
            <div
                class="rounded-lg bg-white shadow-md border border-gray-200 p-6 mb-6 hover:shadow-lg hover:scale-105 transition duration-300 ease-in-out">
                <h2 class="text-lg font-semibold text-gray-700 mb-4 text-center">Statistik Permintaan Barang</h2>
                <div class="relative w-full h-64">
                    <canvas id="permintaanChart"></canvas>
                </div>
            </div>

            <!-- Distribusi Barang Terbaru -->
            <div
                class="rounded-lg bg-white shadow-md border border-gray-200 p-6 mb-6 hover:shadow-lg hover:scale-105 transition duration-300 ease-in-out">
                <a href="{{ route('gudang.distribusi-barang.index') }}">
                    <h2 class="text-lg font-semibold text-gray-700 mb-4">Distribusi Barang Terbaru</h2>
                </a>
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
            </div>
        </div>
    </div>

    <!-- Script Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('barangChart').getContext('2d');

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [], // Kosongkan agar tidak muncul legend dari Chart.js
                datasets: [{
                    data: [{{ $pupukCount }}, {{ $bibitCount }}, {{ $obatCount }}],
                    backgroundColor: ['#66BB6A', '#FFCA28', '#EF5350'],
                    borderWidth: 0,
                    hoverOffset: 8
                }]
            },
            options: {
                cutout: '65%',
                responsive: true,
                plugins: {
                    legend: {
                        display: false // Legend bawaan dimatikan
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const value = context.parsed;
                                return `${value.toLocaleString()}`;
                            }
                        }
                    }
                }
            }
        });
    </script>

    <!-- Script untuk Diagram Garis -->
    <script>
        const permintaanCtx = document.getElementById('permintaanChart').getContext('2d');

        new Chart(permintaanCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($diagramData['labels']) !!}, // Label bulan
                datasets: [{
                    label: 'Total Permintaan',
                    data: {!! json_encode($diagramData['data']) !!}, // Data total permintaan
                    borderColor: '#66BB6A',
                    borderWidth: 2,
                    tension: 0, // Garis lurus
                    fill: false // Hilangkan warna di bawah garis
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const value = context.parsed.y;
                                return `Total: ${value.toLocaleString()}`;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Bulan'
                        },
                        grid: {
                            display: false // Hilangkan kotak-kotak pada sumbu X
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Jumlah Permintaan'
                        },
                        beginAtZero: true,
                        grid: {
                            display: false // Hilangkan kotak-kotak pada sumbu Y
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
