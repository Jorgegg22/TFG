<?php

namespace App\Models;

use CodeIgniter\Model;

class AtributosUserModel extends Model
{
    protected $table = 'usuario_atributos';
    protected $primaryKey = 'usuario_id';
    protected $allowedFields = ['usuario_id', 'atributo_id'];

}