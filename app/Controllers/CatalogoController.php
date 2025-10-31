<?php
namespace App\Controllers;

class CatalogoController extends BaseController
{
    /**
     * Muestra el catálogo dependiendo del rol del usuario.
     */
    public function index()
    {
        $rol = strtolower(session('rol') ?? 'invitado');

        // Puedes pasar datos comunes
        $data = [
            'titulo' => 'Catálogo del Sistema',
            'usuario' => session('nombre') ?? 'Usuario',
        ];

        // Renderiza vistas distintas según el rol
        switch ($rol) {
            case 'administrador':
                return $this->renderView('modules/catalogo/administrador', $data);

            case 'bodeguero':
                return $this->renderView('modules/catalogo/bodeguero', $data);

            case 'intervencionista':
                return $this->renderView('modules/catalogo/intervencionista', $data);

            default:
                // Rol no válido o sin sesión
                return redirect()->to('/unauthorized');
        }
    }
}
