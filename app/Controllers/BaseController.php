<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController menyediakan wadah terpusat untuk memuat komponen
 * dan menjalankan fungsi-fungsi dasar yang dibutuhkan oleh seluruh controller di aplikasi.
 *
 * Kelas ini diwarisi oleh controller lain:
 * ```
 *     class Home extends BaseController
 * ```
 *
 * Demi keamanan, pastikan metode baru dideklarasikan sebagai protected atau private.
 */
abstract class BaseController extends Controller
{
    /**
     * Menampung helper yang akan dimuat secara otomatis.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Menginisialisasi controller utama.
     * Mengatur request, response, dan sistem logger bawaan CodeIgniter.
     *
     * @param RequestInterface  $request  Objek HTTP Request
     * @param ResponseInterface $response Objek HTTP Response
     * @param LoggerInterface   $logger   Objek Logger
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Pemuatan helper form dan url secara bawaan untuk mempermudah pengerjaan form
        $this->helpers = ['form', 'url'];

        // Memanggil initController milik parent class (Controller dasar CodeIgniter)
        parent::initController($request, $response, $logger);

        // Contoh inisialisasi service sesi jika diperlukan secara global
        // $this->session = \Config\Services::session();
    }
}
