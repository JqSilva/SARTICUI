<?php

namespace App\Controllers;
use App\Models\UsuarioModel;

class Auth extends BaseController
{
    public function login()
    {
        helper(['form']);
        echo view('auth/login');
    }

    public function doLogin()
    {
        $session = session();
        $userModel = new UsuarioModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel
            ->select('USUARIO.*, PERFIL.NOMBRE_PERFIL')
            ->join('PERFIL', 'PERFIL.ID_PERFIL = USUARIO.ID_PERFIL_USUARIO')
            ->where('NOMBRE_USUARIO', $username)
            ->first();

        if ($user && password_verify($password, $user['CONTRASENA_USUARIO'])) {
            $session->set([
                'id' => $user['ID_USUARIO'],
                'nombre' => $user['NOMBRE_USUARIO'],
                'rol' => strtolower($user['NOMBRE_PERFIL']),
                'logged_in' => true
            ]);

            return redirect()->to(
                strtolower($user['NOMBRE_PERFIL']) === 'administrador' ? '/administrador' : '/bodeguero'
            );
        } else {
            return redirect()->back()->with('error', 'Credenciales inválidas');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
