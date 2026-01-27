<?php

use App\Controllers\UsuariosController;
use App\Controllers\UniversidadesController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


    $routes->get('api/usuarios', [UsuariosController::class,'index']);
    $routes->get('api/universidades', [UniversidadesController::class,'universidadesLista']);
    $routes->post('match', 'MatchesController::create');
