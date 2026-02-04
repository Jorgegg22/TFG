<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UsuariosModel;
use App\Models\AtributosModel;
use App\Models\AtributosUserModel;

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


    public function  getUsuarioById(){
    $userId = $this->request->getJson();

    $usuarioModel = new UsuariosModel();

    $usuario = $usuarioModel->getUsuarios($userId);

    return $this->respondCreated([
        'status'  => 'success',
        'mensaje' => 'Usuario obtenido correctamente',
        'data' => $usuario
        
    ]);



    }

    public function getAtributos(){
        
    $atributosModel = new AtributosModel();
    $atributos = $atributosModel -> getAtributos();
    return $this-> respond($atributos); 
    

    }

    public function setAtributos(){
        $userData = $this->request->getJson();
        
        
        $atributosUserModel = new AtributosUserModel();
        if(!$userData){
            return $this->failNotFound('No se han seleccionado atributos');
        }
        $userId = $userData->userId;
        $atributosArray = $userData->atributosSelected;

        foreach($atributosArray as $atributoId){
            $data = [
                'usuario_id' => $userId,
                'atributo_id' => $atributoId
            ];

            $atributosUserModel -> insert($data);
            
        }

        return $this->respondCreated([
        'status'  => 'success',
        'mensaje' => 'Atributos insertados correctamente'
    ]);

    }


    public function complete(){
        $userData = $this->request->getJson();
        $model = new UsuariosModel();
        if(!$userData){
            return $this->failNotFound('No se han seleccionado atributos');
        }

        // $data = {
        //     'universidad_id' => $userData->id_uni,

        // }

    }


        


    
}