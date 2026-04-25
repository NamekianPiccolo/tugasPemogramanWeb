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
        return view('Backend/Unit/index', $data);
    }

    public function create()
    {
        return view('Backend/Unit/create');
    }

    public function store()
    {
        $this->unitModel->save([
            'nama_unit' => $this->request->getPost('nama_unit')
        ]);
        session()->setFlashdata('success', 'Unit/Bagian berhasil ditambahkan.');
        return redirect()->to('/admin/unit');
    }

    public function edit($id)
    {
        $data['unit'] = $this->unitModel->find($id);
        return view('Backend/Unit/edit', $data);
    }

    public function update($id)
    {
        $this->unitModel->update($id, [
            'nama_unit' => $this->request->getPost('nama_unit')
        ]);
        session()->setFlashdata('success', 'Unit/Bagian berhasil diubah.');
        return redirect()->to('/admin/unit');
    }

    public function delete($id)
    {
        $this->unitModel->delete($id);
        session()->setFlashdata('success', 'Unit/Bagian berhasil dihapus.');
        return redirect()->to('/admin/unit');
    }
}
