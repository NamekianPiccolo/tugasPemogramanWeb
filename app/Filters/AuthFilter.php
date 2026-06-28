<?php
 
namespace App\Filters;
 
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
 
/**
 * Filter AuthFilter
 *
 * Middleware untuk memverifikasi status login pengguna.
 * Jika status sesi 'isLoggedIn' belum bernilai true, permohonan akses halaman akan dicegah
 * dan diarahkan kembali ke formulir login.
 */
class AuthFilter implements FilterInterface
{
    /**
     * Dijalankan SEBELUM request masuk ke controller terkait.
     * Digunakan untuk mengamankan route tertentu dari pengguna non-autentikasi.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Memeriksa jika variabel sesi login belum aktif
        if (!session()->get('isLoggedIn')) {
            // Mencegah request dan mengarahkan pengguna kembali ke halaman login utama dengan flash pesan error
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu');
        }
    }
 
    /**
     * Dijalankan SETELAH request selesai diproses oleh controller.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Dapat digunakan untuk logging setelah pemrosesan respons selesai jika diperlukan
    }
}
