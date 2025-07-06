<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'AuthController::viewLoginUser');
$routes->get('/dashboard', 'Home::index');

$routes->get('/login-admin', 'AuthController::viewLoginAdmin');
$routes->get('/login-user', 'AuthController::viewLoginUser');
$routes->get('/register-user', 'AuthController::viewRegisterUser');

$routes->get('/produk', 'ProductController::produk');

$routes->get('/home', 'Home::home');
$routes->get('/order', 'ProductController::order');
$routes->get('/keranjang', 'ProductController::keranjang');
$routes->get('/kategori', 'ProductController::kategori');



