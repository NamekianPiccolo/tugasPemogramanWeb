<?php
 
use CodeIgniter\Router\RouteCollection;
 
/**
 * @var RouteCollection $routes
 */
 
// Route Home View
$routes->get('/', 'HomeController::index');
$routes->get('/login', 'AuthController::index');
$routes->post('/login', 'AuthController::process');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/mahasiswa/profile/(:alpha)/(:num)/(:alphanum)','HomeController::belajar_segment/$1/$2/$3');
 
// --- Route untuk Sistem Manajemen Arsip (Admin) ---
$routes->group('admin', ['filter' => ['auth', 'role:admin']], static function ($routes) {
    // 1. Dashboard
    $routes->get('dashboard', 'DashboardController::index');
 
    // 2. Data Dokumen (CRUD)
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
 
    // 4. Unit / Bagian (CRUD)
    $routes->get('unit', 'UnitController::index');
    $routes->get('unit/create', 'UnitController::create');
    $routes->post('unit/store', 'UnitController::store');
    $routes->get('unit/edit/(:num)', 'UnitController::edit/$1');
    $routes->post('unit/update/(:num)', 'UnitController::update/$1');
    $routes->get('unit/delete/(:num)', 'UnitController::delete/$1');
 
    // 5. User Management (CRUD Admin)
    $routes->get('user', 'UserController::index');
    $routes->get('user/create', 'UserController::create');
    $routes->post('user/store', 'UserController::store');
    $routes->get('user/edit/(:num)', 'UserController::edit/$1');
    $routes->post('user/update/(:num)', 'UserController::update/$1');
    $routes->get('user/delete/(:num)', 'UserController::delete/$1');
 
    // 6. Distribusi Dokumen
    $routes->get('distribusi', 'DistribusiController::index');
    $routes->get('distribusi/create', 'DistribusiController::create');
    $routes->post('distribusi/store', 'DistribusiController::store');
    $routes->get('distribusi/delete/(:num)', 'DistribusiController::delete/$1');
 
    // 7. Riwayat Dokumen
    $routes->get('riwayat', 'RiwayatController::index');
 
    // 7. Persetujuan Izin
    $routes->group('izin', static function ($routes) {
        $routes->get('/', 'IzinController::admin_index');
        $routes->get('approve/(:num)', 'IzinController::approve/$1');
        $routes->get('reject/(:num)', 'IzinController::reject/$1');
    });

    // 8. Review Perubahan (Revisi)
    $routes->group('revisi', static function ($routes) {
        $routes->get('/', 'RevisiController::index');
        $routes->get('approve/(:num)', 'RevisiController::approve/$1');
        $routes->post('reject/(:num)', 'RevisiController::reject/$1');
    });
});
 
// --- Route untuk Karyawan ---
$routes->group('karyawan', ['filter' => ['auth', 'role:karyawan']], static function ($routes) {
    $routes->get('dashboard', 'DashboardController::karyawan');
    $routes->get('dokumen', 'DokumenController::karyawan_index');
    $routes->get('dokumen/edit/(:num)', 'DokumenController::edit/$1');
    $routes->post('dokumen/update/(:num)', 'RevisiController::store'); // Diarahkan ke Revisi
    
    $routes->group('izin', static function ($routes) {
        $routes->get('/', 'IzinController::index');
        $routes->get('create', 'IzinController::create');
        $routes->post('store', 'IzinController::store');
    });

    $routes->group('distribusi', static function ($routes) {
        $routes->get('/', 'DistribusiController::index');
        $routes->get('create', 'DistribusiController::create');
        $routes->post('store', 'DistribusiController::store');
    });
});
