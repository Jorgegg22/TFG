<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\InmueblesModel;


class InmueblesController extends ResourceController
{
    protected $modelName = 'App\Models\InmueblesModel';
    protected $format    = 'json';

    public function inmueblesLista()
    {
            
        $modelInmueble = new InmueblesModel();
        $inmuebles = $modelInmueble->getInmuebles();
        return $this->respond($inmuebles);

      
    }
    public function inmueblesListaAleatoria()
    {
            
        $modelInmueble = new InmueblesModel();
        $inmueblesAleatorios = $modelInmueble->getInmueblesAleatorios();
        return $this->respond($inmueblesAleatorios);

      
    }

    public function inmuebleDetalle($id = null){
        
        $modelInmueble = new InmueblesModel();

        if(!$id){
            return $this->respond("No se ha encontrado un piso con ese id");
        }

        $inmueble = $modelInmueble->getInmuebleDetalle($id);

        return $this->respond($inmueble);




    }




}