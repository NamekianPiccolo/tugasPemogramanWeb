<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DistribusiModel;
use App\Models\DokumenModel;
use App\Models\UserModel;

/**
 * Controller DistribusiController
 *
 * Mengelola proses pencatatan distribusi dokumen (transaksi peminjaman dokumen fisik/digital)
 * kepada para karyawan, termasuk pengelolaan data peminjaman, status pengembalian, dan pencatatan riwayat audit trail.
 */
class DistribusiController extends BaseController
{
    /**
     * Instance model DistribusiModel.
     * 
     * @var DistribusiModel
     */
    protected $distribusiModel;

    /**
     * Instance model DokumenModel.
     * 
     * @var DokumenModel
     */
    protected $dokumenModel;

    /**
     * Instance model UserModel.
     * 
     * @var UserModel
     */
    protected $userModel;

    /**
     * Instance model RiwayatModel untuk pencatatan log aktivitas.
     * 
     * @var \App\Models\RiwayatModel
     */
    protected $riwayatModel;

    /**
     * Konstruktor kelas. Menginisialisasi semua model yang dibutuhkan untuk manajemen distribusi.
     */
    public function __construct()
    {
        $this->distribusiModel = new DistribusiModel();
        $this->dokumenModel = new DokumenModel();
        $this->userModel = new UserModel();
        $this->riwayatModel = new \App\Models\RiwayatModel();
    }

    /**
     * Menampilkan daftar transaksi distribusi/peminjaman dokumen.
     * Melakukan join dengan tabel dokumen dan users untuk menyusun informasi lengkap.
     *
     * @return string Halaman indeks distribusi dokumen
     */
    public function index()
    {
        // Mengambil semua data distribusi digabung dengan judul dokumen dan nama lengkap peminjam
        $data['distribusi'] = $this->distribusiModel
            ->select('distribusi.*, dokumen.judul, users.nama_lengkap as peminjam_nama')
            ->join('dokumen', 'dokumen.id = distribusi.dokumen_id', 'left')
            ->join('users', 'users.id = distribusi.user_id', 'left')
            ->findAll();
        
        $data['title'] = 'Data Distribusi Dokumen';
        return view('admin/distribusi/index', $data);
    }

    /**
     * Menampilkan formulir pendaftaran transaksi distribusi baru.
     * Menyediakan pilihan dokumen terdaftar dan daftar karyawan penerima/peminjam.
     *
     * @return string Halaman formulir tambah distribusi
     */
    public function create()
    {
        // Mengambil daftar dokumen dan user dengan role 'karyawan'
        $data['dokumen'] = $this->dokumenModel->findAll();
        $data['users'] = $this->userModel->where('role', 'karyawan')->findAll();
        // Mendapatkan default dokumen yang dipilih melalui query parameter (jika diakses dari tombol pinjam di explorer)
        $data['selected_dokumen'] = $this->request->getGet('dokumen');
        $data['title'] = 'Tambah Distribusi Dokumen';
        return view('admin/distribusi/create', $data);
    }

