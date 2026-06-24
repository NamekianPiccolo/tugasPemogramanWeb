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
        return view('admin/dokumen/index', $data);
    }

    public function create()
    {
        $data['kategori'] = $this->kategoriModel->findAll();
        $data['unit'] = $this->unitModel->findAll();
        return view('admin/dokumen/create', $data);
    }

    public function store()
    {
        try {
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
                'user_id' => session()->get('id'), 
                'aksi' => 'Upload Dokumen',
                'keterangan' => 'Dokumen baru diunggah oleh ' . session()->get('username')
            ]);

            session()->setFlashdata('success', 'Dokumen berhasil ditambahkan.');
            $role = session()->get('role');
            return redirect()->to("/$role/dokumen");
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $data['dokumen'] = $this->dokumenModel->find($id);
        $data['kategori'] = $this->kategoriModel->findAll();
        $data['unit'] = $this->unitModel->findAll();
        return view('admin/dokumen/edit', $data);
    }

    public function update($id)
    {
        try {
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

            // Catat Riwayat Edit
            $this->riwayatModel->save([
                'dokumen_id' => $id,
                'user_id' => session()->get('id'), 
                'aksi' => 'Edit Dokumen',
                'keterangan' => 'Dokumen diperbarui oleh ' . session()->get('username')
            ]);

            session()->setFlashdata('success', 'Dokumen berhasil diubah.');
            $role = session()->get('role');
            return redirect()->to("/$role/dokumen");
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        try {
            $dokumen = $this->dokumenModel->find($id);

            if ($dokumen) {
                // Catat riwayat sebelum dokumen dihapus
                $this->riwayatModel->save([
                    'dokumen_id' => $id,
                    'user_id' => session()->get('id'), 
                    'aksi' => 'Hapus Dokumen',
                    'keterangan' => 'Dokumen "' . $dokumen['judul'] . '" dihapus secara permanen.'
                ]);

                // Hapus file fisik jika ada
                if (!empty($dokumen['file_dokumen']) && file_exists(FCPATH . 'uploads/' . $dokumen['file_dokumen'])) {
                    unlink(FCPATH . 'uploads/' . $dokumen['file_dokumen']);
                }

                $this->dokumenModel->delete($id);
            }

            session()->setFlashdata('success', 'Dokumen berhasil dihapus.');
            $role = session()->get('role');
            return redirect()->to("/$role/dokumen");
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function karyawan_index()
    {
        $userId = session()->get('id');
        $data['dokumen'] = $this->dokumenModel
            ->select('dokumen.*, kategori.nama_kategori, unit.nama_unit, izin.status_izin, distribusi.status as status_distribusi, 
                     (SELECT COUNT(id) FROM distribusi as d2 WHERE d2.dokumen_id = dokumen.id AND d2.status != \'Dikembalikan\') as sedang_dipinjam_global')
            ->join('kategori', 'kategori.id = dokumen.kategori_id', 'left')
            ->join('unit', 'unit.id = dokumen.unit_id', 'left')
            ->join('izin', "izin.dokumen_id = dokumen.id AND izin.user_id = $userId", 'left')
            ->join('distribusi', "distribusi.dokumen_id = dokumen.id AND distribusi.user_id = $userId AND distribusi.status != 'Dikembalikan'", 'left')
            ->findAll();
        
        return view('admin/dokumen/index', $data);
    }
}
