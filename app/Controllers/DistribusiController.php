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
        $data['title'] = 'Data Distribusi Dokumen';
        return view('admin/distribusi/index', $data);
    }

    public function create()
    {
        $data['dokumen'] = $this->dokumenModel->findAll();
        $data['selected_dokumen'] = $this->request->getGet('dokumen');
        $data['title'] = 'Tambah Distribusi Dokumen';
        return view('admin/distribusi/create', $data);
    }

    public function store()
    {
        try {
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
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $data['distribusi'] = $this->distribusiModel->find($id);
        $data['dokumen'] = $this->dokumenModel->findAll();
        $data['title'] = 'Edit Distribusi Dokumen';
        return view('admin/distribusi/edit', $data);
    }

    public function update($id)
    {
        try {
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
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        try {
            $this->distribusiModel->delete($id);
            session()->setFlashdata('success', 'Data distribusi berhasil dihapus.');
            $role = session()->get('role');
            return redirect()->to("/$role/distribusi");
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
