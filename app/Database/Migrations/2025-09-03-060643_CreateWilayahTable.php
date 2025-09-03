<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateWilayahTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'w_id' => [
                'type'       => 'CHAR',
                'constraint' => 4,
                'unique'     => true,
            ],
            'w_nama_kabupaten_atau_kota' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'w_created_at datetime default current_timestamp',
            'w_updated_at datetime default current_timestamp on update current_timestamp',
            'w_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('w_id');
        $this->forge->createTable('tb_wilayah');
    }

    public function down()
    {
        $this->forge->dropTable('tb_wilayah');
    }
}