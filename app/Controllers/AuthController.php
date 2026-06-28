<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

/**
 * Controller AuthController
 *
 * Mengelola alur autentikasi pengguna secara umum (baik Admin maupun Karyawan),
 * meliputi penampilan form login, pemrosesan validasi login, dan penghapusan sesi (logout).
 */
class AuthController extends BaseController
{
    /**
     * Menampilkan halaman login utama.
     * Jika pengguna sudah login sebelumnya, otomatis diarahkan ke dashboard masing-masing role.
     *
     * @return string|\CodeIgniter\HTTP\RedirectResponse View login atau redirect response
     */
    public function index()
    {
        // Memeriksa apakah status sesi login sudah aktif
        if (session()->get('isLoggedIn')) {
            // Mengarahkan ke dashboard yang sesuai dengan role pengguna
            $redirectPath = (session()->get('role') === 'admin') ? '/admin/dashboard' : '/karyawan/dashboard';
            return redirect()->to($redirectPath);
        }
        
        // Jika belum login, tampilkan view login
        return view("auth/login");
    }

    /**
     * Memproses data formulir login (POST).
     * Memvalidasi keberadaan username dan kesesuaian password pengguna.
     *
     * @return ResponseInterface Redirect response ke dashboard jika sukses, atau kembali ke login jika gagal
     */
    public function process()
    {
        $loginType = null;
        try {
            // Inisialisasi model pengguna
            $users = new UserModel();
            
            // Mendapatkan input dari data POST
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $loginType = $this->request->getPost('login_type');
            
            // Mencari data pengguna berdasarkan username di database
            $dataUser = $users->where('username', $username)->first();
    
            if ($dataUser) {
                // Memverifikasi kesesuaian password input dengan password terenkripsi di database
                if (password_verify($password, $dataUser['password'])) {
                    // Menyimpan informasi pengguna yang berhasil login ke dalam sesi (session)
                    session()->set([
                        'id'           => $dataUser['id'],
                        'username'     => $dataUser['username'],
                        'nama_lengkap' => $dataUser['nama_lengkap'],
                        'email'        => $dataUser['email'],
                        'role'         => $dataUser['role'],
                        'isLoggedIn'   => true
                    ]);
                    
                    // Menentukan alamat redirect berdasarkan role pengguna
                    $redirectPath = ($dataUser['role'] === 'admin') ? '/admin/dashboard' : '/karyawan/dashboard';
                    return redirect()->to($redirectPath);
                } else {
                    // Jika password tidak cocok
                    session()->setFlashdata('login_type', $loginType);
                    session()->setFlashdata('error', 'Password salah');
                    return redirect()->back();
                }
            } else {
                // Jika username tidak ditemukan
                session()->setFlashdata('login_type', $loginType);
                session()->setFlashdata('error', 'Username tidak ditemukan');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            // Menangkap kesalahan tak terduga dalam sistem
            session()->setFlashdata('login_type', $loginType);
            session()->setFlashdata('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Menghancurkan sesi pengguna (logout) dan mengarahkan kembali ke halaman utama.
     *
     * @return ResponseInterface Redirect response ke halaman utama
     */
    public function logout()
    {
        // Menghancurkan seluruh variabel sesi yang aktif
        session()->destroy();
        
        // Mengarahkan kembali ke halaman root (login)
        return redirect()->to('/');
    }
}
