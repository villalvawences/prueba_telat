<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::dashboard');
$routes->get('/usuarios/create', 'UsuarioController::create');
$routes->post('/usuarios/guardar', 'UsuarioController::guardar');
$routes->get('/usuarios/reportes', 'UsuarioController::reportes');
$routes->get('/usuarios/cargar_datos_reportes', 'UsuarioController::cargar_datos_reporte');
$routes->get('/usuarios/(:num)/editar', 'UsuarioController::editarUsuario/$1');
$routes->post('/usuarios/actualizar/(:num)', 'UsuarioController::actualizarUsuario/$1');
$routes->post('/usuarios/eliminar/(:num)', 'UsuarioController::eliminarUsuario/$1');
