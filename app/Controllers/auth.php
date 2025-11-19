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

       
        $rutIngresado = $this->request->getPost('rut'); 
        $password     = $this->request->getPost('password'); 

        
        $rutFormateado = $this->formatearRut($rutIngresado); 

        
        if (!$rutFormateado) {
             return redirect()->back()->with('error', 'Formato de RUT inválido');
        }

        
        $user = $userModel
            ->select('USUARIO.*, PERFIL.NOMBRE_PERFIL')
            ->join('PERFIL', 'PERFIL.ID_PERFIL = USUARIO.ID_PERFIL_USUARIO')
            ->where('RUT_USUARIO', $rutFormateado) 
            ->first();

        
        if ($user && password_verify($password, $user['CONTRASENA_USUARIO'])) {
            $session->set([
                'id'        => $user['ID_USUARIO'],
                'nombre'    => $user['NOMBRE_USUARIO'], 
                'rut'       => $user['RUT_USUARIO'],    
                'rol'       => strtolower($user['NOMBRE_PERFIL']),
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

    // Función para formatear el RUT antes de buscar en la BD
    private function formatearRut($rutEntrada) {
        // 1. Eliminar puntos y guiones, dejar solo números y k
        $rutLimpio = preg_replace('/[^0-9kK]/', '', $rutEntrada);
        
        // 2. Si está vacío, retornar null
        if (strlen($rutLimpio) < 2) return null;

        // 3. Separar cuerpo y dígito verificador
        $cuerpo = substr($rutLimpio, 0, -1);
        $dv = strtoupper(substr($rutLimpio, -1)); // La 'k' siempre mayúscula

        // 4. Retornar en el formato que decidimos guardar en la BD: "12345678-K"
        return $cuerpo . '-' . $dv;
    }

    

}
