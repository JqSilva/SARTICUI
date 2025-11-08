<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Si no hay sesión activa, redirige al login
        if (!$session->has('rol')) {
            return redirect()->to('/login');
        }

        $rolUsuario = strtolower($session->get('rol'));

        // Si el filtro tiene argumentos, revisamos si el rol tiene permiso
        if ($arguments && !in_array($rolUsuario, $arguments)) {
            return redirect()->to('/unauthorized'); // Ruta de acceso denegado
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nada por ahora
    }
}
