<?php

use App\Controllers\UsuariosController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


    $routes->get('api/usuarios', [UsuariosController::class,'index']);
    $routes->get('pisos/(:num)', 'InmueblesController::show/$1');
    $routes->post('match', 'MatchesController::create');
