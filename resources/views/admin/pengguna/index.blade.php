<x-app-layout>
    @if (session('error'))
        <script>
            alert("{{ session('error') }}");
        </script>
    @endif
    <div class="p-4 sm">
        <!-- Heading dan Breadcrumb -->
        <div class="mb-4">
            <nav class="text-sm text-gray-500">
                <ol class="list-reset flex">
                    <li><a href="{{ route('admin.index') }}" class="hover:underline">Admin</a></li>
                    <li><span class="mx-2">></span></li>
                    <li class="text-gray-700"><a href="{{ route('admin.pengguna.index') }}">Pengguna</a></li>
                </ol>
                <h1 class="text-2xl font-bold text-black">Kelola Pengguna</h1>
            </nav>
        </div>

        <div class="p-4 rounded-lg bg-white border border-gray-200">
            <!-- Filter by Role -->
            <div class="flex items-center justify-between mb-4">
                <form method="GET" action="{{ route('admin.pengguna.filter') }}" class="flex items-center">
                    <label for="role" class="block text-sm font-medium text-gray-700 mr-2">Filter Role:</label>
                    <select name="role" id="role"
                        class="mt-1 block w-48 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">Semua</option>
                        <option value="gudang" {{ request('role') == 'gudang' ? 'selected' : '' }}>Gudang</option>
                        <option value="petani" {{ request('role') == 'petani' ? 'selected' : '' }}>Petani</option>
                        <option value="distributor" {{ request('role') == 'distributor' ? 'selected' : '' }}>Distributor
                        </option>
                    </select>
                    <button type="submit"
                        class="ml-2 px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Filter
                    </button>
                </form>
            </div>

            <!-- Tabel Pengguna -->
            <div class="overflow-x-auto mb-4">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
                    <thead class="bg-gradient-to-r from-green-400 to-green-600 text-white">
                        <tr>
                            <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider border-b">No
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider border-b">Nama
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider border-b">Email
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider border-b">Role
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider border-b">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($users as $index => $user)
                            <tr class="hover:bg-green-50 hover:shadow-md transition duration-200 ease-in-out">
                                <td class="px-6 py-4 text-center text-sm text-gray-700">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $user->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $user->email }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    @if ($user->role == 'gudang')
                                        Gudang
                                    @elseif ($user->role == 'petani')
                                        Petani
                                    @elseif ($user->role == 'distributor')
                                        Distributor
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <button type="submit"
                                        class="text-gray-500 hover:text-gray-700 transition duration-200 ease-in-out">
                                        <a href="{{ route('admin.pengguna.index', ['user_id' => $user->id]) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.522 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7s-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada pengguna.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @include('admin.pengguna.show')
</x-app-layout>
