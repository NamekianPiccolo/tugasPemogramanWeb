<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

/**
 * Controller KategoriController
 *
 * Mengelola proses CRUD (Create, Read, Update, Delete) kategori dokumen
 * untuk membantu pengarsipan dokumen secara terstruktur berdasarkan kategorinya.
 */
class KategoriController extends BaseController
{
    /**
     * Instance model KategoriModel.
     * 
     * @var KategoriModel
     */
    protected $kategoriModel;
    protected $riwayatModel;

    /**
     * Konstruktor kelas. Menginisialisasi KategoriModel.
     */
    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
        $this->riwayatModel = new \App\Models\RiwayatModel();
    }

    /**
     * Menampilkan daftar semua kategori dokumen yang tersedia dengan pilihan pengurutan.
     *
     * @return string Halaman indeks kategori dokumen
     */
    public function index()
    {
        $sort = $this->request->getGet('sort') ?? 'nama';
        
        $query = $this->kategoriModel;
        
        if ($sort === 'tanggal_baru') {
            $query = $query->orderBy('created_at', 'DESC');
        } elseif ($sort === 'tanggal_lama') {
            $query = $query->orderBy('created_at', 'ASC');
        } elseif ($sort === 'nama_desc') {
            $query = $query->orderBy('nama_kategori', 'DESC');
        } else {
            $query = $query->orderBy('nama_kategori', 'ASC');
        }
        
        $data['kategori'] = $query->findAll();
        $data['sort'] = $sort;
        $data['title'] = 'Data Kategori Dokumen';
        return view('admin/datakategori/index', $data);
    }

    /**
     * Menampilkan formulir pembuatan kategori dokumen baru.
     *
     * @return string Halaman formulir tambah kategori
     */
    public function create()
    {
        $data['title'] = 'Tambah Kategori Dokumen';
        return view('admin/kategori/create', $data);
    }

    /**
     * Menyimpan data kategori baru ke database (POST).
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function store()
    {
        try {
            // Menyimpan entri kategori baru
            $this->kategoriModel->save([
                'nama_kategori' => $this->request->getPost('nama_kategori')
            ]);

            // Mencatat log aktivitas
            $this->riwayatModel->save([
                'dokumen_id' => null,
                'user_id'    => session()->get('id'),
                'aksi'       => 'Tambah Kategori',
                'keterangan' => 'Kategori dokumen baru ditambahkan: ' . $this->request->getPost('nama_kategori') . ' oleh ' . session()->get('username')
            ]);

            session()->setFlashdata('success', 'Kategori berhasil ditambahkan.');
            return redirect()->to('/admin/kategori');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Menampilkan formulir edit untuk memperbarui kategori dokumen tertentu.
     *
     * @param int $id ID kategori dokumen
     * @return string Halaman formulir edit kategori
     */
    public function edit($id)
    {
        $data['kategori'] = $this->kategoriModel->find($id);
        $data['title'] = 'Edit Kategori Dokumen';
        return view('admin/kategori/edit', $data);
    }

    /**
     * Memperbarui nama kategori dokumen tertentu di database (POST).
     *
     * @param int $id ID kategori dokumen
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function update($id)
    {
        try {
            // Memperbarui record kategori
            $this->kategoriModel->update($id, [
                'nama_kategori' => $this->request->getPost('nama_kategori')
            ]);

            // Mencatat log aktivitas
            $this->riwayatModel->save([
                'dokumen_id' => null,
                'user_id'    => session()->get('id'),
                'aksi'       => 'Edit Kategori',
                'keterangan' => 'Kategori dokumen diperbarui menjadi: ' . $this->request->getPost('nama_kategori') . ' oleh ' . session()->get('username')
            ]);

            session()->setFlashdata('success', 'Kategori berhasil diubah.');
            return redirect()->to('/admin/kategori');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Menghapus secara permanen kategori dokumen tertentu berdasarkan ID-nya.
     *
     * @param int $id ID kategori dokumen
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function delete($id)
    {
        try {
            $targetKat = $this->kategoriModel->find($id);
            $targetName = $targetKat ? $targetKat['nama_kategori'] : 'ID: ' . $id;

            // Menghapus data kategori
            $this->kategoriModel->delete($id);

            // Mencatat log aktivitas
            $this->riwayatModel->save([
                'dokumen_id' => null,
                'user_id'    => session()->get('id'),
                'aksi'       => 'Hapus Kategori',
                'keterangan' => 'Kategori dokumen ' . $targetName . ' dihapus oleh ' . session()->get('username')
            ]);

            session()->setFlashdata('success', 'Kategori berhasil dihapus.');
            return redirect()->to('/admin/kategori');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
