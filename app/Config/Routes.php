<?php

namespace Config;

$routes = Services::routes();

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

// ==================== HOME / LANDING PAGE ====================
$routes->get('/', 'Home::index');
$routes->get('/home/dashboard', 'Home::dashboard');
$routes->get('/home/viewMap', 'Home::viewMap');
$routes->get('/home/basemap', 'Home::baseMap');
$routes->get('/home/marker', 'Home::marker');
$routes->get('/home/polygon', 'Home::polygon');
$routes->get('/home/geojson', 'Home::geojson');

// ==================== LOKASI ====================
$routes->get('/lokasi/index', 'Lokasi::index');
$routes->get('/lokasi/pemetaanLokasi', 'Lokasi::pemetaanLokasi');
$routes->get('/lokasi/inputLokasi', 'Lokasi::inputLokasi');
$routes->get('/lokasi/editLokasi/(:any)', 'Lokasi::editLokasi/$1');
$routes->post('/lokasi/save', 'Lokasi::save');
$routes->post('/lokasi/update/(:any)', 'Lokasi::update/$1');
$routes->get('/lokasi/delete/(:any)', 'Lokasi::delete/$1');
$routes->get('/lokasi/getStatistics', 'Lokasi::getStatistics');

// ==================== SEARCH SCHOOLS ====================
$routes->get('/search', 'Search::index');
$routes->post('/search/api', 'Search::api');
$routes->get('/search/compare', 'Search::compare');

// ==================== AUTH ====================
$routes->get('/auth/login', 'Auth::login');
$routes->post('/auth/doLogin', 'Auth::doLogin');
$routes->get('/auth/logout', 'Auth::logout');

// Routes untuk User (Publik)
$routes->get('/schools', 'Schools::index');
$routes->get('/schools/search', 'Schools::search');
$routes->get('/schools/detail/(:any)', 'Schools::detail/$1');
$routes->get('/schools/getKecamatan', 'Schools::getKecamatan');

// Routes untuk Admin (CRUD)
$routes->get('/lokasi/index', 'Lokasi::index');
$routes->get('/lokasi/pemetaanLokasi', 'Lokasi::pemetaanLokasi');
$routes->get('/lokasi/inputLokasi', 'Lokasi::inputLokasi');
$routes->get('/lokasi/editLokasi/(:any)', 'Lokasi::editLokasi/$1');
$routes->post('/lokasi/save', 'Lokasi::save');
$routes->post('/lokasi/update/(:any)', 'Lokasi::update/$1');
$routes->get('/lokasi/delete/(:any)', 'Lokasi::delete/$1');
$routes->get('/lokasi/getStatistics', 'Lokasi::getStatistics');