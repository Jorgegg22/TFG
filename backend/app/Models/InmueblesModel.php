<?php

namespace App\Models;

use CodeIgniter\Model;

class InmueblesModel extends Model
{
    protected $table = 'inmuebles';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'titulo', 
        'descripcion', 
        'direccion', 
        'precio', 
        'universidad_id', 
        'propietario_id', 
        'imagen_principal'
    ];

    public function getInmuebles($id = null)
    {
        if ($id === null) {
            return $this->findAll();
        }

        return $this->find($id);
    }

    public function getInmueblesConDetalles()
    {
        return $this->select('inmuebles.*, usuarios.nombre as propietario, universidades.nombre as universidad')
                    ->join('usuarios', 'usuarios.id = inmuebles.propietario_id')
                    ->join('universidades', 'universidades.id = inmuebles.universidad_id')
                    ->findAll();
    }
}