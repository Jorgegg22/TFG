<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
class AdminController extends BaseController
{
    public function index()
    {
        // Opcional: Aquí deberías verificar si el usuario es admin
        // if (!session()->get('is_admin')) { return redirect()->to('/login'); }

        // Esto busca el archivo en: app/Views/panel/index.php
        return view('panel/index');
    }
}