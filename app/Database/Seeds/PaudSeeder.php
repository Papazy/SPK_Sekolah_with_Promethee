<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PaudSeeder extends Seeder
{
    public function run()
    {
        // Data PAUD
        $paudData = [
            [
                'npsn' => '12345678',
                'nama' => 'PAUD Harapan Bangsa',
                'alamat' => 'Jl. Merdeka No.1',
                'kecamatan' => 'Kota Juang',
                'status' => 'negeri',
                'akreditasi' => 'A',
                'latitude' => '5.20123',
                'longitude' => '96.70123',
                'kepala_sekolah' => 'Bu Ani',
                'biaya_spp' => 50000,
            ],
            [
                'npsn' => '87654321',
                'nama' => 'PAUD Ceria',
                'alamat' => 'Jl. Ahmad Yani No.5',
                'kecamatan' => 'Samalanga',
                'status' => 'swasta',
                'akreditasi' => 'B',
                'latitude' => '5.21234',
                'longitude' => '96.71234',
                'kepala_sekolah' => 'Pak Budi',
                'biaya_spp' => 75000,
            ],
            [
                'npsn' => '56781234',
                'nama' => 'PAUD Pelangi',
                'alamat' => 'Jl. Cut Nyak Dhien No.8',
                'kecamatan' => 'Juli',
                'status' => 'negeri',
                'akreditasi' => 'A',
                'latitude' => '5.22345',
                'longitude' => '96.72345',
                'kepala_sekolah' => 'Bu Fitri',
                'biaya_spp' => 0,
            ],
            [
                'npsn' => '43218765',
                'nama' => 'PAUD Matahari',
                'alamat' => 'Jl. Sudirman No.12',
                'kecamatan' => 'Jeumpa',
                'status' => 'swasta',
                'akreditasi' => 'B',
                'latitude' => '5.23456',
                'longitude' => '96.73456',
                'kepala_sekolah' => 'Pak Joko',
                'biaya_spp' => 100000,
            ],
            [
                'npsn' => '34567812',
                'nama' => 'PAUD Bintang Kecil',
                'alamat' => 'Jl. Diponegoro No.15',
                'kecamatan' => 'Pandrah',
                'status' => 'negeri',
                'akreditasi' => 'A',
                'latitude' => '5.24567',
                'longitude' => '96.74567',
                'kepala_sekolah' => 'Bu Sari',
                'biaya_spp' => 25000,
            ],
        ];

        // Insert ke tabel PAUD
        $this->db->table('paud')->insertBatch($paudData);

        // Ambil ID sekolah yang baru dibuat
        $paudIds = $this->db->table('paud')->select('id')->orderBy('id', 'DESC')->limit(5)->get()->getResultArray();

        // Dummy data nilai kriteria untuk masing-masing PAUD
        foreach ($paudIds as $paud) {
            for ($kriteriaId = 1; $kriteriaId <= 6; $kriteriaId++) {
                $nilai = null;
                
                if ($kriteriaId != 6) {
                    // Untuk C1-C5 isi nilai 1-5 random
                    $nilai = rand(1, 5);
                }
                // Untuk C6 (Jarak) -> NULL / kosong

                $this->db->table('kriteria_paud')->insert([
                    'paud_id'  => $paud['id'],
                    'kriteria_id' => $kriteriaId,
                    'nilai'       => $nilai,
                ]);
            }
        }
    }
}
