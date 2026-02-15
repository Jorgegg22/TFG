<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\InmueblesModel;
use App\Models\UniversidadesModel;
use App\Models\UsuariosModel;

class InmueblesControllerA extends BaseController
{


    public function index()
    {
        $inmueblesModel = new InmueblesModel();

        $inmuebles = $inmueblesModel->getInmuebles();

        $data = [
            'inmuebles' => $inmuebles
        ];

        return view('panel/templates/header') .
            view('panel/inmuebles/gestionInmuebles', $data) .
            view('panel/templates/footer');
    }

    public function crear()
    {

        $uniModel = new UniversidadesModel();
        $usuarioModel = new UsuariosModel();



        $data = [
            'universidades' => $uniModel->getUniversidades(),
            'propietarios' => $usuarioModel->where('rol', 'propietario')->findAll()
        ];

        return view('panel/templates/header') .
            view('panel/inmuebles/formInmueble', $data) .
            view('panel/templates/footer');
    }

    public function editar($id = null)
    {
        $inmueblesModel = new InmueblesModel();
        $uniModel = new UniversidadesModel();
        $usuarioModel = new UsuariosModel();


        $inmueble = $inmueblesModel->getInmuebles($id);



        $data = [
            'inmueble' => $inmueble,
            'universidades' => $uniModel->getUniversidades(),
            'propietarios' => $usuarioModel->where('rol', 'propietario')->findAll()
        ];

        return view('panel/templates/header') .
            view('panel/inmuebles/formInmueble', $data) .
            view('panel/templates/footer');
    }

    public function guardar()
    {
        $inmueblesModel = new InmueblesModel();
        $id = $this->request->getPost('id');


        if ($id) {
            $reglas = [
                'titulo' => "required",
                'direccion' => "required|min_length[3]|max_length[100]|is_unique[inmuebles.titulo,id,{$id}]",
                'descripcion' => "required|min_length[3]|max_length[100]",
                'precio' => "required|numeric",
                'metros' => "required",
                'habitaciones' => "required",
                'banios' => "required",
                'n_personas' => "required",
                'universidad_id' => "required",
                'propietario_id' => "required",
                'imagen_principal' => "is_image[imagen_principal]|mime_in[imagen_principal,image/jpg,image/jpeg,image/png]|max_size[imagen_principal,2048]",
                'imagen1' => "is_image[imagen1]|mime_in[imagen1,image/jpg,image/jpeg,image/png]|max_size[imagen1,2048]",
                'imagen2' => "is_image[imagen2]|mime_in[imagen2,image/jpg,image/jpeg,image/png]|max_size[imagen2,2048]",
                'imagen3' => "is_image[imagen3]|mime_in[imagen3,image/jpg,image/jpeg,image/png]|max_size[imagen3,2048]",
                'imagen4' => "is_image[imagen4]|mime_in[imagen4,image/jpg,image/jpeg,image/png]|max_size[imagen4,2048]",
            ];
        } else {
            $reglas = [
                'titulo' => "required",
                'direccion' => "required|min_length[3]|max_length[100]|is_unique[inmuebles.titulo]",
                'descripcion' => "required|min_length[3]|max_length[100]",
                'precio' => "required|numeric",
                'metros' => "required",
                'habitaciones' => "required",
                'banios' => "required",
                'n_personas' => "required",
                'universidad_id' => "required",
                'propietario_id' => "required",
                'imagen_principal' => "uploaded[imagen_principal]|is_image[imagen_principal]|mime_in[imagen_principal,image/jpg,image/jpeg,image/png]|max_size[imagen_principal,2048]",
                'imagen1' => "uploaded[imagen1]|is_image[imagen1]|mime_in[imagen1,image/jpg,image/jpeg,image/png]|max_size[imagen1,2048]",
                'imagen2' => "uploaded[imagen2]|is_image[imagen2]|mime_in[imagen2,image/jpg,image/jpeg,image/png]|max_size[imagen2,2048]",
                'imagen3' => "uploaded[imagen3]|is_image[imagen3]|mime_in[imagen3,image/jpg,image/jpeg,image/png]|max_size[imagen3,2048]",
                'imagen4' => "uploaded[imagen4]|is_image[imagen4]|mime_in[imagen4,image/jpg,image/jpeg,image/png]|max_size[imagen4,2048]",
            ];
        }




        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errores', $this->validator->getErrors());
        }

