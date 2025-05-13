<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKriteria extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'auto_increment' => true],
            'kode'       => ['type' => 'VARCHAR', 'constraint' => 5],    // C1, C2, dst
            'nama'       => ['type' => 'VARCHAR', 'constraint' => 100],
            'jenis'      => ['type' => 'ENUM', 'constraint' => ['Benefit', 'Cost']],
            'skala'      => ['type' => 'VARCHAR', 'constraint' => 50],    // Misal: Skala 1-5, Kilometer
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('kriteria');
    }

    public function down()
    {
        $this->forge->dropTable('kriteria');
    }
}
