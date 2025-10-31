<?php

namespace App\Controllers;

class BodegueroController extends BaseController
{
    public function index()
    {
        // Carga la vista con el layout dinámico
        return $this->renderView('bodeguero/dashboard');
    }
}