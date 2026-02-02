<?php



// Rutas
use App\Controllers\UsuariosController;
use App\Controllers\UniversidadesController;
use App\Controllers\InmueblesController;


//Rutas Admin
use App\Controllers\InmueblesControllerA;
use App\Controllers\UniversidadesControllerA;


use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');



// USUARIOS RUTAS
    $routes->get('api/usuarios', [UsuariosController::class,'index']);


//UNIVERSIDADES RUTAS    
    $routes->get('api/universidades', [UniversidadesController::class,'universidadesLista']);


//INMUEBLES RUTAS    
    $routes->get('api/inmuebles', [InmueblesController::class, 'inmueblesLista']);



$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function($routes) {
    $routes->get('admin/index', 'Dashboard::index'); 
    $routes->get('admin/usuarios', 'Users::index');         
});


    $routes->post('match', 'MatchesController::create');
