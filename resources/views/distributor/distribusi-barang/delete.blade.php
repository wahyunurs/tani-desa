<!-- Modal Delete -->
<div id="deleteModal" tabindex="-1"
    class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="relative bg-white rounded-lg shadow-lg w-full max-w-md">
        <!-- Tombol Close -->
        <button type="button"
            class="absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
            id="closeModalButton">
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
        </button>

        <!-- Konten Modal -->
        <div class="p-6 text-center">
            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <h3 class="mb-5 text-lg font-normal text-gray-500">Apakah Anda yakin ingin menghapus distribusi ini?</h3>

            <!-- Tombol Hapus -->
            <form id="deleteForm" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Ya, Hapus
                </button>
            </form>

            <!-- Tombol Batal -->
            <button type="button" id="cancelDeleteButton"
                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-300 hover:text-black focus:z-10 focus:ring-4 focus:ring-gray-100">
                Tidak, Batal
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteModal = document.getElementById('deleteModal');
        const deleteForm = document.getElementById('deleteForm');
        const cancelDeleteButton = document.getElementById('cancelDeleteButton');
        const closeModalButton = document.getElementById('closeModalButton');
        const deleteButtons = document.querySelectorAll('.deleteButton');

        // Fungsi untuk membuka modal
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const deleteUrl = this.getAttribute('data-url');
                deleteForm.setAttribute('action', deleteUrl);
                deleteModal.classList.remove('hidden');
            });
        });

        // Fungsi untuk menutup modal
        cancelDeleteButton.addEventListener('click', function() {
            deleteModal.classList.add('hidden');
        });

        // Fungsi untuk menutup modal dengan tombol close
        closeModalButton.addEventListener('click', function() {
            deleteModal.classList.add('hidden');
        });
    });
</script>
