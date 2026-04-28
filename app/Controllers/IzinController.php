<?php
 
namespace App\Controllers;
 
use App\Controllers\BaseController;
use App\Models\IzinModel;
 
class IzinController extends BaseController
{
    protected $izinModel;
 
    public function __construct()
    {
        $this->izinModel = new IzinModel();
    }
 
    public function index()
    {
        $data['title'] = 'Izin Akses Dokumen';
        $data['izin'] = $this->izinModel
            ->select('izin.*, dokumen.judul')
            ->join('dokumen', 'dokumen.id = izin.dokumen_id', 'left')
            ->where('user_id', session()->get('id'))
            ->findAll();
        
        return view('Backend/Izin/index', $data);
    }

    public function create()
    {
        $dokumenModel = new \App\Models\DokumenModel();
        $data['title'] = 'Ajukan Izin Akses';
        $data['dokumen'] = $dokumenModel->findAll();
        
        return view('Backend/Izin/create', $data);
    }

    public function store()
    {
        $userId = session()->get('id');
        $dokumenId = $this->request->getPost('dokumen_id');

        // Cek apakah sudah ada pengajuan yang Pending atau Disetujui
        $existing = $this->izinModel->where([
            'user_id' => $userId,
            'dokumen_id' => $dokumenId
        ])->whereIn('status_izin', ['Pending', 'Disetujui'])->first();

        if ($existing) {
            session()->setFlashdata('error', 'Anda sudah memiliki pengajuan untuk dokumen ini yang sedang diproses atau sudah disetujui.');
            return redirect()->back();
        }

        $this->izinModel->save([
            'user_id' => $userId,
            'dokumen_id' => $dokumenId,
            'pesan' => $this->request->getPost('pesan'),
            'status_izin' => 'Pending',
            'tgl_pengajuan' => date('Y-m-d H:i:s')
        ]);

        session()->setFlashdata('success', 'Pengajuan izin berhasil dikirim.');
        return redirect()->to('/karyawan/izin');
    }

    public function admin_index()
    {
        $data['title'] = 'Manajemen Persetujuan Izin';
        $data['izin'] = $this->izinModel
            ->select('izin.*, dokumen.judul, users.nama_lengkap')
            ->join('dokumen', 'dokumen.id = izin.dokumen_id', 'left')
            ->join('users', 'users.id = izin.user_id', 'left')
            ->orderBy('izin.created_at', 'DESC')
            ->findAll();
        
        return view('Backend/Izin/admin_index', $data);
    }

    public function approve($id)
    {
        $this->izinModel->update($id, ['status_izin' => 'Disetujui']);
        session()->setFlashdata('success', 'Izin berhasil disetujui.');
        return redirect()->to('/admin/izin');
    }

    public function reject($id)
    {
        $this->izinModel->update($id, ['status_izin' => 'Ditolak']);
        session()->setFlashdata('success', 'Izin telah ditolak.');
        return redirect()->to('/admin/izin');
    }
}
