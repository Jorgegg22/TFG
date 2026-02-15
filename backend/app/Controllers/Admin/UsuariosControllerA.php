<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;
use App\Models\UniversidadesModel;
use App\Models\CarrerasModel;

class UsuariosControllerA extends BaseController
{


    public function index()
    {
        $usuarioModel = new UsuariosModel();



        $usuarios = $usuarioModel->getUsuarios();

        $data = [
            'usuarios' => $usuarios
        ];

        return view('panel/templates/header') .
            view('panel/usuarios/gestionUsuarios', $data) .
            view('panel/templates/footer');
    }

    public function crear()
    {

        $uniModel = new UniversidadesModel();
        $carrerasModel = new CarrerasModel();

        $data = [
            'universidades' => $uniModel->getUniversidades(),
            'carreras' => $carrerasModel->getCarreras()
        ];

        return view('panel/templates/header') .
            view('panel/usuarios/formUsuario', $data) .
            view('panel/templates/footer');
    }

    public function editar($id = null)
    {
        $usuariosModel = new UsuariosModel();
        $uniModel = new UniversidadesModel();
        $carrerasModel = new CarrerasModel();

        $usuario = $usuariosModel->getUsuarios($id);

        $data = [
            'usuario' => $usuario,
            'universidades' => $uniModel->getUniversidades(),
            'carreras' => $carrerasModel->getCarreras()
        ];



        return view('panel/templates/header') .
            view('panel/usuarios/formUsuario', $data) .
            view('panel/templates/footer');
    }

    public function guardar()
    {
        $usuariosModel = new UsuariosModel();
        $id = $this->request->getPost('id');

        $reglas = [
            'nombre' => "required|min_length[3]|max_length[100]|is_unique[usuarios.nombre,id,{$id}]",
            //CORREO UNICO EXCEPTO EN EL ID DEL USUARIO
            'email' => "required|valid_email|is_unique[usuarios.email,id,{$id}]",
            'rol' => 'required|in_list[admin,estudiante,propietario]',
            'universidad_id' => 'required|numeric',
            'id_carreara' => 'required|numeric',
            'descripcion' => 'required|min_length[10]|max_length[500]',
            'telefono' => 'required|min_length[9]|max_length[9]'
        ];



        // SI NO HAY ID ES QUE SE CREA USUARIO,VALIDAMOS CONTRASÑEA

        if (!$id) {
            $reglas['password'] = 'required|min_length[8]';
            $reglas['foto_perfil'] = 'required|uploaded[foto_perfil]|is_image[foto_perfil]|max_size[foto_perfil,2048]|mime_in[foto_perfil,image/jpg,image/jpeg,image/png]';
        } else {
            if (!empty($this->request->getPost('password'))) {
                $reglas['password'] = 'min_length[8]';

            }
            $reglas['foto_perfil'] = 'is_image[foto_perfil]|max_size[foto_perfil,2048]|mime_in[foto_perfil,image/jpg,image/jpeg,image/png]';
        }

        // SI HAY ID EDITA LA IMAGEN QUE EXISTE


        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errores', $this->validator->getErrors());
        }


        $datos = [
            'nombre' => $this->request->getPost('nombre'),
            'email' => $this->request->getPost('email'),
            'telefono' => $this->request->getPost('telefono'),
            'rol' => $this->request->getPost('rol'),
            'universidad_id' => $this->request->getPost('universidad_id'),
            'id_carreara' => $this->request->getPost('id_carreara'),
            'descripcion' => $this->request->getPost('descripcion'),
            'link_instagram' => $this->request->getPost('link_instagram'),
            'link_x' => $this->request->getPost('link_x'),
            'link_spotify' => $this->request->getPost('link_spotify'),
        ];

        $rutaCarpeta = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'perfiles' . DIRECTORY_SEPARATOR;
        $img = $this->request->getFile('foto_perfil');

        if ($img && $img->isValid() && !$img->hasMoved()) {

            if ($id) {
                $viejo = $usuariosModel->find($id);
                if ($viejo && !empty($viejo['foto_perfil'])) {
                    $rutaVieja = $rutaCarpeta . $viejo['foto_perfil'];
                    if (file_exists($rutaVieja)) {
                        unlink($rutaVieja);
                    }
                }
            }
            $rutaCompletaImagen = $rutaCarpeta . $img->getName();
            if ($img->isValid() && !$img->hasMoved()) {

                if (file_exists($rutaCompletaImagen)) {
                    $nombreFinal = $img->getRandomName();
                } else {
                    $nombreFinal = $img->getName();
                }

                $img->move($rutaCarpeta, $nombreFinal);
                $datos['foto_perfil'] = $nombreFinal;

            }

        }







        $password = $this->request->getPost('password');


        if (!empty($password)) {
            $datos['password'] = password_hash($password, PASSWORD_BCRYPT);
        }



        if ($id) {
            $usuariosModel->update($id, $datos);
            $mensaje = 'Usuario actualizado correctamente.';
        } else {
            $usuariosModel->insert($datos);
            $mensaje = 'Usuario creado con éxito.';
        }
        return redirect()->to(base_url('admin/usuarios'))->with('mensaje', $mensaje);


    }




    public function borrar($id = null)
    {

        $usuariosModel = new UsuariosModel();
        $usuario = $usuariosModel->getUsuarios($id);
        $rol = $usuario['rol'];

        if (!empty($usuario['foto_perfil']) && $usuario['foto_perfil'] !== 'avatar_default.png') {
            $rutaPerfil = FCPATH . "uploads/perfiles/" . $usuario['foto_perfil'];
            if (file_exists($rutaPerfil)) {
                unlink($rutaPerfil);
            }
        }

        $usuariosModel->delete($id);


        if ($rol === "estudiante") {
            $mensaje = 'Usuario(estudiante) borrado Correctamente. También se han eliminado sus solicitudes y matches asociados.';

        } else {
            $mensaje = 'Usuario(propietario) borrado Correctamente. También se han eliminado inmuebles, solicitudes y matches asociados.';

        }

        return redirect()->to(base_url('admin/usuarios'))->with('mensaje', $mensaje);

    }
}