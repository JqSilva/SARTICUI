<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection
 */


// Rutas de Controladores

// Incio
$routes->get('/', 'Home::index');

// Sub-Vistas
$routes->get('/catalogosistema', 'Home::catalogoSistema');
$routes->get('/relacioninsumos', 'Home::relacionInsumos');
$routes->get('/relacionlotes', 'Home::relacionLotes');
$routes->get('/relacionusuarios', 'Home::relacionUsuarios');
$routes->get('/relacionsubunidades', 'Home::relacionSubunidades');
$routes->get('/relacionsolicitudes', 'Home::relacionSolicitudes');
$routes->get('/relacionmantenciones', 'Home::relacionMantenciones');
$routes->get('/relacionprestaciones', 'Home::relacionPrestaciones');

$routes->get('/bodega', 'BodegaController::index');
$routes->get('/stock', 'StockController::index');

// Rutas de Licitaciones
$routes->get('licitaciones', 'LicitacionController::index');
$routes->get('licitaciones/create', 'LicitacionController::create');
$routes->post('licitaciones/store', 'LicitacionController::store');
$routes->get('licitaciones/edit/(:num)', 'LicitacionController::edit/$1');
$routes->post('licitaciones/update/(:num)', 'LicitacionController::update/$1');
$routes->get('licitaciones/delete/(:num)', 'LicitacionController::delete/$1');

// Rutas de Proveedores
$routes->get('proveedores', 'ProveedorController::index');
$routes->get('proveedores/create', 'ProveedorController::create');
$routes->post('proveedores/store', 'ProveedorController::store');
$routes->get('proveedores/edit/(:num)', 'ProveedorController::edit/$1');
$routes->post('proveedores/update/(:num)', 'ProveedorController::update/$1');
$routes->get('proveedores/delete/(:num)', 'ProveedorController::delete/$1');

// Rutas de Clasificaciones
$routes->get('clasificaciones', 'ClasificacionController::index');
$routes->get('clasificaciones/create', 'ClasificacionController::create');
$routes->post('clasificaciones/store', 'ClasificacionController::store');
$routes->get('clasificaciones/edit/(:num)', 'ClasificacionController::edit/$1');
$routes->post('clasificaciones/update/(:num)', 'ClasificacionController::update/$1');
$routes->get('clasificaciones/delete/(:num)', 'ClasificacionController::delete/$1');

// Rutas de Disponibilidades
$routes->get('disponibilidades', 'DisponibilidadController::index');
$routes->get('disponibilidades/create', 'DisponibilidadController::create');
$routes->post('disponibilidades/store', 'DisponibilidadController::store');
$routes->get('disponibilidades/edit/(:num)', 'DisponibilidadController::edit/$1');
$routes->post('disponibilidades/update/(:num)', 'DisponibilidadController::update/$1');
$routes->get('disponibilidades/delete/(:num)', 'DisponibilidadController::delete/$1');

// Rutas de Insumos
$routes->get('insumos', 'InsumoController::index');
$routes->get('insumos/create', 'InsumoController::create');
$routes->post('insumos/store', 'InsumoController::store');
$routes->get('insumos/edit/(:num)', 'InsumoController::edit/$1');
$routes->post('insumos/update/(:num)', 'InsumoController::update/$1');
$routes->get('insumos/delete/(:num)', 'InsumoController::delete/$1');

// Rutas de Lotes
$routes->get('lotes', 'LoteController::index');
$routes->get('lotes/create', 'LoteController::create');
$routes->post('lotes/store', 'LoteController::store');
$routes->get('lotes/edit/(:num)', 'LoteController::edit/$1');
$routes->post('lotes/update/(:num)', 'LoteController::update/$1');
$routes->get('lotes/delete/(:num)', 'LoteController::delete/$1');

// Rutas de Procedencias
$routes->get('procedencias', 'ProcedenciaController::index');
$routes->get('procedencias/create', 'ProcedenciaController::create');
$routes->post('procedencias/store', 'ProcedenciaController::store');
$routes->get('procedencias/edit/(:num)', 'ProcedenciaController::edit/$1');
$routes->post('procedencias/update/(:num)', 'ProcedenciaController::update/$1');
$routes->get('procedencias/delete/(:num)', 'ProcedenciaController::delete/$1');

