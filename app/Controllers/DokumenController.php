<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DokumenModel;
use App\Models\KategoriModel;
use App\Models\UnitModel;
use App\Models\RiwayatModel;

/**
 * Controller DokumenController
 *
 * Mengelola proses CRUD dokumen digital (unggah file PDF/DOC, perbarui berkas, hapus dokumen fisik,
 * pengelompokan berdasarkan kategori/unit), serta menampilkan data dokumen untuk Admin maupun Karyawan.
 */
class DokumenController extends BaseController
{
    /**
     * Instance model DokumenModel.
     * 
     * @var DokumenModel
     */
    protected $dokumenModel;

    /**
     * Instance model KategoriModel.
     * 
     * @var KategoriModel
     */
    protected $kategoriModel;

    /**
     * Instance model UnitModel.
     * 
     * @var UnitModel
     */
    protected $unitModel;

    /**
     * Instance model RiwayatModel untuk log audit trail.
     * 
     * @var RiwayatModel
     */
    protected $riwayatModel;

    /**
     * Konstruktor kelas. Menginisialisasi semua model yang digunakan untuk manajemen dokumen.
     */
    public function __construct()
    {
        $this->dokumenModel = new DokumenModel();
        $this->kategoriModel = new KategoriModel();
        $this->unitModel = new UnitModel();
        $this->riwayatModel = new RiwayatModel();
    }

    /**
     * Menampilkan daftar semua dokumen digital untuk Administrator.
     * Menggabungkan informasi nama kategori dan unit kerja.
     *
     * @return string Halaman explorer dokumen admin
     */
    public function index()
    {
        // Mengambil semua dokumen dengan join ke kategori dan unit
        $data['dokumen'] = $this->dokumenModel
            ->select('dokumen.*, kategori.nama_kategori, unit.nama_unit')
            ->join('kategori', 'kategori.id = dokumen.kategori_id', 'left')
            ->join('unit', 'unit.id = dokumen.unit_id', 'left')
            ->findAll();
        return view('admin/dokumen/index', $data);
    }

    /**
     * Menampilkan formulir unggah dokumen baru.
     * Menyediakan pilihan kategori dan unit kerja yang aktif.
     *
     * @return string Halaman formulir tambah dokumen
     */
    public function create()
    {
        $data['kategori'] = $this->kategoriModel->findAll();
        $data['unit'] = $this->unitModel->findAll();
        return view('admin/dokumen/create', $data);
    }

    /**
     * Memproses unggahan file dokumen baru dan menyimpan informasi meta data ke database.
     * Serta mencatat log aktivitas 'Upload Dokumen'.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function store()
    {
        try {
            // Mengambil input berkas file_dokumen
            $file = $this->request->getFile('file_dokumen');
            $fileName = '';

            // Memvalidasi apakah file yang diunggah valid dan belum dipindahkan
            if ($file && $file->isValid() && ! $file->hasMoved()) {
                // Menghasilkan nama acak (random name) untuk keamanan file di server
                $fileName = $file->getRandomName();
                // Memindahkan file fisik ke direktori public/uploads/
                $file->move(FCPATH . 'uploads', $fileName);
            }

            // Menyimpan entri data dokumen baru
            $this->dokumenModel->insert([
                'judul'        => $this->request->getPost('judul'),
                'deskripsi'    => $this->request->getPost('deskripsi'),
                'tanggal'      => $this->request->getPost('tanggal'),
                'kategori_id'  => $this->request->getPost('kategori_id'),
                'unit_id'      => $this->request->getPost('unit_id'),
                'file_dokumen' => $fileName
            ]);

            // Mendapatkan ID dokumen yang baru saja diinsert
            $dokumenId = $this->dokumenModel->getInsertID();

            // Mencatat log aktivitas unggah berkas
            $this->riwayatModel->save([
                'dokumen_id' => $dokumenId,
                'user_id'    => session()->get('id'),
                'aksi'       => 'Upload Dokumen',
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

    /**
     * Menampilkan formulir edit dokumen untuk mengubah berkas atau metadata terkait.
     *
     * @param int $id ID dokumen
     * @return string Halaman formulir edit dokumen
     */
    public function edit($id)
    {
        $data['dokumen'] = $this->dokumenModel->find($id);
        $data['kategori'] = $this->kategoriModel->findAll();
        $data['unit'] = $this->unitModel->findAll();
        return view('admin/dokumen/edit', $data);
    }

