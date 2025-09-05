@extends('admin.layout.default')

@section('content')
    <div class="bg-white p-6 mb-6 shadow-sm w-full">
        <h1 class="text-xl font-bold text-red-600 flex items-center">
            <!-- Icon Back -->
            <a href="{{ url()->previous() }}" class="text-red-600 hover:text-red-700 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            Perencanaan Agen 
            <span class="text-black text-base font-normal ml-2">/ Tambah</span>
        </h1>
    </div>

    <!-- Filter Form Card -->
    <div class="bg-white border rounded-lg p-6 mb-6 m-5 shadow-sm">
        <form id="filterForm">
            @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Kolom Kiri: Tanggal Awal, Tanggal Akhir, Kondisi -->
            <div class="flex flex-col space-y-6">
            <!-- Tanggal Awal -->
            <div class="flex items-center relative">
                <label class="block text-sm font-medium text-gray-700 min-w-[120px]">
                    Tanggal<br> Awal
                    <span class="text-red-600">*</span>
                </label>
                <div class="w-full relative">
                    <input type="text" id="tanggal_awal" name="tanggal_awal"
                        class="block rounded-md border-gray-300 shadow-md focus:ring-red-500 focus:border-red-500 sm:text-sm px-3 py-2 w-full pr-10"
                        style="box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                    <span class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </span>
                </div>
            </div>

            <!-- Tanggal Akhir -->
            <div class="flex items-center relative">
                <label class="block text-sm font-medium text-gray-700 min-w-[120px]">
                    Tanggal<br> Akhir
                    <span class="text-red-600">*</span>
                </label>
                <div class="w-full relative">
                    <input type="text" id="tanggal_akhir" name="tanggal_akhir"
                        class="block rounded-md border-gray-300 shadow-md focus:ring-red-500 focus:border-red-500 sm:text-sm px-3 py-2 w-full pr-10"
                        style="box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                    <span class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </span>
                </div>
            </div>
            <script>
                flatpickr("#tanggal_awal", { dateFormat: "Y-m-d" });
                flatpickr("#tanggal_akhir", { dateFormat: "Y-m-d" });
            </script>

            <!-- Kondisi -->
            <div class="flex items-center">
                <label class="block text-sm font-medium text-blue-600 min-w-[120px]">Kondisi</label>
                <select id="kondisiSelect" name="kondisi" class="block rounded-md border-gray-300 shadow-md focus:ring-red-500 focus:border-red-500 sm:text-sm px-3 py-2 w-full font-bold"
                style="box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                    <option value="Normal" class="text-blue-600 font-bold">Normal</option>
                    <option value="Sedang" class="text-yellow-500 font-bold">Sedang</option>
                    <option value="Tinggi" class="text-red-600 font-bold">Tinggi</option>
                </select>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const select = document.getElementById('kondisiSelect');
                    const colorMap = {
                        'Normal': '#2563eb',      // blue-600
                        'Sedang': '#f59e42',      // yellow-500
                        'Tinggi': '#dc2626',      // red-600
                        'Darurat': '#2563eb'      // blue-600
                    };
                    function updateColor() {
                        select.style.color = colorMap[select.value] || '#111827';
                        select.style.fontWeight = 'bold';
                    }
                    select.addEventListener('change', updateColor);
                    updateColor();
                });
            </script>
            </div>
            <!-- Kolom Kanan: Wilayah, Pangkalan -->
            <div class="flex flex-col space-y-6">
            <!-- Wilayah -->
            <div x-data="dropdownWilayah()" class="flex items-center mb-4 relative w-full">
                <label class="block text-sm font-medium text-gray-700 min-w-[120px]">Wilayah</label>

                <!-- Trigger -->
                <div class="relative w-full">
                    <input type="hidden" name="wilayah" x-model="selectedId">
                    <button type="button" @click="open = !open"
                        class="w-full flex justify-between items-center border rounded-md px-3 py-2 bg-white shadow-md focus:ring-red-500 focus:border-red-500 sm:text-sm">
                        <span x-text="selectedNama || 'Pilih Wilayah'"></span>
                        <!-- Arrow Icon -->
                        <svg class="h-4 w-4 text-gray-400 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                        </svg>
                    </button>

                    <!-- Dropdown -->
                    <div x-show="open" @click.prevent @click.away="open=false"
                        class="absolute z-10 mt-1 w-full bg-white border rounded-md shadow-lg max-h-60 overflow-y-auto"
                        x-transition>
                        <!-- Search -->
                        <div class="p-2">
                            <input type="text" x-model="search" placeholder="Cari wilayah..."
                                class="w-full border rounded px-2 py-1 text-sm focus:ring-red-500 focus:border-red-500">
                        </div>

                        <!-- Options -->
                        <ul>
                            <template x-for="item in filtered()" :key="item.w_id">
                                <li>
                                    <button type="button" @click="select(item)"
                                            class="w-full text-left px-3 py-2 hover:bg-gray-100 text-sm flex justify-between items-center">
                                        <span x-text="item.w_nama_kabupaten_atau_kota"></span>
                                    </button>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Pangkalan -->
            <div x-data="dropdownPangkalan()" class="flex items-center mb-4 relative w-full">
                <label class="block text-sm font-medium text-gray-700 min-w-[120px]">Pangkalan</label>

                <!-- Trigger -->
                <div class="relative w-full">
                    <input type="hidden" name="pangkalan" x-model="selectedId">
                    <button type="button" @click="open = !open"
                        class="w-full flex justify-between items-center border rounded-md px-3 py-2 bg-white shadow-md focus:ring-red-500 focus:border-red-500 sm:text-sm">
                        <span x-text="selectedNama || 'Pilih Pangkalan'"></span>
                        <!-- Arrow Icon -->
                        <svg class="h-4 w-4 text-gray-400 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                        </svg>
                    </button>

                    <!-- Dropdown -->
                    <div x-show="open" @click.prevent @click.away="open=false"
                        class="absolute z-10 mt-1 w-full bg-white border rounded-md shadow-lg max-h-60 overflow-y-auto"
                        x-transition>
                        
                        <!-- Search -->
                        <div class="p-2">
                            <input type="text" x-model="search" placeholder="Cari pangkalan..."
                                class="w-full border rounded px-2 py-1 text-sm focus:ring-red-500 focus:border-red-500">
                        </div>

                        <!-- Pilih Semua Option -->
                        <ul>
                            <li>
                                <button type="button"
                                    @click="
                                        selectedId = 'all';
                                        selectedNama = 'Pilih Semua Pangkalan';
                                        open = false;
                                    "
                                    class="w-full text-left px-3 py-2 hover:bg-gray-100 text-sm flex justify-between items-center font-semibold text-blue-600"
                                >
                                    Pilih Semua Pangkalan
                                </button>
                            </li>
                            <!-- Options -->
                            <template x-for="item in filtered()" :key="item.pklan_id">
                                <li>
                                    <button @click="select(item)"
                                            class="w-full text-left px-3 py-2 hover:bg-gray-100 text-sm flex justify-between items-center">
                                        <span x-text="item.pklan_nama_pangkalan"></span>
                                    </button>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Alpine.js Logic -->
            <script src="//unpkg.com/alpinejs" defer></script>
            <script>
            function dropdownWilayah() {
                return {
                    open: false,
                    search: '',
                    selectedId: null,
                    selectedNama: '',
                    items: @json($wilayah), // data dari controller
                    filtered() {
                        return this.items.filter(i =>
                            i.w_nama_kabupaten_atau_kota.toLowerCase().includes(this.search.toLowerCase())
                        );
                    },
                    select(item) {
                        this.selectedId = item.w_id;
                        this.selectedNama = item.w_nama_kabupaten_atau_kota;
                        this.open = false;

                        // trigger update dropdown pangkalan
                        window.dispatchEvent(new CustomEvent('wilayah-selected', { detail: this.selectedId }));
                    }
                }
            }

            function dropdownPangkalan() {
                return {
                    open: false,
                    search: '',
                    selectedId: null,
                    selectedNama: '',
                    items: [],
                    filtered() {
                        return this.items.filter(i =>
                            i.pklan_nama_pangkalan.toLowerCase().includes(this.search.toLowerCase())
                        );
                    },
                    select(item) {
                        this.selectedId = item.pklan_id;
                        this.selectedNama = item.pklan_nama_pangkalan;
                        this.open = false;
                    },
                    init() {
                        // dengar event dari wilayah
                        window.addEventListener('wilayah-selected', (e) => {
                            let wilayahId = e.detail;
                            fetch(`/perencanaan/pangkalan/${wilayahId}`)
                                .then(res => res.json())
                                .then(data => {
                                    this.items = data;
                                    this.selectedId = null;
                                    this.selectedNama = '';
                                });
                        });
                    }
                }
            }
            </script>


            </div>
        </div>

        {{-- <!-- Tombol -->
        <div class="mt-6 flex space-x-3">
            <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounscript shadow">
                Tampilkan
            </button>
            <div class="relative inline-block" style="min-width: 120px;">
                <select id="importDropdownSelect" class="block appearance-none bg-blue-400 text-white font-semibold px-4 py-2 pr-8 rounded-md shadow focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer"
                    style="width: 140px; min-width: 120px;">
                    <option value="" disabled selected>Import Data</option>
                    <option value="excel">Import Excel (.xlsx/.xls)</option>
                    <option value="csv">Import CSV (.csv)</option>
                </select>
                <!-- Custom Dropdown Arrow -->
                <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2">
                    <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                    </svg>
                </span>
                <form id="excelImportForm" action="{{ route('admin.perencanaan.import') }}" method="POST" enctype="multipart/form-data" style="display:none;">
                    @csrf
                    <input type="file" name="import_file" accept=".xlsx,.xls" id="excelFileInput">
                </form>
                <form id="csvImportForm" action="{{ route('admin.perencanaan.import') }}" method="POST" enctype="multipart/form-data" style="display:none;">
                    @csrf
                    <input type="file" name="import_file" accept=".csv" id="csvFileInput">
                </form>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const select = document.getElementById('importDropdownSelect');
                    const excelForm = document.getElementById('excelImportForm');
                    const csvForm = document.getElementById('csvImportForm');
                    const excelInput = document.getElementById('excelFileInput');
                    const csvInput = document.getElementById('csvFileInput');

                    select.addEventListener('change', function () {
                        if (select.value === 'excel') {
                            excelInput.click();
                        } else if (select.value === 'csv') {
                            csvInput.click();
                        }
                        select.selectedIndex = 0;
                    });

                    excelInput.addEventListener('change', function () {
                        if (excelInput.files.length) {
                            excelForm.submit();
                        }
                    });
                    csvInput.addEventListener('change', function () {
                        if (csvInput.files.length) {
                            csvForm.submit();
                        }
                    });
                });
            </script>
        </div>
        </form> --}}

        
            <!-- Tombol -->
            <div class="mt-6 flex space-x-3">
                <button type="button" id="btnTampilkan" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">
                    Tampilkan
                </button>
                <button type="button" id="btnImport" class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-2 rounded shadow relative" style="width: 140px; min-width: 120px;">
                    Import Data
                    <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2">
                        <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                        </svg>
                    </span>
                </button>
                <input type="file" id="importFile" name="import_file" accept=".xlsx,.xls,.csv" style="display: none;">
            </div>
        </form>
    </div>

    <!-- Table Card -->
    {{-- <div class="bg-white border rounded-lg p-6 m-5 shadow-sm overflow-x-auto">
        <h2 class="text-lg font-semibold mb-4 text-gray-700">Perencanaan Agen</h2>

        <table class="min-w-full table-auto border border-gray-300 text-sm">
            <thead class="text-gray-700">
            <tr>
                <th class="px-4 py-2 text-left border-2 border-gray-400 w-auto">Id Registrasi</th>
                <th class="px-4 py-2 text-left border-2 border-gray-400 w-64">Nama Pangkalan</th>
                <th class="px-4 py-2 text-left border-2 border-gray-400 w-32">Pembayaran</th>
                <th class="px-4 py-2 text-center border-2 border-gray-400 w-full">04-06</th>
            </tr>
            </thead>
            <tbody id="tableBody">
            <tr>
                <td class="px-4 py-2 border border-gray-300">120142941125046</td>
                <td class="px-4 py-2 border border-gray-300 truncate">ANDAR SITEPU</td>
                <td class="px-4 py-2 border border-gray-300">CASHLESS</td>
                <td class="border border-gray-300 text-center p-0">
                <div class="flex justify-center items-center">
                    <input type="number"
                    class="w-full h-full border bg-white text-center focus:outline-none 
                        focus:ring-0 text-gray-700 [appearance:textfield] rounded-md p-1 mx-2 input-04-06"
                    value="0"
                    min="0"
                    style="max-width: 99%; box-sizing: border-box;">
                </div>
                </td>
            </tr>

            <tr>
                <td class="px-4 py-2 border border-gray-300">120135941125048</td>
                <td class="px-4 py-2 border border-gray-300 truncate">ANDREAS SURBAKTI</td>
                <td class="px-4 py-2 border border-gray-300">CASHLESS</td>
                <td class="border border-gray-300 text-center p-0">
                <div class="flex justify-center items-center">
                    <input type="number"
                    class="w-full h-full border bg-white text-center focus:outline-none 
                        focus:ring-0 text-gray-700 [appearance:textfield] rounded-md p-1 mx-2 input-04-06"
                    value="0"
                    min="0"
                    style="max-width: 99%; box-sizing: border-box;">
                </div>
                </td>
            </tr>

            <tr>
                <td class="px-4 py-2 border border-gray-300">120255941125039</td>
                <td class="px-4 py-2 border border-gray-300 truncate">ATIKA THESA SAFITRI</td>
                <td class="px-4 py-2 border border-gray-300">CASHLESS</td>
                <td class="border border-gray-300 text-center p-0">
                <div class="flex justify-center items-center">
                    <input type="number"
                    class="w-full h-full border bg-white text-center focus:outline-none 
                        focus:ring-0 text-gray-700 [appearance:textfield] rounded-md p-1 mx-2 input-04-06"
                    value="0"
                    min="0"
                    style="max-width: 99%; box-sizing: border-box;">
                </div>
                </td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3" class="px-4 py-2 text-center font-bold border border-gray-300 bg-gray-100">Total</td>
                <td class="px-4 py-2 text-center font-bold border border-gray-300 bg-gray-100">
                <span id="total-04-06">0</span>
                </td>
            </tr>
            </tfoot>
        </table>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
            function updateTotal() {
                let total = 0;
                document.querySelectorAll('.input-04-06').forEach(function(input) {
                total += parseInt(input.value) || 0;
                });
                document.getElementById('total-04-06').textContent = total;
            }
            document.querySelectorAll('.input-04-06').forEach(function(input) {
                input.addEventListener('input', updateTotal);
            });
            updateTotal();
            });
        </script>
    </div> --}}
    <!-- Table Card -->
    <div class="bg-white border rounded-lg p-6 m-5 shadow-sm overflow-x-auto">
        <h2 class="text-lg font-semibold mb-4 text-gray-700">Perencanaan Agen</h2>
        <table id="perencanaanTable" class="min-w-full table-auto border border-gray-300 text-sm">
            <thead id="tableHeader" class="text-gray-700">
                <!-- Header tabel akan diisi secara dinamis -->
            </thead>
            <tbody id="tableBody">
                <!-- Data tabel akan diisi secara dinamis -->
            </tbody>
            <tfoot id="tableFooter">
                <!-- Footer tabel akan diisi secara dinamis -->
            </tfoot>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const wilayahSelect = document.getElementById('wilayah');
            const pangkalanSelect = document.getElementById('pangkalan');
            const btnTampilkan = document.getElementById('btnTampilkan');
            const tableHeader = document.getElementById('tableHeader');
            const tableBody = document.getElementById('tableBody');
            const tableFooter = document.getElementById('tableFooter');

            // Fetch pangkalan berdasarkan wilayah
            wilayahSelect.addEventListener('change', function () {
                const wilayahId = this.value;
                if (wilayahId) {
                    fetch(`/perencanaan/form/pangkalan/${wilayahId}`)
                        .then(response => response.json())
                        .then(data => {
                            pangkalanSelect.innerHTML = '<option value="all">Pilih Semua Pangkalan</option>';
                            data.forEach(item => {
                                pangkalanSelect.innerHTML += `<option value="${item.pklan_id}">${item.pklan_nama_pangkalan}</option>`;
                            });
                        });
                } else {
                    pangkalanSelect.innerHTML = '<option value="all">Pilih Semua Pangkalan</option>';
                }
            });

            // Event untuk tombol "Tampilkan"
            btnTampilkan.addEventListener('click', function () {
                const formData = new FormData(document.getElementById('filterForm'));
                const tanggalAwal = new Date(formData.get('tanggal_awal'));
                const tanggalAkhir = new Date(formData.get('tanggal_akhir'));

                // Buat header tabel berdasarkan rentang tanggal
                const headerRow = `
                    <tr>
                        <th class="px-4 py-2 text-left border-2 border-gray-400">Id Registrasi</th>
                        <th class="px-4 py-2 text-left border-2 border-gray-400">Nama Pangkalan</th>
                        <th class="px-4 py-2 text-left border-2 border-gray-400">Pembayaran</th>
                        ${generateDateHeaders(tanggalAwal, tanggalAkhir)}
                    </tr>
                `;
                tableHeader.innerHTML = headerRow;

                // Isi data tabel
                tableBody.innerHTML = '';
                const wilayahText = wilayahSelect.options[wilayahSelect.selectedIndex].text;
                const pangkalanText = pangkalanSelect.options[pangkalanSelect.selectedIndex].text;

                const row = `
                    <tr>
                        <td class="px-4 py-2 border border-gray-300">${generateUniqueId()}</td>
                        <td class="px-4 py-2 border border-gray-300">${pangkalanText}</td>
                        <td class="px-4 py-2 border border-gray-300">CASHLESS</td>
                        ${generateDateCells(tanggalAwal, tanggalAkhir)}
                    </tr>
                `;
                tableBody.innerHTML += row;

                // Tambahkan footer untuk total
                const footerRow = `
                    <tr>
                        <td colspan="3" class="px-4 py-2 text-center font-bold border border-gray-300 bg-gray-100">Total</td>
                        <td colspan="${getDateRangeLength(tanggalAwal, tanggalAkhir)}" class="px-4 py-2 text-center font-bold border border-gray-300 bg-gray-100">
                            <span id="total-04-06">0</span>
                        </td>
                    </tr>
                `;
                tableFooter.innerHTML = footerRow;

                // Update total setelah data dimuat
                updateTotal();
            });

            // Fungsi untuk membuat header tanggal (dd-mm)
            function generateDateHeaders(startDate, endDate) {
                let headers = '';
                for (let d = new Date(startDate); d <= endDate; d.setDate(d.getDate() + 1)) {
                    const formattedDate = `${String(d.getDate()).padStart(2, '0')}-${String(d.getMonth() + 1).padStart(2, '0')}`;
                    headers += `<th class="px-4 py-2 text-center border-2 border-gray-400">${formattedDate}</th>`;
                }
                return headers;
            }

            // Fungsi untuk membuat sel tanggal kosong
            function generateDateCells(startDate, endDate) {
                let cells = '';
                for (let d = new Date(startDate); d <= endDate; d.setDate(d.getDate() + 1)) {
                    cells += `
                        <td class="border border-gray-300 text-center p-0">
                            <div class="flex justify-center items-center">
                                <input type="number"
                                    class="w-full h-full border bg-white text-center focus:outline-none 
                                        focus:ring-0 text-gray-700 [appearance:textfield] rounded-md p-1 mx-2 input-04-06"
                                    value="0"
                                    min="0"
                                    style="max-width: 99%; box-sizing: border-box;">
                            </div>
                        </td>
                    `;
                }
                return cells;
            }

            // Fungsi untuk menghitung total
            function updateTotal() {
                let total = 0;
                document.querySelectorAll('.input-04-06').forEach(function(input) {
                    total += parseInt(input.value) || 0;
                });
                document.getElementById('total-04-06').textContent = total;
            }

            // Fungsi untuk menghitung panjang rentang tanggal
            function getDateRangeLength(startDate, endDate) {
                let length = 0;
                for (let d = new Date(startDate); d <= endDate; d.setDate(d.getDate() + 1)) {
                    length++;
                }
                return length;
            }

            // Fungsi untuk membuat ID unik 15 digit
            function generateUniqueId() {
                return Math.floor(100000000000000 + Math.random() * 900000000000000);
            }

            // Tambahkan event listener untuk menghitung total saat nilai spinner berubah
            document.addEventListener('input', function (event) {
                if (event.target.classList.contains('input-04-06')) {
                    updateTotal();
                }
            });
        });
    </script>

<style>
/* Hilangkan spinner bawaan number di Chrome, lalu custom warna */
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    opacity: 1;
}
</style>



@endsection
