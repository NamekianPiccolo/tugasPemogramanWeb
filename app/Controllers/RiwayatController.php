<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RiwayatModel;

class RiwayatController extends BaseController
{
    protected $riwayatModel;

    public function __construct()
    {
        $this->riwayatModel = new RiwayatModel();
    }

    public function index()
    {
        $data['riwayat'] = $this->riwayatModel
            ->select('riwayat.*, dokumen.judul, users.username')
            ->join('dokumen', 'dokumen.id = riwayat.dokumen_id', 'left')
            ->join('users', 'users.id = riwayat.user_id', 'left')
            ->orderBy('riwayat.created_at', 'DESC')
            ->findAll();
            
        return view('Backend/Riwayat/index', $data);
    }
}
