<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('index');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'c_user::index');
$routes->get('/Pages', 'Pages::index');
$routes->get('/c_pemasukan/create', 'c_pemasukan::create');
$routes->get('/c_pemasukan/edit/(:segment)', 'c_pemasukan::edit/$1');
$routes->delete('/c_pemasukan/(:num)', 'c_pemasukan::delete/$1');
$routes->get('/c_pemasukan/(:any)', 'c_pemasukan::detail/$1');

$routes->get('/c_pengeluaran/create', 'c_pengeluaran::create');
$routes->get('/c_pengeluaran/edit/(:segment)', 'c_pengeluaran::edit/$1');
$routes->delete('/c_pengeluaran/(:num)', 'c_pengeluaran::delete/$1');
$routes->get('/c_pengeluaran/(:any)', 'c_pengeluaran::detail/$1');

$routes->get('/c_pengguna/create', 'c_pengguna::create');
$routes->get('/c_pengguna/edit/(:segment)', 'c_pengguna::edit/$1');
$routes->delete('/c_pengguna/(:num)', 'c_pengguna::delete/$1');
$routes->get('/c_pengguna/(:any)', 'c_pengguna::detail/$1');
/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
