<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Frontend::index');
$routes->get('/login', 'Frontend::login');
$routes->get('/register', 'Frontend::register');
$routes->get('/forgot', 'Frontend::forgot');
$routes->get('/admin', 'Login::index');
$routes->get('/Toko/editProfilAdmin/(:segment)', 'Toko::editProfilAdmin/$1');
$routes->get('/toko/tampilFoto/(:segment)/(:segment)', 'Toko::tampilFoto/$1/$2');


$routes->get('/berita/(:segment)', 'Frontend::detailBerita/$1');
$routes->get('/Pages/editBanner/(:segment)', 'Pages::editBanner/$1');

$routes->delete('/Pages/dataBanner/(:num)', 'Pages::deleteBanner/$1');

$routes->get('/Toko/editProduk/(:segment)', 'Toko::editProduk/$1');
$routes->get('/Toko/editToko/(:segment)', 'Toko::editToko/$1');
$routes->get('/Backend/editProduk/(:segment)', 'Backend::editProduk/$1');
$routes->get('/Backend/editProfil/(:segment)', 'Backend::editProfil/$1');
$routes->get('/Backend/editLokasi/(:segment)', 'Backend::editLokasi/$1');

$routes->delete('/toko/(:num)', 'Toko::delete/$1');
$routes->delete('/Toko/verifikasiData/(:num)', 'Toko::rejectData/$1');
$routes->delete('/Backend/(:num)', 'Backend::deleteProduk/$1');
$routes->delete('/Toko/detail/(:segment)', 'Toko::deleteProduk/$1');

$routes->get('/backend/(:segment)', 'Backend::detailToko/$1');
$routes->get('/toko/(:any)', 'Toko::detail/$1');

$routes->get('/Pages/editPenulis/(:segment)', 'Pages::editPenulis/$1');
$routes->delete('/Pages/dataPenulis/(:num)', 'Pages::deletePenulis/$1');

$routes->get('/Pages/editBerita/(:segment)', 'Pages::editBerita/$1');
$routes->delete('/Pages/dataBerita/(:num)', 'Pages::deleteBerita/$1');

$routes->get('/Pages/editAdmin/(:segment)', 'Pages::editAdmin/$1');
$routes->delete('/Pages/dataAdmin/(:num)', 'Pages::deleteAdmin/$1');

$routes->get('Toko/printexcel', 'Toko::printexcel');
$routes->get('Toko/import', 'Toko::import');


/*
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
