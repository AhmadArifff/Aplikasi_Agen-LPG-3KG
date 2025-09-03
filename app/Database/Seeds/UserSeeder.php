<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'u_username'      => 'adminagen',
                'u_password'      => password_hash('admin123', PASSWORD_DEFAULT),
                'u_fullname'      => 'Admin Agen',
                'u_role'          => 'admin',
                'u_referensi'     => null,
                'u_email'         => 'admin@agen.com',
                'u_nik'           => '1234567890123456',
                'u_nama'          => 'Admin Agen',
                'u_tempat_lahir'  => 'Jakarta',
                'u_tanggal_lahir' => '1990-01-01',
                'u_jenis_kelamin' => 'Laki-laki',
                'u_provinsi'      => 'DKI Jakarta',
                'u_kota'          => 'Jakarta Selatan',
                'u_kelurahan'     => 'Kebayoran Baru',
                'u_kecamatan'     => 'Kebayoran Baru',
                'u_kodepos'       => '12110',
                'u_deleted_at'    => null,
            ],
        ];

        for ($i = 1; $i <= 5; $i++) {
            $users[] = [
                'u_username'      => "pangkalan$i",
                'u_password'      => password_hash("pangkalan$i", PASSWORD_DEFAULT),
                'u_fullname'      => "User Pangkalan $i",
                'u_role'          => 'pangkalan',
                'u_referensi'     => null,
                'u_email'         => "pangkalan$i@email.com",
                'u_nik'           => "9876543210$i",
                'u_nama'          => "User Pangkalan $i",
                'u_tempat_lahir'  => 'Bandung',
                'u_tanggal_lahir' => '1995-0' . $i . '-10',
                'u_jenis_kelamin' => 'Perempuan',
                'u_provinsi'      => 'Jawa Barat',
                'u_kota'          => 'Bandung',
                'u_kelurahan'     => 'Cicendo',
                'u_kecamatan'     => 'Cicendo',
                'u_kodepos'       => '40173',
                'u_deleted_at'    => null,
            ];
        }

        $this->db->table('tb_user')->insertBatch($users);
    }
}
