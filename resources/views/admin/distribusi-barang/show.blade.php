<!-- filepath: d:\laragon\www\pupuk-tani-desa\resources\views\admin\distribusi-barang\show.blade.php -->
<!-- Modal -->
<div id="distribusiDetailModal"
    class="fixed inset-0 z-50 {{ isset($selectedDistribusiBarang) ? '' : 'hidden' }} bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white w-full max-w-lg rounded-lg shadow-lg relative">
        <!-- Header -->
        <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-800">Detail Distribusi Barang</h2>
            <button id="closeModalButton" class="text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Konten -->
        <div class="px-6 py-4 space-y-6">
            @if (isset($selectedDistribusiBarang))
                <!-- Detail Distribusi Barang -->
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-x-4 items-center">
                        <h3 class="text-sm font-semibold text-gray-500">ID Distribusi</h3>
                        <p class="text-gray-700 ml-4">{{ $selectedDistribusiBarang->id }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-x-4 items-center">
                        <h3 class="text-sm font-semibold text-gray-500">Status</h3>
                        <p class="text-gray-700 ml-4">{{ $selectedDistribusiBarang->status }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-x-4 items-center">
                        <h3 class="text-sm font-semibold text-gray-500">Distributor</h3>
                        <p class="text-gray-700 ml-4">
                            {{ $selectedDistribusiBarang->distributor->name ?? 'Tidak Diketahui' }}</p>
                    </div>
                </div>

                <!-- Detail Permintaan Barang -->
                @if ($selectedDistribusiBarang->permintaanBarang)
                    <div class="space-y-4 mt-6">
                        <h2 class="text-lg font-semibold text-gray-700 border-gray-200 pb-2">Detail Permintaan Barang
                        </h2>
                        <div class="grid grid-cols-2 gap-x-4 items-center">
                            <h3 class="text-sm font-semibold text-gray-500">ID Permintaan</h3>
                            <p class="text-gray-700 ml-4">{{ $selectedDistribusiBarang->permintaanBarang->id }}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-x-4 items-center">
                            <h3 class="text-sm font-semibold text-gray-500">Nama Barang</h3>
                            <p class="text-gray-700 ml-4">{{ $selectedDistribusiBarang->permintaanBarang->nama_barang }}
                            </p>
                        </div>
                        <div class="grid grid-cols-2 gap-x-4 items-center">
                            <h3 class="text-sm font-semibold text-gray-500">Jumlah</h3>
                            <p class="text-gray-700 ml-4">{{ $selectedDistribusiBarang->permintaanBarang->jumlah }}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-x-4 items-center">
                            <h3 class="text-sm font-semibold text-gray-500">Status Permintaan</h3>
                            <p class="text-gray-700 ml-4">{{ $selectedDistribusiBarang->permintaanBarang->status }}</p>
                        </div>
                    </div>
                @else
                    <p class="text-gray-600">Detail permintaan barang tidak ditemukan.</p>
                @endif
            @else
                <p class="text-gray-600 text-center">Distribusi barang tidak ditemukan.</p>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('distribusiDetailModal');
        const closeModalButtons = document.querySelectorAll('#closeModalButton, #closeModalButtonFooter');
        const openModalButtons = document.querySelectorAll('.openModalButton');

        // Fungsi untuk membuka modal
        openModalButtons.forEach(button => {
            button.addEventListener('click', function() {
                modal.classList.remove('hidden');
            });
        });

        // Fungsi untuk menutup modal
        closeModalButtons.forEach(button => {
            button.addEventListener('click', function() {
                modal.classList.add('hidden');
            });
        });
    });
</script>
