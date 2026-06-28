<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UnitModel;

/**
 * Controller UnitController
 *
 * Mengelola proses CRUD (Create, Read, Update, Delete) data Unit Kerja / Bagian
 * untuk membantu memetakan kepemilikan dokumen di organisasi.
 */
class UnitController extends BaseController
{
    /**
     * Instance model UnitModel.
     * 
     * @var UnitModel
     */
    protected $unitModel;
    protected $riwayatModel;

    /**
     * Konstruktor kelas. Menginisialisasi UnitModel.
     */
    public function __construct()
    {
        $this->unitModel = new UnitModel();
        $this->riwayatModel = new \App\Models\RiwayatModel();
    }

    /**
     * Menampilkan daftar semua unit kerja yang terdaftar dengan pilihan pengurutan.
     *
     * @return string Halaman indeks unit kerja
     */
    public function index()
    {
        $sort = $this->request->getGet('sort') ?? 'nama';
        
        $query = $this->unitModel;
        
        if ($sort === 'tanggal_baru') {
            $query = $query->orderBy('created_at', 'DESC');
        } elseif ($sort === 'tanggal_lama') {
            $query = $query->orderBy('created_at', 'ASC');
        } elseif ($sort === 'nama_desc') {
            $query = $query->orderBy('nama_unit', 'DESC');
        } else {
            $query = $query->orderBy('nama_unit', 'ASC');
        }
        
        $data['unit'] = $query->findAll();
        $data['sort'] = $sort;
        $data['title'] = 'Data Unit Kerja';
        return view('admin/unit/index', $data);
    }

    /**
     * Menampilkan formulir pendaftaran unit kerja baru.
     *
     * @return string Halaman formulir tambah unit
     */
    public function create()
    {
        $data['title'] = 'Tambah Unit Kerja';
        return view('admin/unit/create', $data);
    }

    /**
     * Menyimpan data unit kerja baru ke database (POST).
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function store()
    {
        try {
            // Menyimpan entri unit kerja baru
            $this->unitModel->save([
                'nama_unit' => $this->request->getPost('nama_unit')
            ]);

            // Mencatat log aktivitas
            $this->riwayatModel->save([
                'dokumen_id' => null,
                'user_id'    => session()->get('id'),
                'aksi'       => 'Tambah Unit',
                'keterangan' => 'Unit kerja baru ditambahkan: ' . $this->request->getPost('nama_unit') . ' oleh ' . session()->get('username')
            ]);

            session()->setFlashdata('success', 'Unit/Bagian berhasil ditambahkan.');
            return redirect()->to('/admin/unit');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Menampilkan formulir edit untuk memperbarui nama unit kerja.
     *
     * @param int $id ID unit kerja
     * @return string Halaman formulir edit unit
     */
    public function edit($id)
    {
        $data['unit'] = $this->unitModel->find($id);
        $data['title'] = 'Edit Unit Kerja';
        return view('admin/unit/edit', $data);
    }

    /**
     * Memperbarui nama unit kerja di database (POST).
     *
     * @param int $id ID unit kerja
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function update($id)
    {
        try {
            // Memperbarui nama unit kerja
            $this->unitModel->update($id, [
                'nama_unit' => $this->request->getPost('nama_unit')
            ]);

            // Mencatat log aktivitas
            $this->riwayatModel->save([
                'dokumen_id' => null,
                'user_id'    => session()->get('id'),
                'aksi'       => 'Edit Unit',
                'keterangan' => 'Unit kerja diperbarui menjadi: ' . $this->request->getPost('nama_unit') . ' oleh ' . session()->get('username')
            ]);

            session()->setFlashdata('success', 'Unit/Bagian berhasil diubah.');
            return redirect()->to('/admin/unit');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Menghapus unit kerja tertentu dari database berdasarkan ID-nya.
     *
     * @param int $id ID unit kerja
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function delete($id)
    {
        try {
            $targetUnit = $this->unitModel->find($id);
            $targetName = $targetUnit ? $targetUnit['nama_unit'] : 'ID: ' . $id;

            // Menghapus data unit kerja
            $this->unitModel->delete($id);

            // Mencatat log aktivitas
            $this->riwayatModel->save([
                'dokumen_id' => null,
                'user_id'    => session()->get('id'),
                'aksi'       => 'Hapus Unit',
                'keterangan' => 'Unit kerja ' . $targetName . ' dihapus oleh ' . session()->get('username')
            ]);

            session()->setFlashdata('success', 'Unit/Bagian berhasil dihapus.');
            return redirect()->to('/admin/unit');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
