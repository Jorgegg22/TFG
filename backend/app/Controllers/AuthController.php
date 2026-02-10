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





        $token = bin2hex(random_bytes(32));

        $data = [
            'nombre' => $userData->name,
            'email' => $userData->email,
            'password' => password_hash($userData->password, PASSWORD_BCRYPT),
            'token' => $token,
       
        ];



        $usuarioModel->insert($data);
        return $this->respondCreated([
            'status' => 'success',
            'nombre' => $userData->name,
            'token' => $token
        ]);
    }

    public function insertRol()
    {
        $token = $this->request->getHeaderLine('X-API-TOKEN');
        $userData = $this->request->getJSON();

        if (!$token) {
            return $this->failUnauthorized('No se proporcionó token');
        }

        $usuarioModel = new UsuariosModel();
        $usuario = $usuarioModel->where('token', $token)->first();
        if (!$usuario) {
            return $this->failNotFound('Usuario no encontrado o sesión inválida');
        }

        $data = [
            'rol' => $userData->rol
        ];

        $usuarioModel->update($usuario['id'], $data);

        return $this->respond([
            'status' => 'success',
            'message' => 'Rol guardado correctamente',
            'rol' => $userData->rol
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


        $token = bin2hex(random_bytes(32));

        $usuarioModel->update($usuario['id'], [
            'token' => $token,
  
        ]);



        return $this->respond([
            'status' => 'success',
            'message' => 'Rol guardado correctamente',
            'token' => $token,
            'nombre' => $usuario['nombre'],
            'rol' => $usuario['rol']
        ]);
    }

    public function logout()
    {
       
        $token = $this->request->getServer('HTTP_X_API_TOKEN') ?? session()->get('token');
        $usuarioModel = new UsuariosModel();

       

        $usuario = $usuarioModel->where('token', $token)->first();
        

       if ($usuario) {
        $rol = $usuario['rol'];

        $usuarioModel->update($usuario['id'], [
            'token' => null
        ]);

        

        if ($rol === "admin") {
            return redirect()->to('http://localhost:4200/login');
        }
    }

        $this->respond(['status' => 'success', 'mensaje' => 'Sesión cerrada en servidor']);
       
        
    }





}