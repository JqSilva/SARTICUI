<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Base extends Controller
{
    public function dashboard()
    {
        return view('base/dashboard');
    }
}
