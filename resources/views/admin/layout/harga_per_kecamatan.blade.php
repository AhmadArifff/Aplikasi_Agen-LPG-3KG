@extends('admin.layout.default')

@section('content')
<div class="bg-white p-6 mb-6 shadow-sm w-full flex items-center justify-between">
    <h1 class="text-2xl font-bold text-gray-700">Harga Harian</h1>
    <a href="#" class="text-blue-500 flex flex-col items-center hover:text-blue-700">
      <span class="text-xl font-bold">+</span>
      <span>Penyaluran</span>
    </a>
</div>

<!-- Filter -->
<div class="bg-white border rounded-lg p-6 mb-6 m-5 shadow-sm">
    <form method="GET" id="filterForm" class="flex space-x-2 mb-4">
        <!-- Pilih Kota -->
        <select name="kota" class="border p-2 rounded" onchange="document.getElementById('filterForm').submit()">
            <option value="">-- Pilih Kota --</option>
            @foreach($kotaList as $kota)
                <option value="{{ $kota->w_id }}" {{ $selectedKota == $kota->w_id ? 'selected' : '' }}>
                    {{ $kota->w_nama_kabupaten_atau_kota }}
                </option>
            @endforeach
        </select>

        <!-- Bulan -->
        <input type="month" name="bulan" class="border rounded p-2"
            value="{{ $selectedBulan }}"
            onchange="document.getElementById('filterForm').submit()">
    </form>

    <!-- Tabel -->
    <div class="bg-white shadow rounded-lg p-4">
        <table id="hargaTable" class="min-w-full border border-gray-200 display">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Tanggal</th>
                    <th class="px-4 py-2 border">Wilayah</th>
                    <th class="px-4 py-2 border">Min. Harga Pangkalan</th>
                    <th class="px-4 py-2 border">Max. Harga Pangkalan</th>
                    <th class="px-4 py-2 border">Min. Estimasi Konsumen</th>
                    <th class="px-4 py-2 border">Max. Estimasi Konsumen</th>
                    <th class="px-4 py-2 border">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $row)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $row['tanggal'] }}</td>
                        <td class="px-4 py-2 border">{{ $row['wilayah'] }}</td>
                        <td class="px-4 py-2 border">{{ $row['min_harga'] }}</td>
                        <td class="px-4 py-2 border">{{ $row['max_harga'] }}</td>
                        <td class="px-4 py-2 border">{{ $row['min_estimasi'] }}</td>
                        <td class="px-4 py-2 border">{{ $row['max_estimasi'] }}</td>
                        <td class="px-4 py-2 border text-center">
                            <a href="#">
                                <img src="/images/view.png" alt="View" class="inline w-5 h-5">
                            </a>
                            <a href="#" class="ml-2">
                                <img src="/images/edit.png" alt="Edit" class="inline w-5 h-5">
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

<script>
    document.addEventListener("DOMContentLoaded", function() {
        $('#hargaTable').DataTable({
            paging: true,         
            searching: false,     
            lengthChange: true,   
            ordering: true,       
            order: [[0, 'desc']], 
            info: true,           
            language: {
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Tidak ada data tersedia",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "›",
                    previous: "‹"
                }
            },
            dom: 't<"flex justify-between items-center mt-4"ip>'
            
        });
    });
</script>
@endsection

