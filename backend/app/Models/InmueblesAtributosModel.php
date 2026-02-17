<?php

namespace App\Models;

use CodeIgniter\Model;

class InmueblesAtributosModel extends Model
{
    protected $table = 'inmueble_atributos';
    protected $primaryKey = null; 
    protected $useAutoIncrement = false;
    protected $allowedFields = ['inmueble_id', 'atributo_id'];

}