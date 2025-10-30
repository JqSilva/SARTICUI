<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Bodeguero extends Controller
{
    public function dashboard()
    {
        return view('bodeguero/dashboard');
    }
}
