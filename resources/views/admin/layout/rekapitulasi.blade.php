<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Rekapitulasi Penyaluran</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>
<body class="bg-gray-50 p-6">

  <!-- Header -->
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-700">Rekapitulasi Penyaluran</h1>
    <button class="text-blue-500 flex items-center space-x-1 hover:text-blue-700">
      <span class="text-xl font-bold">+</span>
      <span>Penyaluran</span>
    </button>
  </div>

  <!-- Filter Section -->
  <div class="bg-white p-4 rounded-xl shadow mb-6">
    <div class="flex flex-wrap items-center gap-4">
      <!-- Dropdown Kota -->
      <select id="kota" class="border rounded p-2 w-48">
        <option>KOTA MEDAN</option>
        <option>KOTA JAKARTA</option>
      </select>

      <!-- Dropdown Pangkalan -->
      <select id="pangkalan" class="border rounded p-2 w-60">
        <option>Pilih Semua Pangkalan</option>
        <option>Pangkalan A</option>
        <option>Pangkalan B</option>
      </select>

      <!-- Date Picker -->
      <input type="month" class="border rounded p-2" value="2024-06">

      <!-- Kondisi -->
      <select id="kondisi" class="border rounded p-2">
        <option>Normal</option>
        <option>Lainnya</option>
      </select>

      <!-- Tombol Cashless -->
      <button class="bg-green-100 text-gray-700 font-semibold px-4 py-2 rounded hover:bg-green-200">
        Cashless
      </button>

      <!-- Download -->
      <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Download Sebagai
      </button>
    </div>
  </div>

  <!-- Table -->
  <div class="bg-white p-4 rounded-xl shadow">
    <table id="rekapTable" class="display w-full text-sm">
      <thead>
        <tr>
          <th>Id Registrasi</th>
          <th>Nama Pangkalan</th>
          <th>Status</th>
          <th>Alokasi</th>
          <th>01</th>
          <th>02</th>
          <th>03</th>
          <th>04</th>
          <th>05</th>
          <th>06</th>
          <th>07</th>
          <th>08</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>120221941125010</td>
          <td>AHMAD ANDIKA SILABAN</td>
          <td>AKTIF</td>
          <td>560</td>
          <td>0</td><td>0</td><td>0</td><td>0</td>
          <td>0</td><td>0</td><td>0</td><td>0</td>
        </tr>
        <tr>
          <td>120142941125046</td>
          <td>ANDAR SITEPU</td>
          <td>AKTIF</td>
          <td>560</td>
          <td>0</td><td>0</td><td>110</td><td>0</td>
          <td>0</td><td>0</td><td>90</td><td>0</td>
        </tr>
        <tr>
          <td>120135941125048</td>
          <td>ANDAREAS SURBAKTI</td>
          <td>TIDAK AKTIF</td>
          <td>560</td>
          <td>0</td><td>0</td><td>0</td><td>0</td>
          <td>0</td><td>0</td><td>100</td><td>0</td>
        </tr>
      </tbody>
    </table>
  </div>

  <script>
    $(document).ready(function () {
      $('#rekapTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        columnDefs: [
          { targets: 2, type: 'string' } // kolom status bisa di sort
        ],
        language: {
          url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
        }
      });
    });
  </script>
</body>
</html>
