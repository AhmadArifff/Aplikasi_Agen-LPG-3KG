<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerencanaanAgen;
use App\Models\Pangkalan;
use App\Models\Wilayah;

class RekapitulasiController extends Controller
{
    public function index(Request $request)
    {
        // Data untuk filter
        $wilayah   = Wilayah::select('w_id', 'w_nama_kabupaten_atau_kota')->get();
        $pangkalan = Pangkalan::select('pklan_id', 'pklan_nama_pangkalan')->get();
        $kondisi   = PerencanaanAgen::select('pa_kondisi')->distinct()->get();

        // Query dasar
        $query = PerencanaanAgen::with(['pangkalan.wilayah']);

        // Filter kota
        if ($request->filled('kota')) {
            $query->whereHas('pangkalan.wilayah', function ($q) use ($request) {
                $q->where('w_id', $request->kota);
            });
        }

        // Filter pangkalan
        if ($request->filled('pangkalan')) {
            $query->where('pklan_id', $request->pangkalan);
        }

        // Filter bulan (format YYYY-MM)
        if ($request->filled('bulan')) {
            $query->whereRaw("DATE_FORMAT(pa_tgl_awal, '%Y-%m') = ?", [$request->bulan]);
        }

        // Filter kondisi
        if ($request->filled('kondisi')) {
            $query->where('pa_kondisi', $request->kondisi);
        }

        // Ambil hasil query
        $rekapitulasi = $query->get();

        return view('admin.layout.rekapitulasi', compact('wilayah', 'pangkalan', 'kondisi', 'rekapitulasi'));
    }
}
