<?php

namespace App\Models;

use CodeIgniter\Model;

class AtributosModel extends Model
{
    protected $table = 'atributos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'icono'];

    public function getAtributos($id = null)
    {
        if ($id === null) {
            return $this->findAll();
        }

        return $this->find($id);
    }
}