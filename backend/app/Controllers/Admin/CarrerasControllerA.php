<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CarrerasModel; 

class CarrerasControllerA extends BaseController
{
    
     public function index()
    {
        $carrerasModel = new CarrerasModel();

        $carreras = $carrerasModel-> getCarreras();
     
        $data = [
            'carreras' => $carreras
        ];

        return view('panel/templates/header').
        view('panel/carreras/gestionCarreras',$data);
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

        $carrerasModel = new CarrerasModel();
        $carrerasModel -> delete($id);


        return view('panel/templates/header').
        view('panel/carreras/gestionCarreras',[
            'mensaje' => 'Carrera borrada Correctamente'
        ]);
    
    
   }
}