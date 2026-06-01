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

        return view('admin/dashboard', $data);
    }

    public function karyawan()
    {
        $dokumenModel = new DokumenModel();
        $izinModel = new \App\Models\IzinModel();
        $userId = session()->get('id');

        $data = [
            'title' => 'Dashboard Karyawan',
            'total_dokumen' => $dokumenModel->countAllResults(),
            'izin_pending' => $izinModel->where('user_id', $userId)->where('status_izin', 'Menunggu')->countAllResults(),
            'izin_disetujui' => $izinModel->where('user_id', $userId)->where('status_izin', 'Disetujui')->countAllResults(),
        ];
        return view('admin/dashboard', $data);
    }
}
