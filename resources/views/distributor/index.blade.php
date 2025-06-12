<x-app-layout>
    <x-session-modal />

    <div class="p-6 sm">
        <!-- Heading dan Breadcrumb -->
        <div class="mb-6">
            <nav class="text-sm text-gray-500">
                <ol class="list-reset flex items-center space-x-2">
                    <li><a href="{{ route('distributor.index') }}" class="hover:underline text-blue-600">Distributor</a>
                    </li>
                    <li><span class="text-gray-400">></span></li>
                    <li class="text-gray-700 font-semibold">Dashboard</li>
                </ol>
                <h1 class="text-3xl font-bold text-gray-800 mt-2">Distributor Dashboard</h1>
            </nav>
        </div>

        <div class="p-6 rounded-lg bg-white shadow-lg border border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
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
                <!-- Distribusi Barang Terbaru -->
                <div
                    class="rounded-lg bg-white shadow-md border border-gray-200 p-6 hover:shadow-lg hover:scale-105 transition duration-300 ease-in-out">
                    <a href="{{ route('distributor.distribusi-barang.index') }}">
                        <h2 class="text-lg font-semibold text-gray-700 mb-4">Distribusi Barang Terbaru</h2>
                    </a>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <tbody>
                                @forelse ($distribusiBarang as $distribusi)
                                    <tr
                                        class="border-b hover:bg-gray-100 hover:shadow-sm transition duration-200 ease-in-out">
                                        <td class="px-4 py-2 text-gray-900">
                                            {{ $distribusi->permintaan_id ?? 'Tidak Diketahui' }}
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $distribusi->status }}
                                        </td>
                                        <td class="px-4 py-2 text-gray-500">
                                            {{ $distribusi->created_at->format('d M Y') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-4 py-2 text-center text-gray-500">Belum ada
                                            distribusi barang.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Card untuk Diagram -->
            <div
                class="rounded-lg bg-white shadow-md border border-gray-200 p-6 mb-6 hover:shadow-lg hover:scale-105 transition duration-300 ease-in-out">
                <h2 class="text-lg font-semibold text-gray-700 mb-4 text-center">Statistik Distribusi Barang</h2>
                <div class="relative w-full h-64">
                    <canvas id="distribusiChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Script untuk Diagram Garis -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const distribusiCtx = document.getElementById('distribusiChart').getContext('2d');

            new Chart(distribusiCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($diagramData['labels']) !!}, // Label bulan
                    datasets: [{
                        label: 'Total Distribusi',
                        data: {!! json_encode($diagramData['data']) !!}, // Data total distribusi
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
                                display: false
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Jumlah Distribusi'
                            },
                            beginAtZero: true,
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        </script>
</x-app-layout>
