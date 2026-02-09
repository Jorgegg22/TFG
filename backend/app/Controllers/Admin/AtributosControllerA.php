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
        view('panel/atributos/gestionAtributos',$data);
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

        $atributosModel = new AtributosModel();
        $atributosModel -> delete($id);


        return view('panel/templates/header').
        view('panel/atributos/gestionAtributos',[
            'mensaje' => 'Atributo borrado Correctamente'
        ]);
    
    
   }
}