<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\InmueblesModel; 
use App\Models\UniversidadesModel; 
use App\Models\UsuariosModel; 

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
        $usuarioModel = new UsuariosModel();

        

        $data = [
            'universidades' => $uniModel -> getUniversidades(),
            'propietarios' => $usuarioModel->where('rol','propietario')->findAll()
        ];

        return view('panel/templates/header').
        view('panel/inmuebles/formInmueble',$data).
        view('panel/templates/footer');
    }

    public function editar($id = null)
{
    $inmueblesModel = new InmueblesModel();
    $uniModel = new UniversidadesModel();
    $usuarioModel = new UsuariosModel();


    $inmueble = $inmueblesModel->find($id);
    
    

    $data = [
        'inmueble'      => $inmueble,
        'universidades' => $uniModel->getUniversidades(),
        'propietarios' => $usuarioModel->where('rol','propietario')->findAll()
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
            'metros' => "required|",
            'habitaciones' => "required|",
            'banios' => "required|",
            'n_personas' => "required|",
            'universidad_id' => "required|",
            'propietario_id' => "required",
            // 'imagen_principal' => "required|min_length[3]|max_length[100]|is_unique[carreras.nombre,id,{$id}]",
            // 'imagen1' => "required|",
            // 'imagen2' => "required|",
            // 'imagen3' => "required|",
            // 'imagen4' => "required|",
        
        ];


        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errores', $this->validator->getErrors());}

        $datos = [
        'titulo'         => $this->request->getPost('titulo'),
        'descripcion' => $this->request->getPost('descripcion'),
        'direccion' => $this->request->getPost('direccion'),
        'precio' => $this->request->getPost('precio'),
        'imagen_principal' => $this->request->getPost('imagen_principal'),
        'imagen1' => $this->request->getPost('imagen1'),
        'imagen2' => $this->request->getPost('imagen2'),
        'imagen3' => $this->request->getPost('imagen3'),
        'imagen4' => $this->request->getPost('imagen4'),
        'propietario_id' => $this->request->getPost('propietario_id'),
        'universidad_id' => $this->request->getPost('universidad_id'),
        'metros' => $this->request->getPost('metros'),
        'habitaciones' => $this->request->getPost('habitaciones'),
        'banios' => $this->request->getPost('banios'),
        'n_personas' => $this->request->getPost('n_personas'),
    ];

  

        if ($id) {
        $inmueblesModel->update($id, $datos);
        $mensaje = 'Inmueble actualizado correctamente.';
    } else {
        $inmueblesModel->insert($datos);
        $mensaje = 'Inmueble creado con éxito.';
    }
        return redirect()->to(base_url('admin/inmuebles'))->with('mensaje', $mensaje);
    }

    public function borrar($id = null)
    {

        $inmueblesModel = new InmueblesModel();
        $inmueblesModel -> delete($id);


     
    
        $mensaje = 'Inmueble borrado Correctamente';
    
        return redirect()->to(base_url('admin/inmuebles'))->with('mensaje', $mensaje);
   }
}