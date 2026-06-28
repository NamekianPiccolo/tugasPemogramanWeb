<?php

namespace App\Controllers;

// Memuat model M_Admin untuk interaksi data administrator
use App\Models\M_Admin;

/**
 * Controller Admin
 *
 * Mengelola proses login, autentikasi sesi, dan tampilan dashboard
 * khusus untuk entitas Administrator (lama/legacy).
 */
class Admin extends BaseController
{
    /**
     * Menampilkan halaman formulir login Administrator.
     *
     * @return string View login admin
     */
    public function login()
    {
        return view('login');
    }

    /**
     * Menampilkan halaman dashboard dasar (uji coba).
     *
     * @return string View dashboard.php
     */
    public function dash()
    {
        return view("dashboard.php");
    }

    /**
     * Memproses autentikasi input login administrator.
     * Memeriksa username dan mencocokkan password terenkripsi.
     *
     * @return void/redirect Redirect ke dashboard jika sukses, atau kembali ke halaman sebelumnya jika gagal
     */
    public function autentikasi()
    {
        // Inisialisasi model administrator
        $modelAdmin = new M_Admin();
        
        // Mendapatkan data input dari form POST
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Memeriksa jumlah baris admin dengan username tersebut yang aktif (is_delete_admin = '0')
        $cekUsername = $modelAdmin->getDataAdmin([
            'username_admin' => $username,
            'is_delete_admin' => '0'
        ])->getNumRows();

        if ($cekUsername == 0) {
            // Jika username tidak ditemukan di database
            session()->setFlashdata('error', 'Username Tidak Ditemukan!');
            ?>
            <script>
                // Kembali ke halaman login sebelumnya
                history.go(-1);
            </script>
            <?php
        } else {
            // Mengambil satu baris data admin hasil query
            $dataUser = $modelAdmin->getDataAdmin([
                'username_admin' => $username,
                'is_delete_admin' => '0'
            ])->getRowArray();

            // Mendapatkan hash password dari database
            $passwordUser = $dataUser['password_admin'];

            // Memverifikasi apakah password input cocok dengan password terenkripsi di database
            $verifikasiPassword = password_verify($password, $passwordUser);

            if (!$verifikasiPassword) {
                // Jika password salah
                session()->setFlashdata('error', 'Password Tidak Sesuai!');
                ?>
                <script>
                    history.go(-1);
                </script>
                <?php
            } else {
                // Jika login sukses, buat data sesi (session)
                $dataSession = [
                    'ses_id'   => $dataUser['id_admin'],
                    'ses_user' => $dataUser['nama_admin'],
                    'ses_level'=> $dataUser['akses_level']
                ];

                // Menyimpan data sesi ke dalam session server
                session()->set($dataSession);
                session()->setFlashdata('success', 'Login Berhasil!');
                ?>
                <script>
                    // Mengarahkan ke halaman dashboard admin
                    document.location = "<?= base_url('admin/dashboard-admin');?>";
                </script>
                <?php
            }
        }
    }

    /**
     * Menampilkan halaman dashboard utama Administrator (Legacy).
     * Melakukan pengecekan apakah sesi pengguna telah aktif.
     *
     * @return string View dashboard atau script redirect ke halaman login
     */
    public function dashboard()
    {
        // Memeriksa apakah variabel sesi id, nama, dan level telah terisi
        if (session()->get('ses_id') == "" || session()->get('ses_user') == "" || session()->get('ses_level') == "") {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
            ?>
            <script>
                document.location = "<?= base_url('admin/login-admin');?>";
            </script>
            <?php
            return '';
        } else {
            // Memuat bagian template backend dashboard admin dan mengembalikannya sebagai string
            return view('Backend/Template/header')
                 . view('Backend/Template/sidebar')
                 . view('Backend/Login/dashboard_admin')
                 . view('Backend/Template/footer');
        }
    }
}