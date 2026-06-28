<?php
 
namespace App\Filters;
 
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
 
/**
 * Filter RoleFilter
 *
 * Middleware untuk memverifikasi hak akses (role) pengguna pada suatu route tertentu.
 * Memeriksa apakah role pengguna (admin/karyawan) tercantum dalam daftar role yang diperbolehkan mengakses halaman tersebut.
 */
class RoleFilter implements FilterInterface
{
    /**
     * Dijalankan SEBELUM request masuk ke controller.
     * Mengamankan route dari pengguna yang rolenya tidak diizinkan.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments Daftar role yang diizinkan (misal: ['admin'] atau ['karyawan'])
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Mendapatkan peran/role pengguna dari data sesi yang aktif
        $role = session()->get('role');
        
        // Mencegah akses jika data role tidak ditemukan pada sesi
        if (!$role) {
            return redirect()->to('/login')->with('error', 'Role tidak ditemukan');
        }
 
        // Memeriksa apakah data role saat ini terdaftar pada parameter argument role yang diperbolehkan
        if ($arguments && !in_array($role, $arguments)) {
            // Mencegah akses jika role pengguna tidak terdaftar di daftar parameter route
            return redirect()->to('/login')->with('error', 'Anda tidak memiliki akses ke halaman ini');
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
        // Dapat digunakan pasca pemrosesan respons
    }
}
