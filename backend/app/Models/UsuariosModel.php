<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'email', 'password','rol','universidad_id'];
    /**
     * @param false|string 
     *
     * @return array|null
     */

    public function getUsuarios($id = null)
    {

        if($id === null){
            $sql = $this->select('usuarios.*');
            $sql = $this->findAll();
            return $sql;
        }

        $sql = $this->select('usuarios.*');
        $sql = $this-> where('usuarios.id',$id);
        $sql = $this->first();
        return $sql;

       
    }

   

}