<?php

namespace App\Models;

use CodeIgniter\Model;

class SolicitudesModel extends Model
{
    protected $table = 'solicitudes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['estudiante_id', 'inmueble_id', 'estado'];

}