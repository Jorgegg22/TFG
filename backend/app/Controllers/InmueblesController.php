<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\InmueblesModel;
use App\Models\UsuariosModel;
use App\Models\SolicitudesModel;

class InmueblesController extends ResourceController
{
    protected $modelName = 'App\Models\InmueblesModel';
    protected $format = 'json';

    public function inmueblesLista()
    {

        $token = $this->request->getHeaderLine('X-API-TOKEN');
        $usuarioModel = new UsuariosModel();

        $usuarioSesion = $usuarioModel->where('token', $token)
            ->first();

        $idUsuarioSesion = $usuarioSesion['id'];

        $modelInmueble = new InmueblesModel();
        $inmuebles = $modelInmueble->getInmueblesFiltrados($idUsuarioSesion);
        return $this->respond($inmuebles);


    }


    public function inmueblesFiltradoUniversidad()
    {

        $token = $this->request->getHeaderLine('X-API-TOKEN');
        $usuarioModel = new UsuariosModel();

        $usuarioSesion = $usuarioModel->where('token', $token)
            ->first();



        $idUsuarioSesion = $usuarioSesion['id'];

        $modelInmueble = new InmueblesModel();
        $inmueblesUni = $modelInmueble->getInmueblesFiltradoUni($idUsuarioSesion);

        return $this->respond($inmueblesUni);
    }
    public function inmueblesListaAleatoria()
    {

        $modelInmueble = new InmueblesModel();

        $token = $this->request->getHeaderLine('X-API-TOKEN');
        $usuarioModel = new UsuariosModel();

        $usuarioSesion = $usuarioModel->where('token', $token)
            ->first();

        $idUsuarioSesion = $usuarioSesion['id'];
        $inmueblesAleatorios = $modelInmueble->getInmueblesAleatorios($idUsuarioSesion);
        return $this->respond($inmueblesAleatorios);


    }

    public function inmuebleDetalle($id = null)
    {

        $modelInmueble = new InmueblesModel();

        if (!$id) {
            return $this->respond("No se ha encontrado un piso con ese id");
        }

        $inmueble = $modelInmueble->getInmuebleDetalle($id);

        return $this->respond($inmueble);




    }

    public function postSolicitud()
    {

        $data = $this->request->getJSON();

        $token = $this->request->getHeaderLine('X-API-TOKEN');
        $usuarioModel = new UsuariosModel();

        if (!$token) {
            return $this->respond("No hay token");
        }

        $usuarioSesion = $usuarioModel->where('token', $token)
            ->first();

        if (!$usuarioSesion) {
            return $this->respond("No hay sesion");
        }
        ;

        $idUsuario = $usuarioSesion['id'];
        $casaLike = $data->houseId;

        $solicitudModel = new SolicitudesModel();

        $data = [
            'estudiante_id' => $idUsuario,
            'inmueble_id' => $casaLike,

        ];


        $solicitudModel->insert($data);
        return $this->respond("Solicitud insertadad correctamente");


    }


    public function postInmueble()
    {
        $data = $this->request->getJSON();

        $token = $this->request->getHeaderLine('X-API-TOKEN');
        $usuarioModel = new UsuariosModel();
        $inmueblesModel = new InmueblesModel();

        if (!$data) {
            return $this->respond("No hay datos");
        }

        if (!$token) {
            return $this->respond("No hay token");
        }

        $usuarioSesion = $usuarioModel->where('token', $token)->first();

        if (!$usuarioSesion) {
            return $this->respond("No hay sesion");
        }

        $idUsuario = $usuarioSesion['id'];

        $nuevoInmueble = [
            'titulo' => $data->titulo,
            'descripcion' => $data->desc,
            'direccion' => $data->direccion,
            'precio' => $data->precio,
            'propietario_id' => $idUsuario,
            'universidad_id' => $data->universidad_id,
            'metros' => $data->metros,
            'habitaciones' => $data->habitaciones,
            'banios' => $data->banios,
            'n_personas' => $data->n_personas,
            'imagen_principal' => $this->guardarImagen($data->imagen_principal),
            'imagen1' => $this->guardarImagen($data->imagen1),
            'imagen2' => $this->guardarImagen($data->imagen2),
            'imagen3' => $this->guardarImagen($data->imagen3),
            'imagen4' => $this->guardarImagen($data->imagen4),

        ];

        if ($inmueblesModel->insert($nuevoInmueble)) {
            return $this->respond(["mensaje" => "Inmueble creado con éxito"], 201);
        } else {
            return $this->respond(["mensaje" => "Error al insertar"], 500);
        }
    }


