<x-guest-layout>
    <main>
        <div class="min-h-screen flex items-center justify-center bg-green-100">
            <div class="flex flex-col md:flex-row w-full max-w-5xl bg-white rounded-lg shadow-lg overflow-hidden">
                <!-- Form Section -->
                <div class="md:w-1/2 p-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Masuk ke Akun Anda</h2>
                    <p class="text-gray-600 mb-6">Selamat datang kembali! Silakan login untuk melanjutkan.</p>
                    <form class="space-y-6" method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input id="email" type="email" name="email" :value="old('email')" required
                                autofocus
                                class="mt-1 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                placeholder="youremail@gmail.com">
                            @error('email')
                                <span class="text-sm text-red-500 mt-2">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input id="password" type="password" name="password" required
                                class="mt-1 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                placeholder="Masukkan password Anda">
                            @error('password')
                                <span class="text-sm text-red-500 mt-2">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember_me" type="checkbox"
                                    class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-green-500">
                                <label for="remember_me" class="ml-2 text-sm text-gray-700">Ingat Saya</label>
                            </div>

                            <!-- Forgot Password Link -->
                            {{-- @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="text-sm text-green-500 hover:underline">Lupa Password?</a>
                            @endif --}}
                        </div>

                        <!-- Login Button -->
                        <div>
                            <button type="submit"
                                class="w-full bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition duration-300">
                                Masuk
                            </button>
                        </div>
                    </form>

                    <!-- Register Link -->
                    <p class="text-center text-sm text-gray-600 mt-6">
                        Belum punya akun? <a href="{{ route('register') }}"
                            class="text-green-500 hover:underline">Daftar</a>
                    </p>
                </div>

                <!-- Image Section -->
                <div class="hidden md:block md:w-1/2">
                    <img src="{{ asset('images/login-register.png') }}" alt="Login Image"
                        class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </main>
</x-guest-layout>
