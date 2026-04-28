<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DistribusiModel;
use App\Models\DokumenModel;

class DistribusiController extends BaseController
{
    protected $distribusiModel;
    protected $dokumenModel;

    public function __construct()
    {
        $this->distribusiModel = new DistribusiModel();
        $this->dokumenModel = new DokumenModel();
    }

    public function index()
    {
        $data['distribusi'] = $this->distribusiModel
            ->select('distribusi.*, dokumen.judul')
            ->join('dokumen', 'dokumen.id = distribusi.dokumen_id', 'left')
            ->findAll();
        return view('Backend/Distribusi/index', $data);
    }

    public function create()
    {
        $data['dokumen'] = $this->dokumenModel->findAll();
        $data['selected_dokumen'] = $this->request->getGet('dokumen');
        return view('Backend/Distribusi/create', $data);
    }

    public function store()
    {
        $this->distribusiModel->save([
            'dokumen_id' => $this->request->getPost('dokumen_id'),
            'peminjam' => $this->request->getPost('peminjam'),
            'tanggal_pinjam' => $this->request->getPost('tanggal_pinjam'),
            'tanggal_kembali' => $this->request->getPost('tanggal_kembali'),
            'status' => $this->request->getPost('status')
        ]);
        session()->setFlashdata('success', 'Data distribusi/peminjaman berhasil ditambahkan.');
        $role = session()->get('role');
        return redirect()->to("/$role/distribusi");
    }

    public function edit($id)
    {
        $data['distribusi'] = $this->distribusiModel->find($id);
        $data['dokumen'] = $this->dokumenModel->findAll();
        return view('Backend/Distribusi/edit', $data);
    }

    public function update($id)
    {
        $this->distribusiModel->update($id, [
            'dokumen_id' => $this->request->getPost('dokumen_id'),
            'peminjam' => $this->request->getPost('peminjam'),
            'tanggal_pinjam' => $this->request->getPost('tanggal_pinjam'),
            'tanggal_kembali' => $this->request->getPost('tanggal_kembali'),
            'status' => $this->request->getPost('status')
        ]);
        session()->setFlashdata('success', 'Data distribusi berhasil diubah.');
        $role = session()->get('role');
        return redirect()->to("/$role/distribusi");
    }

    public function delete($id)
    {
        $this->distribusiModel->delete($id);
        session()->setFlashdata('success', 'Data distribusi berhasil dihapus.');
        $role = session()->get('role');
        return redirect()->to("/$role/distribusi");
    }
}
