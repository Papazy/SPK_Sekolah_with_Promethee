<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKriteriaPaud extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'    => ['type' => 'INT', 'auto_increment' => true],
            'paud_id' => ['type' => 'INT'],
            'kriteria_id' => ['type' => 'INT'],
            'nilai' => ['type' => 'DECIMAL', 'constraint' => '5,2', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('paud_id', 'paud', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('kriteria_id', 'kriteria', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kriteria_paud'); 
    }

    public function down()
    {
        $this->forge->dropTable('kriteria_paud');
    }
}
