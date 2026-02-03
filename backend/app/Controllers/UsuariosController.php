<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UsuariosModel;
use App\Models\AtributosModel;

class UsuariosController extends ResourceController
{
    protected $modelName = 'App\Models\UsuariosModel';
    protected $format    = 'json';

    public function index()
    {

        $usuarios = $this->model->getUsuarios();
        return $this->respond($usuarios);
    }

    public function show($id = null)
    {
        $usuario = $this->model->getUsuarios($id);
        
        if (!$usuario) {
            return $this->failNotFound('Usuario no encontrado');
        }

        return $this->respond($usuario);
    }

    public function getAtributos(){
        
    $atributosModel = new AtributosModel();
    $atributos = $atributosModel -> getAtributos();
    return $this-> respond($atributos); 
        

    }

    public function setAtributos(){
        $data = $this->request->getJson();

        
    }


    
}