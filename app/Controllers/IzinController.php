<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\IzinModel;

/**
 * Controller IzinController
 *
 * Mengelola proses permohonan izin akses dokumen oleh karyawan serta
 * persetujuan/penolakan izin akses tersebut oleh administrator.
 */
class IzinController extends BaseController
{
    /**
     * Instance model IzinModel.
     * 
     * @var IzinModel
     */
    protected $izinModel;
    protected $riwayatModel;

    /**
     * Konstruktor kelas. Menginisialisasi model IzinModel.
     */
    public function __construct()
    {
        $this->izinModel = new IzinModel();
        $this->riwayatModel = new \App\Models\RiwayatModel();
    }

    /**
     * Menampilkan daftar permohonan izin akses dokumen milik karyawan yang sedang login.
     *
     * @return string Halaman indeks izin akses karyawan
     */
    public function index()
    {
        $data['title'] = 'Izin Akses Dokumen';

        // Mengambil semua riwayat izin akses milik karyawan bersangkutan
        $data['izin'] = $this->izinModel
            ->select('izin.*, dokumen.judul')
            ->join('dokumen', 'dokumen.id = izin.dokumen_id', 'left')
            ->where('user_id', session()->get('id'))
            ->findAll();

        return view('admin/izin/karyawan_index', $data);
    }

    /**
     * Menampilkan formulir pengajuan izin akses dokumen bagi karyawan.
     *
     * @return string Halaman formulir pengajuan izin
     */
    public function create()
    {
        $dokumenModel = new \App\Models\DokumenModel();
        $data['title'] = 'Ajukan Izin Akses';
        $data['dokumen'] = $dokumenModel->findAll();

        return view('admin/izin/create', $data);
    }

    /**
     * Memproses penyimpanan pengajuan izin akses baru (POST).
     * Melakukan pengecekan untuk menghindari duplikasi pengajuan yang masih aktif (Pending/Disetujui).
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function store()
    {
        try {
            $userId = session()->get('id');
            $dokumenId = $this->request->getPost('dokumen_id');

            // Cek apakah sudah ada pengajuan izin akses sebelumnya
            $existing = $this->izinModel->where([
                'user_id'    => $userId,
                'dokumen_id' => $dokumenId
            ])->first();

            if ($existing) {
                $isExpired = false;
                if ($existing['status_izin'] === 'Disetujui') {
                    $distribusiModel = new \App\Models\DistribusiModel();
                    $activeDist = $distribusiModel->where([
                        'dokumen_id' => $dokumenId,
                        'user_id'    => $userId,
                        'status'     => 'Dipinjam'
                    ])->first();
                    if ($activeDist && !empty($activeDist['tanggal_kembali']) && $activeDist['tanggal_kembali'] < date('Y-m-d')) {
                        $isExpired = true;
                    }
                }

                if (($existing['status_izin'] === 'Pending' || $existing['status_izin'] === 'Disetujui') && !$isExpired) {
                    // Memberitahu user jika sudah ada pengajuan aktif
                    session()->setFlashdata('error', 'Anda sudah memiliki pengajuan untuk dokumen ini yang sedang diproses atau sudah disetujui.');
                    return redirect()->back();
                } else {
                    // Jika berstatus ditolak atau kedaluwarsa, update kembali record tersebut menjadi 'Pending'
                    $this->izinModel->update($existing['id'], [
                        'pesan'         => $this->request->getPost('pesan'),
                        'status_izin'   => 'Pending',
                        'pesan_admin'   => null, // Reset catatan alasan penolakan sebelumnya
                        'tgl_pengajuan' => date('Y-m-d H:i:s')
                    ]);
                }
            } else {
                // Menyimpan pengajuan izin baru ke database
                $this->izinModel->save([
                    'user_id'       => $userId,
                    'dokumen_id'    => $dokumenId,
                    'pesan'         => $this->request->getPost('pesan'),
                    'status_izin'   => 'Pending',
                    'pesan_admin'   => null,
                    'tgl_pengajuan' => date('Y-m-d H:i:s')
                ]);
            }

            // Mengambil judul dokumen untuk dimasukkan ke riwayat
            $docModel = new \App\Models\DokumenModel();
            $doc = $docModel->find($dokumenId);
            $docTitle = $doc ? $doc['judul'] : 'ID: ' . $dokumenId;

            // Mencatat log aktivitas
            $this->riwayatModel->save([
                'dokumen_id' => $dokumenId,
                'user_id'    => $userId,
                'aksi'       => 'Ajukan Izin',
                'keterangan' => 'Mengajukan permohonan izin akses untuk dokumen "' . $docTitle . '" oleh ' . session()->get('username')
            ]);

            session()->setFlashdata('success', 'Pengajuan izin berhasil dikirim.');
            return redirect()->to('/karyawan/izin');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Menampilkan halaman manajemen persetujuan izin akses untuk Administrator.
     *
     * @return string Halaman indeks persetujuan izin oleh admin
     */
    public function admin_index()
    {
        $data['title'] = 'Manajemen Persetujuan Izin';

        // Mengambil seluruh pengajuan izin akses yang diajukan oleh karyawan
        $data['izin'] = $this->izinModel
            ->select('izin.*, dokumen.judul, users.nama_lengkap')
            ->join('dokumen', 'dokumen.id = izin.dokumen_id', 'left')
            ->join('users', 'users.id = izin.user_id', 'left')
            ->orderBy('izin.created_at', 'DESC')
            ->findAll();

        return view('admin/izin/index', $data);
    }

