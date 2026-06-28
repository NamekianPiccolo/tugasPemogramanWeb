<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RiwayatModel;

/**
 * Controller RiwayatController
 *
 * Mengelola tampilan riwayat aktivitas (audit trail) sistem untuk administrator,
 * termasuk pencarian, filter, dan pencetakan laporan aktivitas.
 */
class RiwayatController extends BaseController
{
    /**
     * Instance dari model Riwayat untuk interaksi database.
     * 
     * @var RiwayatModel
     */
    protected $riwayatModel;

    /**
     * Konstruktor kelas. Inisiasi model RiwayatModel yang digunakan di semua method.
     */
    public function __construct()
    {
        $this->riwayatModel = new RiwayatModel();
    }

    /**
     * Menampilkan halaman daftar riwayat aktivitas sistem.
     * Menggabungkan data dari tabel riwayat dengan tabel dokumen dan users.
     *
     * @return string HTML halaman riwayat aktivitas
     */
    public function index()
    {
        // Mengambil semua data log riwayat aktivitas beserta judul dokumen dan username pelaku
        $data['riwayat'] = $this->riwayatModel
            ->select('riwayat.*, dokumen.judul, users.username')
            ->join('dokumen', 'dokumen.id = riwayat.dokumen_id', 'left')
            ->join('users', 'users.id = riwayat.user_id', 'left')
            ->orderBy('riwayat.created_at', 'DESC')
            ->findAll();
            
        // Judul halaman browser
        $data['title'] = 'Riwayat Aktivitas';
        
        // Memuat view daftar riwayat
        return view('admin/riwayat/index', $data);
    }

    /**
     * Memproses dan menampilkan halaman cetak laporan riwayat aktivitas (print-friendly view).
     * Mendukung penyaringan data berdasarkan tipe/kategori aksi yang dikirim melalui query parameter 'aksi'.
     *
     * @return string HTML halaman cetak laporan
     */
    public function print()
    {
        // Mendapatkan query parameter 'aksi' untuk memfilter laporan yang dicetak
        $filterAksi = $this->request->getGet('aksi');
        
        // Mendapatkan query parameter 'sort' untuk mengurutkan laporan (default: desc)
        $sort = $this->request->getGet('sort') ?? 'desc';
        $sortOrder = (strtolower($sort) === 'asc') ? 'ASC' : 'DESC';

        // Mendapatkan query parameter 'tanggal' untuk memfilter laporan berdasarkan tanggal tertentu
        $tanggal = $this->request->getGet('tanggal');

        // Mendapatkan query parameter 'search' untuk memfilter laporan berdasarkan pencarian teks
        $search = $this->request->getGet('search');

        // Inisialisasi query builder untuk mengambil riwayat, relasi dokumen, dan pengguna pelaku
        $builder = $this->riwayatModel
            ->select('riwayat.*, dokumen.judul, users.username, users.nama_lengkap')
            ->join('dokumen', 'dokumen.id = riwayat.dokumen_id', 'left')
            ->join('users', 'users.id = riwayat.user_id', 'left');
            
        // Melakukan filter di tingkat query database jika parameter aksi diisi
        if (!empty($filterAksi)) {
            if ($filterAksi === 'tambah') {
                $builder->groupStart()
                        ->like('riwayat.aksi', 'tambah')
                        ->orLike('riwayat.aksi', 'buat')
                        ->orLike('riwayat.aksi', 'upload')
                        ->groupEnd();
            } elseif ($filterAksi === 'edit') {
                $builder->groupStart()
                        ->like('riwayat.aksi', 'ubah')
                        ->orLike('riwayat.aksi', 'edit')
                        ->orLike('riwayat.aksi', 'revisi')
                        ->groupEnd();
            } elseif ($filterAksi === 'hapus') {
                $builder->like('riwayat.aksi', 'hapus');
            } elseif ($filterAksi === 'login') {
                $builder->groupStart()
                        ->like('riwayat.aksi', 'login')
                        ->orLike('riwayat.aksi', 'logout')
                        ->groupEnd();
            }
        }

        // Filter berdasarkan tanggal jika ada
        if (!empty($tanggal)) {
            $builder->where('DATE(riwayat.created_at)', $tanggal);
        }

        // Filter berdasarkan pencarian jika ada
        if (!empty($search)) {
            $builder->groupStart()
                    ->like('users.username', $search)
                    ->orLike('riwayat.aksi', $search)
                    ->orLike('dokumen.judul', $search)
                    ->orLike('riwayat.keterangan', $search)
                    ->groupEnd();
        }

        // Urutkan data berdasarkan parameter sort
        $builder->orderBy('riwayat.created_at', $sortOrder);
        
        // Menjalankan query dan mengambil hasilnya
        $data['riwayat'] = $builder->findAll();
        $data['title'] = 'Laporan Riwayat Aktivitas';
        $data['filter_aksi'] = $filterAksi;
        $data['filter_tanggal'] = $tanggal;
        $data['filter_search'] = $search;
        $data['sort_order'] = $sortOrder;
        
        // Memuat view pencetakan khusus (tanpa layout sidebar/admin dashboard)
        return view('admin/riwayat/print', $data);
    }
}
