<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/paud', 'Paud::index');
// $routes->get('/paud/create', 'Paud::create');
$routes->post('/paud/store', 'Paud::store');

// Authentication routes
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::doLogin');
$routes->get('/logout', 'Auth::logout');
$routes->post('/logout', 'Auth::logout');

// Auth Middleware
$routes->group('', ['filter' => 'auth'], function($routes){
  // $routes->get('/', 'admin\dashboard');
  $routes->get('dashboard', 'Admin\Dashboard::index');
  $routes->get('paud', 'Admin\Paud::index');
// $routes->get('kriteria', 'Admin\Kriteria::index');
  $routes->get('paud/create', 'Admin\Paud::create');
  
});

// Admin routes
$routes->group('admin', ['filter' => 'auth'], function($routes){
  $routes->get('dashboard', 'Admin\Dashboard::index');
  $routes->get('paud', 'Admin\Paud::index');
  $routes->get('paud/create', 'Admin\Paud::create');
  $routes->post('paud/store', 'Admin\Paud::store');
  $routes->get('paud/delete/(:num)', 'Admin\Paud::delete/$1');
  $routes->get('paud/kriteria/(:num)/input', 'Admin\Paud::inputKriteria/$1');
  $routes->post('paud/save-kriteria', 'Admin\Paud::saveKriteria');
  $routes->get('paud/detail/(:num)', 'Admin\Paud::detail/$1');
  $routes->get('paud/kriteria', 'Admin\Paud::tabelKriteria');

  $routes->post('paud/update-kriteria', 'Admin\Paud::updateKriteria');
  $routes->post('paud/update-kriteria-massal', 'Admin\Paud::updateKriteriaMassal');


  $routes->get('kriteria', 'KriteriaController');
  $routes->post('kriteria/store', 'KriteriaController::store');
  $routes->post('kriteria/update/(:num)', 'KriteriaController::update/$1');
  $routes->get('kriteria/delete/(:num)', 'KriteriaController::delete/$1');
  
});
$routes->get('/', 'User\Home::index');
$routes->get('spk', 'User\Spk::form');
$routes->post('spk/hitung', 'User\Spk::hitung');