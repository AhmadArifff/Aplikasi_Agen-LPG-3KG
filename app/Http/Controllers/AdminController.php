<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\Wilayah;
use App\Models\Pangkalan;
use App\Models\Perencanaan;


class AdminController extends Controller
{
    public function index()
    {
        return view('admin.layout.default');
    }
    // Fungsi untuk menampilkan form perencanaan
    public function showPerencanaanForm()
    {
        $wilayah = Wilayah::all();
        return view('admin.perencanaan.form', compact('wilayah')); // Pastikan view ini ada
    }
    public function showPeyaluranForm()
    {
        $wilayah = Wilayah::all();
        return view('admin.layout.form_penyaluran', compact('wilayah')); // Pastikan view ini ada
    }
    // Getpangkalan berdasarkan wilayah (AJAX)
    public function getPangkalanByWilayah($w_id)
    {
        // Ambil pangkalan berdasarkan wilayah terpilih
        $pangkalan = Pangkalan::where('w_id', $w_id)->get();

        return response()->json($pangkalan);
    }
    // Fungsi untuk meng-handle import data
    // public function importData(Request $request)
    // {
    //     // Validasi file yang diupload
    //     $validator = Validator::make($request->all(), [
    //         'import_file' => 'required|file|mimes:xlsx,xls,csv|max:2048',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->route('admin.perencanaan.form')
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     // Proses file import
    //     $file = $request->file('import_file');
    //     $filePath = $file->getRealPath();

    //     // Contoh: Baca file CSV (gunakan library seperti Laravel Excel untuk file XLSX/XLS)
    //     $data = array_map('str_getcsv', file($filePath));

    //     // Simpan data ke database (sesuaikan dengan struktur database Anda)
    //     foreach ($data as $row) {
    //         // Contoh: Simpan data ke tabel perencanaan
    //         // Perencanaan::create([
    //         //     'nama_pangkalan' => $row[0],
    //         //     'jumlah_tabung' => $row[1],
    //         //     'tanggal_distribusi' => $row[2],
    //         // ]);
    //     }

    //     return redirect()->route('admin.perencanaan.form')->with('success', 'Data berhasil diimport.');
    // }
    
    // Perencanaan form tampilkan data
    public function getPangkalanByWilayahTabel($w_id)
    {
        $pangkalan = Pangkalan::where('w_id', $w_id)->get();
        return response()->json($pangkalan);
    }
    // import data excel
    public function importData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'import_file' => 'required|file|mimes:csv,txt,xlsx,xls|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $file = $request->file('import_file');
        $filePath = $file->getRealPath();

        // Baca file CSV
        $data = array_map('str_getcsv', file($filePath));
        $header = array_shift($data); // Ambil header

        // Validasi header
        if ($header !== ['Tanggal Awal', 'Tanggal Akhir', 'Kondisi', 'Wilayah', 'Pangkalan']) {
            return response()->json(['error' => 'Format file tidak valid.'], 422);
        }

        // Proses data
        $rows = [];
        foreach ($data as $row) {
            $wilayah = Wilayah::where('w_id', $row[3])->first();
            $pangkalan = $row[4] === 'all'
                ? 'all'
                : Pangkalan::where('pklan_nama_pangkalan', $row[4])->first();

            $rows[] = [
                'pa_id' => Str::uuid(),
                'tanggal_awal' => $row[0],
                'tanggal_akhir' => $row[1],
                'kondisi' => $row[2],
                'wilayah_id' => $wilayah ? $wilayah->w_id : null,
                'pangkalan_id' => $pangkalan === 'all' ? 'all' : ($pangkalan ? $pangkalan->pklan_id : null),
                'pembayaran' => 'CASHLESS',
                'values' => [], // Tambahkan logika untuk nilai spinner jika diperlukan
            ];
        }

        return response()->json([
            'tanggal_awal' => $rows[0]['tanggal_awal'],
            'tanggal_akhir' => $rows[0]['tanggal_akhir'],
            'rows' => $rows,
        ]);
    }
    public function store(Request $request)
    {
        $data = $request->all();
        try {
            // Validasi data yang diterima
            $validated = $request->validate([
                'tanggal_awal'  => 'required|date',
                'tanggal_akhir' => 'required|date',
                'kondisi'       => 'required|string',
                'wilayah_id'    => 'required|string|exists:tb_wilayah,w_id',
                'pangkalan_id'  => 'nullable',
                'data'          => 'required|array',
            ]);

            // Looping data dari tabel yang ditampilkan
            foreach ($request->data as $row) {
                // Ambil nilai pembayaran, gunakan nilai default jika tidak ada
                $pembayaran = $row['pembayaran'] ?? 'CASHLESS';

                // Jika pangkalan_id adalah "all", simpan data untuk semua pangkalan di wilayah tersebut
                if ($validated['pangkalan_id'] === 'all') {
                    $pangkalanList = Pangkalan::where('w_id', $validated['wilayah_id'])->get();
                    foreach ($pangkalanList as $p) {
                        foreach ($row['values'] as $tanggal => $jumlah) {
                            Perencanaan::create([
                                'pa_id'        => $this->generateUniqueId(),
                                'pa_tgl_awal'  => $validated['tanggal_awal'],
                                'pa_tgl_akhir' => $validated['tanggal_akhir'],
                                'pa_kondisi'   => $validated['kondisi'],
                                'w_id'         => $validated['wilayah_id'],
                                'pklan_id'     => $p->pklan_id,
                                'pa_pembayaran'=> $pembayaran, // Gunakan nilai pembayaran
                                'pa_jumlah'    => $jumlah,
                                'pa_jadwal'    => \Carbon\Carbon::createFromFormat('d-m-Y', $tanggal)->format('Y-m-d'), // Konversi ke format Y-m-d
                                'pa_created_at'=> now(),
                                'pa_updated_at'=> now(),
                            ]);
                        }
                    }
                } else {
                    // Jika pangkalan tertentu dipilih
                    foreach ($row['values'] as $tanggal => $jumlah) {
                        Perencanaan::create([
                            'pa_id'        => $this->generateUniqueId(),
                            'pa_tgl_awal'  => $validated['tanggal_awal'],
                            'pa_tgl_akhir' => $validated['tanggal_akhir'],
                            'pa_kondisi'   => $validated['kondisi'],
                            'w_id'         => $validated['wilayah_id'],
                            'pklan_id'     => $validated['pangkalan_id'],
                            'pa_pembayaran'=> $pembayaran, // Gunakan nilai pembayaran
                            'pa_jumlah'    => $jumlah,
                            'pa_jadwal'    => \Carbon\Carbon::createFromFormat('d-m-Y', $tanggal)->format('Y-m-d'), // Konversi ke format Y-m-d
                            'pa_created_at'=> now(),
                            'pa_updated_at'=> now(),
                        ]);
                    }
                }
            }

            return response()->json(['message' => 'Data perencanaan berhasil disimpan!'], 201);

        } catch (\Exception $e) {
            // Log error untuk debugging
            \Log::error('Error saat menyimpan data:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
    private function generateUniqueId()
    {
        return str_pad(mt_rand(1, 999999999999999), 15, '0', STR_PAD_LEFT);
    }


}
