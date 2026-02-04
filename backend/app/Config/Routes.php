<?php



// Rutas
use App\Controllers\UsuariosController;
use App\Controllers\UniversidadesController;
use App\Controllers\InmueblesController;
use App\Controllers\AuthController;


//Rutas Admin
use App\Controllers\InmueblesControllerA;
use App\Controllers\UniversidadesControllerA;


use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


// REGISTRO , LOGIN Y AUTENTICACIÓN

    $routes->post('api/auth/register', [AuthController::class,'registro']);
    $routes->post('api/auth/rol', [AuthController::class,'insertRol']);
    $routes->post('api/auth/login', [AuthController::class,'checkUser']);


// USUARIOS RUTAS
    $routes->get('api/usuarios', [UsuariosController::class,'index']);
    $routes->post('api/usuarios/usuario', [UsuariosController::class,'getUsuarioById']);
        $routes->post('api/usuarios/guardarDatos', [UsuariosController::class,'complete']);
    $routes->get('api/atributos', [UsuariosController::class,'getAtributos']);
    $routes->post('api/atributos/send', [UsuariosController::class,'setAtributos']);


//UNIVERSIDADES RUTAS    
    $routes->get('api/universidades', [UniversidadesController::class,'universidadesLista']);
    $routes->get('api/carreras', [UniversidadesController::class,'carrerasLista']);

//INMUEBLES RUTAS    
    $routes->get('api/inmuebles/lista', [InmueblesController::class, 'inmueblesLista']);
    $routes->get('api/inmuebles/listaAleatoria', [InmueblesController::class, 'inmueblesListaAleatoria']);



$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function($routes) {
    $routes->get('admin/index', 'Dashboard::index'); 
    $routes->get('admin/usuarios', 'Users::index');         
});


    $routes->post('match', 'MatchesController::create');
