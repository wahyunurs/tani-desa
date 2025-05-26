<x-app-layout>
    @if (session('error'))
        <script>
            alert("{{ session('error') }}");
        </script>
    @endif
    <div class="p-6 sm">
        <!-- Heading dan Breadcrumb -->
        <div class="mb-6">
            <nav class="text-sm text-gray-500">
                <ol class="list-reset flex items-center space-x-2">
                    <li><a href="{{ route('gudang.index') }}" class="hover:underline text-blue-600">Gudang</a></li>
                    <li><span class="text-gray-400">></span></li>
                    <li class="text-gray-700 font-semibold">Dashboard</li>
                </ol>
                <h1 class="text-3xl font-bold text-gray-800 mt-2">Petugas Gudang Dashboard</h1>
            </nav>
        </div>

        <div class="p-6 rounded-lg bg-white shadow-lg border border-gray-200">

        </div>
    </div>
</x-app-layout>
