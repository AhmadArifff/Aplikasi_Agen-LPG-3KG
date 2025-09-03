<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePangkalanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'pklan_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'w_id' => [
                'type'       => 'CHAR',
                'constraint' => 4,
            ],
            'pklan_nama_pangkalan' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'pklan_alamat' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'pklan_no_telepon' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'pklan_created_at datetime default current_timestamp',
            'pklan_updated_at datetime default current_timestamp on update current_timestamp',
            'pklan_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('pklan_id');
        $this->forge->addForeignKey('w_id', 'tb_wilayah', 'w_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_pangkalan');
    }

    public function down()
    {
        $this->forge->dropTable('tb_pangkalan');
    }
}