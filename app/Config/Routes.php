<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Route View
$routes->get('/', 'DashboardController::index');
$routes->get('/login', 'Login:index');
$routes->get('/history', 'History:index');
$routes->get('/coba', 'DashboardController:coba');


// Route CRUD Document
$routes->post('Create','DashboardController::create');



