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
        
    }

    public function borrar($id = null)
    {

        $inmueblesModel = new InmueblesModel();
        $inmueblesModel -> delete($id);


     
    
        $mensaje = 'Inmueble borrado Correctamente';
    
        return redirect()->to(base_url('admin/inmuebles'))->with('mensaje', $mensaje);
   }
}