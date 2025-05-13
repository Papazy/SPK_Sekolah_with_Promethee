<?php

namespace App\Models;

use CodeIgniter\Model;

class PaudModel extends Model
{
    protected $table      = 'paud';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'npsn', 'nama', 'alamat', 'kecamatan', 'status', 'akreditasi',
        'latitude', 'longitude', 'kepala_sekolah', 'biaya_spp'
    ];
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getPaudWithKriteria()
    {
        return $this->db->table($this->table)->select('
             paud.*,
                MAX(CASE WHEN kriteria.kode = "C1" THEN kriteria_paud.nilai ELSE NULL END) AS metode_pengajaran,
                MAX(CASE WHEN kriteria.kode = "C2" THEN kriteria_paud.nilai ELSE NULL END) AS kurikulum,
                MAX(CASE WHEN kriteria.kode = "C5" THEN kriteria_paud.nilai ELSE NULL END) AS reputasi,
                MAX(CASE WHEN kriteria.kode = "C6" THEN kriteria_paud.nilai ELSE NULL END) AS jarak        
        ')
        ->join('kriteria_paud', 'paud.id = kriteria_paud.paud_id', 'left')
        ->join('kriteria', 'kriteria.id = kriteria_paud.kriteria_id', 'left')
        ->groupBy('paud.id')
        ->get()
        ->getResultArray();
    }
}
