<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\AtributosModel;
use App\Models\UsuariosModel;
use App\Models\InmueblesModel;
use App\Models\MatchesModel;

class AdminController extends BaseController
{
    public function index()
    {
 
        $usuariosModel = new UsuariosModel();
        $inmueblesModel = new InmueblesModel();
        $matchesModel = new MatchesModel();

        $data = [
            'usuarios' => $usuariosModel->findAll(),
            'inmuebles' => $inmueblesModel->getInmuebles(),
            'matches' => $matchesModel->findAll()
        ];

        return view('panel/templates/header').
        view('panel/index',$data).
        view('panel/templates/footer');
    }
}