<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PaudModel;

class Paud extends BaseController
{
    protected $paud;

    public function __construct()
    {
        $this->paud = new PaudModel();
    }

    public function index()
    {
        $data['paud'] = $this->paud->findAll();
        return view('paud/index', $data);
    }

    public function create()
    {
        return view('paud/create');
    }

    public function store()
    {
        $this->paud->save($this->request->getPost());
        return redirect()->to('/paud');
    }
}
