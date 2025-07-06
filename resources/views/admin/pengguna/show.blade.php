<div id="userDetailModal"
    class="fixed inset-0 z-50 {{ isset($selectedUser) ? '' : 'hidden' }} bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white w-full max-w-lg rounded-lg shadow-lg relative">
        <!-- Header -->
        <div class="flex justify-between items-center px-8 py-4 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-800">Detail Pengguna</h2>
            <button id="closeModalButton" class="text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Konten -->
        <div class="px-6 py-4 space-y-6">
            <!-- Informasi Pengguna -->
            @if (isset($selectedUser))
                <div id="userDetailContent" class="space-y-4">
                    <div class="grid grid-cols-2 gap-x-4 items-center">
                        <h3 class="text-sm font-semibold text-gray-800">Nama</h3>
                        <p class="text-gray-600 ml-4">{{ $selectedUser->name }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-x-4 items-center">
                        <h3 class="text-sm font-semibold text-gray-800">Email</h3>
                        <p class="text-gray-600 ml-4">{{ $selectedUser->email }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-x-4 items-center">
                        <h3 class="text-sm font-semibold text-gray-800">Alamat</h3>
                        <p class="text-gray-600 ml-4">{{ $selectedUser->alamat ?? 'Tidak ada data' }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-x-4 items-center">
                        <h3 class="text-sm font-semibold text-gray-800">Desa</h3>
                        <p class="text-gray-600 ml-4">{{ $selectedUser->desa ?? 'Tidak ada data' }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-x-4 items-center">
                        <h3 class="text-sm font-semibold text-gray-800">No Telepon</h3>
                        <p class="text-gray-600 ml-4">{{ $selectedUser->nomor_telepon ?? 'Tidak ada data' }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-x-4 items-center">
                        <h3 class="text-sm font-semibold text-gray-800">Role</h3>
                        <p class="text-gray-600 ml-4 capitalize">{{ $selectedUser->role }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-x-4 items-center">
                        <h3 class="text-sm font-semibold text-gray-800">Tanggal Daftar</h3>
                        <p class="text-gray-600 ml-4">{{ $selectedUser->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            @else
                <p class="text-gray-600 ml-4">Tidak ada data pengguna yang dipilih.</p>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('userDetailModal');
        const closeModalButton = document.getElementById('closeModalButton');

        // Tampilkan modal jika ada selectedUser
        @if (isset($selectedUser))
            modal.classList.remove('hidden');
        @endif

        // Fungsi untuk menutup modal
        if (closeModalButton) {
            closeModalButton.addEventListener('click', function() {
                // Redirect ke halaman index tanpa parameter
                window.location.href = "{{ route('admin.pengguna.index') }}";
            });
        }

        // Tutup modal ketika klik di luar modal
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                // Redirect ke halaman index tanpa parameter
                window.location.href = "{{ route('admin.pengguna.index') }}";
            }
        });
    });
</script>
