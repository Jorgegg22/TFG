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
        $carrerasModel = new CarrerasModel();
        $id = $this->request->getPost('id');

        $reglas = [
            'nombre' => "required|min_length[3]|max_length[100]|is_unique[carreras.nombre,id,{$id}]",

        
        ];


        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errores', $this->validator->getErrors());}

        $datos = [
        'nombre'         => $this->request->getPost('nombre'),
    ];

  

        if ($id) {
        $carrerasModel->update($id, $datos);
        $mensaje = 'Carrera actualizada correctamente.';
    } else {
        $carrerasModel->insert($datos);
        $mensaje = 'Carrera creada con éxito.';
    }
        return redirect()->to(base_url('admin/carreras'))->with('mensaje', $mensaje);
    }

    public function borrar($id = null)
    {

        $carrerasModel = new CarrerasModel();
        $carrerasModel -> delete($id);



        $mensaje = 'Carrera borrada Correctamente';
    
        return redirect()->to(base_url('admin/carreras'))->with('mensaje', $mensaje);
    
    
   }
}