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
$routes->get('/administrador', 'AdministradorController::index');
$routes->get('/bodeguero', 'BodegueroController::index');


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
$routes->group('insumos', function ($routes) {
    $routes->get('/', 'InsumoController::index');
    $routes->get('create', 'InsumoController::create');
    $routes->post('store', 'InsumoController::store');
    $routes->get('edit/(:num)', 'InsumoController::edit/$1');
    $routes->post('update/(:num)', 'InsumoController::update/$1');
    $routes->get('delete/(:num)', 'InsumoController::delete/$1');
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

// -- CATALOGO
$routes->get('/catalogosistema', 'CatalogoController::index');

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

$routes->group('perfiles', function ($routes) {
    $routes->get('/', 'PerfilController::index');
    $routes->get('create', 'PerfilController::create');
    $routes->post('store', 'PerfilController::store');
    $routes->get('edit/(:num)', 'PerfilController::edit/$1');
    $routes->post('update/(:num)', 'PerfilController::update/$1');
    $routes->get('delete/(:num)', 'PerfilController::delete/$1');
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

$routes->get('/bodega', 'BodegaController::index');
$routes->get('/solicitudes', 'SolicitudController::index');

// ==========================
// 🧩 Fallback genérico
// ==========================
$routes->get('/dashboard', 'Home::index');
