<?php

namespace App\Models;

use CodeIgniter\Model;

class SolicitudesModel extends Model
{
    protected $table = 'solicitudes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['estudiante_id', 'inmueble_id', 'estado'];


    public function getNotificaciones($estudiante_id)
    {
        return $this->select('solicitudes.*, inmuebles.titulo as nombre_inmueble')
            ->join('inmuebles', 'inmuebles.id = solicitudes.inmueble_id')
            ->where('solicitudes.estudiante_id', $estudiante_id)
            ->whereIn('solicitudes.estado', ['aceptado', 'rechazado'])
            ->orderBy('solicitudes.id', 'DESC')
            ->limit(5)
            ->findAll();
    }

}