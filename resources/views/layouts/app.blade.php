<!-- filepath: d:\laragon\www\pupuk-tani-desa\resources\views\layouts\app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Admin Panel</title>
</head>

<body>
    <div id="app-container" class="relative flex">
        @include('components.sidebar-admin')
        <div id="content-container" class="flex-1 transition-all duration-300 ml-64">
            @include('components.navbar-admin')

            <main id="main-content" class="bg-gray-100 p-4 transition-all duration-300">
                {{ $slot }}
            </main>
        </div>
    </div>

    {{-- Script flowbite --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script>
        // Toggle Sidebar
        document.getElementById('toggle-sidebar').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar-admin');
            const contentContainer = document.getElementById('content-container');
            const toggleSidebarButton = document.getElementById('toggle-sidebar');
            const navbarLogo = document.getElementById('navbar-logo');

            // Toggle sidebar visibility
            sidebar.classList.toggle('-translate-x-full');

            // Adjust content layout
            if (sidebar.classList.contains('-translate-x-full')) {
                navbarLogo.classList.remove('hidden');
                contentContainer.classList.remove('ml-64');
                contentContainer.classList.add('w-full');
            } else {
                navbarLogo.classList.add('hidden');
                contentContainer.classList.add('ml-64');
                contentContainer.classList.remove('w-full');
            }
        });
    </script>
</body>

</html>
