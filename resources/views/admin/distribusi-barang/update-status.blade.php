<!-- Modal Update Status -->
<div id="updateStatusModal" tabindex="-1"
    class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="relative bg-white rounded-lg shadow-lg w-full max-w-md">
        <!-- Tombol Close -->
        <button type="button"
            class="absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
            id="closeStatusModalButton">
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
        </button>

        <!-- Konten Modal -->
        <div class="p-6">
            <h3 class="mb-5 text-lg font-semibold text-gray-800">Update Status Distribusi</h3>

            <!-- Form Update Status -->
            <form id="updateStatusForm" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Status Field -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                        <option value="">Pilih Status</option>
                        <option value="Proses Pengiriman">Proses Pengiriman</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Gagal">Gagal</option>
                    </select>
                </div>

                <!-- Tombol Submit dan Batal -->
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" id="cancelUpdateButton"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const updateStatusModal = document.getElementById('updateStatusModal');
        const updateStatusForm = document.getElementById('updateStatusForm');
        const cancelUpdateButton = document.getElementById('cancelUpdateButton');
        const closeStatusModalButton = document.getElementById('closeStatusModalButton');
        const updateStatusButtons = document.querySelectorAll('.updateStatusButton');

        // Fungsi untuk membuka modal
        updateStatusButtons.forEach(button => {
            button.addEventListener('click', function() {
                const updateUrl = this.getAttribute('data-url');
                const currentStatus = this.getAttribute('data-status');
                updateStatusForm.setAttribute('action', updateUrl);

                // Set current status in select
                const statusSelect = document.getElementById('status');
                if (statusSelect) {
                    statusSelect.value = currentStatus;
                }

                updateStatusModal.classList.remove('hidden');
            });
        });

        // Fungsi untuk menutup modal
        const closeModal = () => {
            updateStatusModal.classList.add('hidden');
        };

        cancelUpdateButton.addEventListener('click', closeModal);
        closeStatusModalButton.addEventListener('click', closeModal);
    });
</script>
