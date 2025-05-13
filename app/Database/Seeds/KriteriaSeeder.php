<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['kode' => 'C1', 'nama' => 'Metode Pengajaran', 'jenis' => 'Benefit', 'skala' => 'Skala 1-5'],
            ['kode' => 'C2', 'nama' => 'Kualitas Kurikulum', 'jenis' => 'Benefit', 'skala' => 'Skala 1-5'],
            ['kode' => 'C3', 'nama' => 'Kualifikasi Guru', 'jenis' => 'Benefit', 'skala' => 'Skala 1-5'],
            ['kode' => 'C4', 'nama' => 'Fasilitas Sekolah', 'jenis' => 'Benefit', 'skala' => 'Skala 1-5'],
            ['kode' => 'C5', 'nama' => 'Reputasi Sekolah', 'jenis' => 'Benefit', 'skala' => 'Skala 1-5'],
            ['kode' => 'C6', 'nama' => 'Jarak Sekolah dari Rumah', 'jenis' => 'Cost', 'skala' => 'Kilometer'],
        ];
        $this->db->table('kriteria')->insertBatch($data);
    }
}
