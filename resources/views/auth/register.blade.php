<x-guest-layout>
    <main class="bg-green-100 min-h-screen flex items-center justify-center">
        <div class="flex flex-col md:flex-row w-full max-w-5xl bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Form Section -->
            <div class="md:w-1/2 p-8 overflow-y-auto max-h-[calc(100vh-4rem)]">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Daftar Akun Baru</h2>
                <p class="text-gray-600 mb-6">Silakan isi formulir di bawah untuk membuat akun baru.</p>
                <form class="space-y-6" method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input id="name" type="text" name="name" :value="old('name')" required autofocus
                            class="mt-1 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                            placeholder="Nama Lengkap">
                        @error('name')
                            <span class="text-sm text-red-500 mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" type="email" name="email" :value="old('email')" required
                            class="mt-1 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                            placeholder="youremail@gmail.com">
                        @error('email')
                            <span class="text-sm text-red-500 mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <input id="alamat" type="text" name="alamat" :value="old('alamat')" required
                            class="mt-1 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                            placeholder="Alamat Anda">
                        @error('alamat')
                            <span class="text-sm text-red-500 mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Desa -->
                    <div>
                        <label for="desa" class="block text-sm font-medium text-gray-700">Desa</label>
                        <input id="desa" type="text" name="desa" :value="old('desa')" required
                            class="mt-1 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                            placeholder="Desa Anda">
                        @error('desa')
                            <span class="text-sm text-red-500 mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Nomor Telepon -->
                    <div>
                        <label for="nomor_telepon" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <input id="nomor_telepon" type="number" name="nomor_telepon" :value="old('nomor_telepon')"
                            required
                            class="mt-1 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                            placeholder="Nomor Telepon">
                        @error('nomor_telepon')
                            <span class="text-sm text-red-500 mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input id="password" type="password" name="password" required
                            class="mt-1 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                            placeholder="Password">
                        @error('password')
                            <span class="text-sm text-red-500 mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi
                            Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            class="mt-1 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                            placeholder="Konfirmasi Password">
                        @error('password_confirmation')
                            <span class="text-sm text-red-500 mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="w-full bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition duration-300">
                            Daftar
                        </button>
                    </div>
                </form>

                <!-- Login Link -->
                <p class="text-center text-sm text-gray-600 mt-6">
                    Sudah punya akun? <a href="{{ route('login') }}" class="text-green-500 hover:underline">Masuk</a>
                </p>
            </div>

            <!-- Image Section -->
            <div class="hidden md:block md:w-1/2">
                <img src="{{ asset('images/login-register.png') }}" alt="Register Image"
                    class="w-full h-full object-cover">
            </div>
        </div>
    </main>
</x-guest-layout>