// Rutas de Tipos de Compras
$routes->get('tiposcompras', 'TipoCompraController::index');
$routes->get('tiposcompras/create', 'TipoCompraController::create');
$routes->post('tiposcompras/store', 'TipoCompraController::store');
$routes->get('tiposcompras/edit/(:num)', 'TipoCompraController::edit/$1');
$routes->post('tiposcompras/update/(:num)', 'TipoCompraController::update/$1');
$routes->get('tiposcompras/delete/(:num)', 'TipoCompraController::delete/$1');

// Rutas de Perfiles
$routes->get('perfiles', 'PerfilController::index');
$routes->get('perfiles/create', 'PerfilController::create');
$routes->post('perfiles/store', 'PerfilController::store');
$routes->get('perfiles/edit/(:num)', 'PerfilController::edit/$1');
$routes->post('perfiles/update/(:num)', 'PerfilController::update/$1');
$routes->get('perfiles/delete/(:num)', 'PerfilController::delete/$1');

// Rutas de Estamentos
$routes->get('estamentos', 'EstamentoController::index');
$routes->get('estamentos/create', 'EstamentoController::create');
$routes->post('estamentos/store', 'EstamentoController::store');
$routes->get('estamentos/edit/(:num)', 'EstamentoController::edit/$1');
$routes->post('estamentos/update/(:num)', 'EstamentoController::update/$1');
$routes->get('estamentos/delete/(:num)', 'EstamentoController::delete/$1');

// Rutas de Usuarios
$routes->get('usuarios', 'UsuarioController::index');
$routes->get('usuarios/create', 'UsuarioController::create');
$routes->post('usuarios/store', 'UsuarioController::store');
$routes->get('usuarios/edit/(:num)', 'UsuarioController::edit/$1');
$routes->post('usuarios/update/(:num)', 'UsuarioController::update/$1');
$routes->get('usuarios/delete/(:num)', 'UsuarioController::delete/$1');

// Rutas de Subunidades
$routes->get('subunidades', 'SubunidadController::index');
$routes->get('subunidades/create', 'SubunidadController::create');
$routes->post('subunidades/store', 'SubunidadController::store');
$routes->get('subunidades/edit/(:num)', 'SubunidadController::edit/$1');
$routes->post('subunidades/update/(:num)', 'SubunidadController::update/$1');
$routes->get('subunidades/delete/(:num)', 'SubunidadController::delete/$1');

// Rutas de Salas
$routes->get('salas', 'SalaController::index');
$routes->get('salas/create', 'SalaController::create');
$routes->post('salas/store', 'SalaController::store');
$routes->get('salas/edit/(:num)', 'SalaController::edit/$1');
$routes->post('salas/update/(:num)', 'SalaController::update/$1');
$routes->get('salas/delete/(:num)', 'SalaController::delete/$1');

// Rutas de Estado de Solicitud
$routes->get('estadossolicitudes', 'EstadoSolicitudController::index');
$routes->get('estadossolicitudes/create', 'EstadoSolicitudController::create');
$routes->post('estadossolicitudes/store', 'EstadoSolicitudController::store');
$routes->get('estadossolicitudes/edit/(:num)', 'EstadoSolicitudController::edit/$1');
$routes->post('estadossolicitudes/update/(:num)', 'EstadoSolicitudController::update/$1');
$routes->get('estadossolicitudes/delete/(:num)', 'EstadoSolicitudController::delete/$1');

// Rutas de Solicitud
$routes->get('solicitudes', 'SolicitudController::index');
$routes->get('solicitudes/create', 'SolicitudController::create');
$routes->post('solicitudes/store', 'SolicitudController::store');
$routes->get('solicitudes/edit/(:num)', 'SolicitudController::edit/$1');
$routes->post('solicitudes/update/(:num)', 'SolicitudController::update/$1');
$routes->get('solicitudes/delete/(:num)', 'SolicitudController::delete/$1');

// Rutas Salida de Bodega
$routes->get('insumossalas', 'InsumoSalaController::index');
$routes->get('insumossalas/create', 'InsumoSalaController::create');
$routes->post('insumossalas/store', 'InsumoSalaController::store');
$routes->get('insumossalas/edit/(:num)', 'InsumoSalaController::edit/$1');
$routes->post('insumossalas/update/(:num)', 'InsumoSalaController::update/$1');
$routes->get('insumossalas/delete/(:num)', 'InsumoSalaController::delete/$1');

// Rutas de Pacientes
$routes->get('pacientes', 'PacienteController::index');
$routes->get('pacientes/create', 'PacienteController::create');
$routes->post('pacientes/store', 'PacienteController::store');
$routes->get('pacientes/edit/(:num)', 'PacienteController::edit/$1');
$routes->post('pacientes/update/(:num)', 'PacienteController::update/$1');
$routes->get('pacientes/delete/(:num)', 'PacienteController::delete/$1');

