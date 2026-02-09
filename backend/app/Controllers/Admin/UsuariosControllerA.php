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
     
        $data = [
            'usuarios' => $usuarios
        ];

        return view('panel/templates/header').
        view('panel/usuarios/gestionUsuarios',$data);
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

        $usuariosModel = new UsuariosModel();
        $usuario = $usuariosModel->getUsuarios($id);
        $rol = $usuario['rol'];

        $usuariosModel -> delete($id);


        if($rol === "estudiante"){
             return view('panel/templates/header').
        view('panel/usuarios/gestionUsuarios',[
            'mensaje' => 'Usuario(estudiante) borrado Correctamente. También se han eliminado sus solicitudes y matches asociados.'
        ]);
        }else{
                  return view('panel/templates/header').
        view('panel/usuarios/gestionUsuarios',[
            'mensaje' => 'Usuario(propietario) Correctamente. También se han eliminado inmuebles ,las solicitudes y los matches asociados a sus inmuebles.'
        ]);
        }
       
    
    
   }
}