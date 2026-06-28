<?php
 
namespace App\Controllers;
 
use App\Controllers\BaseController;
use App\Models\RevisiModel;
use App\Models\DokumenModel;
use App\Models\RiwayatModel;
 
/**
 * Controller RevisiController
 *
 * Mengelola alur peninjauan perubahan (revisi) dokumen oleh Karyawan.
 * Karyawan dapat mengajukan draf baru dokumen yang mereka pinjam, dan Administrator
 * meninjau pengajuan tersebut untuk kemudian disetujui (diterapkan ke dokumen utama) atau ditolak.
 */
class RevisiController extends BaseController
{
    /**
     * Instance model RevisiModel.
     * 
     * @var RevisiModel
     */
    protected $revisiModel;

    /**
     * Instance model DokumenModel.
     * 
     * @var DokumenModel
     */
    protected $dokumenModel;

    /**
     * Instance model RiwayatModel untuk log audit trail.
     * 
     * @var RiwayatModel
     */
    protected $riwayatModel;
 
    /**
     * Konstruktor kelas. Menginisialisasi semua model yang digunakan untuk manajemen revisi.
     */
    public function __construct()
    {
        $this->revisiModel = new RevisiModel();
        $this->dokumenModel = new DokumenModel();
        $this->riwayatModel = new RiwayatModel();
    }
 
    /**
     * Memproses penyimpanan draf usulan perubahan dokumen yang diajukan oleh Karyawan (POST).
     * Melakukan upload berkas baru, mengubah status peminjaman menjadi 'Dikembalikan',
     * menandai status izin akses menjadi 'Selesai', serta mencatat log audit trail 'Ajukan Revisi'.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function store()
    {
        try {
            $dokumenId = $this->request->getPost('dokumen_id');
            $file = $this->request->getFile('file_dokumen');
            $fileName = $this->request->getPost('file_lama');
            
            // Proses upload berkas revisi baru jika diunggah oleh karyawan
            if ($file && $file->isValid() && ! $file->hasMoved()) {
                $fileName = $file->getRandomName();
                $file->move(FCPATH . 'uploads', $fileName);
            }
     
            // Menyimpan entri baru usulan revisi berkas
            $this->revisiModel->save([
                'dokumen_id'    => $dokumenId,
                'user_id'       => session()->get('id'),
                'judul'         => $this->request->getPost('judul'),
                'deskripsi'     => $this->request->getPost('deskripsi'),
                'pesan_revisi'  => $this->request->getPost('pesan_revisi'),
                'tanggal'       => $this->request->getPost('tanggal'),
                'kategori_id'   => $this->request->getPost('kategori_id'),
                'unit_id'       => $this->request->getPost('unit_id'),
                'file_dokumen'  => $fileName,
                'status_revisi' => 'Pending'
            ]);
            
            // Mengubah status peminjaman distribusi aktif menjadi 'Dikembalikan' secara otomatis
            $distribusiModel = new \App\Models\DistribusiModel();
            $userId = session()->get('id');
            $activeDistribusi = $distribusiModel->where('dokumen_id', $dokumenId)
                                                ->where('user_id', $userId)
                                                ->where('status !=', 'Dikembalikan')
                                                ->first();
            if ($activeDistribusi) {
                $distribusiModel->update($activeDistribusi['id'], ['status' => 'Dikembalikan']);
            }

            // Mengubah status izin aktif dari 'Disetujui' menjadi 'Selesai' 
            // agar karyawan harus meminta izin lagi jika ingin merevisi kembali di masa mendatang
            $izinModel = new \App\Models\IzinModel();
            $activeIzin = $izinModel->where('dokumen_id', $dokumenId)
                                    ->where('user_id', $userId)
                                    ->where('status_izin', 'Disetujui')
                                    ->first();
            if ($activeIzin) {
                $izinModel->update($activeIzin['id'], ['status_izin' => 'Selesai']);
            }
            
            // Mencatat log aktivitas pengajuan revisi
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
 
    /**
     * Menampilkan daftar semua draf pengajuan perubahan dokumen untuk Administrator.
     *
     * @return string Halaman indeks peninjauan revisi admin
     */
    public function index()
    {
        $data['title'] = 'Review Perubahan Dokumen';
        
        // Mengambil daftar seluruh usulan revisi beserta nama pengaju dan info dokumen asli
        $data['revisi'] = $this->revisiModel
            ->select('revisi.*, dokumen.judul as judul_asli, dokumen.deskripsi as deskripsi_asli, dokumen.file_dokumen as file_asli, users.nama_lengkap')
            ->join('dokumen', 'dokumen.id = revisi.dokumen_id', 'left')
            ->join('users', 'users.id = revisi.user_id', 'left')
            ->orderBy('revisi.created_at', 'DESC')
            ->findAll();
        
        return view('admin/revisi/index', $data);
    }
 
