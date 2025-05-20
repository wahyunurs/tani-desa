<!-- filepath: d:\laragon\www\pupuk-tani-desa\resources\views\auth\register.blade.php -->
<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-b from-green-200 to-green-100 flex items-center justify-center py-10">
        <div class="w-full max-w-md p-8 bg-white border border-green-300 rounded-lg shadow-lg">
            <h2 class="text-3xl font-bold text-center text-green-700 mb-6">Daftar Akun Baru</h2>
            <p class="text-center text-gray-600 mb-6">Silakan isi formulir di bawah untuk membuat akun baru.</p>
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Nama Lengkap')" class="text-green-700" />
                    <x-text-input id="name"
                        class="block mt-1 w-full p-3 border border-green-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                        placeholder="Nama Lengkap" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500" />
                </div>

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-green-700" />
                    <x-text-input id="email"
                        class="block mt-1 w-full p-3 border border-green-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        type="email" name="email" :value="old('email')" required autocomplete="username"
                        placeholder="youremail@gmail.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
                </div>

                <!-- Alamat -->
                <div>
                    <x-input-label for="alamat" :value="__('Alamat')" class="text-green-700" />
                    <x-text-input id="alamat"
                        class="block mt-1 w-full p-3 border border-green-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        type="text" name="alamat" :value="old('alamat')" required autocomplete="alamat"
                        placeholder="Alamat Lengkap" />
                    <x-input-error :messages="$errors->get('alamat')" class="mt-2 text-red-500" />
                </div>

                <!-- Desa -->
                <div>
                    <x-input-label for="desa" :value="__('Desa')" class="text-green-700" />
                    <x-text-input id="desa"
                        class="block mt-1 w-full p-3 border border-green-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        type="text" name="desa" :value="old('desa')" required autocomplete="desa"
                        placeholder="Nama Desa" />
                    <x-input-error :messages="$errors->get('desa')" class="mt-2 text-red-500" />
                </div>

                <!-- Nomor Telepon -->
                <div>
                    <x-input-label for="nomor_telepon" :value="__('Nomor Telepon')" class="text-green-700" />
                    <x-text-input id="nomor_telepon"
                        class="block mt-1 w-full p-3 border border-green-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        type="text" name="nomor_telepon" :value="old('nomor_telepon')" required autocomplete="tel"
                        placeholder="081234567890" />
                    <x-input-error :messages="$errors->get('nomor_telepon')" class="mt-2 text-red-500" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-green-700" />
                    <x-text-input id="password"
                        class="block mt-1 w-full p-3 border border-green-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        type="password" name="password" required autocomplete="new-password" placeholder="Password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-green-700" />
                    <x-text-input id="password_confirmation"
                        class="block mt-1 w-full p-3 border border-green-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        type="password" name="password_confirmation" required autocomplete="new-password"
                        placeholder="Konfirmasi Password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500" />
                </div>

                <!-- Role -->
                <div>
                    <x-input-label for="role" :value="__('Role')" class="text-green-700" />
                    <select id="role" name="role"
                        class="block mt-1 w-full p-3 border border-green-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                        <option value="petani" {{ old('role') == 'petani' ? 'selected' : '' }}>Petani</option>
                        <option value="gudang" {{ old('role') == 'gudang' ? 'selected' : '' }}>Petugas Gudang</option>
                        <option value="distributor" {{ old('role') == 'distributor' ? 'selected' : '' }}>Distributor
                        </option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-2 text-red-500" />
                </div>

                <!-- Already Registered -->
                <div class="flex items-center justify-between">
                    <a class="text-sm text-green-700 hover:text-green-500 focus:outline-none focus:ring-2 focus:ring-green-500"
                        href="{{ route('login') }}">
                        {{ __('Sudah punya akun? Masuk') }}
                    </a>
                    <x-primary-button
                        class="px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:ring-2 focus:ring-green-500">
                        {{ __('Daftar') }}
                    </x-primary-button>
                </div>
            </form>

            <!-- Back to Home -->
            <div class="mt-6 text-center">
                <a href="{{ route('welcome') }}"
                    class="text-sm text-green-700 hover:text-green-500 focus:outline-none focus:ring-2 focus:ring-green-500">
                    {{ __('Kembali ke Beranda') }}
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
