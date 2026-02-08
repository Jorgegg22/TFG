<?php



// Rutas
use App\Controllers\UsuariosController;
use App\Controllers\UniversidadesController;
use App\Controllers\InmueblesController;
use App\Controllers\AuthController;


//Rutas Admin
use App\Controllers\Admin\AdminController;
use App\Controllers\Admin\InmueblesControllerA;
use App\Controllers\Admin\UniversidadesControllerA;
use App\Controllers\Admin\AtributosControllerA;
use App\Controllers\Admin\UsuariosControllerA;
use App\Controllers\Admin\CarrerasControllerA;


use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


// REGISTRO , LOGIN ,AUTENTICACIÓN Y LOGOUT

$routes->post('api/auth/register', [AuthController::class, 'registro']);
$routes->post('api/auth/rol', [AuthController::class, 'insertRol']);
$routes->post('api/auth/login', [AuthController::class, 'checkUser']);
$routes->get('api/auth/logout', [AuthController::class, 'logout']);


// USUARIOS RUTAS
$routes->get('api/usuarios', [UsuariosController::class, 'index']);
$routes->get('api/usuarios/usuario', [UsuariosController::class, 'getUsuarioByToken']);
$routes->post('api/usuarios/guardarDatos', [UsuariosController::class, 'complete']);
$routes->get('api/atributos', [UsuariosController::class, 'getAtributos']);
$routes->post('api/atributos/send', [UsuariosController::class, 'setAtributos']);
$routes->get('api/usuarios/solicitudes', [UsuariosController::class, 'solicitudesUsuario']);
$routes->get('api/usuarios/perfil', [UsuariosController::class, 'getPerfilUsuario']); // Para el perfil propio
$routes->get('api/usuarios/perfil/(:num)', [UsuariosController::class, 'getPerfilUsuario/$1']);



//UNIVERSIDADES RUTAS    
$routes->get('api/universidades', [UniversidadesController::class, 'universidadesLista']);
$routes->get('api/carreras', [UniversidadesController::class, 'carrerasLista']);

//INMUEBLES RUTAS    
$routes->get('api/inmuebles/lista', [InmueblesController::class, 'inmueblesLista']);
$routes->get('api/inmuebles/listaUni', [InmueblesController::class, 'inmueblesFiltradoUniversidad']);
$routes->get('api/inmuebles/listaAleatoria', [InmueblesController::class, 'inmueblesListaAleatoria']);
$routes->get('api/inmuebles/inmuebleDetalle/(:num)', [InmueblesController::class, 'inmuebleDetalle']);
$routes->post('api/inmuebles/postSolicitud', [InmueblesController::class, 'postSolicitud']);



$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    $routes->get('/', [AdminController::class, 'index']); 

    // USUARIOS
    $routes->get('usuarios', [UsuariosControllerA::class, 'index']);
    $routes->get('usuarios/crear', [UsuariosControllerA::class, 'crear']);
    $routes->get('usuarios/editar/(:num)', [UsuariosControllerA::class, 'editar/$1']);
    $routes->post('usuarios/guardar', [UsuariosControllerA::class, 'guardar']);
    $routes->get('usuarios/borrar/(:num)', [UsuariosControllerA::class, 'borrar/$1']);

    // INMUEBLES
    $routes->get('inmuebles', [InmueblesControllerA::class, 'index']);
    $routes->get('inmuebles/crear', [InmueblesControllerA::class, 'crear']);
    $routes->get('inmuebles/editar/(:num)', [InmueblesControllerA::class, 'editar/$1']);
    $routes->post('inmuebles/guardar', [InmueblesControllerA::class, 'guardar']);
    $routes->get('inmuebles/borrar/(:num)', [InmueblesControllerA::class, 'borrar/$1']);

    // UNIVERSIDADES
    $routes->get('universidades', [UniversidadesControllerA::class, 'index']);
    $routes->get('universidades/crear', [UniversidadesControllerA::class, 'crear']);
    $routes->get('universidades/editar/(:num)', [UniversidadesControllerA::class, 'editar/$1']);
    $routes->post('universidades/guardar', [UniversidadesControllerA::class, 'guardar']);
    $routes->get('universidades/borrar/(:num)', [UniversidadesControllerA::class, 'borrar/$1']);

    // CARRERAS
    $routes->get('carreras', [CarrerasControllerA::class, 'index']);
    $routes->get('carreras/crear', [CarrerasControllerA::class, 'crear']);
    $routes->get('carreras/editar/(:num)', [CarrerasControllerA::class, 'editar/$1']);
    $routes->post('carreras/guardar', [CarrerasControllerA::class, 'guardar']);
    $routes->get('carreras/borrar/(:num)', [CarrerasControllerA::class, 'borrar/$1']);

    // ATRIBUTOS
    $routes->get('atributos', [AtributosControllerA::class, 'index']);
    $routes->get('atributos/crear', [AtributosControllerA::class, 'crear']);
    $routes->get('atributos/editar/(:num)', [AtributosControllerA::class, 'editar/$1']);
    $routes->post('atributos/guardar', [AtributosControllerA::class, 'guardar']);
    $routes->get('atributos/borrar/(:num)', [AtributosControllerA::class, 'borrar/$1']);
});


$routes->post('match', 'MatchesController::create');
