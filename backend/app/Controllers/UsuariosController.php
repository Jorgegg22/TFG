<?php

namespace App\Controllers;

use App\Models\InmueblesModel;
use CodeIgniter\RESTful\ResourceController;
use App\Models\UsuariosModel;
use App\Models\AtributosModel;
use App\Models\AtributosUserModel;
use App\Models\SolicitudesModel;
use App\Models\MatchesModel;

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
        $fotoFinal = "avatar_default.png";

        if (!empty($userData->userPhoto)) {
            // Si manda algo y es una imagen real en Base64, la guardamos
            if (strpos($userData->userPhoto, 'data:image') !== false) {
                $fotoFinal = $this->guardarImagen($userData->userPhoto);
            }

        }

        $data = [
            'telefono' => $userData->userPhone,
            'descripcion' => $userData->userDescription,
            'foto_perfil' => $fotoFinal,
            'id_carrera' => (!empty($userData->userCareer)) ? $userData->userCareer : null,
            'universidad_id' => (!empty($userData->userUni)) ? $userData->userUni : null,
        ];

        $usuarioModel->update($userId, $data);

        return $this->respondCreated([
            'status' => 'success',
            'mensaje' => 'Perfil completado correctamente'
        ]);

    }

    public function guardarImagen($imagen)
    {
        if (empty($imagen)) {
            return $this->respond(["mensaje" => "Falta una imagen"], 500);
        }

        //COMPROBAR SI VIENE CON DATA:IMAGE
        if (strpos($imagen, ',') !== false) {
            // SEPARAR STRING EN TIPO Y EL NOMBRE USANDO ;
            @list($type, $imagen) = explode(';', $imagen);
            // IMAGEN base64,iVBORw0KGgoAAAANSUhEUgAA... SE ELIMINA ANTES DE LA COMA,SE GUARDA IMAGEN
            @list(, $imagen) = explode(',', $imagen);
        }
        //CONTENIDO BINARIO DE LA IMAGEN
        $img = base64_decode($imagen);
        $rutaCarpeta = FCPATH . 'uploads/perfiles/';

        if (!is_dir($rutaCarpeta)) {
            mkdir($rutaCarpeta, 0777, true);
        }

        //NOMBRE ALEATORIO PARA ASOCIAR CON LOS DATOS $IMG
        $nombreFinal = bin2hex(random_bytes(10)) . '.jpg';
        $rutaCompleta = $rutaCarpeta . $nombreFinal;

        //SE METE LOS DATOS DE $IMG EN RUTACOMPLET  => /RUTA/NOMBREFINAL
        if (file_put_contents($rutaCompleta, $img)) {
            return $nombreFinal; //Nombre para la db
        }

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
        $rol = $sesionActiva['rol'];

        if (!$userId) {
            return $this->failUnauthorized('No hay id');
        }

        if ($rol === "estudiante") {
            // DATOS PAGINA SOLICITUDES
            $solicitudesInmuebles = $model->getSolicitudesUsuario($userId);
        } else if ($rol === "propietario") {
            // DATOS HOME PROPIETARIO
            $solicitudesInmuebles = $model->getSolicitudesPropietario($userId);
        }


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

    public function eliminarSolicitud()
    {
        $data = $this->request->getJSON();

        if (!$data || !isset($data->idSol)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'No se recibió el ID de la solicitud',
                'debug' => $data // Esto te ayudará a ver qué llega realmente
            ]);
        }

        $idSolicitud = $data->idSol;

        $solicitudesModel = new SolicitudesModel();

        $solicitudesModel->delete($idSolicitud);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Solicitud eliminada correctamente'
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


    public function getInmueblesPropietario($id = null)
    {


        $token = $this->request->getHeaderLine('X-API-TOKEN');
        $model = new UsuariosModel();
        $inmuebleModel = new InmueblesModel();



        $sesionActiva = $model->where('token', $token)
            ->first();



        if (!$sesionActiva) {
            return $this->failUnauthorized('Debes estar logueado para ver perfiles');
        }

        if ($id === null) {
            $id = $sesionActiva['id'];
        }

        $inmueblesPropietario = $inmuebleModel->getInmueblesPropietario($id);

        return $this->respond(
            $inmueblesPropietario
        );




    }





    public function crearMatch()
    {
        $data = $this->request->getJSON();

        if (!$data) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'No se recibieron datos']);
        }

        $solicitudesModel = new SolicitudesModel();
        $matchesModel = new MatchesModel();

        $solicitudesModel->update($data->solicitud_id, [
            'estado' => 'aceptado'
        ]);

        $matchesModel->insert([
            'estudiante_id' => $data->estudiante_id,
            'inmueble_id' => $data->inmueble_id,
            'fecha_match' => date('Y-m-d H:i:s')
        ]);

        $dataMatch = [
            'estudiante_id' => $data->estudiante_id,
            'inmueble_id' => $data->inmueble_id,
            'fecha_match' => date('Y-m-d H:i:s')
        ];

        $matchesModel->insert($dataMatch);


        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Match creado correctamente'
        ]);
    }


    public function rechazarSolicitud()
    {
        $data = $this->request->getJSON();

        if (!$data) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'No se recibieron datos']);
        }

        $solicitudesModel = new SolicitudesModel();

        $solicitudesModel->update($data->solicitud_id, [
            'estado' => 'rechazado'
        ]);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Solicitud rechazada correctamente'
        ]);
    }


    public function getUltimasNotificaciones()
    {

        $data = $this->request->getJSON();
        $solicitudesModel = new SolicitudesModel();

        if (!$data || !isset($data->id)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'No se recibió el ID del usuario o el JSON está mal formado'
            ]);
        }

        $idUsuario = $data->id;
        if (!$idUsuario) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'No se ha recibido id']);
        }
        $notificaciones = $solicitudesModel->getNotificaciones($idUsuario);




        return $this->respond(
            $notificaciones
        );
    }


    public function updatePerfil()
    {
        $token = $this->request->getHeaderLine('X-API-TOKEN');
        $model = new UsuariosModel();

        $usuario = $model->where('token', $token)->first();

        if (!$usuario) {
            return $this->failUnauthorized('Sesión no válida');
        }

        $userData = $this->request->getJSON();

        $fotoFinal = $usuario['foto_perfil'];


        if (!empty($userData->foto_perfil)) {
            $rutaCarpeta = FCPATH . "/uploads/perfiles/";
            unlink( $rutaCarpeta . $usuario['foto_perfil']);
            
            if (strpos($userData->foto_perfil, 'data:image') !== false) {
                $fotoFinal = $this->guardarImagen($userData->foto_perfil);
            }

        }

        $data = [
            'nombre' => $userData->nombre ?? $usuario['nombre'],
            'email' => $userData->email ?? $usuario['email'],
            'telefono' => $userData->telefono ?? $usuario['telefono'],
            'descripcion' => $userData->descripcion ?? $usuario['descripcion'],
            'foto_perfil' => $fotoFinal
        ];

        if (isset($userData->universidad_id)) {
            $data['universidad_id'] = $userData->universidad_id;
        }

        if (isset($userData->id_carrera)) {
            $data['id_carrera'] = $userData->id_carrera;
        }






        if ($model->update($usuario['id'], $data)) {
            return $this->respondUpdated([
                'status' => 200,
                'message' => 'Perfil actualizado correctamente'
            ]);
        }

        return $this->fail('No se pudo actualizar el perfil');
    }

}