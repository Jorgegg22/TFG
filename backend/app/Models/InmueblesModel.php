<?php

namespace App\Models;

use CodeIgniter\Model;

class InmueblesModel extends Model
{
    protected $table = 'inmuebles';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'titulo',
        'descripcion',
        'direccion',
        'precio',
        'universidad_id',
        'propietario_id',
        'imagen_principal'
    ];

    public function getInmueblesFiltrados($id)
    {
        $this->select('inmuebles.*');
        $this->select('u_prop.nombre as nombre_propietario');
        $this->select('universidades.nombre as nombre_universidad');
 
        //PROPIETARIO
        $this->join('usuarios AS u_prop', 'u_prop.id = inmuebles.propietario_id', 'left');
        //UNIVERSIDAD CERCA DEL PISO
        $this->join('universidades', 'universidades.id = inmuebles.universidad_id', 'left');

        // --- GUÍA DEL FILTRADO ---

        // INMUEBLE ID IGUAL A INMUEBLE_ID EN TABLA INMUEBLE_ATRIBUTOS
        $this->join('inmueble_atributos AS ia', 'ia.inmueble_id = inmuebles.id');

        // INMUEBLES QUE TIENEN LOS MISMOS ATRIBUTOS QUE EL USUARIO
        $this->join('usuario_atributos AS ua', 'ua.atributo_id = ia.atributo_id');

        // ID DEL USUARIO = A USUARIO_ID DE INMUEBLE
        $this->join('usuarios AS u_filtro', 'u_filtro.id = ua.usuario_id');

        // ID DEL USUARIO
        $this->where('u_filtro.id', $id);

        // UNIVERSIDAD USUARIO = INMUEBLE UNIVERSIDAD
        $this->where('inmuebles.universidad_id = u_filtro.universidad_id');

        $this->where("inmuebles.id NOT IN (SELECT inmueble_id FROM solicitudes WHERE estudiante_id = " . (int)$id . ")", null, false);

        // NO REPETIDOS
        $this->distinct();

        $this->orderBy('RAND()');

        return $this->findAll();
    }


    public function getInmueblesFiltradoUni($id)
{

    $id = (int)$id;

    $this->select('inmuebles.*');
    $this->select('u_prop.nombre as nombre_propietario');
    $this->select('universidades.nombre as nombre_universidad');

    // Joins básicos
    $this->join('usuarios AS u_prop', 'u_prop.id = inmuebles.propietario_id', 'left');
    $this->join('universidades', 'universidades.id = inmuebles.universidad_id', 'left');

    // Definimos u_filtro uniendo la tabla usuarios con el ID que recibimos
    $this->join('usuarios AS u_filtro', 'u_filtro.id = ' . $id);

    // Ahora ya podemos comparar las universidades
    $this->where('inmuebles.universidad_id = u_filtro.universidad_id');

    // Excluimos los inmuebles a los que el usuario ya ha reaccionado (Like/Dislike)
   $this->where("inmuebles.id NOT IN (SELECT inmueble_id FROM solicitudes WHERE estudiante_id = " . (int)$id . ")", null, false);

    $this->distinct();
    $this->orderBy('RAND()');

    return $this->findAll();
}

    public function getInmueblesAleatorios()
    {
        // Copiamos la misma lógica de selects y joins
        $this->select('inmuebles.*');
        $this->select('u_prop.nombre as nombre_propietario');
        $this->select('universidades.nombre as nombre_universidad');
        $this->select('u_est.id as est_id');
        $this->select('u_est.nombre as est_nombre');
        // $this->select('u_est.foto_perfil as est_foto');

        $this->join('usuarios as u_prop', 'u_prop.id = inmuebles.propietario_id', 'left');
        $this->join('universidades', 'universidades.id = inmuebles.universidad_id', 'left');
        $this->join('matches', 'matches.inmueble_id = inmuebles.id', 'left');
        $this->join('usuarios as u_est', 'u_est.id = matches.estudiante_id', 'left');

        // LA CLAVE: Ordenar por RAND()
        $this->orderBy('RAND()');

        return $this->findAll();
    }

    public function getInmueblesConDetalles()
    {
        return $this->select('inmuebles.*, usuarios.nombre as propietario, universidades.nombre as universidad')
            ->join('usuarios', 'usuarios.id = inmuebles.propietario_id')
            ->join('universidades', 'universidades.id = inmuebles.universidad_id')
            ->findAll();
    }



    public function getInmuebleDetalle($id = null)
    {
        // Seleccionamo inmueble con el id,traemos el propietario y la universidad
        $this->select('inmuebles.*');
        $this->select('u_prop.nombre as nombre_propietario');
        $this->select('universidades.nombre as nombre_universidad');

        $this->join(
            'usuarios as u_prop',
            'u_prop.id = inmuebles.propietario_id',
            'left'
        );

        $this->join(
            'universidades',
            'universidades.id = inmuebles.universidad_id',
            'left'
        );

        $inmueble = $this->find($id);

        $db = \Config\Database::connect();

        // Traemos las solicitudes,con el nombre de los usuarios que han solicitado ese piso


        $solicitudes = $db->table('solicitudes')
            ->select('solicitudes.*')
            ->select('u_sol.nombre as nombre_solicitante')
            ->join(
                'usuarios as u_sol',
                'u_sol.id = solicitudes.estudiante_id',
                'left'
            )
            ->where('solicitudes.inmueble_id', $id)
            ->get()
            ->getResultArray();


        // Traemos los mathes,con el nombre de los usuarios que han hecho match con ese piso 

        $matches = $db->table('matches')
            ->select('matches.*')
            ->select('u_est.nombre as nombre_estudiante')
            ->join(
                'usuarios as u_est',
                'u_est.id = matches.estudiante_id',
                'left'
            )
            ->where('matches.inmueble_id', $id)
            ->get()
            ->getResultArray();


        //Unimos el array de inmueble con los arrays de solicitudes y matches.
        $inmueble['solicitudes'] = $solicitudes;
        $inmueble['matches'] = $matches;

        return $inmueble;


    }
}