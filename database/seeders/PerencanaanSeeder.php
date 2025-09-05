<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class PerencanaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvPath = public_path('data/perencanaan.csv');
        if (!file_exists($csvPath)) {
            $this->command->error("CSV file not found at: $csvPath");
            return;
        }

        $csv = fopen($csvPath, 'r');
        $header = fgetcsv($csv);

        while (($row = fgetcsv($csv)) !== false) {
            $data = array_combine($header, $row);

            DB::table('tb_perencanaan_agen')->insert([
                'pa_id'         => $data['pa_id'],
                'pa_tgl_awal'   => $data['pa_tgl_awal'],
                'pa_tgl_akhir'  => $data['pa_tgl_akhir'],
                'pa_kondisi'    => $data['pa_kondisi'],
                'w_id'          => $data['w_id'],
                'pklan_id'      => $data['pklan_id'],
                'pa_jumlah'     => $data['pa_jumlah'],
                'pa_created_at' => $data['pa_created_at'],
                'pa_updated_at' => $data['pa_updated_at'],
                'pa_deleted_at' => (strtoupper($data['pa_deleted_at']) === 'NULL' || $data['pa_deleted_at'] === '') 
                                    ? null 
                                    : $data['pa_deleted_at'],
            ]);

        }

        fclose($csv);
    }
}
