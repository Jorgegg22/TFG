<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UniversidadesModel;

class UniversidadesController extends ResourceController
{
    protected $modelName = 'App\Models\UniversidadesModel';
    protected $format    = 'json';

    public function universidadesLista()
    {

        $universidades = $this->model->getUniversidades();
        return $this->respond($universidades);
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