<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Controller HomeController
 *
 * Mengelola pemuatan halaman beranda (landing page/public page)
 * serta contoh metode pembelajaran segmen URL (routing segment).
 */
class HomeController extends BaseController
{
    /**
     * Menampilkan halaman utama website / beranda publik.
     *
     * @return string View home
     */
    public function index()
    {
        return view("home");
    }

    /**
     * Contoh fungsi demonstrasi untuk menangkap parameter dari segmen URL.
     * Digunakan dalam proses pembelajaran framework CodeIgniter 4.
     *
     * @param string $nama Segmen nama mahasiswa
     * @param string $nim Segmen NIM mahasiswa
     * @param string $kelas Segmen kelas mahasiswa
     * @return string View segment_view beserta variabel data
     */
    public function belajar_segment($nama, $nim, $kelas)
    {
        // Menyusun parameter URL ke dalam array data untuk dikirim ke view
        $data['nama'] = $nama;
        $data['nim'] = $nim;
        $data['kelas'] = $kelas;
        
        // Memuat view segment_view
        return view('segment_view', $data);
    }
}

