<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KriteriaModel;
use App\Models\KriteriaPaudModel;
use App\Models\PaudModel;
use CodeIgniter\HTTP\ResponseInterface;

class Paud extends BaseController
{
    public function index()
    {
        $paudModel = new PaudModel();
        $paudList = $paudModel->findAll();

        $nilaiModel = new KriteriaPaudModel();
        $kriteriaModel = new KriteriaModel();

        foreach ($paudList as &$p) {
            $p['kriteria'] = $nilaiModel->select('kriteria.nama, kriteria.jenis, kriteria_paud.nilai')
                ->join('kriteria', 'kriteria.id = kriteria_paud.kriteria_id')
                ->where('kriteria_paud.paud_id', $p['id'])
                ->findAll();
        }

        return view('admin/paud/index', [
            'paud' => $paudList
        ]);
    }
    public function create()
    {
        return view('admin/paud/create', [
            'title' => 'Tambah Paud'
        ]);
    }

    public function store()
    {
        // validasi
        $validation = \Config\Services::validation();
        $validation->setRules([
            'npsn' => 'required|numeric',
            'nama' => 'required|min_length[3]',
            'kecamatan' => 'required',
            'alamat' => 'required',
            'status' => 'required',
            'akreditasi' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'kepala_paud' => 'required|min_length[3]',
            'biaya_spp' => 'required|numeric',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'npsn' => $this->request->getPost('npsn'),
            'nama' => $this->request->getPost('nama'),
            'kecamatan' => $this->request->getPost('kecamatan'),
            'alamat' => $this->request->getPost('alamat'),
            'status' => $this->request->getPost('status'),
            'akreditasi' => $this->request->getPost('akreditasi'),
            'latitude' => $this->request->getPost('latitude'),
            'longitude' => $this->request->getPost('longitude'),
            'kepala_paud' => $this->request->getPost('kepala_paud'),
            'biaya_spp' => $this->request->getPost('biaya_spp'),
        ];

        $paudModel = new PaudModel();
        $paudModel->insert($data);

        $idPaud = $paudModel->getInsertID();

        return redirect()->to('/admin/paud/kriteria/' . $idPaud . '/input')
            ->with('success', 'Data Paud berhasil ditambahkan');
    }

    public function inputKriteria($id)
    {
        $paudModel = new PaudModel();
        $kriteriaModel = new KriteriaModel();
        $nilaiModel = new KriteriaPaudModel();

        $paud = $paudModel->find($id);
        $kriteria = $kriteriaModel->findAll();

        $nilaiKriteria = $nilaiModel->where('paud_id', $id)->findAll();

        $nilaiMap = [];
        foreach ($nilaiKriteria as $nk) {
            $nilaiMap[$nk['kriteria_id']] = $nk['nilai'];
        }

        return view('admin/paud/input_kriteria', [
            'paud' => $paud,
            'kriteria' => $kriteria,
            'nilaiMap' => $nilaiMap,
        ]);
    }

    public function saveKriteria()
    {
        $nilaiModel = new KriteriaPaudModel();
        $paud_id = $this->request->getPost('paud_id');
        $kriteriaInput = $this->request->getPost('kriteria');

        foreach ($kriteriaInput as $kriteria_id => $nilai) {
            $existing = $nilaiModel->where([
                'paud_id' => $paud_id,
                'kriteria_id' => $kriteria_id
            ])->first();

            if ($existing) {
                $nilaiModel->update($existing['id'], [
                    'nilai' => $nilai
                ]);
            } else {
                // Belum ada, lakukan INSERT
                $nilaiModel->insert([
                    'paud_id'  => $paud_id,
                    'kriteria_id' => $kriteria_id,
                    'nilai'       => $nilai
                ]);
            }
        }

        return redirect()->to('/admin/paud')->with('success', 'Nilai kriteria berhasil disimpan/diupdate!');
    }

    public function delete($id)
    {
        $paudModel = new PaudModel();

        if ($paudModel->find($id)) {
            $paudModel->delete($id);
            session()->setFlashdata('deleted', 'Data berhasil dihapus');

            return redirect()->to('/admin/paud');

        }

        return redirect()->to('/admin/paud')->with('error', 'Data Paud tidak ditemukan');
    }

    public function detail($id)
{
    $paudModel = new PaudModel();
    $nilaiModel = new KriteriaPaudModel();
    $kriteriaModel = new KriteriaModel();

    $paud = $paudModel->find($id);

    if (!$paud) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    $nilaiKriteria = $nilaiModel->select('kriteria.nama, kriteria.jenis, kriteria_paud.nilai')
                                ->join('kriteria', 'kriteria.id = kriteria_paud.kriteria_id')
                                ->where('kriteria_paud.paud_id', $id)
                                ->findAll();

    return view('admin/paud/detail', [
        'paud' => $paud,
        'kriteria' => $nilaiKriteria,
    ]);
}

public function tabelKriteria()
{
    $paudModel = new PaudModel();
    $kriteriaModel = new KriteriaModel();
    $nilaiModel = new KriteriaPaudModel();

    $paudList = $paudModel->findAll();
    $kriteriaList = $kriteriaModel->orderBy('id')->findAll();

    $dataTabel = [];

    foreach ($paudList as $p) {
        $row = [
            'id' => $p['id'],
            'nama' => $p['nama'],
        ];

        foreach ($kriteriaList as $k) {
            $nilai = $nilaiModel->where([
                'paud_id' => $p['id'],
                'kriteria_id' => $k['id']
            ])->first();

            $row['C'.$k['id']] = $nilai['nilai'] ?? '-';
        }

        $dataTabel[] = $row;
    }

    return view('admin/paud/kriteria_table', [
        'paud' => $dataTabel,
        'kriteria' => $kriteriaList
    ]);
}

public function updateKriteria()
{
    if ($this->request->isAJAX()) {
        $paudId = $this->request->getPost('paud_id');
        $kriteriaId = $this->request->getPost('kriteria_id');
        $nilai = $this->request->getPost('nilai');

        $model = new \App\Models\KriteriaPaudModel();

        // Cek apakah sudah ada
        $existing = $model->where([
            'paud_id' => $paudId,
            'kriteria_id' => $kriteriaId
        ])->first();

        if ($existing) {
            $model->update($existing['id'], ['nilai' => $nilai]);
        } else {
            $model->insert([
                'paud_id' => $paudId,
                'kriteria_id' => $kriteriaId,
                'nilai' => $nilai
            ]);
        }

        return $this->response->setJSON(['success' => true]);
    }

    return $this->response->setStatusCode(400)->setJSON(['error' => 'Invalid request']);
}

public function updateKriteriaMassal()
{
    if ($this->request->isAJAX()) {
        $payload = $this->request->getJSON(true);
        $data = $payload['data'] ?? [];

        $model = new \App\Models\KriteriaPaudModel();

        foreach ($data as $item) {
            $paudId = $item['paud_id'];
            $kriteriaId = $item['kriteria_id'];
            $nilai = $item['nilai'];

            $existing = $model->where([
                'paud_id' => $paudId,
                'kriteria_id' => $kriteriaId
            ])->first();

            if ($existing && isset($existing['id'])) {
                $model->update($existing['id'], ['nilai' => $nilai]);
            } else {
                $model->insert([
                    'paud_id' => $paudId,
                    'kriteria_id' => $kriteriaId,
                    'nilai' => $nilai
                ]);
            }
        }

        return $this->response->setJSON(['success' => true]);
    }

    return $this->response->setStatusCode(400)->setJSON(['error' => 'Invalid request']);
}

}
