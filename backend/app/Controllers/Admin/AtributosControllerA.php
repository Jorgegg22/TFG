<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AtributosModel;

class AtributosControllerA extends BaseController
{
    

    public function index()
    {
        $atributosModel = new AtributosModel();

        $atributos = $atributosModel-> getAtributos();
     
        $data = [
            'atributos' => $atributos
        ];

        return view('panel/templates/header').
        view('panel/atributos/gestionAtributos',$data).
        view('panel/templates/footer');
    }


    public function crear()
    {
        return view('panel/templates/header').
        view('panel/atributos/formAtributos').
        view('panel/templates/footer');
    }

    public function editar($id = null)
    {
        $atributosModel = new AtributosModel();

        $atributos = $atributosModel-> getAtributos($id);

        $data = [
            'atributos' => $atributos
        ];

        return view('panel/templates/header').
        view('panel/usuarios/formAtributos',$data).
        view('panel/templates/footer');
    }

    public function guardar()
    {
        // Lógica para insertar o actualizar (POST)
    }

    public function borrar($id = null)
    {

        $atributosModel = new AtributosModel();
        $atributosModel -> delete($id);




        $mensaje =  'Atributo borrado Correctamente';
    
        return redirect()->to(base_url('admin/atributos'))->with('mensaje', $mensaje);
    
    
   }
}