<!-- filepath: d:\laragon\www\pupuk-tani-desa\resources\views\auth\login.blade.php -->
<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-b from-green-200 to-green-100 flex items-center justify-center py-10">
        <div class="w-full max-w-md p-8 bg-white border border-green-200 rounded-lg shadow-lg">
            <h2 class="text-3xl font-bold text-center text-green-700 mb-6">Masuk ke Akun Anda</h2>
            <p class="text-center text-gray-600 mb-6">Selamat datang kembali! Silakan login untuk melanjutkan.</p>
            <form class="space-y-6" method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-green-700" />
                    <x-text-input id="email"
                        class="block mt-1 w-full p-3 border border-green-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                        placeholder="youremail@gmail.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-green-700" />
                    <x-text-input id="password"
                        class="block mt-1 w-full p-3 border border-green-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        type="password" name="password" required autocomplete="current-password"
                        placeholder="Masukkan password Anda" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="w-4 h-4 border border-green-300 rounded bg-green-50 focus:ring-3 focus:ring-green-500">
                        <label for="remember_me" class="ml-2 text-sm font-medium text-green-700">
                            {{ __('Ingat Saya') }}
                        </label>
                    </div>
                    @if (Route::has('password.request'))
                        <a class="text-sm text-green-500 hover:underline focus:outline-none focus:ring-2 focus:ring-green-500"
                            href="{{ route('password.request') }}">
                            {{ __('Lupa Password?') }}
                        </a>
                    @endif
                </div>

                <!-- Login Button -->
                <div class="flex items-center justify-between mt-6">
                    <a class="text-sm text-green-700 hover:text-green-500 focus:outline-none focus:ring-2 focus:ring-green-500"
                        href="{{ route('register') }}">
                        {{ __('Belum punya akun? Daftar') }}
                    </a>
                    <x-primary-button
                        class="px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:ring-2 focus:ring-green-500">
                        {{ __('Masuk') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
