<!-- filepath: c:\xampp\htdocs\Aplikasi_Agen-LPG-3KG\resources\views\admin\layout\default.blade.php -->
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
            <svg xmlns="http://www.w3.org/2000/svg" 
                 fill="none" viewBox="0 0 24 24" 
                 stroke-width="1.5" stroke="currentColor" 
                 class="w-5 h-5">
                <path stroke-linecap="round" 
                      stroke-linejoin="round" 
                      d="M15.75 9V5.25m0 0a3 3 0 00-3-3h-1.5a3 3 0 00-3 3V9m7.5 0h-9M4.5 9h15M5.25 9v10.5a3 3 0 003 3h7.5a3 3 0 003-3V9" />
            </svg>
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
                    <span>📊</span>
                    <span>Dashboard</span>
                </a>
                <!-- Perencanaan -->
                <div class="group">
                    <button class="flex items-center justify-between w-full px-3 py-2 rounded hover:bg-gray-200">
                        <span class="flex items-center space-x-2">
                            <span>📝</span>
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
                        <a href="#" class="block px-3 py-2 rounded hover:bg-gray-200">Rekapitulasi</a>
                    </div>
                </div>
                <a href="#" class="flex items-center space-x-2 px-3 py-2 rounded hover:bg-gray-200">
                    <span>🚚</span>
                    <span>Penyaluran</span>
                </a>
                <a href="#" class="flex items-center space-x-2 px-3 py-2 rounded hover:bg-gray-200">
                    <span>📖</span>
                    <span>Penerimaan</span>
                </a>
                <a href="#" class="flex items-center space-x-2 px-3 py-2 rounded hover:bg-gray-200">
                    <span>🗓️</span>
                    <span>Verifikasi Bulanan</span>
                </a>
                <a href="#" class="flex items-center space-x-2 px-3 py-2 rounded hover:bg-gray-200">
                    <span>📅</span>
                    <span>Verifikasi Triwulan</span>
                </a>
                <a href="#" class="flex items-center space-x-2 px-3 py-2 rounded hover:bg-gray-200">
                    <span>✅</span>
                    <span>Verifikasi Desember</span>
                </a>
            </nav>
        </aside>

        <!-- Content Area -->
        <main class="flex-1 bg-white p-6 overflow-y-auto">
            @yield('content') <!-- Bagian ini akan diisi oleh file lain -->
        </main>
    </div>

</body>
</html>