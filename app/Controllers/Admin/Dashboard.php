<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PaudModel;
use App\Models\KriteriaModel;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    public function index()
{
    $paudModel = new PaudModel();
    $kriteriaModel = new KriteriaModel();

    $totalPaud = $paudModel->countAll();

    $db = \Config\Database::connect();
    $builder = $db->table('kriteria_paud');
    $terverifikasi = $builder->distinct()->select('paud_id')->countAllResults();

    $belum = $totalPaud - $terverifikasi;

    $jumlahKriteria = $kriteriaModel->countAll();

    $kecamatanData = $paudModel
        ->select('kecamatan, COUNT(*) as total')
        ->groupBy('kecamatan')
        ->findAll();

    return view('admin/index', [
        'totalPaud'     => $totalPaud,
        'terverifikasi' => $terverifikasi,
        'belum'         => $belum,
        'jumlahKriteria'=> $jumlahKriteria,
        'kecamatanData' => $kecamatanData
    ]);
}
}
