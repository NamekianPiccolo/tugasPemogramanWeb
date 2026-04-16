<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Route Home View
$routes->get('/', 'HomeController::index');
$routes->get('/login', 'AuthController::index');
$routes->get('/mahasiswa/profile/(:alpha)/(:num)/(:alphanum)','HomeController::belajar_segment/$1/$2/$3');




