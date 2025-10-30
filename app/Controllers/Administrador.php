<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Administrador extends Controller
{
    public function dashboard()
    {
        return view('administrador/dashboard');
    }
}
