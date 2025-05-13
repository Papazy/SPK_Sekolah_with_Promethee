<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePaud extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'npsn' => ['type' => 'VARCHAR', 'constraint' => 100],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 100],
            'alamat' => ['type' => 'TEXT'],
            'kecamatan' => ['type' => 'VARCHAR', 'constraint' => 100],
            'status' => ['type' => 'VARCHAR', 'constraint' => 100],
            'akreditasi' => ['type' => 'VARCHAR', 'constraint' => 100],
            'latitude' => ['type' => 'DECIMAL', 'constraint' => '10,8'],
            'longitude' => ['type' => 'DECIMAL', 'constraint' => '11,8'],
            'kepala_sekolah' => ['type' => 'varchar', 'constraint' => 100],
            'biaya_spp' => ['type' => 'DECIMAL', 'constraint' => '11,2'],
            // 'metode_pengajaran' => ['type' => 'VARCHAR', 'constraint' => 100],
            // 'fasilitas' => ['type' => 'TEXT'],
            // 'kurikulum' => ['type' => 'VARCHAR', 'constraint' => 100],
            // 'kualifikasi_guru' => ['type' => 'VARCHAR', 'constraint' => 100],
            // 'reputasi' => ['type' => 'INT'],
            // 'jarak' => ['type' => 'DECIMAL', 'constraint' => '5,2'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('paud');
    }

    public function down()
    {
        $this->forge->dropTable('paud');
    }
}
