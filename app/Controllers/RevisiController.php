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
        try {
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
            
            // Ubah status distribusi menjadi 'Dikembalikan'
            $distribusiModel = new \App\Models\DistribusiModel();
            $userId = session()->get('id');
            $activeDistribusi = $distribusiModel->where('dokumen_id', $dokumenId)
                                                ->where('user_id', $userId)
                                                ->where('status !=', 'Dikembalikan')
                                                ->first();
            if ($activeDistribusi) {
                $distribusiModel->update($activeDistribusi['id'], ['status' => 'Dikembalikan']);
            }

            // Ubah status izin menjadi 'Selesai' agar karyawan harus minta izin lagi jika ingin merevisi kembali
            $izinModel = new \App\Models\IzinModel();
            $activeIzin = $izinModel->where('dokumen_id', $dokumenId)
                                    ->where('user_id', $userId)
                                    ->where('status_izin', 'Disetujui')
                                    ->first();
            if ($activeIzin) {
                $izinModel->update($activeIzin['id'], ['status_izin' => 'Selesai']);
            }
            // Catat Riwayat Pengajuan Revisi
            $this->riwayatModel->save([
                'dokumen_id' => $dokumenId,
                'user_id' => session()->get('id'), 
                'aksi' => 'Ajukan Revisi',
                'keterangan' => 'Mengajukan draft perubahan dokumen'
            ]);
     
            session()->setFlashdata('success', 'Draft perubahan telah dikirim ke Admin untuk ditinjau.');
            return redirect()->to('/karyawan/dokumen');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
 
    // Admin: Daftar pengajuan perubahan
    public function index()
    {
        $data['title'] = 'Review Perubahan Dokumen';
        $data['revisi'] = $this->revisiModel
            ->select('revisi.*, dokumen.judul as judul_asli, dokumen.deskripsi as deskripsi_asli, users.nama_lengkap')
            ->join('dokumen', 'dokumen.id = revisi.dokumen_id', 'left')
            ->join('users', 'users.id = revisi.user_id', 'left')
            ->orderBy('revisi.created_at', 'DESC')
            ->findAll();
        
        return view('admin/revisi/index', $data);
    }
 
    // Admin: Menyetujui perubahan (Apply to main table)
    public function approve($id)
    {
        try {
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
     
            // 2. Update Status Revisi yang Disetujui
            $this->revisiModel->update($id, ['status_revisi' => 'Disetujui']);
     
            // 3. Catat Riwayat Persetujuan
            $this->riwayatModel->save([
                'dokumen_id' => $revisi['dokumen_id'],
                'user_id'    => session()->get('id'),
                'aksi'       => 'Persetujuan Perubahan',
                'keterangan' => 'Perubahan dari karyawan ' . $revisi['user_id'] . ' telah disetujui dan diterapkan.'
            ]);

            // 4. Tolak otomatis pengajuan revisi lain (jika ada) untuk dokumen yang sama
            $revisiLain = $this->revisiModel
                ->where('dokumen_id', $revisi['dokumen_id'])
                ->where('id !=', $id)
                ->where('status_revisi', 'Pending')
                ->findAll();

            if (!empty($revisiLain)) {
                $pesanOtomatis = 'Revisi ditolak otomatis karena pengajuan revisi lain untuk dokumen ini telah disetujui.';
                foreach ($revisiLain as $rl) {
                    $this->revisiModel->update($rl['id'], [
                        'status_revisi' => 'Ditolak',
                        'pesan_admin'   => $pesanOtomatis
                    ]);

                    $this->riwayatModel->save([
                        'dokumen_id' => $rl['dokumen_id'],
                        'user_id'    => session()->get('id'),
                        'aksi'       => 'Penolakan Perubahan',
                        'keterangan' => 'Sistem menolak otomatis perubahan dari karyawan ' . $rl['user_id'] . '. Pesan: ' . $pesanOtomatis
                    ]);
                }
            }
     
            session()->setFlashdata('success', 'Perubahan dokumen berhasil disetujui dan diterapkan ke sistem.');
            return redirect()->to('/admin/revisi');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back();
        }
    }
 
    // Admin: Menolak perubahan
    public function reject($id)
    {
        try {
            $pesan = $this->request->getPost('pesan_admin');
            $this->revisiModel->update($id, [
                'status_revisi' => 'Ditolak',
                'pesan_admin'   => $pesan
            ]);

            // Catat Riwayat Penolakan
            $revisi = $this->revisiModel->find($id);
            if ($revisi) {
                $this->riwayatModel->save([
                    'dokumen_id' => $revisi['dokumen_id'],
                    'user_id'    => session()->get('id'),
                    'aksi'       => 'Penolakan Perubahan',
                    'keterangan' => 'Perubahan dokumen ditolak oleh Admin. Pesan: ' . $pesan
                ]);
            }
     
            session()->setFlashdata('success', 'Perubahan dokumen telah ditolak.');
            return redirect()->to('/admin/revisi');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
