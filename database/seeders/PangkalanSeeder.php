<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PangkalanSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk tb_pangkalan
     */
    public function run(): void
    {
        $data = [
            [
                'w_id' => '0001',
                'pklan_nama_pangkalan' => 'Pangkalan Simeulue Jaya',
                'pklan_alamat' => 'Jl. Merdeka No. 1, Simeulue',
                'pklan_no_telepon' => '081234567001',
                'pklan_created_at' => '2025-09-03 14:05:35',
                'pklan_updated_at' => '2025-09-03 14:05:35',
                'pklan_deleted_at' => null,
            ],
            [
                'w_id' => '0001',
                'pklan_nama_pangkalan' => 'Pangkalan Singkil Makmur',
                'pklan_alamat' => 'Jl. Mawar No. 2, Aceh Singkil',
                'pklan_no_telepon' => '081234567002',
                'pklan_created_at' => '2025-09-03 14:05:35',
                'pklan_updated_at' => '2025-09-03 14:05:35',
                'pklan_deleted_at' => null,
            ],
            [
                'w_id' => '0001',
                'pklan_nama_pangkalan' => 'Pangkalan Selatan Abadi',
                'pklan_alamat' => 'Jl. Melati No. 3, Aceh Selatan',
                'pklan_no_telepon' => '081234567003',
                'pklan_created_at' => '2025-09-03 14:05:35',
                'pklan_updated_at' => '2025-09-03 14:05:35',
                'pklan_deleted_at' => null,
            ],
            [
                'w_id' => '0001',
                'pklan_nama_pangkalan' => 'Pangkalan Tenggara Sejahtera',
                'pklan_alamat' => 'Jl. Kenanga No. 4, Aceh Tenggara',
                'pklan_no_telepon' => '081234567004',
                'pklan_created_at' => '2025-09-03 14:05:35',
                'pklan_updated_at' => '2025-09-03 14:05:35',
                'pklan_deleted_at' => null,
            ],
            [
                'w_id' => '0001',
                'pklan_nama_pangkalan' => 'Pangkalan Timur Bersama',
                'pklan_alamat' => 'Jl. Anggrek No. 5, Aceh Timur',
                'pklan_no_telepon' => '081234567005',
                'pklan_created_at' => '2025-09-03 14:05:35',
                'pklan_updated_at' => '2025-09-03 14:05:35',
                'pklan_deleted_at' => null,
            ],
            [
                'w_id' => '0002',
                'pklan_nama_pangkalan' => 'Pangkalan Tengah Mandiri',
                'pklan_alamat' => 'Jl. Dahlia No. 6, Aceh Tengah',
                'pklan_no_telepon' => '081234567006',
                'pklan_created_at' => '2025-09-03 14:05:35',
                'pklan_updated_at' => '2025-09-03 14:05:35',
                'pklan_deleted_at' => null,
            ],
            [
                'w_id' => '0003',
                'pklan_nama_pangkalan' => 'Pangkalan Barat Sentosa',
                'pklan_alamat' => 'Jl. Flamboyan No. 7, Aceh Barat',
                'pklan_no_telepon' => '081234567007',
                'pklan_created_at' => '2025-09-03 14:05:35',
                'pklan_updated_at' => '2025-09-03 14:05:35',
                'pklan_deleted_at' => null,
            ],
            [
                'w_id' => '0003',
                'pklan_nama_pangkalan' => 'Pangkalan Besar Mulia',
                'pklan_alamat' => 'Jl. Seroja No. 8, Aceh Besar',
                'pklan_no_telepon' => '081234567008',
                'pklan_created_at' => '2025-09-03 14:05:35',
                'pklan_updated_at' => '2025-09-03 14:05:35',
                'pklan_deleted_at' => null,
            ],
            [
                'w_id' => '0003',
                'pklan_nama_pangkalan' => 'Pangkalan Pidie Amanah',
                'pklan_alamat' => 'Jl. Teratai No. 9, Pidie',
                'pklan_no_telepon' => '081234567009',
                'pklan_created_at' => '2025-09-03 14:05:35',
                'pklan_updated_at' => '2025-09-03 14:05:35',
                'pklan_deleted_at' => null,
            ],
            [
                'w_id' => '0003',
                'pklan_nama_pangkalan' => 'Pangkalan Bireuen Sukses',
                'pklan_alamat' => 'Jl. Cempaka No. 10, Bireuen',
                'pklan_no_telepon' => '081234567010',
                'pklan_created_at' => '2025-09-03 14:05:35',
                'pklan_updated_at' => '2025-09-03 14:05:35',
                'pklan_deleted_at' => null,
            ],
        ];

        DB::table('tb_pangkalan')->insert($data);
    }
}
