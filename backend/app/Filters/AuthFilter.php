<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // 1. Si ya está logueado, adelante
        if (session()->get('logged')) {
            return;
        }

        // 2. Si no está logueado, miramos si trae un token en la URL
        $token = service('request')->getGet('tkn');

        // Si no hay sesión Y tampoco hay token en la URL, entonces sí, al login
        if (!$token) {
            return redirect()->to('http://localhost:4200/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}