    /**
     * Menyetujui usulan perubahan dokumen dan menerapkannya langsung ke tabel utama dokumen (Admin).
     * Secara otomatis menolak usulan revisi lain yang masih berstatus Pending untuk dokumen yang sama.
     *
     * @param int $id ID usulan revisi
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function approve($id)
    {
        try {
            $revisi = $this->revisiModel->find($id);
            if (!$revisi) return redirect()->back();
     
            // 1. Memperbarui tabel utama 'dokumen' dengan isi draf baru yang diajukan karyawan
            $this->dokumenModel->update($revisi['dokumen_id'], [
                'judul'         => $revisi['judul'],
                'deskripsi'     => $revisi['deskripsi'],
                'tanggal'       => $revisi['tanggal'],
                'kategori_id'   => $revisi['kategori_id'],
                'unit_id'       => $revisi['unit_id'],
                'file_dokumen'  => $revisi['file_dokumen'],
            ]);
     
            // 2. Mengubah status usulan revisi ini menjadi 'Disetujui'
            $this->revisiModel->update($id, ['status_revisi' => 'Disetujui']);
     
            // 3. Mencatat log persetujuan perubahan
            $this->riwayatModel->save([
                'dokumen_id' => $revisi['dokumen_id'],
                'user_id'    => session()->get('id'),
                'aksi'       => 'Persetujuan Perubahan',
                'keterangan' => 'Perubahan dari karyawan ' . $revisi['user_id'] . ' telah disetujui dan diterapkan.'
            ]);


     
            session()->setFlashdata('success', 'Perubahan dokumen berhasil disetujui dan diterapkan ke sistem.');
            return redirect()->to('/admin/revisi');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back();
        }
    }
 
    /**
     * Menolak usulan perubahan dokumen dan menyimpan umpan balik/pesan dari Admin (POST).
     *
     * @param int $id ID usulan revisi
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function reject($id)
    {
        try {
            // Mengambil pesan tanggapan admin dari form POST
            $pesan = $this->request->getPost('pesan_admin');
            
            // Mengubah status menjadi 'Ditolak' dan menyimpan alasan penolakan
            $this->revisiModel->update($id, [
                'status_revisi' => 'Ditolak',
                'pesan_admin'   => $pesan
            ]);

            // Mencatat log aktivitas penolakan revisi
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

    /**
     * Menampilkan daftar usulan perubahan dokumen yang diajukan oleh Karyawan yang sedang login.
     *
     * @return string Halaman indeks usulan revisi karyawan
     */
    public function karyawan_index()
    {
        $data['title'] = 'Riwayat Pengajuan Revisi';
        $userId = session()->get('id');

        // Mengambil daftar usulan revisi yang dibuat oleh karyawan yang sedang login
        $data['revisi'] = $this->revisiModel
            ->select('revisi.*, dokumen.judul as judul_asli, dokumen.deskripsi as deskripsi_asli, dokumen.file_dokumen as file_asli, users.nama_lengkap, kategori.nama_kategori, unit.nama_unit')
            ->join('dokumen', 'dokumen.id = revisi.dokumen_id', 'left')
            ->join('users', 'users.id = revisi.user_id', 'left')
            ->join('kategori', 'kategori.id = revisi.kategori_id', 'left')
            ->join('unit', 'unit.id = revisi.unit_id', 'left')
            ->where('revisi.user_id', $userId)
            ->orderBy('revisi.created_at', 'DESC')
            ->findAll();

        return view('admin/revisi/karyawan_index', $data);
    }
}