    /**
     * Menyimpan transaksi distribusi dokumen baru ke database.
     * Serta mencatat riwayat peminjaman dokumen tersebut ke tabel riwayat aktivitas.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function store()
    {
        try {
            $dokumenId = $this->request->getPost('dokumen_id');
            $userId = $this->request->getPost('user_id');
            $tanggalPinjam = $this->request->getPost('tanggal_pinjam');
            $tanggalKembali = $this->request->getPost('tanggal_kembali');
            $status = $this->request->getPost('status');
            $today = date('Y-m-d');

            if ($tanggalPinjam !== $today) {
                session()->setFlashdata('error', 'Tanggal pinjam harus hari ini (' . date('d-m-Y') . ').');
                return redirect()->back()->withInput();
            }

            if (!empty($tanggalKembali) && $tanggalKembali < $tanggalPinjam) {
                session()->setFlashdata('error', 'Tanggal pengembalian harus sama dengan atau setelah tanggal pinjam.');
                return redirect()->back()->withInput();
            }

            if ($status !== 'Dipinjam') {
                session()->setFlashdata('error', 'Status distribusi harus "Dipinjam".');
                return redirect()->back()->withInput();
            }

            // Cek apakah karyawan sudah meminjam dokumen ini dan belum dikembalikan
            $alreadyBorrowed = $this->distribusiModel->where([
                'dokumen_id' => $dokumenId,
                'user_id'    => $userId,
                'status !='  => 'Dikembalikan'
            ])->first();

            if ($alreadyBorrowed) {
                session()->setFlashdata('error', 'Karyawan ini sudah meminjam dokumen tersebut.');
                return redirect()->back()->withInput();
            }
            // Tutup distribusi lama yang belum dikembalikan untuk user dan dokumen ini
            $oldActive = $this->distribusiModel->where([
                'dokumen_id' => $dokumenId,
                'user_id'    => $userId,
                'status !='  => 'Dikembalikan'
            ])->findAll();
            foreach ($oldActive as $oa) {
                $this->distribusiModel->update($oa['id'], ['status' => 'Dikembalikan']);
            }

            // Menyimpan entri baru distribusi
            $this->distribusiModel->save([
                'dokumen_id'      => $dokumenId,
                'user_id'         => $userId,
                'tanggal_pinjam'  => $tanggalPinjam,
                'tanggal_kembali' => $tanggalKembali ?: null,
                'status'          => $status
            ]);

            // Otomatis buat / setujui izin akses dokumen untuk user bersangkutan
            $izinModel = new \App\Models\IzinModel();
            $existingIzin = $izinModel->where([
                'user_id'    => $userId,
                'dokumen_id' => $dokumenId
            ])->first();

            if ($existingIzin) {
                $izinModel->update($existingIzin['id'], [
                    'status_izin'   => 'Disetujui',
                    'pesan'         => $existingIzin['pesan'] ?: 'Langsung diizinkan admin',
                    'pesan_admin'   => 'Langsung diizinkan admin',
                    'tgl_pengajuan' => date('Y-m-d H:i:s')
                ]);
            } else {
                $izinModel->save([
                    'user_id'       => $userId,
                    'dokumen_id'    => $dokumenId,
                    'pesan'         => 'Langsung diizinkan admin',
                    'status_izin'   => 'Disetujui',
                    'tgl_pengajuan' => date('Y-m-d H:i:s'),
                    'pesan_admin'   => 'Langsung diizinkan admin'
                ]);
            }
            
            // Mencatat aktivitas peminjaman/distribusi ke log riwayat sistem
            $this->riwayatModel->save([
                'dokumen_id' => $dokumenId,
                'user_id'    => session()->get('id'), // ID Admin pembuat transaksi
                'aksi'       => 'Distribusi Dokumen',
                'keterangan' => 'Dokumen dipinjamkan/didistribusikan ke user ID: ' . $userId
            ]);

            session()->setFlashdata('success', 'Data distribusi/peminjaman berhasil ditambahkan.');
            $role = session()->get('role');
            return redirect()->to("/$role/distribusi");
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Menampilkan formulir edit untuk memperbarui detail peminjaman/distribusi.
     *
     * @param int $id ID transaksi distribusi
     * @return string Halaman edit distribusi
     */
    public function edit($id)
    {
        $data['distribusi'] = $this->distribusiModel->find($id);
        $data['dokumen'] = $this->dokumenModel->findAll();
        $data['users'] = $this->userModel->where('role', 'karyawan')->findAll();
        $data['title'] = 'Edit Distribusi Dokumen';
        return view('admin/distribusi/edit', $data);
    }

