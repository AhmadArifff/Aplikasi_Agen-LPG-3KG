<!-- filepath: c:\xampp\htdocs\Aplikasi_Agen-LPG-3KG\resources\views\admin\layout\default.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pertamina - Sim3long</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <!-- Local & CDN Stylesheets -->
    <link rel="stylesheet" href="https://simelon-cbdkdzc9fsbebget.a01.azurefd.net/res/css/icons/icomoon/styles.min.css?ver=1.0.0" type="text/css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-screen flex flex-col">

    <!-- Navbar -->
    <header class="w-full bg-red-600 text-white flex justify-between items-center px-6 py-3 shadow">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('assets/img/favicon.png') }}" alt="Logo" class="w-8 h-8 object-contain" style="filter: brightness(0) invert(1);">
            <span class="font-bold text-lg">PERTAMINA</span>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center space-x-2 hover:text-gray-200">
                <img src="{{ asset('images/power-button.png') }}" alt="Dashboard Icon" class="w-7 h-7.">
                <span>Keluar</span>
            </button>
        </form>
    </header>

    <!-- Main Layout -->
    <div class="flex flex-1 overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r overflow-y-auto p-4">
            <div class="mb-6">
                <div class="font-bold text-gray-800">941125</div>
                <div class="text-sm text-gray-600">KOPERASI PURNA KARYA PERTAMINA</div>
            </div>
            <div class="text-xs font-semibold text-gray-500 uppercase mb-2">Navigasi</div>
            <nav class="space-y-1">
                <a href="#" class="flex items-center space-x-2 px-3 py-2 rounded hover:bg-gray-200">
                    <img src="{{ asset('images/pie-chart.png') }}" alt="Dashboard Icon" class="w-3.5 h-3.">
                    <span>Dashboard</span>
                </a>
                <!-- Simple Dropdown Button (pakai Alpine) -->
                <div x-data="{ open: false }" x-cloak @click.away="open = false" class="w-full">
                    <!-- Button utama -->
                    <button
                        @click="open = !open"
                        :aria-expanded="open.toString()"
                        class="flex items-center justify-between w-full px-3 py-2 rounded hover:bg-gray-200 transition"
                        :class="{ 'bg-gray-200': open }"
                    >
                        <span class="flex items-center space-x-2">
                            <img src="{{ asset('images/arrow-right.png') }}" alt="Perencanaan Icon" class="w-3.5 h-3">
                            <span class="text-sm">Perencanaan</span>
                        </span>

                        <!-- panah berputar -->
                        <svg class="w-4 h-4 transform transition-transform duration-200" :class="{ 'rotate-90': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>

                    <!-- Submenu (muncul/sembunyi) -->
                    <div
                        x-show="open"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 -translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-1"
                        class="ml-6 mt-1 space-y-1"
                        style="display: none;"   
                    >
                        <!-- filepath: c:\xampp\htdocs\Aplikasi_Agen-LPG-3KG\resources\views\admin\layout\default.blade.php -->
                        <a href="{{ url('/admin/perencanaan/form') }}" 
                        class="block px-3 py-2 rounded transition-colors text-sm 
                                {{ request()->is('admin/perencanaan/form') ? 'bg-red-500 text-white' : 'hover:bg-gray-200' }}">
                            Form
                        </a>
                        <a href="{{ url('/rekapitulasi') }}" 
                        class="block px-3 py-2 rounded transition-colors text-sm 
                                {{ request()->is('rekapitulasi') ? 'bg-red-500 text-white' : 'hover:bg-gray-200' }}">
                            Rekapitulasi
                        </a>
                    </div>
                </div>

                <!-- Penyaluran Dropdown -->
                <div x-data="{ open: false }" x-cloak @click.away="open = false" class="w-full">
                    <!-- Button utama -->
                    <button
                        @click="open = !open"
                        :aria-expanded="open.toString()"
                        class="flex items-center justify-between w-full px-3 py-2 rounded hover:bg-gray-200 transition"
                        :class="{ 'bg-gray-200': open }"
                    >
                        <span class="flex items-center space-x-2">
                            <img src="{{ asset('images/arrow-left.png') }}" alt="Penyaluran Icon" class="w-3.5 h-3">
                            <span class="text-sm">Penyaluran</span>
                        </span>
                        <svg class="w-4 h-4 transform transition-transform duration-200" :class="{ 'rotate-90': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                    <!-- Submenu (muncul/sembunyi) -->
                    <div
                        x-show="open"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 -translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-1"
                        class="ml-6 mt-1 space-y-1"
                        style="display: none;"
                    >
                        <a href="{{ url('/admin/penyaluran/form') }}"
                           class="block px-3 py-2 rounded transition-colors text-sm
                           {{ request()->is('admin/penyaluran/form') ? 'bg-red-500 text-white' : 'hover:bg-gray-200' }}">
                            Form Penyaluran
                        </a>
                        <a href="{{ url('/admin/penyaluran/rekapitulasi') }}"
                           class="block px-3 py-2 rounded transition-colors text-sm
                           {{ request()->is('admin/penyaluran/rekapitulasi') ? 'bg-red-500 text-white' : 'hover:bg-gray-200' }}">
                            Rekapitulasi Penyaluran
                        </a>
                    </div>
                </div>

                <!-- Penerimaan Dropdown -->
                <div x-data="{ open: false }" x-cloak @click.away="open = false" class="w-full">
                    <button
                        @click="open = !open"
                        :aria-expanded="open.toString()"
                        class="flex items-center justify-between w-full px-3 py-2 rounded hover:bg-gray-200 transition"
                        :class="{ 'bg-gray-200': open }"
                    >
                        <span class="flex items-center space-x-2">
                            <img src="{{ asset('images/open-book.png') }}" alt="Penerimaan Icon" class="w-3.5 h-3.">
                            <span class="text-sm">Penerimaan</span>
                        </span>
                        <svg class="w-4 h-4 transform transition-transform duration-200" :class="{ 'rotate-90': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                    <div
                        x-show="open"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 -translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-1"
                        class="ml-6 mt-1 space-y-1"
                        style="display: none;"
                    >
                        <a href="#" class="block px-3 py-2 rounded hover:bg-gray-200 transition-colors text-sm">Submenu 1</a>
                        <a href="#" class="block px-3 py-2 rounded hover:bg-gray-200 transition-colors text-sm">Submenu 2</a>
                    </div>
                </div>

                <!-- Verifikasi Bulanan Dropdown -->
                <div x-data="{ open: false }" x-cloak @click.away="open = false" class="w-full">
                    <button
                        @click="open = !open"
                        :aria-expanded="open.toString()"
                        class="flex items-center justify-between w-full px-3 py-2 rounded hover:bg-gray-200 transition"
                        :class="{ 'bg-gray-200': open }"
                    >
                        <span class="flex items-center space-x-2">
                            <img src="{{ asset('images/calendar.png') }}" alt="Verifikasi Bulanan Icon" class="w-3.5 h-3.">
                            <span class="text-sm">Verifikasi Bulanan</span>
                        </span>
                        <svg class="w-4 h-4 transform transition-transform duration-200" :class="{ 'rotate-90': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                    <div
                        x-show="open"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 -translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-1"
                        class="ml-6 mt-1 space-y-1"
                        style="display: none;"
                    >
                        <a href="#" class="block px-3 py-2 rounded hover:bg-gray-200 transition-colors text-sm">Submenu 1</a>
                        <a href="#" class="block px-3 py-2 rounded hover:bg-gray-200 transition-colors text-sm">Submenu 2</a>
                    </div>
                </div>

                <!-- Verifikasi Triwulan Dropdown -->
                <div x-data="{ open: false }" x-cloak @click.away="open = false" class="w-full">
                    <button
                        @click="open = !open"
                        :aria-expanded="open.toString()"
                        class="flex items-center justify-between w-full px-3 py-2 rounded hover:bg-gray-200 transition"
                        :class="{ 'bg-gray-200': open }"
                    >
                        <span class="flex items-center space-x-2">
                            <img src="{{ asset('images/calendar (1).png') }}" alt="Verifikasi Triwulan Icon" class="w-3.5 h-3.">
                            <span class="text-sm">Verifikasi Triwulan</span>
                        </span>
                        <svg class="w-4 h-4 transform transition-transform duration-200" :class="{ 'rotate-90': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                    <div
                        x-show="open"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 -translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-1"
                        class="ml-6 mt-1 space-y-1"
                        style="display: none;"
                    >
                        <a href="#" class="block px-3 py-2 rounded hover:bg-gray-200 transition-colors text-sm">Submenu 1</a>
                        <a href="#" class="block px-3 py-2 rounded hover:bg-gray-200 transition-colors text-sm">Submenu 2</a>
                    </div>
                </div>

                <!-- Verifikasi Desember Dropdown -->
                <div x-data="{ open: false }" x-cloak @click.away="open = false" class="w-full">
                    <button
                        @click="open = !open"
                        :aria-expanded="open.toString()"
                        class="flex items-center justify-between w-full px-3 py-2 rounded hover:bg-gray-200 transition"
                        :class="{ 'bg-gray-200': open }"
                    >
                        <span class="flex items-center space-x-2">
                            <img src="{{ asset('images/calendar (1).png') }}" alt="Verifikasi Desember Icon" class="w-3.5 h-3.">
                            <span class="text-sm">Verifikasi Desember</span>
                        </span>
                        <svg class="w-4 h-4 transform transition-transform duration-200" :class="{ 'rotate-90': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                    <div
                        x-show="open"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 -translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-1"
                        class="ml-6 mt-1 space-y-1"
                        style="display: none;"
                    >
                        <a href="#" class="block px-3 py-2 rounded hover:bg-gray-200 transition-colors text-sm">Submenu 1</a>
                        <a href="#" class="block px-3 py-2 rounded hover:bg-gray-200 transition-colors text-sm">Submenu 2</a>
                    </div>
                </div>

                <!-- IN / OUT Agen Dropdown -->
                <div x-data="{ open: false }" x-cloak @click.away="open = false" class="w-full">
                    <button
                        @click="open = !open"
                        :aria-expanded="open.toString()"
                        class="flex items-center justify-between w-full px-3 py-2 rounded hover:bg-gray-200 transition"
                        :class="{ 'bg-gray-200': open }"
                    >
                        <span class="flex items-center space-x-2">
                            <img src="{{ asset('images/pie-chart.png') }}" alt="IN / OUT Agen Icon" class="w-3.5 h-3.">
                            <span class="text-sm">IN / OUT Agen</span>
                        </span>
                        <svg class="w-4 h-4 transform transition-transform duration-200" :class="{ 'rotate-90': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                    <div
                        x-show="open"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 -translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-1"
                        class="ml-6 mt-1 space-y-1"
                        style="display: none;"
                    >
                        <a href="#" class="block px-3 py-2 rounded hover:bg-gray-200 transition-colors text-sm">Submenu 1</a>
                        <a href="#" class="block px-3 py-2 rounded hover:bg-gray-200 transition-colors text-sm">Submenu 2</a>
                    </div>
                </div>

                <!-- Input Harian Dropdown -->
                <div x-data="{ open: false }" x-cloak @click.away="open = false" class="w-full">
                    <button
                        @click="open = !open"
                        :aria-expanded="open.toString()"
                        class="flex items-center justify-between w-full px-3 py-2 rounded hover:bg-gray-200 transition"
                        :class="{ 'bg-gray-200': open }"
                    >
                        <span class="flex items-center space-x-2">
                            <img src="{{ asset('images/pencil.png') }}" alt="Input Harian Icon" class="w-3.5 h-3.">
                            <span class="text-sm">Input Harian</span>
                        </span>
                        <svg class="w-4 h-4 transform transition-transform duration-200" :class="{ 'rotate-90': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                    <div
                        x-show="open"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 -translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-1"
                        class="ml-6 mt-1 space-y-1"
                        style="display: none;"
                    >
                        <a href="{{ url('/admin/harga-per-kecamatan') }}" 
                           class="block px-3 py-2 rounded transition-colors text-sm 
                           {{ request()->is('admin/harga-per-kecamatan') ? 'bg-red-500 text-white' : 'hover:bg-gray-200' }}">
                            Harga Per Kecamatan
                        </a>
                        <a href="{{ url('/admin/input-harian/rekapitulasi') }}" 
                           class="block px-3 py-2 rounded transition-colors text-sm 
                           {{ request()->is('admin/input-harian/rekapitulasi') ? 'bg-red-500 text-white' : 'hover:bg-gray-200' }}">
                            Stok Per Pangkalan
                        </a>
                    </div>
                </div>

                <!-- Master Dropdown -->
                <div x-data="{ open: false }" x-cloak @click.away="open = false" class="w-full">
                    <button
                        @click="open = !open"
                        :aria-expanded="open.toString()"
                        class="flex items-center justify-between w-full px-3 py-2 rounded hover:bg-gray-200 transition"
                        :class="{ 'bg-gray-200': open }"
                    >
                        <span class="flex items-center space-x-2">
                            <img src="{{ asset('images/troubleshoot.png') }}" alt="Master Icon" class="w-3.5 h-3.">
                            <span class="text-sm">Master</span>
                        </span>
                        <svg class="w-4 h-4 transform transition-transform duration-200" :class="{ 'rotate-90': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                    <div
                        x-show="open"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 -translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-1"
                        class="ml-6 mt-1 space-y-1"
                        style="display: none;"
                    >
                        <a href="#" class="block px-3 py-2 rounded hover:bg-gray-200 transition-colors text-sm">Submenu 1</a>
                        <a href="#" class="block px-3 py-2 rounded hover:bg-gray-200 transition-colors text-sm">Submenu 2</a>
                    </div>
                </div>

                <!-- Pendaftaran Pangkalan Dropdown -->
                <div x-data="{ open: false }" x-cloak @click.away="open = false" class="w-full">
                    <button
                        @click="open = !open"
                        :aria-expanded="open.toString()"
                        class="flex items-center justify-between w-full px-3 py-2 rounded hover:bg-gray-200 transition"
                        :class="{ 'bg-gray-200': open }"
                    >
                        <span class="flex items-center space-x-2">
                            <img src="{{ asset('images/checkmark.png') }}" alt="Pendaftaran Pangkalan Icon" class="w-3.5 h-3.">
                            <span class="text-sm">Pendaftaran Pangkalan</span>
                        </span>
                        <svg class="w-4 h-4 transform transition-transform duration-200" :class="{ 'rotate-90': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                    <div
                        x-show="open"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 -translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-1"
                        class="ml-6 mt-1 space-y-1"
                        style="display: none;"
                    >
                        <a href="#" class="block px-3 py-2 rounded hover:bg-gray-200 transition-colors text-sm">Submenu 1</a>
                        <a href="#" class="block px-3 py-2 rounded hover:bg-gray-200 transition-colors text-sm">Submenu 2</a>
                    </div>
                </div>
            </nav>
        </aside>

        <!-- Content Area -->
        <main class="flex-1 bg-gray-100 overflow-y-auto">
            @yield('content')
        </main>


    </div>

</body>
</html>