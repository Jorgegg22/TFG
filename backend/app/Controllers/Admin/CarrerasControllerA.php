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
        view('panel/carreras/gestionCarreras',$data).
        view('panel/templates/footer');
    }
    public function crear()
    {
        return view('panel/templates/header').
        view('panel/carreras/formCarrera').
        view('panel/templates/footer');
    }

    public function editar($id = null)
    {
        $carrerasModel = new CarrerasModel();

        $carreras = $carrerasModel-> getCarreras($id);

        $data = [
            'carrera' => $carreras
        ];

        return view('panel/templates/header').
        view('panel/carreras/formCarrera',$data).
        view('panel/templates/footer');
    }

    public function guardar()
    {
        // Lógica para insertar o actualizar (POST)
    }

    public function borrar($id = null)
    {

        $carrerasModel = new CarrerasModel();
        $carrerasModel -> delete($id);



        $mensaje = 'Carrera borrada Correctamente';
    
        return redirect()->to(base_url('admin/carreras'))->with('mensaje', $mensaje);
    
    
   }
}