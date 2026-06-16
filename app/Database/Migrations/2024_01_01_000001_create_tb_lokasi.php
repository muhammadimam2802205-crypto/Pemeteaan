<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTbLokasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_lokasi' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_sekolah' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
                'null'       => false,
            ],
            'jenjang' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
            'alamat' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'kecamatan' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'latitude' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,8',
                'null'       => true,
            ],
            'longitude' => [
                'type'       => 'DECIMAL',
                'constraint' => '11,8',
                'null'       => true,
            ],
            'fasilitas' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'akreditasi' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        
        $this->forge->addKey('id_lokasi', true);
        $this->forge->addKey('kecamatan');
        $this->forge->addKey('jenjang');
        
        $this->forge->createTable('tb_lokasi');
    }

    public function down()
    {
        $this->forge->dropTable('tb_lokasi');
    }
}