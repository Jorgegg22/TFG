<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\AtributosModel;
use App\Models\UsuariosModel;
use App\Models\InmueblesModel;
use App\Models\MatchesModel;

class AdminController extends BaseController
{
   public function index()
{
    $tokenSesion = $this->request->getGet("tkn");

    $usuariosModel   = new UsuariosModel();
    $inmueblesModel  = new InmueblesModel();
    $matchesModel    = new MatchesModel();

    // Buscar usuario por token (ajusta el campo si es distinto)
    $usuario = $usuariosModel
        ->where('token', $tokenSesion)
        ->first();

    
    if (!$usuario) {
        return redirect()->to('http://localhost:4200/login');
    }

    // Guardar sesión correctamente
    session()->set([
        'id'     => $usuario['id'],
        'nombre' => $usuario['nombre'],
        'rol'    => $usuario['rol'],
        'logged' => true,
        'token' => $usuario['token']
    ]);

  
    if ($usuario['rol'] !== 'admin') {
        return redirect()->to('http://localhost:4200/login');
    }


    $data = [
        'usuarios'  => $usuariosModel->findAll(),
        'inmuebles' => $inmueblesModel->getInmuebles(),
        'matches'   => $matchesModel->findAll()
    ];

    return view('panel/templates/header')
        . view('panel/index', $data)
        . view('panel/templates/footer');
}
}