    public function guardarImagen($imagen)
    {
        if (empty($imagen)) {
            return $this->respond(["mensaje" => "Faltan imagenes"], 500);
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
        $rutaCarpeta = FCPATH . 'uploads/inmuebles_fotos/';

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


    public function eliminarInmueble()
    {
        $json = $this->request->getJSON();
        $id = $json->id;

        if (!$id) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'ID no proporcionado']);
        }

        $inmueblesModel = new InmueblesModel();
        $inmuebleDatos = $inmueblesModel->find($id);

        $rutaCarpeta = FCPATH . "/uploads/inmuebles_fotos/";
        $imaganesInmueble = [
            'imagen_principal' => $inmuebleDatos['imagen_principal'],
            'imagen1' => $inmuebleDatos['imagen1'],
            'imagen2' => $inmuebleDatos['imagen2'],
            'imagen3' => $inmuebleDatos['imagen3'],
            'imagen4' => $inmuebleDatos['imagen4'],

        ];

        foreach ($imaganesInmueble as $img) {
            if (file_exists($rutaCarpeta . $img)) {
                unlink($rutaCarpeta . $img);
            }

        }




        if ($inmueblesModel->delete($id)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Inmueble eliminado correctamente'
            ]);
        } else {
            return $this->response->setStatusCode(500)->setJSON([
                'status' => 'error',
                'message' => 'No se pudo eliminar el inmueble'
            ]);
        }
    }

    public function updateInmueble()
    {
        $token = $this->request->getHeaderLine('X-API-TOKEN');
        $usuariosModel = new UsuariosModel();
        $inmueblesModel = new InmueblesModel();


        $usuario = $usuariosModel->where('token', $token)->first();
        if (!$usuario) {
            return $this->failUnauthorized('Sesión no válida');
        }

        $inmData = $this->request->getJSON();


        $inmuebleOriginal = $inmueblesModel->where('id', $inmData->id)->first();
        if (!$inmuebleOriginal) {
            return $this->failNotFound('Inmueble no encontrado');
        }



        $rutaCarpeta = FCPATH . "/uploads/inmuebles_fotos/";

        $data = [
            'titulo' => $inmData->titulo ?? $inmuebleOriginal['titulo'],
            'direccion' => $inmData->direccion ?? $inmuebleOriginal['direccion'],
            'precio' => $inmData->precio ?? $inmuebleOriginal['precio'],
            'n_personas' => $inmData->n_personas ?? $inmuebleOriginal['n_personas'],
            'habitaciones' => $inmData->habitaciones ?? $inmuebleOriginal['habitaciones'],
            'banios' => $inmData->banios ?? $inmuebleOriginal['banios'],
            'metros' => $inmData->metros ?? $inmuebleOriginal['metros'],
            'descripcion' => $inmData->descripcion ?? $inmuebleOriginal['descripcion'],
            'universidad_id' => $inmData->universidad_id ?? $inmuebleOriginal['universidad_id'],
        ];


        $camposImagenes = ['imagen_principal', 'imagen1', 'imagen2', 'imagen3', 'imagen4'];

        foreach ($camposImagenes as $campo) {
            if (!empty($inmData->$campo) && strpos($inmData->$campo, 'data:image') !== false) {


                if (!empty($inmuebleOriginal[$campo]) && file_exists($rutaCarpeta . $inmuebleOriginal[$campo])) {
                    unlink($rutaCarpeta . $inmuebleOriginal[$campo]);
                }


                $data[$campo] = $this->guardarImagen($inmData->$campo);
            }
        }


      

        if ($inmueblesModel->update($inmData->id, $data)) {

            return $this->response->setJSON([
                'status' => 200,
                'message' => 'Inmueble actualizado correctamente'
            ]);
        }

        return $this->response->setJSON(['status' => 500, 'error' => 'Error al actualizar'])->setStatusCode(500);



    }


}