<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\InmueblesModel; 
use App\Models\UniversidadesModel; 

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
        view('panel/inmuebles/gestionInmuebles',$data).
        view('panel/templates/footer');
    }

    public function crear()
    {

        $uniModel = new UniversidadesModel();

        $data = [
            'universidades' => $uniModel -> getUniversidades()
        ];

        return view('panel/templates/header').
        view('panel/inmuebles/formInmueble',$data).
        view('panel/templates/footer');
    }

    public function editar($id = null)
{
    $inmueblesModel = new InmueblesModel();
    $uniModel = new UniversidadesModel();

    $inmueble = $inmueblesModel->find($id);

    $data = [
        'inmueble'      => $inmueble,
        'universidades' => $uniModel->getUniversidades()
    ];

    return view('panel/templates/header') .
           view('panel/inmuebles/formInmueble', $data) .
           view('panel/templates/footer');
}

    public function guardar()
    {
        $inmueblesModel = new InmueblesModel();
        $id = $this->request->getPost('id');

        $reglas = [
            'titulo' => "required|",
            'direccion' => "required|min_length[3]|max_length[100]|is_unique[inmuebles.titulo,id,{$id}]",
            'descripcion' => "required|min_length[3]|max_length[100]|is_unique[carreras.nombre,id,{$id}]",
            'precio' => "required|numeric",
            'metros' => "required|min_length[3]|max_length[100]|is_unique[carreras.nombre,id,{$id}]",
            'habitaciones' => "required|min_length[3]|max_length[100]|is_unique[carreras.nombre,id,{$id}]",
            'banios' => "required|min_length[3]|max_length[100]|is_unique[carreras.nombre,id,{$id}]",
            'n_personas' => "required|min_length[3]|max_length[100]|is_unique[carreras.nombre,id,{$id}]",
            'universidad_id' => "required|min_length[3]|max_length[100]|is_unique[carreras.nombre,id,{$id}]",
            'imagen' => "required|min_length[3]|max_length[100]|is_unique[carreras.nombre,id,{$id}]",

        
        ];


        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errores', $this->validator->getErrors());}

        $datos = [
        'nombre'         => $this->request->getPost('nombre'),
        '' => $this->request->getPost('nombre'),
        '' => $this->request->getPost('nombre'),
        '' => $this->request->getPost('nombre'),
        '' => $this->request->getPost('nombre'),
        '' => $this->request->getPost('nombre'),
        '' => $this->request->getPost('nombre'),
        '' => $this->request->getPost('nombre'),
        '' => $this->request->getPost('nombre'),
    ];

  

        if ($id) {
        $inmueblesModel->update($id, $datos);
        $mensaje = 'Inmueble actualizado correctamente.';
    } else {
        $inmueblesModel->insert($datos);
        $mensaje = 'Inmuebke creado con éxito.';
    }
        return redirect()->to(base_url('admin/carreras'))->with('mensaje', $mensaje);
    }

    public function borrar($id = null)
    {

        $inmueblesModel = new InmueblesModel();
        $inmueblesModel -> delete($id);


     
    
        $mensaje = 'Inmueble borrado Correctamente';
    
        return redirect()->to(base_url('admin/inmuebles'))->with('mensaje', $mensaje);
   }
}