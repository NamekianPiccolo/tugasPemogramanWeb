<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DokumenModel;
use App\Models\KategoriModel;
use App\Models\UnitModel;
use App\Models\RiwayatModel;

class DokumenController extends BaseController
{
    protected $dokumenModel;
    protected $kategoriModel;
    protected $unitModel;
    protected $riwayatModel;

    public function __construct()
    {
        $this->dokumenModel = new DokumenModel();
        $this->kategoriModel = new KategoriModel();
        $this->unitModel = new UnitModel();
        $this->riwayatModel = new RiwayatModel();
    }

    public function index()
    {
        $data['dokumen'] = $this->dokumenModel
            ->select('dokumen.*, kategori.nama_kategori, unit.nama_unit')
            ->join('kategori', 'kategori.id = dokumen.kategori_id', 'left')
            ->join('unit', 'unit.id = dokumen.unit_id', 'left')
            ->findAll();
        return view('Backend/Dokumen/index', $data);
    }

    public function create()
    {
        $data['kategori'] = $this->kategoriModel->findAll();
        $data['unit'] = $this->unitModel->findAll();
        return view('Backend/Dokumen/create', $data);
    }

    public function store()
    {
        $file = $this->request->getFile('file_dokumen');
        $fileName = '';
        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move(FCPATH . 'uploads', $fileName);
        }

        $this->dokumenModel->insert([
            'judul' => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'tanggal' => $this->request->getPost('tanggal'),
            'kategori_id' => $this->request->getPost('kategori_id'),
            'unit_id' => $this->request->getPost('unit_id'),
            'file_dokumen' => $fileName
        ]);

        $dokumenId = $this->dokumenModel->getInsertID();

        // Catat Riwayat
        $this->riwayatModel->save([
            'dokumen_id' => $dokumenId,
            'user_id' => 1, // Seharusnya dari session, dihardcode untuk demo
            'aksi' => 'Upload Dokumen',
            'keterangan' => 'Dokumen baru diunggah oleh admin.'
        ]);

        session()->setFlashdata('success', 'Dokumen berhasil ditambahkan.');
        return redirect()->to('/admin/dokumen');
    }

    public function edit($id)
    {
        $data['dokumen'] = $this->dokumenModel->find($id);
        $data['kategori'] = $this->kategoriModel->findAll();
        $data['unit'] = $this->unitModel->findAll();
        return view('Backend/Dokumen/edit', $data);
    }

    public function update($id)
    {
        $dokumenLama = $this->dokumenModel->find($id);
        $file = $this->request->getFile('file_dokumen');
        $fileName = $dokumenLama['file_dokumen'];
        
        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move(FCPATH . 'uploads', $fileName);
            // Hapus file lama jika ada
            if (!empty($dokumenLama['file_dokumen']) && file_exists(FCPATH . 'uploads/' . $dokumenLama['file_dokumen'])) {
                unlink(FCPATH . 'uploads/' . $dokumenLama['file_dokumen']);
            }
        }

        $this->dokumenModel->update($id, [
            'judul' => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'tanggal' => $this->request->getPost('tanggal'),
            'kategori_id' => $this->request->getPost('kategori_id'),
            'unit_id' => $this->request->getPost('unit_id'),
            'file_dokumen' => $fileName
        ]);

        session()->setFlashdata('success', 'Dokumen berhasil diubah.');
        return redirect()->to('/admin/dokumen');
    }

    public function delete($id)
    {
        $dokumen = $this->dokumenModel->find($id);
        if (!empty($dokumen['file_dokumen']) && file_exists(FCPATH . 'uploads/' . $dokumen['file_dokumen'])) {
            unlink(FCPATH . 'uploads/' . $dokumen['file_dokumen']);
        }
        $this->dokumenModel->delete($id);
        session()->setFlashdata('success', 'Dokumen berhasil dihapus.');
        return redirect()->to('/admin/dokumen');
    }
}
