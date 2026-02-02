<?php

namespace App\Models;

use CodeIgniter\Model;

class UniversidadesModel extends Model
{
    protected $table = 'universidades';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'siglas', 'ciudad'];

    public function getUniversidades()
    {
        
    
        return $this->findAll();
        

        
    }
}