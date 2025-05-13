<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KriteriaModel;
use CodeIgniter\HTTP\ResponseInterface;

class KriteriaController extends BaseController
{
    public function index()
    {
        $model = new KriteriaModel();
        $data['kriteria'] = $model->findAll();

        return view('admin/kriteria/index', $data);
    }

    public function store()
    {
        $model = new KriteriaModel();
        $model->save([
            'nama' => $this->request->getPost('nama'),
            'jenis' => $this->request->getPost('jenis')
        ]);

        return redirect()->to('/admin/kriteria')->with('success', 'Kriteria berhasil ditambahkan.');
    }

    public function update($id)
    {
        $model = new KriteriaModel();
        $model->update($id, [
            'nama' => $this->request->getPost('nama'),
            'jenis' => $this->request->getPost('jenis')
        ]);

        return redirect()->to('/admin/kriteria')->with('success', 'Kriteria berhasil diperbarui.');
    }

    public function delete($id)
    {
        $model = new KriteriaModel();
        $model->delete($id);

        return redirect()->to('/admin/kriteria')->with('deleted', 'Kriteria berhasil dihapus.');
    }
}