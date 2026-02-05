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

    public function getInmuebles($id = null)
    {
        // --- 1. SELECCIÓN DE CAMPOS (SELECT) ---
        $this->select('inmuebles.*'); 
        $this->select('u_prop.nombre as nombre_propietario');
        $this->select('universidades.nombre as nombre_universidad');
        // Datos del match (si existen)
        $this->select('matches.estudiante_id');
        $this->select('u_est.nombre as nombre_estudiante');

        // --- 2. UNIONES DE TABLAS (JOINS) ---

        // A. Unimos con Usuarios para saber el PROPIETARIO
        // Usamos 'left' por seguridad, aunque todo piso debería tener dueño.
        $this->join('usuarios as u_prop', 'u_prop.id = inmuebles.propietario_id', 'left');

        // B. Unimos con Universidades
        $this->join('universidades', 'universidades.id = inmuebles.universidad_id', 'left');

        // C. Unimos con Matches (CRÍTICO: USAR LEFT JOIN)
        // Usamos LEFT JOIN para que si el piso NO tiene match, SALGA IGUAL en la lista (con campos null).
        $this->join('matches', 'matches.inmueble_id = inmuebles.id', 'left');

        // D. Unimos con Usuarios otra vez para saber el ESTUDIANTE del match
        $this->join('usuarios as u_est', 'u_est.id = matches.estudiante_id', 'left');

        // --- 3. DEVUELVE UNO O TODOS ---
                $this->orderBy('RAND()');


        // Si pasaste un ID, devuelve solo ese piso
        if ($id != null) {
            return $this->find($id);
        }

        // Si NO pasaste ID, devuelve TODOS los pisos
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
}