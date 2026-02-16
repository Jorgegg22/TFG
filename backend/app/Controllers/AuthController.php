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

        $regexFuerte = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';

        $rules = [
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[usuarios.email]',
            'password' => "required|regex_match[$regexFuerte]"
        ];

        $messages = [
            'password' => [
                'regex_match' => 'La contraseña debe tener al menos 8 caracteres, una mayúscula, un número y un carácter especial.'
            ],
            'email' => [
                'is_unique' => 'El email ya esta registrado'
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            // Primer error
            $error = current($this->validator->getErrors());
            return $this->fail($error, 400);
        }

        $usuarioModel = new UsuariosModel();

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

        $token = session()->get('token');
        if ($token) {
            $usuarioModel = new UsuariosModel();
            $usuarioModel->where('token', $token)->set(['token' => null])->update();
        }

        session()->destroy();


        return redirect()->to('https://jorgegomez.com.es/univibe/');
    }





}