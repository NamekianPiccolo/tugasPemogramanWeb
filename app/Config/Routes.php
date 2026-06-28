<?php
 
use CodeIgniter\Router\RouteCollection;
 
/**
 * @var RouteCollection $routes
 */
 
// --- Rute Halaman Autentikasi Publik ---
// Membuka form login, memproses login POST, dan menghancurkan sesi (logout)
$routes->get('/login', 'AuthController::index');
$routes->post('/login', 'AuthController::process');
$routes->get('/logout', 'AuthController::logout');

// Rute pembelajaran dasar menangani segmentasi URL (NIM, Nama, Kelas)
$routes->get('/mahasiswa/profile/(:alpha)/(:num)/(:alphanum)','HomeController::belajar_segment/$1/$2/$3');
 
// --- GRUP RUTE ADMINISTRATOR (ADMIN) ---
// Diproteksi menggunakan filter 'auth' (harus login) dan 'role:admin' (hanya level admin)
$routes->group('admin', ['filter' => ['auth', 'role:admin']], static function ($routes) {
    // 1. Beranda Dashboard Admin
    $routes->get('dashboard', 'DashboardController::index');
 
    // 2. Manajemen Arsip Dokumen Digital (CRUD)
    $routes->get('dokumen', 'DokumenController::index');
    $routes->get('dokumen/create', 'DokumenController::create');
    $routes->post('dokumen/store', 'DokumenController::store');
    $routes->get('dokumen/edit/(:num)', 'DokumenController::edit/$1');
    $routes->post('dokumen/update/(:num)', 'DokumenController::update/$1');
    $routes->get('dokumen/delete/(:num)', 'DokumenController::delete/$1');
 
    // 3. Kategori Dokumen (CRUD)
    $routes->get('kategori', 'KategoriController::index');
    $routes->get('kategori/create', 'KategoriController::create');
    $routes->post('kategori/store', 'KategoriController::store');
    $routes->get('kategori/edit/(:num)', 'KategoriController::edit/$1');
    $routes->post('kategori/update/(:num)', 'KategoriController::update/$1');
    $routes->get('kategori/delete/(:num)', 'KategoriController::delete/$1');
 
    // 4. Unit / Departemen Kerja Karyawan (CRUD)
    $routes->get('unit', 'UnitController::index');
    $routes->get('unit/create', 'UnitController::create');
    $routes->post('unit/store', 'UnitController::store');
    $routes->get('unit/edit/(:num)', 'UnitController::edit/$1');
    $routes->post('unit/update/(:num)', 'UnitController::update/$1');
    $routes->get('unit/delete/(:num)', 'UnitController::delete/$1');
 
    // 5. Manajemen Akun Pengguna (CRUD Karyawan & Admin)
    $routes->get('user', 'UserController::index');
    $routes->get('user/create', 'UserController::create');
    $routes->post('user/store', 'UserController::store');
    $routes->get('user/edit/(:num)', 'UserController::edit/$1');
    $routes->post('user/update/(:num)', 'UserController::update/$1');
    $routes->get('user/delete/(:num)', 'UserController::delete/$1');
 
    // 6. Transaksi Distribusi/Peminjaman Berkas Fisik
    $routes->get('distribusi', 'DistribusiController::index');
    $routes->get('distribusi/create', 'DistribusiController::create');
    $routes->post('distribusi/store', 'DistribusiController::store');
    $routes->get('distribusi/delete/(:num)', 'DistribusiController::delete/$1');
 
    // 7. Peninjauan Log Riwayat Aktivitas Audit Trail
    $routes->get('riwayat', 'RiwayatController::index');
    $routes->get('riwayat/print', 'RiwayatController::print');
 
    // 8. Persetujuan Permohonan Izin Akses Karyawan
    $routes->group('izin', static function ($routes) {
        $routes->get('/', 'IzinController::admin_index');
        $routes->post('approve/(:num)', 'IzinController::approve/$1');
        $routes->post('reject/(:num)', 'IzinController::reject/$1');
    });
 
    // 9. Peninjauan Usulan Perubahan Dokumen (Revisi)
    $routes->group('revisi', static function ($routes) {
        $routes->get('/', 'RevisiController::index');
        $routes->get('approve/(:num)', 'RevisiController::approve/$1');
        $routes->post('reject/(:num)', 'RevisiController::reject/$1');
    });
});
  
// --- GRUP RUTE KARYAWAN ---
// Diproteksi menggunakan filter 'auth' (harus login) dan 'role:karyawan'
$routes->group('karyawan', ['filter' => ['auth', 'role:karyawan']], static function ($routes) {
    // Beranda Dashboard Karyawan
    $routes->get('dashboard', 'DashboardController::karyawan');
    // Explorer Dokumen (Melihat daftar dokumen beserta status izin & distribusinya)
    $routes->get('dokumen', 'DokumenController::karyawan_index');
    // Form Edit/Revisi Dokumen (Diarahkan ke review usulan revisi)
    $routes->get('dokumen/edit/(:num)', 'DokumenController::edit/$1');
    $routes->post('dokumen/update/(:num)', 'RevisiController::store');
    
    // Daftar Usulan Perubahan Dokumen (Revisi) Karyawan
    $routes->get('revisi', 'RevisiController::karyawan_index');
    
    // Kembalikan Dokumen yang Dipinjam
    $routes->get('distribusi/kembalikan/(:num)', 'DistribusiController::kembalikan_karyawan/$1');
    
    // Alur Permohonan Izin Akses Dokumen
    $routes->group('izin', static function ($routes) {
        $routes->get('/', 'IzinController::index');
        $routes->get('create', 'IzinController::create');
        $routes->post('store', 'IzinController::store');
    });
});



$routes->get('/', 'AuthController::index');
$routes->get('/home/coba-parameter/(:alpha)/(:num)/(:alphanum)', 'Home::belajar_segment/$1/$2/$3');

$routes->get('/das', 'Admin::dash');
// Routes untuk login admin
$routes->get('/admin/login-admin', 'Admin::login');
    
