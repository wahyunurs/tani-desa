<x-guest-layout>
    <!-- Navbar -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-white shadow-sm">
        <nav class="container mx-auto p-5 shadow-md">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" class="h-8 w-8" alt="Logo">
                    <span class="ml-2 text-xl font-bold text-gray-800">Tani Desa</span>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="#beranda" id="link-beranda" class="pb-1 text-gray-600 hover:text-green-500">
                        Beranda
                    </a>
                    <a href="#tentang" id="link-tentang" class="pb-1 text-gray-600 hover:text-green-500">
                        Tentang
                    </a>
                    <a href="#produk" id="link-produk" class="pb-1 text-gray-600 hover:text-green-500">
                        Produk
                    </a>
                    <a href="#testimoni" id="link-testimoni" class="pb-1 text-gray-600 hover:text-green-500">
                        Testimoni
                    </a>
                    <a href="{{ route('register') }}"
                        class="bg-green-500 text-white px-6 py-2 rounded-full hover:bg-green-600 transition duration-300">
                        Registrasi →
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Content Section -->
    <main class="min-h-screen pt-16">
        <!-- Beranda Section -->
        <section id="beranda" class="bg-green-50 container mx-auto px-6 h-[calc(100vh-4rem)] flex items-center">
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
                        <a href="{{ route('login') }}">
                            Masuk</a>
                    </button>
                </div>

                <div class="md:w-1/2 flex justify-center">
                    <img src="{{ asset('images/tani-desa.png') }}" alt="Tani Desa" class="w-4/5 h-auto object-contain">
                </div>
            </div>
        </section>

        <!-- Tentang Section -->
        <section id="tentang" class="min-h-screen bg-white">
            <div class="container mx-auto px-6 py-20">
                <!-- Section Header -->
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Fitur Utama Aplikasi Tani Desa</h2>
                    <p class="text-xl text-gray-600">Solusi lengkap untuk kebutuhan pertanian Anda</p>
                </div>

                <!-- Features Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mt-12">
                    <!-- Feature 1 -->
                    <div class="text-center p-6 rounded-lg hover:shadow-xl transition duration-300">
                        <div class="bg-green-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3v18h18V3H3zm5 14h10M8 10h10M8 6h10" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Manajemen Stok</h3>
                        <p class="text-gray-600">
                            Pantau stok barang pertanian secara real-time dengan notifikasi saat stok hampir habis.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="text-center p-6 rounded-lg hover:shadow-xl transition duration-300">
                        <div class="bg-green-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2zm-6 8h12a1 1 0 001-1v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2a1 1 0 001 1z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Transaksi Barang</h3>
                        <p class="text-gray-600">
                            Permudah proses pembelian barang kebutuhan pertanian dengan sistem transaksi yang cepat dan
                            aman.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="text-center p-6 rounded-lg hover:shadow-xl transition duration-300">
                        <div class="bg-green-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h2l1 2h13a1 1 0 01.98 1.197l-1.5 6A1 1 0 0117.5 20H6.5a1 1 0 01-.98-.803L4 12H3v-2z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Distribusi Barang</h3>
                        <p class="text-gray-600">
                            Proses distribusi barang pesanan dilakukan secara efisien hingga ke lokasi tujuan.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Produk Section -->
        <section id="produk" class="min-h-screen bg-green-50">
            <div class="container mx-auto px-6 py-20">
                <!-- Section Header -->
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Produk Unggulan Tani Desa</h2>
                    <p class="text-xl text-gray-600">Temukan produk terbaik kami untuk mendukung pertanian Anda.</p>
                </div>

                <!-- Produk Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Produk 1 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                        <img src="{{ asset('images/pupuk.png') }}" alt="Produk 1" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">Pupuk Organik</h3>
                            <p class="text-gray-600 mb-4">
                                Pupuk organik berkualitas tinggi untuk meningkatkan hasil panen secara alami.
                            </p>
                            <a href="#" class="text-green-500 font-semibold hover:underline">
                                Selengkapnya →
                            </a>
                        </div>
                    </div>

                    <!-- Produk 2 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                        <img src="{{ asset('images/bibit.png') }}" alt="Produk 2" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">Bibit Unggul</h3>
                            <p class="text-gray-600 mb-4">
                                Bibit unggul dengan daya tumbuh tinggi untuk hasil panen yang maksimal.
                            </p>
                            <a href="#" class="text-green-500 font-semibold hover:underline">
                                Selengkapnya →
                            </a>
                        </div>
                    </div>

                    <!-- Produk 3 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                        <img src="{{ asset('images/obat.png') }}" alt="Produk 3" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">Obat Hama</h3>
                            <p class="text-gray-600 mb-4">
                                Obat pertanian yang efektif untuk mengendalikan hama dan penyakit tanaman.
                            </p>
                            <a href="#" class="text-green-500 font-semibold hover:underline">
                                Selengkapnya →
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimoni Section -->
        <section id="testimoni" class="min-h-screen bg-white">
            <div class="container mx-auto px-6 py-20">
                <!-- Section Header -->
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Apa Kata Mereka?</h2>
                    <p class="text-xl text-gray-600">Testimoni dari para pengguna Tani Desa yang telah merasakan
                        manfaatnya.</p>
                </div>

                <!-- Testimoni Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Testimoni 1 -->
                    <div
                        class="bg-green-50 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300 p-6">
                        <div class="flex items-center mb-4">
                            <img src="{{ asset('images/user1.jpg') }}" alt="User 1"
                                class="w-12 h-12 rounded-full object-cover">
                            <div class="ml-4">
                                <h3 class="text-lg font-bold text-gray-900">Budi Santoso</h3>
                                <p class="text-sm text-gray-600">Petani Padi</p>
                            </div>
                        </div>
                        <p class="text-gray-600">
                            "Dengan Tani Desa, saya bisa memantau stok pupuk dan benih dengan mudah. Hasil panen saya
                            meningkat
                            berkat produk berkualitas mereka."
                        </p>
                    </div>

                    <!-- Testimoni 2 -->
                    <div
                        class="bg-green-50 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300 p-6">
                        <div class="flex items-center mb-4">
                            <img src="{{ asset('images/user2.jpg') }}" alt="User 2"
                                class="w-12 h-12 rounded-full object-cover">
                            <div class="ml-4">
                                <h3 class="text-lg font-bold text-gray-900">Siti Aminah</h3>
                                <p class="text-sm text-gray-600">Distributor</p>
                            </div>
                        </div>
                        <p class="text-gray-600">
                            "Platform distribusi Tani Desa sangat membantu saya dalam mengelola pengiriman barang ke
                            petani.
                            Sistemnya mudah digunakan dan efisien."
                        </p>
                    </div>

                    <!-- Testimoni 3 -->
                    <div
                        class="bg-green-50 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300 p-6">
                        <div class="flex items-center mb-4">
                            <img src="{{ asset('images/user3.jpg') }}" alt="User 3"
                                class="w-12 h-12 rounded-full object-cover">
                            <div class="ml-4">
                                <h3 class="text-lg font-bold text-gray-900">Ahmad Fauzi</h3>
                                <p class="text-sm text-gray-600">Kelompok Tani</p>
                            </div>
                        </div>
                        <p class="text-gray-600">
                            "Tani Desa mempermudah koordinasi antar anggota kelompok tani kami. Kami bisa berbagi
                            informasi dan
                            memesan kebutuhan pertanian dengan cepat."
                        </p>
                    </div>
                </div>
            </div>
        </section>
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
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14.752 11.168l-9.193-5.333A1 1 0 004 6.667v10.666a1 1 0 001.559.829l9.193-5.333a1 1 0 000-1.658z" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('.md\\:flex a'); // Pilih semua link di navbar
            const sections = ['beranda', 'tentang', 'produk', 'testimoni']; // ID section yang sesuai dengan hash

            function setActiveLink() {
                const hash = window.location.hash.substring(1); // Ambil hash tanpa tanda #
                links.forEach(link => {
                    link.classList.remove('text-green-600', 'border-b-2',
                        'border-green-600'); // Hapus kelas aktif
                    link.classList.add('text-gray-600'); // Tambahkan kelas default
                });

                if (sections.includes(hash)) {
                    const activeLink = document.querySelector(`#link-${hash}`);
                    if (activeLink) {
                        activeLink.classList.add('text-green-600', 'border-b-2',
                            'border-green-600'); // Tambahkan kelas aktif
                        activeLink.classList.remove('text-gray-600'); // Hapus kelas default
                    }
                }
            }

            // Jalankan saat halaman dimuat
            setActiveLink();

            // Jalankan saat hash berubah
            window.addEventListener('hashchange', setActiveLink);
        });
    </script>
</x-guest-layout>
