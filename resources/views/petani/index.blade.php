<x-guest-layout>
    <x-navbar-petani />

    <!-- Content Section -->
    <main class="bg-green-50 min-h-screen pt-16">
        <x-session-modal />

        @if ($isServiceAvailable)
            <!-- Konten Normal - Layanan Tersedia -->
            <section class="container mx-auto px-6 h-[calc(100vh-4rem)] flex items-center">
                <div class="flex flex-col md:flex-row items-center justify-between w-full">
                    <div class="md:w-1/2 mb-8 md:mb-0">
                        <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-2">
                            Tani Desa
                        </h1>
                        <h1 class="text-4xl md:text-6xl font-bold text-green-500 mb-6">Solusi Pertanian</h1>
                        <p class="text-gray-600 text-lg mb-8">
                            Dukung produktivitas pertanian Anda dengan produk kami yang berkualitas tinggi
                            yang ramah lingkungan dan terjangkau.
                        </p>
                        <button
                            class="bg-green-500 text-white px-8 py-3 rounded-full hover:bg-green-600 transition duration-300">
                            <a href="{{ route('petani.barang.index') }}">
                                Lihat Produk</a>
                        </button>
                    </div>

                    <div class="md:w-1/2 hidden md:flex justify-center">
                        <img src="{{ asset('images/tani-desa.png') }}" alt="Tani Desa"
                            class="w-4/5 h-auto object-contain">
                    </div>
                </div>
            </section>
        @else
            <!-- Konten Layanan Belum Tersedia -->
            <section class="container mx-auto px-6 py-8 min-h-[calc(100vh-4rem)] flex items-center">
                <div class="flex flex-col items-center justify-center w-full text-center">
                    <div class="mb-8">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-24 h-24 sm:w-32 sm:h-32 mx-auto text-gray-400 mb-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <h1 class="text-2xl sm:text-3xl md:text-5xl font-bold text-gray-700 mb-4">
                            Tani Desa
                        </h1>
                        <h2 class="text-xl sm:text-2xl md:text-4xl font-bold text-orange-500 mb-6">
                            Belum Hadir di {{ $userDesa ?? 'Desa Anda' }}
                        </h2>
                    </div>

                    <div class="max-w-2xl mb-8 px-4">
                        <p class="text-gray-600 text-base sm:text-lg md:text-xl mb-6 leading-relaxed">
                            Maaf, layanan Tani Desa belum tersedia di desa Anda saat ini. Kami sedang bekerja keras
                            untuk memperluas jangkauan layanan kami.
                        </p>
                        <p class="text-gray-700 text-base sm:text-lg font-medium mb-8">
                            🚀 <strong>Tani Desa akan segera hadir di {{ $userDesa ?? 'desa Anda' }}!</strong>
                        </p>

                        {{-- <div class="bg-white p-4 sm:p-6 rounded-lg shadow-lg border-l-4 border-green-500 text-left">
                            <h3 class="text-base sm:text-lg font-semibold text-gray-800 mb-3 text-center sm:text-left">
                                Apa yang bisa Anda lakukan?</h3>
                            <ul class="text-gray-600 space-y-2 text-sm sm:text-base">
                                <li class="flex items-start">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Hubungi kami untuk informasi lebih lanjut</span>
                                </li>
                                <li class="flex items-start">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Daftarkan desa Anda untuk layanan prioritas</span>
                                </li>
                                <li class="flex items-start">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Ikuti update terbaru dari kami</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                        <div class="flex flex-col sm:flex-row gap-4 w-full max-w-md">
                            <button
                                class="bg-green-500 text-white px-6 sm:px-8 py-3 rounded-full hover:bg-green-600 transition duration-300 text-sm sm:text-base">
                                <a href="mailto:info@tanidesa.com">
                                    Hubungi Kami
                                </a>
                            </button>
                            <button
                                class="bg-white text-green-500 border-2 border-green-500 px-6 sm:px-8 py-3 rounded-full hover:bg-green-50 transition duration-300 text-sm sm:text-base">
                                <a href="https://wa.me/1234567890" target="_blank">
                                    WhatsApp
                                </a>
                            </button>
                        </div>
                    </div> --}}
            </section>
        @endif
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="container mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Logo and Copyright -->
                <div>
                    <div class="flex items-center mb-4">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-8">
                        <span class="ml-2 text-xl font-bold">Tani Desa</span>
                    </div>
                    <p class="text-gray-400">Copyright © {{ date('Y') }} Tani Desa. All rights reserved.</p>
                    <div class="flex space-x-4 mt-4">
                        <a href="#" class="text-gray-400 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.723-.951.564-2.005.974-3.127 1.195-.897-.956-2.178-1.555-3.594-1.555-2.717 0-4.92 2.203-4.92 4.917 0 .386.044.762.128 1.124-4.087-.205-7.713-2.164-10.141-5.144-.423.725-.666 1.562-.666 2.457 0 1.694.863 3.188 2.175 4.065-.802-.026-1.555-.246-2.213-.616v.062c0 2.366 1.683 4.342 3.918 4.788-.41.111-.843.171-1.287.171-.315 0-.623-.03-.924-.086.624 1.951 2.434 3.374 4.576 3.414-1.68 1.318-3.809 2.105-6.115 2.105-.398 0-.79-.023-1.175-.068 2.179 1.396 4.768 2.21 7.548 2.21 9.057 0 14.01-7.506 14.01-14.01 0-.213-.005-.426-.014-.637.961-.694 1.797-1.562 2.457-2.549z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c-5.488 0-9.837 4.349-9.837 9.837 0 4.355 2.82 8.065 6.737 9.387-.093-.797-.177-2.021.037-2.894.193-.812 1.243-5.165 1.243-5.165s-.317-.634-.317-1.571c0-1.471.854-2.568 1.918-2.568.905 0 1.342.678 1.342 1.491 0 .908-.579 2.265-.879 3.526-.249 1.048.528 1.902 1.566 1.902 1.879 0 3.324-1.981 3.324-4.835 0-2.527-1.815-4.292-4.408-4.292-3.006 0-4.771 2.254-4.771 4.579 0 .908.349 1.883.785 2.411.087.105.1.197.075.302-.082.348-.267 1.105-.303 1.257-.048.197-.157.239-.364.145-1.354-.63-2.2-2.608-2.2-4.198 0-3.417 2.482-6.56 7.166-6.56 3.759 0 6.678 2.678 6.678 6.25 0 3.73-2.344 6.745-5.594 6.745-1.091 0-2.118-.567-2.468-1.238l-.672 2.556c-.243.926-.905 2.086-1.353 2.79 1.019.314 2.093.485 3.211.485 5.488 0 9.837-4.349 9.837-9.837s-4.349-9.837-9.837-9.837z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M19.615 3.184c-1.2-.045-4.2-.045-5.4 0-1.2.045-2.4.3-3.6.9-1.2.6-2.1 1.5-2.7 2.7-.6 1.2-.855 2.4-.9 3.6-.045 1.2-.045 4.2 0 5.4.045 1.2.3 2.4.9 3.6.6 1.2 1.5 2.1 2.7 2.7 1.2.6 2.4.855 3.6.9 1.2.045 4.2.045 5.4 0 1.2-.045 2.4-.3 3.6-.9 1.2-.6 2.1-1.5 2.7-2.7.6-1.2.855-2.4.9-3.6.045-1.2.045-4.2 0-5.4-.045-1.2-.3-2.4-.9-3.6-.6-1.2-1.5-2.1-2.7-2.7-1.2-.6-2.4-.855-3.6-.9zm-7.615 8.816v-4.8l4.8 2.4-4.8 2.4z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Company Links -->
                <div>
                    <h3 class="text-lg font-bold mb-4">Company</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Blog</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Contact Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Pricing</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Testimonials</a></li>
                    </ul>
                </div>

                <!-- Support Links -->
                <div>
                    <h3 class="text-lg font-bold mb-4">Support</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Help Center</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Terms of Service</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Legal</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Privacy Policy</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Status</a></li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div>
                    <h3 class="text-lg font-bold mb-4">Stay up to date</h3>
                    <form action="#" method="POST" class="flex items-center space-x-2">
                        <input type="email" placeholder="Your email address" required
                            class="w-full p-3 rounded-md bg-gray-800 text-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <button type="submit"
                            class="p-3 bg-green-500 rounded-md text-white hover:bg-green-600 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14.752 11.168l-9.193-5.333A1 1 0 004 6.667v10.666a1 1 0 001.559.829l9.193-5.333a1 1 0 000-1.658z" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </footer>
</x-guest-layout>
