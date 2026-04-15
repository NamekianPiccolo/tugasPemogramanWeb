<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Route Home View
$routes->get('/', 'HomeController::index');
$routes->get('/login', 'AuthController::index');




