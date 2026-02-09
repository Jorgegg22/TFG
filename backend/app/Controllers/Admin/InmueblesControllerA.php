<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\InmueblesModel; // Asumiendo que crearás este modelo

class InmueblesControllerA extends BaseController
{
    

    public function index()
    {
        $inmueblesModel = new InmueblesModel();

        $inmuebles = $inmueblesModel-> getInmuebles();
     
        $data = [
            'inmuebles' => $inmuebles
        ];

        return view('panel/templates/header').
        view('panel/inmuebles/gestionInmuebles',$data);
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

        $inmueblesModel = new InmueblesModel();
        $inmueblesModel -> delete($id);


        return view('panel/templates/header').
        view('panel/inmuebles/gestionInmuebles',[
            'mensaje' => 'Inmueble borrado Correctamente'
        ]);
    
    
   }
}