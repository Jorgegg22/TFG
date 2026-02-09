<?php

namespace App\Models;

use CodeIgniter\Model;

class MatchesModel extends Model
{
    protected $table = 'matches';
    protected $primaryKey = 'id';
    protected $allowedFields = ['estudiante_id', 'inmueble_id','created_at'];

    public function getMatches()
    {
  
            return $this->findAll();
        }

}