// Rutas de Uso Paciente
$routes->get('usospacientes', 'UsoPacienteController::index');
$routes->get('usospacientes/create', 'UsoPacienteController::create');
$routes->post('usospacientes/store', 'UsoPacienteController::store');
$routes->get('usospacientes/edit/(:num)', 'UsoPacienteController::edit/$1');
$routes->post('usospacientes/update/(:num)', 'UsoPacienteController::update/$1');
$routes->get('usospacientes/delete/(:num)', 'UsoPacienteController::delete/$1');

// Rutas de Tipo de Registros
$routes->get('tiposregistros', 'TipoRegistroController::index');
$routes->get('tiposregistros/create', 'TipoRegistroController::create');
$routes->post('tiposregistros/store', 'TipoRegistroController::store');
$routes->get('tiposregistros/edit/(:num)', 'TipoRegistroController::edit/$1');
$routes->post('tiposregistros/update/(:num)', 'TipoRegistroController::update/$1');
$routes->get('tiposregistros/delete/(:num)', 'TipoRegistroController::delete/$1');

// Rutas de Equipo Medico
/* $routes->get('equiposmedicos', 'EquipoMedicoController::index');
$routes->get('equiposmedicos/create', 'EquipoMedicoController::create');
$routes->post('equiposmedicos/store', 'EquipoMedicoController::store');
$routes->get('equiposmedicos/edit/(:num)', 'EquipoMedicoController::edit/$1');
$routes->post('equiposmedicos/update/(:num)', 'EquipoMedicoController::update/$1');
$routes->get('equiposmedicos/delete/(:num)', 'EquipoMedicoController::delete/$1');

// Rutas de Tipo de Mantención
$routes->get('tiposmantenciones', 'TipoMantencionController::index');
$routes->get('tiposmantenciones/create', 'TipoMantencionController::create');
$routes->post('tiposmantenciones/store', 'TipoMantencionController::store');
$routes->get('tiposmantenciones/edit/(:num)', 'TipoMantencionController::edit/$1');
$routes->post('tiposmantenciones/update/(:num)', 'TipoMantencionController::update/$1');
$routes->get('tiposmantenciones/delete/(:num)', 'TipoMantencionController::delete/$1');

// Rutas de Mantención Equipo
$routes->get('mantencionesequipos', 'MantencionEquipoController::index');
$routes->get('mantencionesequipos/create', 'MantencionEquipoController::create');
$routes->post('mantencionesequipos/store', 'MantencionEquipoController::store');
$routes->get('mantencionesequipos/edit/(:num)', 'MantencionEquipoController::edit/$1');
$routes->post('mantencionesequipos/update/(:num)', 'MantencionEquipoController::update/$1');
$routes->get('mantencionesequipos/delete/(:num)', 'MantencionEquipoController::delete/$1');

// Rutas de Procedimientos
$routes->get('procedimientos', 'ProcedimientoController::index');
$routes->get('procedimientos/create', 'ProcedimientoController::create');
$routes->post('procedimientos/store', 'ProcedimientoController::store');
$routes->get('procedimientos/edit/(:num)', 'ProcedimientoController::edit/$1');
$routes->post('procedimientos/update/(:num)', 'ProcedimientoController::update/$1');
$routes->get('procedimientos/delete/(:num)', 'ProcedimientoController::delete/$1');

// Rutas de Condicion del Paciente
$routes->get('condicionespacientes', 'CondicionPacienteController::index');
$routes->get('condicionespacientes/create', 'CondicionPacienteController::create');
$routes->post('condicionespacientes/store', 'CondicionPacienteController::store');
$routes->get('condicionespacientes/edit/(:num)', 'CondicionPacienteController::edit/$1');
$routes->post('condicionespacientes/update/(:num)', 'CondicionPacienteController::update/$1');
$routes->get('condicionespacientes/delete/(:num)', 'CondicionPacienteController::delete/$1');

// Rutas de Prestación
$routes->get('prestaciones', 'PrestacionController::index');
$routes->get('prestaciones/create', 'PrestacionController::create');
$routes->post('prestaciones/store', 'PrestacionController::store');
$routes->get('prestaciones/edit/(:num)', 'PrestacionController::edit/$1');
$routes->post('prestaciones/update/(:num)', 'PrestacionController::update/$1');
$routes->get('prestaciones/delete/(:num)', 'PrestacionController::delete/$1'); */