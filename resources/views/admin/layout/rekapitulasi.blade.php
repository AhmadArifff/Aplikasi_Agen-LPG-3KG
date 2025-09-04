@extends('admin.layout.default')

@section('content')
  <!-- Header -->
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-700">Rekapitulasi Penyaluran</h1>
    <button class="text-blue-500 flex flex-col items-center hover:text-blue-700">
      <span class="text-xl font-bold">+</span>
      <span>Penyaluran</span>
    </button>
  </div>

 <!-- Filter Section -->
<div class="bg-white p-4 rounded-xl shadow mb-6">
  <form id="filterForm" method="GET" action="{{ route('rekapitulasi.index') }}">
    <div class="flex flex-wrap items-center gap-4">
      <!-- Kota -->
      <select id="kota" name="kota" class="border rounded p-2 w-48">
        <option value="">Pilih Kota</option>
        @foreach($wilayah as $w)
          <option value="{{ $w->w_id }}" {{ request('kota') == $w->w_id ? 'selected' : '' }}>
            {{ strtoupper($w->w_nama_kabupaten_atau_kota) }}
          </option>
        @endforeach
      </select>

      <!-- Pangkalan -->
      <select id="pangkalan" name="pangkalan" class="border rounded p-2 w-60">
        <option value="">Pilih Semua Pangkalan</option>
        @foreach($pangkalan as $p)
          <option value="{{ $p->pklan_id }}" {{ request('pangkalan') == $p->pklan_id ? 'selected' : '' }}>
            {{ $p->pklan_nama_pangkalan }}
          </option>
        @endforeach
      </select>

      <!-- Bulan -->
      <input type="month" name="bulan" class="border rounded p-2"
             value="{{ request('bulan', now()->format('Y-m')) }}">

      <!-- Kondisi -->
      <select id="kondisi" name="kondisi" class="border rounded p-2">
        <option value="">Semua Kondisi</option>
        @foreach($kondisi as $k)
          <option value="{{ $k->pa_kondisi }}" {{ request('kondisi') == $k->pa_kondisi ? 'selected' : '' }}>
            {{ $k->pa_kondisi }}
          </option>
        @endforeach
      </select>

      <!-- Dropdown Download -->
      <div class="relative inline-block">
        <button type="button" id="downloadDropdownBtn" 
          class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
          Download Sebagai
        </button>
        <div id="downloadDropdown" 
             class="hidden absolute mt-2 w-40 bg-white border border-gray-200 rounded shadow-lg">
          <button type="button" class="download-option block w-full text-left px-4 py-2 hover:bg-gray-100" data-format="csv">CSV</button>
          <button type="button" class="download-option block w-full text-left px-4 py-2 hover:bg-gray-100" data-format="excel">Excel</button>
          <button type="button" class="download-option block w-full text-left px-4 py-2 hover:bg-gray-100" data-format="pdf">PDF</button>
        </div>
      </div>

      <!-- Cashless -->
      <button type="button" class="bg-green-100 text-gray-700 font-semibold px-4 py-2 rounded hover:bg-green-200">
        Cashless
      </button>
    </div>
  </form>
</div>

<!-- Script auto submit -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const filterForm = document.getElementById("filterForm");
    const inputs = filterForm.querySelectorAll("select, input[type='month']");

    inputs.forEach(el => {
      el.addEventListener("change", function () {
        filterForm.submit();
      });
    });

    // Toggle dropdown download
    const dropdownBtn = document.getElementById("downloadDropdownBtn");
    const dropdown = document.getElementById("downloadDropdown");

    dropdownBtn.addEventListener("click", function (e) {
      e.preventDefault();
      dropdown.classList.toggle("hidden");
    });

    document.addEventListener("click", function (e) {
      if (!dropdown.contains(e.target) && !dropdownBtn.contains(e.target)) {
        dropdown.classList.add("hidden");
      }
    });
  });
</script>


  <!-- Table -->
  <div class="bg-white p-4 rounded-xl shadow overflow-x-auto">
    <table id="rekapTable" class="display w-full text-sm border border-gray-300">
      <thead>
        <tr class="bg-gray-100">
          <th class="border border-gray-300 px-2 py-1">Id Registrasi</th>
          <th class="border border-gray-300 px-2 py-1">Nama Pangkalan</th>
          <th class="border border-gray-300 px-2 py-1">Kota</th>
          <th class="border border-gray-300 px-2 py-1">Status</th>
          @for ($i = 1; $i <= 31; $i++)
            <th class="border border-gray-300 px-2 py-1">
              {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}
            </th>
          @endfor
        </tr>
      </thead>
      <tbody>
        @foreach ($rekapitulasi as $r)
          <tr>
            <td>{{ $r->pa_id }}</td>
            <td>{{ $r->pangkalan->pklan_nama_pangkalan ?? '-' }}</td>
            <td>{{ $r->pangkalan->wilayah->w_nama_kabupaten_atau_kota ?? '-' }}</td>
            <td>{{ $r->pa_kondisi }}</td>
            @for ($i = 1; $i <= 31; $i++)
              <td>{{ $r->tanggal[$i] ?? '' }}</td>
            @endfor
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- DataTables Buttons -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<script>
  $(document).ready(function () {
    var table = $('#rekapTable').DataTable({
      paging: false,
      searching: false,
      info: false,
      lengthChange: false,
      ordering: true,
      order: [[1, 'asc']], 
      scrollX: true,
      language: {
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
      },
      dom: 't',
      buttons: [
        { extend: 'csvHtml5', className: 'buttons-csv', text: 'CSV', title: 'Rekapitulasi Penyaluran'},
        { extend: 'excelHtml5', className: 'buttons-excel', text: 'Excel',title: 'Rekapitulasi Penyaluran'},
        { extend: 'pdfHtml5', className: 'buttons-pdf', text: 'PDF',title: 'Rekapitulasi Penyaluran',
          customize: function (doc) {
        doc.content[0].text = 'Rekapitulasi Penyaluran'; // ubah header PDF
        }
          }
        ]
    });

    // Trigger export dari dropdown
    $(".download-option").on("click", function () {
      var format = $(this).data("format");
      table.button('.buttons-' + format).trigger();
      $("#downloadDropdown").addClass("hidden");
    });
  });
</script>
@endsection
