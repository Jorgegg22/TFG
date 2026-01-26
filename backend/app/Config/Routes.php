<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Usuarios;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('api', function($routes) {
    $routes->get('usuarios', 'Usuarios::index');
    $routes->get('pisos/(:num)', 'InmueblesController::show/$1');
    $routes->post('match', 'MatchesController::create');
});