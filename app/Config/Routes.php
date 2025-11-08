<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Login y Logout
$routes->get('/', 'Auth::login');
$routes->get('/login', 'Auth::login');
$routes->post('/auth/doLogin', 'Auth::doLogin');
$routes->get('/logout', 'Auth::logout');

// Dashboards
$routes->group('administrador', ['filter' => 'role:administrador'], fn($r) => $r->get('/', 'AdministradorController::index'));
$routes->group('bodeguero', ['filter' => 'role:bodeguero'], fn($r) => $r->get('/', 'BodegueroController::index'));

// Error sin permisos
$routes->get('/unauthorized', fn() => view('errors/custom/unauthorized'));

// Rutas solo para Administrador
$routes->group('', ['filter' => 'role:administrador'], function ($routes) {
    $routes->group('stock', fn($r) => [
        $r->get('/', 'StockController::index'),
        $r->get('(:segment)', 'StockController::detalle/$1')
    ]);

    $routes->group('perfiles', fn($r) => [
        $r->get('/', 'PerfilesController::index'),
        $r->get('create', 'PerfilesController::create'),
        $r->post('store', 'PerfilesController::store'),
        $r->get('edit/(:num)', 'PerfilesController::edit/$1'),
        $r->post('update/(:num)', 'PerfilesController::update/$1'),
        $r->get('delete/(:num)', 'PerfilesController::delete/$1')
    ]);

    $routes->group('usuarios', fn($r) => [
        $r->get('/', 'UsuarioController::index'),
        $r->get('create', 'UsuarioController::create'),
        $r->post('store', 'UsuarioController::store'),
        $r->get('edit/(:num)', 'UsuarioController::edit/$1'),
        $r->post('update/(:num)', 'UsuarioController::update/$1'),
        $r->get('delete/(:num)', 'UsuarioController::delete/$1')
    ]);

    $routes->group('usospacientes', fn($r) => [
        $r->get('/', 'UsoPacienteController::index'),
        $r->get('create', 'UsoPacienteController::create'),
        $r->post('store', 'UsoPacienteController::store'),
        $r->get('edit/(:num)', 'UsoPacienteController::edit/$1'),
        $r->post('update/(:num)', 'UsoPacienteController::update/$1'),
        $r->get('delete/(:num)', 'UsoPacienteController::delete/$1')
    ]);

    $routes->group('RegistroActividades', fn($r) => $r->get('/', 'TrazabilidadAccionController::index'));
});

// Rutas compartidas (Administrador y Bodeguero)
$routes->group('', ['filter' => 'role:administrador,bodeguero'], function ($routes) {

    $routes->group('insumos', fn($r) => [
        $r->get('/', 'InsumoController::index'),
        $r->get('create', 'InsumoController::create'),
        $r->post('store', 'InsumoController::store'),
        $r->get('edit/(:num)', 'InsumoController::edit/$1'),
        $r->post('update/(:num)', 'InsumoController::update/$1'),
        $r->get('delete/(:num)', 'InsumoController::delete/$1')
    ]);

    $routes->group('insumossalas', fn($r) => [
        $r->get('/', 'InsumoSalaController::index'),
        $r->get('create', 'InsumoSalaController::create'),
        $r->post('store', 'InsumoSalaController::store'),
        $r->get('edit/(:num)', 'InsumoSalaController::edit/$1'),
        $r->post('update/(:num)', 'InsumoSalaController::update/$1'),
        $r->get('delete/(:num)', 'InsumoSalaController::delete/$1')
    ]);

    $routes->group('lotes', fn($r) => [
        $r->get('/', 'LoteController::index'),
        $r->get('create', 'LoteController::create'),
        $r->post('store', 'LoteController::store'),
        $r->get('edit/(:num)', 'LoteController::edit/$1'),
        $r->post('update/(:num)', 'LoteController::update/$1'),
        $r->get('delete/(:num)', 'LoteController::delete/$1')
    ]);

    $routes->group('solicitudes', fn($r) => [
        $r->get('/', 'SolicitudController::index'),
        $r->get('create', 'SolicitudController::create'),
        $r->post('store', 'SolicitudController::store'),
        $r->get('edit/(:num)', 'SolicitudController::edit/$1'),
        $r->post('update/(:num)', 'SolicitudController::update/$1')
    ]);

    $routes->group('clasificaciones', fn($r) => [
        $r->get('/', 'ClasificacionController::index'),
        $r->get('create', 'ClasificacionController::create'),
        $r->post('store', 'ClasificacionController::store'),
        $r->get('edit/(:num)', 'ClasificacionController::edit/$1'),
        $r->post('update/(:num)', 'ClasificacionController::update/$1'),
        $r->get('delete/(:num)', 'ClasificacionController::delete/$1')
    ]);

    $routes->get('/catalogosistema', 'CatalogoController::index');
    $routes->get('/bodega', 'BodegaController::index');

    $routes->get('/relacioninsumos', 'Home::relacionInsumos');
    $routes->get('/relacionlotes', 'Home::relacionLotes');
    $routes->get('/relacionusuarios', 'Home::relacionUsuarios');
    $routes->get('/relacionsubunidades', 'Home::relacionSubunidades');
    $routes->get('/relacionsolicitudes', 'Home::relacionSolicitudes');
    $routes->get('/relacionmantenciones', 'Home::relacionMantenciones');
    $routes->get('/relacionprestaciones', 'Home::relacionPrestaciones');
});
