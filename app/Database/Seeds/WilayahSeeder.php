<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class WilayahSeeder extends Seeder
{
    public function run()
    {
        $file = WRITEPATH . '../public/data/wilayah.csv';
        if (!is_file($file)) {
            throw new \Exception("CSV file not found: $file");
        }

        $handle = fopen($file, 'r');
        if ($handle === false) {
            throw new \Exception("Unable to open CSV file: $file");
        }

        // Skip header
        $header = fgetcsv($handle);

        $id = 1;
        while (($row = fgetcsv($handle)) !== false) {
            $data = [
                'w_id' => str_pad($id, 4, '0', STR_PAD_LEFT),
                'w_nama_kabupaten_atau_kota' => $row[0],
                'w_created_at' => date('Y-m-d H:i:s'),
                'w_updated_at' => date('Y-m-d H:i:s'),
                'w_deleted_at' => null,
            ];
            $this->db->table('tb_wilayah')->insert($data);
            $id++;
        }

        fclose($handle);
    }
}
