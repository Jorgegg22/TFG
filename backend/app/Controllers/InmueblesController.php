<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\InmueblesModel;

class InmueblesController extends ResourceController
{
    protected $modelName = 'App\Models\InmueblesModel';
    protected $format    = 'json';

    public function inmueblesLista()
    {

        $inmuebles = $this->model->getInmuebles();
        return $this->respond($inmuebles);

      
    }
    public function inmueblesListaAleatoria()
    {

        $inmueblesAleatorios = $this->model->getInmueblesAleatorios();
        return $this->respond($inmueblesAleatorios);

      
    }


    public function show($id = null)
    {
        $usuario = $this->model->getUsuarios($id);
        
        if (!$usuario) {
            return $this->failNotFound('Usuario no encontrado');
        }

        return $this->respond($usuario);
    }
}