    /**
     * Memperbarui detail data transaksi distribusi dokumen.
     * Serta mencatat perubahan data/status (misal: 'Dikembalikan') ke riwayat aktivitas.
     *
     * @param int $id ID transaksi distribusi
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function update($id)
    {
        try {
            $dokumenId = $this->request->getPost('dokumen_id');
            $status = $this->request->getPost('status');

            // Memperbarui record distribusi
            $this->distribusiModel->update($id, [
                'dokumen_id'      => $dokumenId,
                'user_id'         => $this->request->getPost('user_id'),
                'tanggal_pinjam'  => $this->request->getPost('tanggal_pinjam'),
                'tanggal_kembali' => $this->request->getPost('tanggal_kembali'),
                'status'          => $status
            ]);

            // Mencatat log perubahan status peminjaman dokumen ke riwayat
            $this->riwayatModel->save([
                'dokumen_id' => $dokumenId,
                'user_id'    => session()->get('id'), 
                'aksi'       => 'Update Distribusi',
                'keterangan' => 'Status peminjaman diubah menjadi: ' . $status
            ]);
            
            session()->setFlashdata('success', 'Data distribusi berhasil diubah.');
            $role = session()->get('role');
            return redirect()->to("/$role/distribusi");
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Menghapus catatan transaksi distribusi dari database secara permanen.
     *
     * @param int $id ID transaksi distribusi
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function delete($id)
    {
        try {
            // Menghapus data transaksi
            $this->distribusiModel->delete($id);
            session()->setFlashdata('success', 'Data distribusi berhasil dihapus.');
            $role = session()->get('role');
            return redirect()->to("/$role/distribusi");
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Memproses pengembalian dokumen oleh Karyawan tanpa melakukan pengajuan revisi.
     * Mengubah status peminjaman distribusi aktif menjadi 'Dikembalikan'
     * dan status izin akses aktif menjadi 'Selesai', serta mencatat log audit trail.
     *
     * @param int $dokumenId ID dokumen yang dikembalikan
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function kembalikan_karyawan($dokumenId)
    {
        try {
            $userId = session()->get('id');
            
            // 1. Ubah status peminjaman distribusi aktif menjadi 'Dikembalikan'
            $activeDistribusi = $this->distribusiModel->where('dokumen_id', $dokumenId)
                                                ->where('user_id', $userId)
                                                ->where('status !=', 'Dikembalikan')
                                                ->first();
            if ($activeDistribusi) {
                $this->distribusiModel->update($activeDistribusi['id'], ['status' => 'Dikembalikan']);
            }

            // 2. Ubah status izin aktif dari 'Disetujui' menjadi 'Selesai'
            $izinModel = new \App\Models\IzinModel();
            $activeIzin = $izinModel->where('dokumen_id', $dokumenId)
                                    ->where('user_id', $userId)
                                    ->where('status_izin', 'Disetujui')
                                    ->first();
            if ($activeIzin) {
                $izinModel->update($activeIzin['id'], ['status_izin' => 'Selesai']);
            }

            // 3. Jika usulan revisi terakhir ditolak, ubah status revisi tersebut menjadi 'Selesai'
            // agar dokumen kembali terkunci (dianggap selesai proses revisinya oleh karyawan)
            $revisiModel = new \App\Models\RevisiModel();
            $latestRevisi = $revisiModel->where('dokumen_id', $dokumenId)
                                        ->where('user_id', $userId)
                                        ->orderBy('created_at', 'DESC')
                                        ->first();
            if ($latestRevisi && $latestRevisi['status_revisi'] === 'Ditolak') {
                $revisiModel->update($latestRevisi['id'], ['status_revisi' => 'Selesai']);
            }
            
            // 4. Catat log riwayat aktivitas pengembalian
            $this->riwayatModel->save([
                'dokumen_id' => $dokumenId,
                'user_id'    => $userId,
                'aksi'       => 'Kembalikan Dokumen',
                'keterangan' => 'Karyawan ' . session()->get('username') . ' mengembalikan dokumen tanpa usulan revisi'
            ]);

            session()->setFlashdata('success', 'Dokumen berhasil dikembalikan.');
            return redirect()->to('/karyawan/dokumen');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
