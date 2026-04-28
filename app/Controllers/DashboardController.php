<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DokumenModel;
use App\Models\KategoriModel;
use App\Models\UnitModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $dokumenModel = new DokumenModel();
        $kategoriModel = new KategoriModel();
        $unitModel = new UnitModel();

        $data = [
            'title' => 'Dashboard Admin',
            'total_dokumen' => $dokumenModel->countAllResults(),
            'total_kategori' => $kategoriModel->countAllResults(),
            'total_unit' => $unitModel->countAllResults(),
        ];

        return view('Backend/dashboard', $data);
    }

    public function karyawan()
    {
        $data = [
            'title' => 'Dashboard Karyawan'
        ];
        return view('Backend/karyawan_dashboard', $data);
    }
}
