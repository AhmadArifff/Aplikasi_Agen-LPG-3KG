<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePerencanaanAgenTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'pa_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'pa_tgl_awal' => [
                'type'       => 'DATE',
            ],
            'pa_tgl_akhir' => [
                'type'       => 'DATE',
            ],
            'pa_kondisi' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'w_id' => [
                'type'       => 'CHAR',
                'constraint' => 4,
            ],
            'pklan_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'pa_jumlah' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'pa_created_at datetime default current_timestamp',
            'pa_updated_at datetime default current_timestamp on update current_timestamp',
            'pa_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('pa_id');
        $this->forge->addForeignKey('w_id', 'tb_wilayah', 'w_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('pklan_id', 'tb_pangkalan', 'pklan_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_perencanaan_agen');
    }

    public function down()
    {
        $this->forge->dropTable('tb_perencanaan_agen');
    }
}