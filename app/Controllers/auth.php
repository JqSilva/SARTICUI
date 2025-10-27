<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Auth extends Controller
{
    public function showLogin()
    {
        // si ya está logeado, manda al dashboard
        if (session('isLoggedIn')) {
            return redirect()->to('dashboard');
        }
        return view('auth/login', ['title' => 'Ingreso']);
    }

    public function doLogin()
    {
        // credenciales hardcode para pruebas
        $validUsers = [
            '11111111-1' => '1234',
            '22222222-2' => 'abcd',
        ];

        $rut  = trim((string) $this->request->getPost('rut'));
        $pass = (string) $this->request->getPost('password');

        if (isset($validUsers[$rut]) && $validUsers[$rut] === $pass) {
            session()->set([
                'isLoggedIn' => true,
                'rut'        => $rut,
            ]);
            return redirect()->to('dashboard');
        }

        return redirect()->back()->withInput()->with('error', 'Credenciales inválidas');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}
