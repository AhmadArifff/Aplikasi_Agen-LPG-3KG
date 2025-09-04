<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-screen flex flex-col">

    <!-- Navbar -->
    <header class="w-full bg-red-600 text-white flex justify-between items-center px-6 py-3 shadow">
        <div class="font-bold text-lg">PERTAMINA</div>
        <button class="flex items-center space-x-2 hover:text-gray-200">
            <img src="{{ asset('images/power-button.png') }}" alt="Dashboard Icon" class="w-7 h-7.">
            <span>Keluar</span>
        </button>
    </header>

    <!-- Main Layout -->
    <div class="flex flex-1 overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-100 border-r overflow-y-auto p-4">
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

                <!-- Perencanaan -->
                <div class="group">
                    <button class="flex items-center justify-between w-full px-3 py-2 rounded hover:bg-gray-200">
                        <span class="flex items-center space-x-2">
                            <img src="{{ asset('images/arrow-right.png') }}" alt="Dashboard Icon" class="w-3.5 h-3.">
                            <span>Perencanaan</span>
                        </span>
                        <svg class="w-4 h-4 transform group-hover:rotate-90 transition" fill="none" 
                             stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" 
                                  stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                    <div class="ml-6 mt-1 space-y-1">
                        <a href="#" class="block px-3 py-2 rounded hover:bg-gray-200">Form</a>
                        <a href="{{ url('/rekapitulasi') }}" class="flex items-center space-x-2 px-3 py-2 rounded hover:bg-gray-200">
                            <span>Rekapitulasi</span>
                        </a>
                    </div>
                </div>

                <a href="#" class="flex items-center space-x-2 px-3 py-2 rounded hover:bg-gray-200">
                    <img src="{{ asset('images/arrow-left.png') }}" alt="Dashboard Icon" class="w-3.5 h-3.">
                    <span>Penyaluran</span>
                </a>

                <a href="#" class="flex items-center space-x-2 px-3 py-2 rounded hover:bg-gray-200">
                    <img src="{{ asset('images/open-book.png') }}" alt="Dashboard Icon" class="w-3.5 h-3.">
                    <span>Penerimaan</span>
                </a>

                <a href="#" class="flex items-center space-x-2 px-3 py-2 rounded hover:bg-gray-200">
                    <img src="{{ asset('images/calendar.png') }}" alt="Dashboard Icon" class="w-3.5 h-3.">
                    <span>Verifikasi Bulanan</span>
                </a>

                <a href="#" class="flex items-center space-x-2 px-3 py-2 rounded hover:bg-gray-200">
                    <img src="{{ asset('images/calendar (1).png') }}" alt="Dashboard Icon" class="w-3.5 h-3.">
                    <span>Verifikasi Triwulan</span>
                </a>

                <a href="#" class="flex items-center space-x-2 px-3 py-2 rounded hover:bg-gray-200">
                    <img src="{{ asset('images/calendar (1).png') }}" alt="Dashboard Icon" class="w-3.5 h-3.">
                    <span>Verifikasi Desember</span>
                </a>
                <a href="#" class="flex items-center space-x-2 px-3 py-2 rounded hover:bg-gray-200">
                    <img src="{{ asset('images/pie-chart.png') }}" alt="Dashboard Icon" class="w-3.5 h-3.">
                    <span>IN / OUT Agen</span>
                </a>
                <a href="#" class="flex items-center space-x-2 px-3 py-2 rounded hover:bg-gray-200">
                    <img src="{{ asset('images/pencil.png') }}" alt="Dashboard Icon" class="w-3.5 h-3.">
                    <span>Input Harian</span>
                </a><a href="#" class="flex items-center space-x-2 px-3 py-2 rounded hover:bg-gray-200">
                    <img src="{{ asset('images/troubleshoot.png') }}" alt="Dashboard Icon" class="w-3.5 h-3.">
                    <span>Master</span>
                </a>
                </a><a href="#" class="flex items-center space-x-2 px-3 py-2 rounded hover:bg-gray-200">
                    <img src="{{ asset('images/checkmark.png') }}" alt="Dashboard Icon" class="w-3.5 h-3.">
                    <span>Pendaftaran Pangkalan</span>
                </a>
            </nav>
        </aside>

        <!-- Content Area -->
        <main class="flex-1 bg-white p-6 overflow-y-auto">
            @yield('content')
        </main>

    </div>

</body>
</html>
