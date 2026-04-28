<?php
 
namespace App\Controllers;
 
use App\Controllers\BaseController;
use App\Models\RevisiModel;
use App\Models\DokumenModel;
use App\Models\RiwayatModel;
 
class RevisiController extends BaseController
{
    protected $revisiModel;
    protected $dokumenModel;
    protected $riwayatModel;
 
    public function __construct()
    {
        $this->revisiModel = new RevisiModel();
        $this->dokumenModel = new DokumenModel();
        $this->riwayatModel = new RiwayatModel();
    }
 
    // Karyawan: Mengirim draf perubahan
    public function store()
    {
        $dokumenId = $this->request->getPost('dokumen_id');
        $file = $this->request->getFile('file_dokumen');
        $fileName = $this->request->getPost('file_lama');
        
        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move(FCPATH . 'uploads', $fileName);
        }
 
        $this->revisiModel->save([
            'dokumen_id'    => $dokumenId,
            'user_id'       => session()->get('id'),
            'judul'         => $this->request->getPost('judul'),
            'deskripsi'     => $this->request->getPost('deskripsi'),
            'tanggal'       => $this->request->getPost('tanggal'),
            'kategori_id'   => $this->request->getPost('kategori_id'),
            'unit_id'       => $this->request->getPost('unit_id'),
            'file_dokumen'  => $fileName,
            'status_revisi' => 'Pending'
        ]);
 
        session()->setFlashdata('success', 'Draft perubahan telah dikirim ke Admin untuk ditinjau.');
        return redirect()->to('/karyawan/dokumen');
    }
 
    // Admin: Daftar pengajuan perubahan
    public function index()
    {
        $data['title'] = 'Review Perubahan Dokumen';
        $data['revisi'] = $this->revisiModel
            ->select('revisi.*, dokumen.judul as judul_asli, users.nama_lengkap')
            ->join('dokumen', 'dokumen.id = revisi.dokumen_id', 'left')
            ->join('users', 'users.id = revisi.user_id', 'left')
            ->orderBy('revisi.created_at', 'DESC')
            ->findAll();
        
        return view('Backend/Revisi/index', $data);
    }
 
    // Admin: Menyetujui perubahan (Apply to main table)
    public function approve($id)
    {
        $revisi = $this->revisiModel->find($id);
        if (!$revisi) return redirect()->back();
 
        // 1. Update Tabel Utama Dokumen
        $this->dokumenModel->update($revisi['dokumen_id'], [
            'judul'         => $revisi['judul'],
            'deskripsi'     => $revisi['deskripsi'],
            'tanggal'       => $revisi['tanggal'],
            'kategori_id'   => $revisi['kategori_id'],
            'unit_id'       => $revisi['unit_id'],
            'file_dokumen'  => $revisi['file_dokumen'],
        ]);
 
        // 2. Update Status Revisi
        $this->revisiModel->update($id, ['status_revisi' => 'Disetujui']);
 
        // 3. Catat Riwayat
        $this->riwayatModel->save([
            'dokumen_id' => $revisi['dokumen_id'],
            'user_id'    => session()->get('id'),
            'aksi'       => 'Persetujuan Perubahan',
            'keterangan' => 'Perubahan dari karyawan ' . $revisi['user_id'] . ' telah disetujui dan diterapkan.'
        ]);
 
        session()->setFlashdata('success', 'Perubahan dokumen berhasil disetujui dan diterapkan ke sistem.');
        return redirect()->to('/admin/revisi');
    }
 
    // Admin: Menolak perubahan
    public function reject($id)
    {
        $pesan = $this->request->getPost('pesan_admin');
        $this->revisiModel->update($id, [
            'status_revisi' => 'Ditolak',
            'pesan_admin'   => $pesan
        ]);
 
        session()->setFlashdata('success', 'Perubahan dokumen telah ditolak.');
        return redirect()->to('/admin/revisi');
    }
}
