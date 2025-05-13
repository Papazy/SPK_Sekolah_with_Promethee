<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\PaudModel;

class Home extends BaseController
{
    public function index()
{
    $paudModel = new PaudModel();
    $data['paudList'] = $paudModel->getPaudWithKriteria();

    return view('user/home', $data);
}
}