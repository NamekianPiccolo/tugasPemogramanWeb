<?php
 
namespace App\Controllers;
 
use App\Controllers\BaseController;
use App\Models\UserModel;
 
/**
 * Controller UserController
 *
 * Mengelola proses CRUD (Create, Read, Update, Delete) akun pengguna aplikasi (Karyawan & Admin),
 * serta mengurusi enkripsi password dan validasi input formulir (username unik, valid email, dll.).
 */
class UserController extends BaseController
{
    /**
     * Instance model UserModel.
     * 
     * @var UserModel
     */
    protected $userModel;
    protected $riwayatModel;
 
    /**
     * Konstruktor kelas. Menginisialisasi UserModel.
     */
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->riwayatModel = new \App\Models\RiwayatModel();
    }
 
    /**
     * Menampilkan daftar semua pengguna aplikasi.
     *
     * @return string Halaman indeks manajemen pengguna
     */
    public function index()
    {
        $data = [
            'title' => 'Manajemen User',
            'users' => $this->userModel->findAll()
        ];
        return view('admin/user/index', $data);
    }
 
    /**
     * Menampilkan formulir pendaftaran akun pengguna baru.
     *
     * @return string Halaman formulir tambah pengguna
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah User'
        ];
        return view('admin/user/create', $data);
    }
 
    /**
     * Menyimpan data pengguna baru ke database (POST).
     * Melakukan validasi input secara ketat (username unik, password minimal 6 karakter, dll.)
     * serta mengenkripsi password dengan password_hash() sebelum disimpan.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function store()
    {
        try {
            // Aturan validasi input pendaftaran pengguna baru
            $rules = [
                'username'     => 'required|min_length[3]|max_length[100]|is_unique[users.username]',
                'nama_lengkap' => 'required',
                'email'        => 'required|valid_email|is_unique[users.email]',
                'password'     => 'required|min_length[6]',
                'role'         => 'required'
            ];
    
            // Memvalidasi request input dengan aturan di atas
            if (!$this->validate($rules)) {
                // Jika validasi gagal, kembali ke form dengan pesan error dan input lama
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
    
            // Menyimpan akun pengguna baru ke database
            $this->userModel->save([
                'username'     => $this->request->getPost('username'),
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'email'        => $this->request->getPost('email'),
                // Mengenkripsi password dengan algoritma default PHP (Bcrypt/Argon2)
                'password'     => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'role'         => $this->request->getPost('role'),
            ]);

            // Mencatat log aktivitas
            $this->riwayatModel->save([
                'dokumen_id' => null,
                'user_id'    => session()->get('id'),
                'aksi'       => 'Tambah User',
                'keterangan' => 'User baru ditambahkan: ' . $this->request->getPost('username') . ' (' . $this->request->getPost('role') . ') oleh ' . session()->get('username')
            ]);
    
            return redirect()->to('/admin/user')->with('success', 'User berhasil ditambahkan');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
 
    /**
     * Menampilkan formulir edit profil akun pengguna.
     *
     * @param int $id ID pengguna
     * @return string|\CodeIgniter\HTTP\RedirectResponse Halaman edit user atau redirect jika data tidak ditemukan
     */
    public function edit($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('/admin/user')->with('error', 'User tidak ditemukan');
        }
 
        $data = [
            'title' => 'Edit User',
            'user'  => $user
        ];
        return view('admin/user/edit', $data);
    }
 
    /**
     * Memproses pembaruan profil akun pengguna (POST).
     * Melakukan validasi input dengan pengecualian ID pengguna saat ini pada aturan is_unique,
     * serta memproses enkripsi password baru jika diisi.
     *
     * @param int $id ID pengguna
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function update($id)
    {
        try {
            $user = $this->userModel->find($id);
            
            // Aturan validasi dengan ignore data milik user yang sedang diedit
            $rules = [
                'username'     => "required|min_length[3]|max_length[100]|is_unique[users.username,id,{$id}]",
                'nama_lengkap' => 'required',
                'email'        => "required|valid_email|is_unique[users.email,id,{$id}]",
                'role'         => 'required'
            ];
    
            // Memvalidasi data masukan
            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
    
            // Menyiapkan data yang akan diperbarui
            $updateData = [
                'id'           => $id,
                'username'     => $this->request->getPost('username'),
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'email'        => $this->request->getPost('email'),
                'role'         => $this->request->getPost('role'),
            ];
    
            // Memperbarui password hanya jika input password diisi oleh admin/user
            if ($this->request->getPost('password')) {
                $updateData['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            }
    
            // Menyimpan pembaruan data pengguna
            $this->userModel->save($updateData);

            // Mencatat log aktivitas
            $this->riwayatModel->save([
                'dokumen_id' => null,
                'user_id'    => session()->get('id'),
                'aksi'       => 'Edit User',
                'keterangan' => 'User ' . $this->request->getPost('username') . ' (' . $this->request->getPost('role') . ') diperbarui oleh ' . session()->get('username')
            ]);
    
            return redirect()->to('/admin/user')->with('success', 'User berhasil diperbarui');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
 
    /**
     * Menghapus akun pengguna dari database berdasarkan ID secara permanen.
     *
     * @param int $id ID pengguna
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function delete($id)
    {
        try {
            $targetUser = $this->userModel->find($id);
            $targetUsername = $targetUser ? $targetUser['username'] : 'ID: ' . $id;

            // Menghapus data akun pengguna
            $this->userModel->delete($id);

            // Mencatat log aktivitas
            $this->riwayatModel->save([
                'dokumen_id' => null,
                'user_id'    => session()->get('id'),
                'aksi'       => 'Hapus User',
                'keterangan' => 'User ' . $targetUsername . ' dihapus oleh ' . session()->get('username')
            ]);

            return redirect()->to('/admin/user')->with('success', 'User berhasil dihapus');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
