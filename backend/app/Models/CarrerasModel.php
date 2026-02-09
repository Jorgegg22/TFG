<?php

namespace App\Models;

use CodeIgniter\Model;

class CarrerasModel extends Model
{
    protected $table = 'carreras';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre'];
    /**
     * @param false|string 
     *
     * @return array|null
     */

    public function getCarreras($id = null)
{
    if ($id === null) {
        return $this->findAll();
    }

    return $this->find($id);
}

   

}