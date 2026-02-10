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



        if (session()->get('logged') && session()->get('rol') === 'admin') {
            return $this->cargarView();
        }



        $tokenSesion = $this->request->getGet("tkn");

        if (empty($tokenSesion)) {
            dd("Error: El token no llega por la URL (tkn está vacío)");
        }

        $usuariosModel = new UsuariosModel();

        // Buscar usuario por token (ajusta el campo si es distinto)
        $usuario = $usuariosModel
            ->where('token', $tokenSesion)
            ->first();



        if (!$usuario) {
            return redirect()->to('http://localhost:4200/login');
        }

        if ($usuario['rol'] !== 'admin') {
            return redirect()->to('http://localhost:4200/login');
        }


        // Guardar sesión correctamente
        session()->set([
            'id' => $usuario['id'],
            'nombre' => $usuario['nombre'],
            'rol' => $usuario['rol'],
            'logged' => true,
            'token' => $usuario['token']
        ]);

        return $this->cargarView();





    }


    function cargarView()
    {
        $usuariosModel = new UsuariosModel();
        $inmueblesModel = new InmueblesModel();
        $matchesModel = new MatchesModel();

        $data = [
            'usuarios' => $usuariosModel->findAll(),
            'inmuebles' => $inmueblesModel->getInmuebles(),
            'matches' => $matchesModel->findAll()
        ];

        return view('panel/templates/header')
            . view('panel/index', $data)
            . view('panel/templates/footer');
    }
}