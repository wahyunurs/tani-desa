<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <title>Admin Panel</title>
    <style>
        #sidebar-admin {
            height: 100vh;
        }

        #content-container {
            transition: margin-left 0.3s ease, width 0.3s ease;
        }

        #content-container.with-sidebar {
            margin-left: 16rem;
            width: calc(100% - 16rem);
        }

        #content-container.full-width {
            margin-left: 0 !important;
            width: 100% !important;
        }
    </style>
</head>

<body>
    <div id="app-container" class="relative flex">
        @include('components.sidebar')

        <div id="content-container" class="flex-1 with-sidebar">
            @include('components.navbar')
            <main id="main-content" class="bg-green-50 p-4 transition-all duration-300">
                {{ $slot }}
            </main>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar-admin');
            const contentContainer = document.getElementById('content-container');
            const toggleSidebarButton = document.getElementById('toggle-sidebar');
            const navbarLogo = document.getElementById('navbar-logo');

            // Fungsi buka/tutup sidebar
            function setSidebarState(show) {
                if (show) {
                    sidebar.style.transform = 'translateX(0)';
                    contentContainer.classList.add('with-sidebar');
                    contentContainer.classList.remove('full-width');
                    navbarLogo.classList.add('hidden');
                } else {
                    sidebar.style.transform = 'translateX(-100%)';
                    contentContainer.classList.remove('with-sidebar');
                    contentContainer.classList.add('full-width');
                    navbarLogo.classList.remove('hidden');
                }
            }

            // Deteksi apakah layar besar atau kecil
            function isLargeScreen() {
                return window.innerWidth >= 1024; // Tailwind lg breakpoint
            }

            // Inisialisasi
            if (isLargeScreen()) {
                setSidebarState(true);
            } else {
                setSidebarState(false);
            }

            // Toggle saat tombol diklik
            toggleSidebarButton.addEventListener('click', function() {
                const isHidden = sidebar.style.transform === 'translateX(-100%)';
                setSidebarState(isHidden);
            });

            // Re-adjust saat resize
            window.addEventListener('resize', () => {
                if (isLargeScreen()) {
                    setSidebarState(true);
                } else {
                    setSidebarState(false);
                }
            });
        });
    </script>

    <script src="https://unpkg.com/alpinejs" defer></script>
</body>

</html>
