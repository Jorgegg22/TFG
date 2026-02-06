<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'email', 'password','rol','universidad_id','id_carrera','telefono', 'descripcion'];
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

        $sql = $this->select('usuarios.*, carreras.nombre  AS nombre_carrera ,universidades.nombre AS nombre_universidad');
        $sql = $this-> where('usuarios.id',$id);
        $sql = $this-> join('carreras', 'carreras.id=usuarios.id_carrera', 'left');
        $sql = $this-> join('universidades', 'universidades.id=usuarios.universidad_id', 'left');
        $sql = $this->first();
        return $sql;

       
    }



    public function getSolicitudesUsuario($id = null){
        $sql = $this->select('usuarios.* ,inm.* , sol.*');
        $sql = $this-> join('solicitudes AS sol', 'sol.estudiante_id = usuarios.id', 'left');
        $sql = $this-> join('inmuebles AS inm', 'inm.id = sol.inmueble_id', 'left');
        $sql = $this-> where('usuarios.id',$id);
        $sql = $this->findAll();
        return $sql;
    }

   

}