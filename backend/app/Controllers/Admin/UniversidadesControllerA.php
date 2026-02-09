<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UniversidadesModel; 

class UniversidadesControllerA extends BaseController
{
  

    public function index()
    {
        $universidadModel = new UniversidadesModel();

        $universidades = $universidadModel-> getUniversidades();
     
        $data = [
            'universidades' => $universidades
        ];

        return view('panel/templates/header').
        view('panel/universidades/gestionUniversidades',$data);
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

        $universidadesModel = new UniversidadesModel();
        $universidadesModel -> delete($id);


        return view('panel/templates/header').
        view('panel/universidades/gestionUniversidades',[
            'mensaje' => 'Universidad borrada Correctamente'
        ]);
    
    
   }
}