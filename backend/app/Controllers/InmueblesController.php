<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\InmueblesModel;
use App\Models\UsuariosModel;

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


        if (!$usuarioSesion) {
            // Si entra aquí, el problema es que el Token que envía Angular no es válido
            return $this->failUnauthorized('Usuario no encontrado con ese Token');
        }
        $idUsuarioSesion = $usuarioSesion['id'];

        $modelInmueble = new InmueblesModel();
        $inmueblesUni = $modelInmueble->getInmueblesFiltradoUni($idUsuarioSesion);
       
        return $this->respond($inmueblesUni);
    }
    public function inmueblesListaAleatoria()
    {

        $modelInmueble = new InmueblesModel();
        $inmueblesAleatorios = $modelInmueble->getInmueblesAleatorios();
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




}