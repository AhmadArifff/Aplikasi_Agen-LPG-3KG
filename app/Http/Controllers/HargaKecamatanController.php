<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wilayah;
use App\Models\PerencanaanAgen;
use Carbon\Carbon;

class HargaKecamatanController extends Controller
{
    public function index(Request $request)
    {
        $selectedKota  = $request->get('kota');                         
        $selectedBulan = $request->get('bulan', now()->format('Y-m')); 

        $query = PerencanaanAgen::with(['wilayah']);

        // filter kota
        if ($selectedKota) {
            $query->where('w_id', $selectedKota);
        }

        // filter bulan (cek tgl_awal)
        if ($selectedBulan) {
            $query->whereRaw("DATE_FORMAT(pa_tgl_awal, '%Y-%m') = ?", [$selectedBulan]);
        }

        $data = $query->get()->map(function ($item) {
            return [
                'tanggal'     => $item->pa_tgl_awal,
                'wilayah'     => $item->wilayah?->w_nama_kabupaten_atau_kota ?? '-',
                'min_harga'   => 17000,  
                'max_harga'   => 17000,
                'min_estimasi'=> 0,
                'max_estimasi'=> $item->pa_jumlah,
            ];
        });

        return view('admin.layout.harga_per_kecamatan', [
            'data'        => $data,
            'kotaList'    => Wilayah::all(),
            'selectedKota'=> $selectedKota,
            'selectedBulan'=> $selectedBulan,
        ]);
    }
}
