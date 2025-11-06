<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ==========================
// 🟢 LOGIN / LOGOUT
// ==========================
$routes->get('/', 'Auth::login');
$routes->get('/login', 'Auth::login');
$routes->post('/auth/doLogin', 'Auth::doLogin');
$routes->get('/logout', 'Auth::logout');

// ==========================
// 🏠 DASHBOARDS POR ROL
// ==========================


// Usan tus controladores para aplicar BaseController y layouts dinámicos
$routes->group('administrador', ['filter' => 'role:administrador'], function($routes) {
    $routes->get('/', 'AdministradorController::index');
});

$routes->group('bodeguero', ['filter' => 'role:bodeguero'], function($routes) {
    $routes->get('/', 'BodegueroController::index');
});


// ==========================
// 🔐 VISTA DE ERROR (SIN PERMISOS)
// ==========================
$routes->get('/unauthorized', function () {
    echo view('errors/custom/unauthorized');
});

// ==========================
// 📦 MÓDULOS PRINCIPALES
// ==========================

// -- STOCK
$routes->group('stock', function ($routes) {
    $routes->get('/', 'StockController::index');
    $routes->get('(:segment)', 'StockController::detalle/$1');
});

// -- INSUMOS
$routes->group('insumos', function($routes) {
    $routes->get('/', 'InsumoController::index');
    $routes->get('create', 'InsumoController::create');
    $routes->post('store', 'InsumoController::store');
    $routes->get('edit/(:num)', 'InsumoController::edit/$1');
    $routes->post('update/(:num)', 'InsumoController::update/$1');
    $routes->get('delete/(:num)', 'InsumoController::delete/$1');
});

// -- INSUMOS A SALA
$routes->group('insumossalas', function($routes) {
    $routes->get('/', 'InsumoSalaController::index');
    $routes->get('create', 'InsumoSalaController::create');
    $routes->post('store', 'InsumoSalaController::store');
    $routes->get('edit/(:num)', 'InsumoSalaController::edit/$1');
    $routes->post('update/(:num)', 'InsumoSalaController::update/$1');
    $routes->get('delete/(:num)', 'InsumoSalaController::delete/$1');
});


// -- BODEGA
$routes->get('/bodega', 'BodegaController::index');


// -- SOLICITUDES
$routes->group('solicitudes', function ($routes) {
    $routes->get('/', 'SolicitudController::index');
    $routes->get('create', 'SolicitudController::create');
    $routes->post('store', 'SolicitudController::store');
    $routes->get('edit/(:num)', 'SolicitudController::edit/$1');
    $routes->post('update/(:num)', 'SolicitudController::update/$1');
});

// -- LOTES

$routes->group('lotes', function ($routes) {
    $routes->get('/', 'LoteController::index');
    $routes->get('create', 'LoteController::create');
    $routes->post('store', 'LoteController::store');
    $routes->get('edit/(:num)', 'LoteController::edit/$1');
    $routes->post('update/(:num)', 'LoteController::update/$1');
});

// -- perfiles
$routes->group('perfiles', function($routes) {
    $routes->get('/', 'PerfilesController::index');
    $routes->get('create', 'PerfilesController::create');
    $routes->post('store', 'PerfilesController::store');
    $routes->get('edit/(:num)', 'PerfilesController::edit/$1');
    $routes->post('update/(:num)', 'PerfilesController::update/$1');
    $routes->get('delete/(:num)', 'PerfilesController::delete/$1');
});


// -- CATALOGO
$routes->get('/catalogosistema', 'CatalogoController::index');


// -- USOS EN PACIENTES
$routes->group('usospacientes', function($routes) {
    $routes->get('/', 'UsoPacienteController::index');
    $routes->get('create', 'UsoPacienteController::create');
    $routes->post('store', 'UsoPacienteController::store');
    $routes->get('edit/(:num)', 'UsoPacienteController::edit/$1');
    $routes->post('update/(:num)', 'UsoPacienteController::update/$1');
    $routes->get('delete/(:num)', 'UsoPacienteController::delete/$1');
});


// ==========================
// 👥 GESTIÓN DE USUARIOS / PERFILES
// ==========================
$routes->group('usuarios', function ($routes) {
    $routes->get('/', 'UsuarioController::index');
    $routes->get('create', 'UsuarioController::create');
    $routes->post('store', 'UsuarioController::store');
    $routes->get('edit/(:num)', 'UsuarioController::edit/$1');
    $routes->post('update/(:num)', 'UsuarioController::update/$1');
    $routes->get('delete/(:num)', 'UsuarioController::delete/$1');
});



// ==========================
// 🧾 OTROS MÓDULOS 
// ==========================

$routes->get('/relacioninsumos', 'Home::relacionInsumos');
$routes->get('/relacionlotes', 'Home::relacionLotes');
$routes->get('/relacionusuarios', 'Home::relacionUsuarios');
$routes->get('/relacionsubunidades', 'Home::relacionSubunidades');
$routes->get('/relacionsolicitudes', 'Home::relacionSolicitudes');
$routes->get('/relacionmantenciones', 'Home::relacionMantenciones');
$routes->get('/relacionprestaciones', 'Home::relacionPrestaciones');


$routes->get('/solicitudes', 'SolicitudController::index');

// ==========================
// 🧩 Fallback genérico
// ==========================
$routes->get('/dashboard', 'Home::index');
