<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Intervencionista extends Controller
{
    public function dashboard()
    {
        return view('intervencionista/dashboard');
    }
}
