<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UnitModel;

class UnitController extends BaseController
{
    protected $unitModel;

    public function __construct()
    {
        $this->unitModel = new UnitModel();
    }

    public function index()
    {
        $data['unit'] = $this->unitModel->findAll();
        $data['title'] = 'Data Unit Kerja';
        return view('admin/unit/index', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Unit Kerja';
        return view('admin/unit/create', $data);
    }

    public function store()
    {
        try {
            $this->unitModel->save([
                'nama_unit' => $this->request->getPost('nama_unit')
            ]);
            session()->setFlashdata('success', 'Unit/Bagian berhasil ditambahkan.');
            return redirect()->to('/admin/unit');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $data['unit'] = $this->unitModel->find($id);
        $data['title'] = 'Edit Unit Kerja';
        return view('admin/unit/edit', $data);
    }

    public function update($id)
    {
        try {
            $this->unitModel->update($id, [
                'nama_unit' => $this->request->getPost('nama_unit')
            ]);
            session()->setFlashdata('success', 'Unit/Bagian berhasil diubah.');
            return redirect()->to('/admin/unit');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        try {
            $this->unitModel->delete($id);
            session()->setFlashdata('success', 'Unit/Bagian berhasil dihapus.');
            return redirect()->to('/admin/unit');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
