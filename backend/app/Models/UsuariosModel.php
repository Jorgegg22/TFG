<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'email', 'password', 'rol', 'universidad_id', 'id_carrera', 'telefono', 'descripcion', 'token', 'token_expira', 'foto_perfil'];
    /**
     * @param false|string 
     *
     * @return array|null
     */

    public function getUsuarios($id = null)
    {

        if ($id === null) {
            $sql = $this->select('usuarios.*');
            $sql = $this->findAll();
            return $sql;
        }

        $sql = $this->select(
            "usuarios.*, 
        carreras.nombre AS nombre_carrera, 
        universidades.nombre AS nombre_universidad,
        GROUP_CONCAT(CONCAT(atributos.nombre, '|', atributos.icono) SEPARATOR ';') AS atributos_usuario"
        );
        $sql = $this->join('carreras', 'carreras.id = usuarios.id_carrera', 'left');
        $sql = $this->join('universidades', 'universidades.id = usuarios.universidad_id', 'left');
        $sql = $this->join('usuario_atributos', 'usuario_atributos.usuario_id = usuarios.id', 'left');
        $sql = $this->join('atributos', 'atributos.id = usuario_atributos.atributo_id', 'left');
        $sql = $this->where('usuarios.id', $id);
        $sql = $this->groupBy('usuarios.id');
        $sql = $this->first();

        return $sql;


    }



    public function getSolicitudesUsuario($id = null)
    {
        $sql = $this->select('
        sol.id AS solicitud_id,
        sol.estado AS estado_solicitud,
        inm.id AS inmueble_id,
        inm.titulo,
        inm.precio,
        inm.direccion,
        inm.imagen_principal,
        usuarios.nombre AS nombre_estudiante
    ');
        $sql = $this->join('solicitudes AS sol', 'sol.estudiante_id = usuarios.id');
        $sql = $this->join('inmuebles AS inm', 'inm.id = sol.inmueble_id');
        $sql = $this->where('usuarios.id', $id);

        return $this->findAll();
    }



}