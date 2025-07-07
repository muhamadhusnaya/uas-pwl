<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Public Routes (dapat diakses tanpa login)
$routes->get('/', 'Home::home');
$routes->get('/home', 'Home::home');


// Guest Routes
$routes->group('', ['filter' => 'guest'], function ($routes) {
    $routes->get('/login-user', 'AuthController::viewLoginUser');
    $routes->get('/register-user', 'AuthController::viewRegisterUser');
    $routes->get('/login-admin', 'AuthController::viewLoginAdmin');
});

// Auth Routes
$routes->post('/login-user', 'AuthController::login');
$routes->post('/login-admin', 'AuthController::login');

$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('/logout', 'AuthController::logout');

    // Cart Routes - perlu login untuk akses keranjang
    $routes->group('/keranjang', function ($routes) {
        $routes->get('', 'OrdersController::keranjang');
        $routes->post('add', 'OrdersController::cart_add');
        $routes->post('update', 'OrdersController::cart_update');
        $routes->get('remove/(:segment)', 'OrdersController::cart_remove/$1');
        $routes->get('clear', 'OrdersController::cart_clear');
        $routes->post('process', 'OrdersController::process_order');
    });
});

// Admin Routes
$routes->group('admin', ['filter' => 'admin'], function ($routes) {
    $routes->get('dashboard', 'Home::index');

    // Product Management
    $routes->get('produk', 'ProductController::produk');
    $routes->post('produk', 'ProductController::store');
    $routes->post('produk/update/(:any)', 'ProductController::update/$1');
    $routes->delete('produk/delete/(:any)', 'ProductController::delete/$1');

    // Order Management
    $routes->get('order', 'ProductController::order');

    // Category Management
    $routes->get('kategori', 'CategoryController::index');
    $routes->post('kategori', 'CategoryController::store');
    $routes->post('kategori/edit/(:any)', 'CategoryController::edit/$1');
    $routes->delete('kategori/delete/(:any)', 'CategoryController::delete/$1');
});



