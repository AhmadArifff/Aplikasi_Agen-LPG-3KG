<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerencanaanAgenSeeder extends Seeder
{
    public function run(): void
    {
        // ambil beberapa pangkalan contoh
        $pangkalan = DB::table('tb_pangkalan')->take(3)->get();

        foreach ($pangkalan as $p) {
            DB::table('tb_perencanaan_agen')->insert([
                'pa_pangkalan_id' => $p->p_id,
                'pa_bulan' => '2025-09',
                'pa_status' => 'Cashless',
                'pa_alokasi' => 560,
                'pa_03' => rand(50, 120),
                'pa_07' => rand(60, 100),
                'pa_08' => rand(30, 90),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
