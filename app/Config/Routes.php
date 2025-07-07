<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//Users Routes
$routes->get('/', 'Home::home');
$routes->get('/login-user', 'AuthController::viewLoginUser');
$routes->get('/register-user', 'AuthController::viewRegisterUser');

// Cart Routes
$routes->get('/keranjang', 'OrdersController::keranjang');
$routes->post('/keranjang/add', 'OrdersController::cart_add');
$routes->post('/keranjang/update', 'OrdersController::cart_update');
$routes->get('/keranjang/remove/(:segment)', 'OrdersController::cart_remove/$1');
$routes->get('/keranjang/clear', 'OrdersController::cart_clear');
$routes->post('/keranjang/process', 'OrdersController::process_order');

// Admin Routes
$routes->get('/login-admin', 'AuthController::viewLoginAdmin');
$routes->group('admin', function ($routes) {
    $routes->get('dashboard', 'Home::index');
    $routes->get('produk', 'ProductController::produk');
    $routes->post('produk', 'ProductController::store');
    $routes->post('produk/update/(:any)', 'ProductController::update/$1');
    $routes->delete('produk/delete/(:any)', 'ProductController::delete/$1');
    $routes->get('order', 'ProductController::order');
    $routes->get('kategori', 'CategoryController::index');
    $routes->post('kategori', 'CategoryController::store');
    $routes->post('kategori/edit/(:any)', 'CategoryController::edit/$1');
    $routes->delete('kategori/delete/(:any)', 'CategoryController::delete/$1');
});



