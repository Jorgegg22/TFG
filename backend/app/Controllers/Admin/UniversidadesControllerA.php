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
        view('panel/universidades/gestionUniversidades',$data).
        view('panel/templates/footer');
    }
    public function crear()
    {

        

        return view('panel/templates/header').
        view('panel/universidades/formUniversidad').
        view('panel/templates/footer');
    }
    

    public function editar($id = null)
    {
        $universidadesModel = new UniversidadesModel();
        $universidades =  $universidadesModel -> getUniversidades($id);

        $data = [
            'universidad' => $universidades
        ];

        return view('panel/templates/header').
        view('panel/universidades/formUniversidad',$data).
        view('panel/templates/footer');
    }

    public function guardar()
    {
        $universidadesModel = new UniversidadesModel();
        $id = $this->request->getPost('id');
        
        $reglas = [
            'nombre' => "required|min_length[3]|max_length[100]|is_unique[universidades.nombre,id,{$id}]",
            'siglas' => "required",
            'ciudad' => "required"
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errores', $this->validator->getErrors());
            
        };


        $datos = [
            'nombre' => $this->request->getPost('nombre'),
            'siglas' =>   strtoupper($this->request->getPost('siglas')) ,
            'ciudad' => $this->request->getPost('ciudad')
        ];

        if ($id) {
        $universidadesModel->update($id, $datos);
        $mensaje = 'Universidad actualizada correctamente.';
    } else {
        $universidadesModel->insert($datos);
        $mensaje = 'Universidad creado con éxito.';
    }
    
     return redirect()->to(base_url('admin/universidades'))->with('mensaje', $mensaje);
    }

    
    public function borrar($id = null)
    {

        $universidadesModel = new UniversidadesModel();
        $universidadesModel -> delete($id);


        $mensaje = 'Universidad borrada Correctamente';
    
        return redirect()->to(base_url('admin/universidades'))->with('mensaje', $mensaje);

   }
}