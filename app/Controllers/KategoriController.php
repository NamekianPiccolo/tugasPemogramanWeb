<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

class KategoriController extends BaseController
{
    protected $kategoriModel;

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
    }

    public function index()
    {
        $data['kategori'] = $this->kategoriModel->findAll();
        $data['title'] = 'Data Kategori Dokumen';
        return view('admin/kategori/index', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Kategori Dokumen';
        return view('admin/kategori/create', $data);
    }

    public function store()
    {
        try {
            $this->kategoriModel->save([
                'nama_kategori' => $this->request->getPost('nama_kategori')
            ]);
            session()->setFlashdata('success', 'Kategori berhasil ditambahkan.');
            return redirect()->to('/admin/kategori');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $data['kategori'] = $this->kategoriModel->find($id);
        $data['title'] = 'Edit Kategori Dokumen';
        return view('admin/kategori/edit', $data);
    }

    public function update($id)
    {
        try {
            $this->kategoriModel->update($id, [
                'nama_kategori' => $this->request->getPost('nama_kategori')
            ]);
            session()->setFlashdata('success', 'Kategori berhasil diubah.');
            return redirect()->to('/admin/kategori');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        try {
            $this->kategoriModel->delete($id);
            session()->setFlashdata('success', 'Kategori berhasil dihapus.');
            return redirect()->to('/admin/kategori');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
