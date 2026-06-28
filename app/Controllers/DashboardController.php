<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DokumenModel;
use App\Models\KategoriModel;
use App\Models\UnitModel;

/**
 * Controller DashboardController
 *
 * Mengelola pemuatan dan kalkulasi data ringkasan statistik untuk halaman dashboard utama,
 * baik bagi peran (role) Administrator maupun Karyawan.
 */
class DashboardController extends BaseController
{
    /**
     * Menampilkan halaman dashboard utama untuk Administrator.
     * Mengkalkulasi jumlah total dokumen, kategori, dan unit kerja yang terdaftar di sistem.
     *
     * @return string View dashboard admin beserta data statistik
     */
    public function index()
    {
        // Instansiasi model-model yang diperlukan untuk statistik dashboard
        $dokumenModel = new DokumenModel();
        $kategoriModel = new KategoriModel();
        $unitModel = new UnitModel();
        $riwayatModel = new \App\Models\RiwayatModel();

        // Mengambil 5 aktivitas terbaru
        $recentActivity = $riwayatModel
            ->select('riwayat.*, users.nama_lengkap, users.role, dokumen.judul')
            ->join('users', 'users.id = riwayat.user_id', 'left')
            ->join('dokumen', 'dokumen.id = riwayat.dokumen_id', 'left')
            ->orderBy('riwayat.created_at', 'DESC')
            ->limit(5)
            ->findAll();

        // Mengambil 5 dokumen terbaru
        $recentDocuments = $dokumenModel
            ->select('dokumen.*, kategori.nama_kategori, unit.nama_unit')
            ->join('kategori', 'kategori.id = dokumen.kategori_id', 'left')
            ->join('unit', 'unit.id = dokumen.unit_id', 'left')
            ->orderBy('dokumen.created_at', 'DESC')
            ->limit(5)
            ->findAll();

        // Menyusun data ringkasan statistik
        $data = [
            'title'            => 'Dashboard Admin',
            'total_dokumen'    => $dokumenModel->countAllResults(), // Menghitung total arsip dokumen
            'total_kategori'   => $kategoriModel->countAllResults(), // Menghitung total kategori
            'total_unit'       => $unitModel->countAllResults(),     // Menghitung total unit kerja
            'recent_activity'  => $recentActivity,
            'recent_documents' => $recentDocuments,
        ];

        // Memuat view dashboard dengan data statistik
        return view('admin/dashboard', $data);
    }

    /**
     * Menampilkan halaman dashboard utama untuk Karyawan.
     * Mengkalkulasi total dokumen secara global, serta izin akses berstatus 'Pending' dan 'Disetujui' milik karyawan yang login.
     *
     * @return string View dashboard karyawan beserta data statistik personal
     */
    public function karyawan()
    {
        // Instansiasi model dokumen dan model perizinan akses
        $dokumenModel = new DokumenModel();
        $izinModel = new \App\Models\IzinModel();
        $riwayatModel = new \App\Models\RiwayatModel();

        // Mendapatkan ID pengguna yang sedang aktif dari sesi
        $userId = session()->get('id');

        // Mengambil 5 aktivitas terbaru dari pengguna ini
        $recentActivity = $riwayatModel
            ->select('riwayat.*, users.nama_lengkap, users.role, dokumen.judul')
            ->join('users', 'users.id = riwayat.user_id', 'left')
            ->join('dokumen', 'dokumen.id = riwayat.dokumen_id', 'left')
            ->where('riwayat.user_id', $userId)
            ->orderBy('riwayat.created_at', 'DESC')
            ->limit(5)
            ->findAll();

        // Mengambil 5 dokumen terbaru secara global
        $recentDocuments = $dokumenModel
            ->select('dokumen.*, kategori.nama_kategori, unit.nama_unit')
            ->join('kategori', 'kategori.id = dokumen.kategori_id', 'left')
            ->join('unit', 'unit.id = dokumen.unit_id', 'left')
            ->orderBy('dokumen.created_at', 'DESC')
            ->limit(5)
            ->findAll();

        // Menyusun data statistik spesifik untuk karyawan yang bersangkutan
        $data = [
            'title'            => 'Dashboard Karyawan',
            'total_dokumen'    => $dokumenModel->countAllResults(),
            // Menghitung jumlah perizinan akses yang masih berstatus pending (menunggu persetujuan admin)
            'izin_pending'     => $izinModel->where('user_id', $userId)->where('status_izin', 'Pending')->countAllResults(),
            // Menghitung jumlah perizinan akses yang telah disetujui oleh admin
            'izin_disetujui'   => $izinModel->where('user_id', $userId)->where('status_izin', 'Disetujui')->countAllResults(),
            'recent_activity'  => $recentActivity,
            'recent_documents' => $recentDocuments,
        ];

        // Memuat view dashboard admin (layout responsif menyesuaikan data/role)
        return view('admin/dashboard', $data);
    }
}
