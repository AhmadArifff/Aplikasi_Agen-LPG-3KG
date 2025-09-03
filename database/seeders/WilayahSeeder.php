<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WilayahSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk tb_wilayah
     */
    public function run(): void
    {
        $file = public_path('data/wilayah.csv'); // Laravel: simpan file CSV di public/data/wilayah.csv

        if (!file_exists($file)) {
            throw new \Exception("CSV file not found: $file");
        }

        $handle = fopen($file, 'r');
        if ($handle === false) {
            throw new \Exception("Unable to open CSV file: $file");
        }

        // Skip header
        fgetcsv($handle);

        $id = 1;
        while (($row = fgetcsv($handle)) !== false) {
            $data = [
                'w_id' => str_pad($id, 4, '0', STR_PAD_LEFT),
                'w_nama_kabupaten_atau_kota' => $row[0],
                'w_created_at' => now(),
                'w_updated_at' => now(),
                'w_deleted_at' => null,
            ];

            DB::table('tb_wilayah')->insert($data);
            $id++;
        }

        fclose($handle);
    }
}
