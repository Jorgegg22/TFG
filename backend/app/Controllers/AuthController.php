<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UsuariosModel;

class AuthController extends ResourceController
{
    protected $modelName = 'App\Models\UsuariosModel';
    protected $format = 'json';

    /* public function index()
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
    } */

    public function registro()
    {
        $userData = $this->request->getJSON();

        // Comprobar si ha lleado bien
        if (!$userData) {
            return $this->fail('No se han recibido datos', 400);
        }

        $usuarioModel = new UsuariosModel();

        $existe = $usuarioModel->where('email', $userData->email)->first();
        if ($existe) {
            return $this->fail('El email ya esta registrado', 409);
        }



        $data = [
            'nombre' => $userData->name,
            'email' => $userData->email,
            'password' => password_hash($userData->password, PASSWORD_BCRYPT),
        ];


        // Insertamos data y cogemos el id del usuario recien registrado
        $usuarioModel->insert($data);
        $newId = $usuarioModel->getInsertID();
        return $this->respondCreated(['status' => 'success', 'mensaje' => 'Usuario creado correctamente', 'id' => $newId]);

    }

    public function insertRol()
    {
        $userData = $this->request->getJSON();
        $usuarioModel = new UsuariosModel();
        $id  = $userData->id;
        $data = [
            'rol' => $userData->rol
        ]; 

        if (!$id) {
            return $this->fail('ID no proporcionado', 400);
        }
        
       $usuarioModel -> update($id,$data);
       return $this->respond([
            'status' => 'success',
            'message' => 'Rol guardado correctamente',
            'rol' => $userData -> rol
        ]);
    }


    public function checkUser()
    {
        $userData = $this->request->getJSON();

        $usuarioModel = new UsuariosModel();

        $usuario = $usuarioModel->where('email', $userData->email)->first();
        if (!$usuario) {
            return $this->fail('El email no esta registrado', 409);
        }

        $verify = password_verify($userData->password, $usuario['password']);

        if (!$verify) {
        return $this->fail('Contraseña incorrecta', 401);
    }
    
      
        
    
       return $this->respond([
            'status' => 'success',
            'message' => 'Rol guardado correctamente',
            'id' => $usuario['id'],
            'nombre' => $usuario['nombre'],
            'email' => $usuario['email'],
            'rol' => $usuario['rol']             
        ]);
    }
    




}