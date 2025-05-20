<!-- filepath: d:\laragon\www\pupuk-tani-desa\resources\views\welcome.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pupuk Tani Desa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 10;
        }

        main {
            padding-top: 80px;
        }
    </style>
</head>

<body class="bg-gradient-to-b from-green-500 to-green-400 text-white font-sans">
    <!-- Header -->
    <header class="flex justify-between items-center px-8 py-4 bg-green-600 shadow-md">
        <div class="flex items-center">
            <img src="{{ asset('images/logo.png') }}" class="h-11 me-3" alt="Tani Desa Logo" />
            <span class="self-center text-xl font-bold sm:text-3xl whitespace-nowrap">Tani Desa</span>
        </div>
        <nav class="flex items-center space-x-6 text-white font-medium">
            <a href="#beranda" class="hover:underline hover:text-green-300 transition duration-300">Beranda</a>
            <a href="#tentang" class="hover:underline hover:text-green-300 transition duration-300">Tentang</a>
            <a href="#produk" class="hover:underline hover:text-green-300 transition duration-300">Produk</a>
            <a href="#testimoni" class="hover:underline hover:text-green-300 transition duration-300">Testimoni</a>
            <a href="#kontak" class="hover:underline hover:text-green-300 transition duration-300">Kontak</a>
            <a href="{{ route('login') }}"
                class="border border-white rounded-full px-4 py-1 hover:bg-white hover:text-green-600 transition duration-300">Masuk</a>
            <a href="{{ route('register') }}"
                class="bg-white text-green-600 rounded-full px-4 py-1 font-semibold hover:bg-green-100 transition duration-300">Daftar</a>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        <!-- Beranda Section -->
        <section id="beranda" class="px-8 py-20 md:flex md:justify-between md:items-center">
            <div class="md:w-1/2 space-y-6">
                <h1
                    class="text-4xl md:text-5xl font-extrabold leading-tight hover:text-green-300 transition duration-300">
                    Tani Desa<br>Solusi
                    Pertanian<br>Modern
                </h1>
                <p class="text-lg text-white/90 hover:text-green-200 transition duration-300">Dukung produktivitas
                    pertanian Anda dengan produk kami yang berkualitas tinggi
                    yang ramah lingkungan dan terjangkau.</p>
                <div class="flex gap-4">
                    <a href="#produk"
                        class="bg-white text-green-600 font-semibold px-6 py-3 rounded-full hover:bg-green-100 hover:scale-105 transition duration-300">Mulai
                        Sekarang</a>
                    <a href="#tentang"
                        class="border border-white text-white px-6 py-3 rounded-full hover:bg-white hover:text-green-600 hover:scale-105 transition duration-300">Pelajari
                        Lebih Lanjut</a>
                </div>
            </div>
            <div class="mt-12 md:mt-0 md:w-1/2 flex justify-center">
                <img src="{{ asset('images/pupuk-tani-desa.png') }}" alt="Pupuk Tani"
                    class="rounded-xl w-[400px] shadow-lg hover:scale-105 transition-transform duration-300">
            </div>
        </section>

        <!-- Tentang Section -->
        <section id="tentang" class="bg-green-100 text-green-800 py-16">
            <div class="max-w-6xl mx-auto px-6">
                <h2 class="text-3xl font-bold text-center mb-8 hover:text-green-600 transition duration-300">Tentang
                    Kami</h2>
                <p class="text-lg leading-relaxed mb-6">
                    Website <strong>Pupuk Tani Desa</strong> adalah platform yang dirancang untuk mendukung petani dalam
                    meningkatkan produktivitas pertanian mereka. Kami menyediakan berbagai fitur dan layanan yang dapat
                    membantu petani, distributor, dan pihak terkait lainnya untuk mencapai hasil yang optimal.
                </p>
                <ul class="list-disc list-inside space-y-4">
                    <li class="hover:text-green-600 transition duration-300">
                        <strong>Produk Berkualitas:</strong> Kami menawarkan berbagai macam produk seperti pupuk, bibit,
                        dan obat tanaman yang dirancang untuk mendukung pertanian modern.
                    </li>
                    <li class="hover:text-green-600 transition duration-300">
                        <strong>Manajemen Permintaan:</strong> Petani dapat dengan mudah mengajukan permintaan barang
                        melalui sistem kami, yang akan diproses oleh distributor dan petugas gudang.
                    </li>
                    <li class="hover:text-green-600 transition duration-300">
                        <strong>Distribusi Efisien:</strong> Kami membantu mengelola distribusi barang agar sampai ke
                        petani dengan cepat dan tepat waktu.
                    </li>
                    <li class="hover:text-green-600 transition duration-300">
                        <strong>Informasi Terbaru:</strong> Dapatkan informasi terkini tentang produk, layanan, dan tips
                        pertanian untuk mendukung keberhasilan Anda.
                    </li>
                    <li class="hover:text-green-600 transition duration-300">
                        <strong>Testimoni:</strong> Dengarkan pengalaman petani lain yang telah menggunakan produk dan
                        layanan kami.
                    </li>
                </ul>
                <p class="mt-6">
                    Dengan <strong>Pupuk Tani Desa</strong>, kami berkomitmen untuk mendukung pertanian berkelanjutan
                    dan membantu petani mencapai hasil panen yang lebih baik. Jelajahi website ini untuk menemukan
                    solusi terbaik bagi kebutuhan pertanian Anda.
                </p>
            </div>
        </section>

        <!-- Produk Section -->
        <section id="produk" class="bg-white text-green-600 py-16">
            <div class="max-w-6xl mx-auto px-6">
                <h2 class="text-3xl font-bold text-center mb-8 hover:text-green-800 transition duration-300">Produk Kami
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center hover:scale-105 transition-transform duration-300">
                        <img src="{{ asset('images/pupuk.png') }}" alt="Produk 1" class="rounded-lg shadow-md mb-4">
                        <h3 class="text-xl font-semibold">Pupuk</h3>
                        <p>Berbagai macam pupuk berkualitas tinggi untuk meningkatkan kesuburan tanah.</p>
                    </div>
                    <div class="text-center hover:scale-105 transition-transform duration-300">
                        <img src="{{ asset('images/bibit.png') }}" alt="Produk 2" class="rounded-lg shadow-md mb-4">
                        <h3 class="text-xl font-semibold">Bibit</h3>
                        <p>Benih unggul yang dirancang untuk menghasilkan tanaman yang lebih sehat dan produktif.</p>
                    </div>
                    <div class="text-center hover:scale-105 transition-transform duration-300">
                        <img src="{{ asset('images/obat.png') }}" alt="Produk 3" class="rounded-lg shadow-md mb-4">
                        <h3 class="text-xl font-semibold">Obat</h3>
                        <p>Solusi perlindungan tanaman dari hama dan penyakit untuk hasil panen yang optimal.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimoni Section -->
        <section id="testimoni" class="bg-white text-green-600 py-16">
            <div class="max-w-6xl mx-auto px-6">
                <h2 class="text-3xl font-bold text-center mb-8 hover:text-green-800 transition duration-300">Apa Kata
                    Mereka?</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-green-50 p-6 rounded-lg shadow-md hover:scale-105 transition-transform duration-300">
                        <p class="italic">"Pupuk Tani Desa sangat membantu meningkatkan hasil panen saya. Tanaman
                            menjadi
                            lebih subur dan sehat."</p>
                        <p class="mt-4 font-semibold">- Budi, Petani Jagung</p>
                    </div>
                    <div class="bg-green-50 p-6 rounded-lg shadow-md hover:scale-105 transition-transform duration-300">
                        <p class="italic">"Produk ini benar-benar ramah lingkungan. Saya sangat merekomendasikannya
                            untuk
                            petani lain."</p>
                        <p class="mt-4 font-semibold">- Siti, Petani Sayur</p>
                    </div>
                    <div class="bg-green-50 p-6 rounded-lg shadow-md hover:scale-105 transition-transform duration-300">
                        <p class="italic">"Bibit unggul dari Tani Desa membuat hasil panen saya meningkat pesat."</p>
                        <p class="mt-4 font-semibold">- Andi, Petani Padi</p>
                    </div>
                    <div class="bg-green-50 p-6 rounded-lg shadow-md hover:scale-105 transition-transform duration-300">
                        <p class="italic">"Obat tanaman dari Tani Desa sangat efektif melindungi tanaman saya dari
                            hama."</p>
                        <p class="mt-4 font-semibold">- Dewi, Petani Buah</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Kontak Section -->
        <section id="kontak" class="bg-green-600 text-white py-16">
            <div class="max-w-6xl mx-auto px-6 text-center">
                <h2 class="text-3xl font-bold mb-8 hover:text-green-300 transition duration-300">Hubungi Kami</h2>
                <p class="mb-4 hover:text-green-200 transition duration-300">Jika Anda memiliki pertanyaan atau ingin
                    memesan produk kami, jangan ragu untuk menghubungi kami.</p>
                <p class="mb-4">Telepon: <a href="tel:+6281234567890" class="hover:text-green-300">+62 812 3456
                        7890</a></p>
                <p class="mb-4">Email: <a href="mailto:info@pupuktanidesa.com"
                        class="hover:text-green-300">info@pupuktanidesa.com</a></p>
                <p>Alamat: Jl. Pertanian No. 123, Desa Makmur, Indonesia</p>
                <a href="mailto:info@pupuktanidesa.com"
                    class="bg-white text-green-600 px-6 py-3 rounded-full font-semibold hover:bg-green-100 hover:scale-105 transition duration-300">Email
                    Kami</a>

            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-green-700 text-white py-8">
        <div class="max-w-4xl mx-auto text-center">
            <p class="text-sm hover:text-green-300 transition duration-300">&copy; 2025 Pupuk Tani Desa. Semua Hak
                Dilindungi.</p>
        </div>
    </footer>
</body>

</html>
