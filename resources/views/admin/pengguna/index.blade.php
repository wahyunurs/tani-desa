<x-app-layout>
    <x-session-modal />

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
            <div
                class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-4 space-y-4 sm:space-y-0 sm:space-x-4">
                <form method="GET" action="{{ route('admin.pengguna.filter') }}" class="flex items-center"
                    id="filterForm"
                    class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-4 w-full">
                    <div class="w-full sm:w-auto">
                        <select name="role" id="role" onchange="document.getElementById('filterForm').submit()"
                            class="mt-1 block w-48 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="">Role</option>
                            <option value="gudang" {{ request('role') == 'gudang' ? 'selected' : '' }}>Gudang</option>
                            <option value="petani" {{ request('role') == 'petani' ? 'selected' : '' }}>Petani</option>
                            <option value="distributor" {{ request('role') == 'distributor' ? 'selected' : '' }}>
                                Distributor
                            </option>
                        </select>
                    </div>
                </form>

                <!-- Button Tambah -->
                <a href="{{ route('admin.pengguna.create') }}"
                    class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 flex items-center justify-center w-full sm:w-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah
                </a>
            </div>

            <!-- Tabel Pengguna -->
            <div class="overflow-x-auto mb-4">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
                    <thead class="bg-gradient-to-r from-green-400 to-green-600 text-white">
                        <tr>
                            <th class="px-4 py-3 text-center text-sm font-medium uppercase tracking-wider border-b">No
                            </th>
                            <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider border-b">Nama
                            </th>
                            <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider border-b">
                                Email
                            </th>
                            <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider border-b">Role
                            </th>
                            <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider border-b">Aksi
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
                                        <span class="px-2 py-1 rounded-full text-white bg-blue-500"> Gudang </span>
                                    @elseif ($user->role == 'petani')
                                        <span class="px-2 py-1 rounded-full text-white bg-red-500"> Petani </span>
                                    @elseif ($user->role == 'distributor')
                                        <span class="px-2 py-1 rounded-full text-white bg-yellow-500"> Distributor
                                        </span>
                                    @endif
                                </td>
                                <td class="h-full px-6 py-4 text-sm text-gray-700">
                                    <div class="flex items-center justify-center space-x-4 h-full">
                                        <!-- Tombol Show -->
                                        <button type="submit"
                                            class="text-gray-500 hover:text-gray-700 transition duration-200 ease-in-out">
                                            <a href="{{ route('admin.pengguna.show', $user->id) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.522 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7s-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                        </button>

                                        <!-- Tombol Edit -->
                                        <form action="{{ route('admin.pengguna.edit', $user->id) }}" method="GET">
                                            <button type="submit"
                                                class="text-yellow-500 hover:text-yellow-700 transition duration-200 ease-in-out">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536M9 11l6.364-6.364a2 2 0 012.828 0l1.172 1.172a2 2 0 010 2.828L13 15l-4 1 1-4z" />
                                                </svg>
                                            </button>
                                        </form>

                                        <!-- Tombol Delete -->
                                        <button type="button" data-id="{{ $user->id }}"
                                            data-url="{{ route('admin.pengguna.destroy', $user->id) }}"
                                            class="deleteButton text-red-500 hover:text-red-700 transition duration-200 ease-in-out">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3m5 0H6" />
                                            </svg>
                                        </button>
                                    </div>
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
    @include('admin.pengguna.delete')
</x-app-layout>
