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
        view('panel/atributos/formAtributos',$data).
        view('panel/templates/footer');
    }

    public function guardar()
    {
        $atributosModel = new AtributosModel();
        $id = $this->request->getPost('id');

        $reglas = [
            'nombre' => "required|is_unique[atributos.nombre,id,{$id}]",
            'icono' => "required"
        
        ];


        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errores', $this->validator->getErrors());}

        $datos = [
        'nombre' => $this->request->getPost('nombre'),
        'icono' => $this->request->getPost('icono')
    
            ];

        if ($id) {
        $atributosModel->update($id, $datos);
        $mensaje = 'Usuario actualizado correctamente.';
    } else {
        $atributosModel->insert($datos);
        $mensaje = 'Carrera creada con éxito.';
    }
        return redirect()->to(base_url('admin/atributos'))->with('mensaje', $mensaje);
    }

    public function borrar($id = null)
    {

        $atributosModel = new AtributosModel();
        $atributosModel -> delete($id);




        $mensaje =  'Atributo borrado Correctamente';
    
        return redirect()->to(base_url('admin/atributos'))->with('mensaje', $mensaje);
    
    
   }
}