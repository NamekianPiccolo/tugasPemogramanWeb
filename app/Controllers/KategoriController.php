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
        return view('Backend/Kategori/index', $data);
    }

    public function create()
    {
        return view('Backend/Kategori/create');
    }

    public function store()
    {
        $this->kategoriModel->save([
            'nama_kategori' => $this->request->getPost('nama_kategori')
        ]);
        session()->setFlashdata('success', 'Kategori berhasil ditambahkan.');
        return redirect()->to('/admin/kategori');
    }

    public function edit($id)
    {
        $data['kategori'] = $this->kategoriModel->find($id);
        return view('Backend/Kategori/edit', $data);
    }

    public function update($id)
    {
        $this->kategoriModel->update($id, [
            'nama_kategori' => $this->request->getPost('nama_kategori')
        ]);
        session()->setFlashdata('success', 'Kategori berhasil diubah.');
        return redirect()->to('/admin/kategori');
    }

    public function delete($id)
    {
        $this->kategoriModel->delete($id);
        session()->setFlashdata('success', 'Kategori berhasil dihapus.');
        return redirect()->to('/admin/kategori');
    }
}