    /**
     * Memproses pembaruan metadata dokumen dan berkas fisik (jika ada file baru yang diunggah).
     * Jika file baru diunggah, file lama akan dihapus dari server (unlink).
     *
     * @param int $id ID dokumen
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function update($id)
    {
        try {
            // Mencari data dokumen lama
            $dokumenLama = $this->dokumenModel->find($id);
            $file = $this->request->getFile('file_dokumen');
            $fileName = $dokumenLama['file_dokumen'];

            // Jika ada berkas baru yang diunggah oleh pengguna
            if ($file && $file->isValid() && ! $file->hasMoved()) {
                $fileName = $file->getRandomName();
                $file->move(FCPATH . 'uploads', $fileName);

                // Menghapus file fisik lama di folder uploads agar tidak membebani ruang server
                if (!empty($dokumenLama['file_dokumen']) && file_exists(FCPATH . 'uploads/' . $dokumenLama['file_dokumen'])) {
                    unlink(FCPATH . 'uploads/' . $dokumenLama['file_dokumen']);
                }
            }

            // Memperbarui data dokumen di database
            $this->dokumenModel->update($id, [
                'judul'        => $this->request->getPost('judul'),
                'deskripsi'    => $this->request->getPost('deskripsi'),
                'tanggal'      => $this->request->getPost('tanggal'),
                'kategori_id'  => $this->request->getPost('kategori_id'),
                'unit_id'      => $this->request->getPost('unit_id'),
                'file_dokumen' => $fileName
            ]);

            // Mencatat log aktivitas pembaruan dokumen
            $this->riwayatModel->save([
                'dokumen_id' => $id,
                'user_id'    => session()->get('id'),
                'aksi'       => 'Edit Dokumen',
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

    /**
     * Menghapus secara permanen dokumen dari database beserta file fisiknya dari folder uploads.
     * Serta mencatat aktivitas log 'Hapus Dokumen'.
     *
     * @param int $id ID dokumen
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function delete($id)
    {
        try {
            $dokumen = $this->dokumenModel->find($id);

            if ($dokumen) {
                // Mencatat log sebelum data dihapus secara permanen dari database
                $this->riwayatModel->save([
                    'dokumen_id' => $id,
                    'user_id'    => session()->get('id'),
                    'aksi'       => 'Hapus Dokumen',
                    'keterangan' => 'Dokumen "' . $dokumen['judul'] . '" dihapus secara permanen.'
                ]);

                // Menghapus file fisik dari direktori server
                if (!empty($dokumen['file_dokumen']) && file_exists(FCPATH . 'uploads/' . $dokumen['file_dokumen'])) {
                    unlink(FCPATH . 'uploads/' . $dokumen['file_dokumen']);
                }

                // Menghapus record data dokumen dari database
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

    /**
     * Menampilkan daftar dokumen khusus untuk Karyawan.
     * Menyertakan data perizinan akses (izin) dan status distribusi (peminjaman aktif) dari karyawan yang login,
     * serta status ketersediaan dokumen secara global (sedang dipinjam oleh user lain atau tidak).
     *
     * @return string Halaman explorer dokumen karyawan
     */
    public function karyawan_index()
    {
        $userId = session()->get('id');

        $data['dokumen'] = $this->dokumenModel
            ->select('dokumen.*, kategori.nama_kategori, unit.nama_unit, izin.status_izin, izin.pesan as izin_pesan, izin.pesan_admin as izin_pesan_admin, izin.tgl_pengajuan as izin_tgl, distribusi.status as status_distribusi, distribusi.tanggal_pinjam as distribusi_tanggal_pinjam, distribusi.tanggal_kembali as distribusi_tanggal_kembali, 
                      (SELECT COUNT(id) FROM distribusi as d2 WHERE d2.dokumen_id = dokumen.id AND d2.status != \'Dikembalikan\') as sedang_dipinjam_global,
                      (SELECT status_revisi FROM revisi as r2 WHERE r2.dokumen_id = dokumen.id AND r2.user_id = ' . $userId . ' ORDER BY r2.created_at DESC LIMIT 1) as status_revisi_terakhir,
                      (SELECT pesan_admin FROM revisi as r3 WHERE r3.dokumen_id = dokumen.id AND r3.user_id = ' . $userId . ' ORDER BY r3.created_at DESC LIMIT 1) as pesan_revisi_admin_terakhir')
            ->join('kategori', 'kategori.id = dokumen.kategori_id', 'left')
            ->join('unit', 'unit.id = dokumen.unit_id', 'left')
            ->join('izin', "izin.dokumen_id = dokumen.id AND izin.user_id = $userId", 'left')
            ->join('distribusi', "distribusi.id = (SELECT MAX(d_sub.id) FROM distribusi d_sub WHERE d_sub.dokumen_id = dokumen.id AND d_sub.user_id = $userId AND d_sub.status != 'Dikembalikan')", 'left')
            ->findAll();

        return view('admin/dokumen/index', $data);
    }
}
