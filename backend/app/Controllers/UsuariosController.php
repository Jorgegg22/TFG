<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UsuariosModel;
use App\Models\AtributosModel;
use App\Models\AtributosUserModel;

class UsuariosController extends ResourceController
{
    protected $modelName = 'App\Models\UsuariosModel';
    protected $format = 'json';

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


    public function getUsuarioByToken()
    {
        $token = $this->request->getHeaderLine('X-API-TOKEN');

        if (!$token) {
            return $this->failUnauthorized('No se proporcionó token');
        }

        $usuarioModel = new UsuariosModel();

        $usuarioSesion = $usuarioModel->where('token', $token)

            ->first();

        if (!$usuarioSesion) {
            return $this->failUnauthorized('Sesión inválida o expirada');
        }
        $usuarioData = $usuarioModel->getUsuarios($usuarioSesion['id']);





        unset($usuarioData['password']);
        unset($usuarioData['token']);

        return $this->respond([
            'status' => 'success',
            'mensaje' => 'Usuario obtenido correctamente',
            'data' => $usuarioData,

        ]);
    }

    public function getAtributos()
    {

        $atributosModel = new AtributosModel();
        $atributos = $atributosModel->getAtributos();
        return $this->respond($atributos);


    }

    public function setAtributos()
    {
        $token = $this->request->getHeaderLine('X-API-TOKEN');
        $userData = $this->request->getJSON();




        if (!$userData) {
            return $this->fail('No se han seleccionado atributos', 400);
        }
        $usuarioModel = new UsuariosModel();
        $usuario = $usuarioModel->where('token', $token)
            ->first();

        if (!$usuario) {
            return $this->failUnauthorized('Sesión inválida o expirada');
        }

        $atributosUserModel = new AtributosUserModel();
        $userId = $usuario['id'];
        $atributosArray = $userData->atributosSelected;

        foreach ($atributosArray as $atributoId) {
            $data = [
                'usuario_id' => $userId,
                'atributo_id' => $atributoId
            ];

            $atributosUserModel->insert($data);

        }

        return $this->respondCreated([
            'status' => 'success',
            'mensaje' => 'Atributos insertados correctamente'
        ]);

    }


    public function complete()
    {
        $token = $this->request->getHeaderLine('X-API-TOKEN');
        $userData = $this->request->getJson();
        $usuarioModel = new UsuariosModel();
       
        if (!$userData) {
            return $this->failNotFound('No se ha recibido informacion');
        }

        $usuario = $usuarioModel->where('token', $token)
            ->first();

        $userId = $usuario['id'];

        $data = [
            'telefono' => $userData->userPhone,
            'id_carrera' => $userData->userCareer,
            'descripcion' => $userData->userDescription,
            'universidad_id' => $userData->userUni
        ];

        $usuarioModel->update($userId, $data);

        return $this->respondCreated([
            'status' => 'success',
            'mensaje' => 'Perfil completado correctamente'
        ]);

    }

    public function solicitudesUsuario()
    {


        $token = $this->request->getHeaderLine('X-API-TOKEN');
        $model = new UsuariosModel();
        $sesionActiva = $model->where('token', $token)
            ->first();

        if (!$sesionActiva) {
            return $this->failUnauthorized('Sesión inválida o expirada');
        }



        $userId = $sesionActiva['id'];

        if (!$userId) {
            return $this->failUnauthorized('No hay id');
        }
        $solicitudesInmuebles = $model->getSolicitudesUsuario($userId);

        $data = [
            'inmuebles' => $solicitudesInmuebles
        ];

        $data = [
            'inmuebles' => $solicitudesInmuebles
        ];

        if (empty($data)) {
            return $this->respondCreated(['status' => 'failed', 'mensaje' => 'lista vacia']);
        }

        return $this->respondCreated([
            'status' => 'success',
            'mensaje' => 'Solcitudes traides correctamente',
            'data' => $data
        ]);


    }

    public function getPerfilUsuario($id = null)
    {


        $token = $this->request->getHeaderLine('X-API-TOKEN');
        $model = new UsuariosModel();



        $sesionActiva = $model->where('token', $token)
            ->first();

        if (!$sesionActiva) {
            return $this->failUnauthorized('Debes estar logueado para ver perfiles');
        }



        // Comprobar si es mi perfil,y luego poner targetId para saber que id acceder para coger Info
        //Booleano comprobando si soy yo,si soy yo coge el id de sesionActiva
        if ($id !== null && $id !== '') {

            $targetId = $id;
        } else {
            $targetId = $sesionActiva['id'];
        }

        $userProfile = $model->getUsuarios($targetId);

        if (!$userProfile) {
            return $this->failNotFound('Usuario no encontrado');
        }




        return $this->respond([
            'status' => 'success',
            'data' => ['perfil' => $userProfile]
        ]);
    }






}