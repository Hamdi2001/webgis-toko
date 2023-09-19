<?php

namespace App\Controllers;

use App\Models\TokoModel;

class Toko extends BaseController
{
    protected $tokoModel;

    public function __construct()
    {
       $this->tokoModel = new TokoModel(); 
    }

    public function index()
    {
        $toko = $this->tokoModel->findAll();

        $data = [
            'title' => 'Daftar Toko',
            'toko' => $toko
        ];


        return view('toko/index', $data);
    }
}