    public function approve($id)
    {
        try {
            // Mengambil info izin untuk detail log
            $izin = $this->izinModel
                ->select('izin.*, dokumen.judul, users.username')
                ->join('dokumen', 'dokumen.id = izin.dokumen_id', 'left')
                ->join('users', 'users.id = izin.user_id', 'left')
                ->find($id);

            // Membaca input tanggal dari form POST
            $tanggalPinjam = $this->request->getPost('tanggal_pinjam');
            $tanggalKembali = $this->request->getPost('tanggal_kembali');

            if (empty($tanggalPinjam)) {
                session()->setFlashdata('error', 'Tanggal pinjam wajib diisi.');
                return redirect()->back();
            }
            if (empty($tanggalKembali)) {
                session()->setFlashdata('error', 'Tanggal kembali wajib diisi.');
                return redirect()->back();
            }

            $today = date('Y-m-d');
            if ($tanggalPinjam < $today) {
                session()->setFlashdata('error', 'Tanggal pinjam tidak boleh kurang dari hari ini.');
                return redirect()->back();
            }
            if ($tanggalKembali < $tanggalPinjam) {
                session()->setFlashdata('error', 'Tanggal kembali tidak boleh kurang dari tanggal pinjam.');
                return redirect()->back();
            }

            // Mengubah status izin menjadi 'Disetujui'
            $this->izinModel->update($id, ['status_izin' => 'Disetujui']);

            $distribusiModel = new \App\Models\DistribusiModel();

            // Tutup distribusi lama yang belum dikembalikan untuk user dan dokumen ini
            $oldActive = $distribusiModel->where([
                'dokumen_id' => $izin['dokumen_id'],
                'user_id'    => $izin['user_id'],
                'status !='  => 'Dikembalikan'
            ])->findAll();
            foreach ($oldActive as $oa) {
                $distribusiModel->update($oa['id'], ['status' => 'Dikembalikan']);
            }

            // Membuat data ke tabel distribusi secara otomatis
            $distribusiModel->save([
                'dokumen_id'      => $izin['dokumen_id'],
                'user_id'         => $izin['user_id'],
                'tanggal_pinjam'  => $tanggalPinjam,
                'tanggal_kembali' => !empty($tanggalKembali) ? $tanggalKembali : null,
                'status'          => 'Dipinjam'
            ]);

            // Mencatat log aktivitas
            $this->riwayatModel->save([
                'dokumen_id' => $izin ? $izin['dokumen_id'] : null,
                'user_id'    => session()->get('id'), // Pelaku aksi (admin)
                'aksi'       => 'Setujui Izin',
                'keterangan' => 'Menyetujui izin akses dokumen "' . ($izin['judul'] ?? 'Dihapus') . '" untuk karyawan ' . ($izin['username'] ?? 'Dihapus') . ' oleh ' . session()->get('username')
            ]);

            session()->setFlashdata('success', 'Izin berhasil disetujui.');
            return redirect()->to('/admin/izin');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function reject($id)
    {
        try {
            $pesanAdmin = $this->request->getPost('pesan_admin');
            
            // Mengambil info izin untuk detail log
            $izin = $this->izinModel
                ->select('izin.*, dokumen.judul, users.username')
                ->join('dokumen', 'dokumen.id = izin.dokumen_id', 'left')
                ->join('users', 'users.id = izin.user_id', 'left')
                ->find($id);

            // Mengubah status izin menjadi 'Ditolak' dengan alasan penolakan
            $this->izinModel->update($id, [
                'status_izin' => 'Ditolak',
                'pesan_admin' => $pesanAdmin ?: 'Permohonan ditolak oleh Administrator.'
            ]);

            // Mencatat log aktivitas
            $this->riwayatModel->save([
                'dokumen_id' => $izin ? $izin['dokumen_id'] : null,
                'user_id'    => session()->get('id'), // Pelaku aksi (admin)
                'aksi'       => 'Tolak Izin',
                'keterangan' => 'Menolak izin akses dokumen "' . ($izin['judul'] ?? 'Dihapus') . '" untuk karyawan ' . ($izin['username'] ?? 'Dihapus') . ' dengan alasan: "' . ($pesanAdmin ?: 'Ditolak administrator.') . '" oleh ' . session()->get('username')
            ]);

            session()->setFlashdata('success', 'Izin telah ditolak.');
            return redirect()->to('/admin/izin');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
