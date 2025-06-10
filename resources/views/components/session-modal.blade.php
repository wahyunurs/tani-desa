@if (session('success'))
    <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-400"
        x-transition:enter-start="opacity-0 transform translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-400"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform translate-y-2" x-init="setTimeout(() => show = false, 4000)"
        class="fixed top-4 right-4 bg-white border border-gray-300 shadow-lg rounded-lg p-4 flex items-center space-x-4 z-50">
        <!-- Icon -->
        <div class="flex-shrink-0">
            <div class="text-2xl mr-3">✅</div>
        </div>
        <!-- Text -->
        <div>
            <p class="text-sm font-bold text-gray-900">SUKSES</p>
            <p class="text-xs text-gray-500">{{ session('success') }}</p>
        </div>
        <!-- Close Button -->
        <button @click="show = false" class="text-gray-400 hover:text-gray-600 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
@elseif (session('failed'))
    <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-400"
        x-transition:enter-start="opacity-0 transform translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-400"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform translate-y-2" x-init="setTimeout(() => show = false, 4000)"
        class="fixed top-4 right-4 bg-white border border-gray-300 shadow-lg rounded-lg p-4 flex items-center space-x-4 z-50">
        <!-- Icon -->
        <div class="flex-shrink-0">
            <div class="text-2xl mr-3">❌</div>
        </div>
        <!-- Text -->
        <div>
            <p class="text-sm font-bold text-gray-900">GAGAL</p>
            <p class="text-xs text-gray-500">{{ session('failed') }}</p>
        </div>
        <!-- Close Button -->
        <button @click="show = false" class="text-gray-400 hover:text-gray-600 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
@elseif (session('error'))
    <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-400"
        x-transition:enter-start="opacity-0 transform translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-400"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform translate-y-2" x-init="setTimeout(() => show = false, 4000)"
        class="fixed top-4 right-4 bg-white border border-gray-300 shadow-lg rounded-lg p-4 flex items-center space-x-4 z-50">
        <!-- Icon -->
        <div class="flex-shrink-0">
            <div class="text-2xl mr-3">⚠️</div>
        </div>
        <!-- Text -->
        <div>
            <p class="text-sm font-bold text-gray-900">KESALAHAN</p>
            <p class="text-xs text-gray-500">{{ session('error') }}</p>
        </div>
        <!-- Close Button -->
        <button @click="show = false" class="text-gray-400 hover:text-gray-600 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
@elseif (session('warning'))
    <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-400"
        x-transition:enter-start="opacity-0 transform translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-400"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform translate-y-2"
        class="fixed top-4 right-4 bg-white border border-gray-300 shadow-lg rounded-lg p-4 flex items-center space-x-4 z-50">
        <!-- Icon -->
        <div class="flex-shrink-0">
            <div class="text-4xl mr-2">❗</div>
        </div>
        <!-- Text -->
        <div>
            <p class="text-sm font-bold text-red-500">PERINGATAN</p>
            <p class="text-xs text-red-400">{{ session('warning') }}</p>
            <a href="{{ route('admin.stok-barang.index') }}"
                class="text-gray-500 text-xs font-medium hover:underline mt-2">
                Cek Stok Barang >
            </a>
        </div>
        <!-- Close Button -->
        <button @click="show = false" class="text-gray-400 hover:text-gray-600 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
@endif
