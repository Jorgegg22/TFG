<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
class AdminController extends BaseController
{
    public function index()
    {
 
        return view('panel/templates/header').
        view('panel/index').
        view('panel/templates/footer');
    }
}