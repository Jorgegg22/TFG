<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UsuariosModel; 

class UsuariosControllerA extends BaseController
{
    

    public function index()
    {
        $usuarioModel = new UsuariosModel();
        $usuarios = $usuarioModel ->getUsuarios();
        return view('panel/templates/header').
        view('panel/usuarios/gestionUsuarios',$usuarios);
    }

    public function crear()
    {
        // Lógica para mostrar formulario vacío
    }

    public function editar($id = null)
    {
        // Lógica para buscar registro y mostrar formulario relleno
    }

    public function guardar()
    {
        // Lógica para insertar o actualizar (POST)
    }

    public function borrar($id = null)
    {
        // Lógica para eliminar registro
    }
}