        $datos = [
            'titulo' => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion'),
            'direccion' => $this->request->getPost('direccion'),
            'precio' => $this->request->getPost('precio'),
            // 'imagen_principal' => $this->request->getPost('imagen_principal'),
            // 'imagen1' => $this->request->getPost('imagen1'),
            // 'imagen2' => $this->request->getPost('imagen2'),
            // 'imagen3' => $this->request->getPost('imagen3'),
            // 'imagen4' => $this->request->getPost('imagen4'),
            'propietario_id' => $this->request->getPost('propietario_id'),
            'universidad_id' => $this->request->getPost('universidad_id'),
            'metros' => $this->request->getPost('metros'),
            'habitaciones' => $this->request->getPost('habitaciones'),
            'banios' => $this->request->getPost('banios'),
            'n_personas' => $this->request->getPost('n_personas'),
        ];



        $rutaCarpeta = FCPATH . 'uploads/inmuebles_fotos';

        if (!is_dir($rutaCarpeta)) {
            mkdir($rutaCarpeta, 0777, true);
        }

        $camposImagenes = ['imagen_principal', 'imagen1', 'imagen2', 'imagen3', 'imagen4'];

        foreach ($camposImagenes as $campo) {
            $img = $this->request->getFile($campo);

            if ($img && $img->isValid() && !$img->hasMoved()) {

                // 1. Borrar imagen vieja si existe (Solo en edición)
                if ($id) {
                    $viejo = $inmueblesModel->find($id);
                    if ($viejo && !empty($viejo[$campo])) {
                        $rutaVieja = $rutaCarpeta . $viejo[$campo];
                        if (file_exists($rutaVieja)) {
                            unlink($rutaVieja);
                        }
                    }
                }

                // 2. Definir nombre final (Evita duplicados)
                // Nombre único para evitar conflictos de caché y duplicados
                $nombreFinal = $img->getRandomName();
                $img->move($rutaCarpeta, $nombreFinal);

                // Guardamos el nombre en el array de datos
                $datos[$campo] = $nombreFinal;
            }
        }


        if ($id) {
            $inmueblesModel->update($id, $datos);
            $mensaje = 'Inmueble actualizado correctamente.';
        } else {
            $inmueblesModel->insert($datos);
            $mensaje = 'Inmueble creado con éxito.';
        }
        return redirect()->to(base_url('admin/inmuebles'))->with('mensaje', $mensaje);
    }

    public function borrar($id = null)
    {

        $inmueblesModel = new InmueblesModel();

        $inmuebleDatos = $inmueblesModel->find($id);

        $rutaCarpeta = FCPATH . "/uploads/inmuebles_fotos/";
        $imaganesInmueble = [
            'imagen_principal' => $inmuebleDatos['imagen_principal'],
            'imagen1' => $inmuebleDatos['imagen1'],
            'imagen2' => $inmuebleDatos['imagen2'],
            'imagen3' => $inmuebleDatos['imagen3'],
            'imagen4' => $inmuebleDatos['imagen4'],

        ];

        foreach ($imaganesInmueble as $img) {
            if (file_exists($rutaCarpeta . $img)) {
                unlink($rutaCarpeta . $img);
            }

        }


        $inmueblesModel->delete($id);




        $mensaje = 'Inmueble borrado Correctamente';

        return redirect()->to(base_url('admin/inmuebles'))->with('mensaje', $mensaje);
    }
}