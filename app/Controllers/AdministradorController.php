<?php
namespace App\Controllers;

use App\Models\BodegaModel;

class AdministradorController extends BaseController
{
    /**
     * Dashboard principal del Administrador
     */
    public function index()
    {
        // 👇 Setea temporalmente el rol (solo si no se asigna en login)
        if (!session()->has('rol')) {
            session()->set(['rol' => 'Administrador']);
        }

        // Puedes enviar datos adicionales si los necesitas
        $data = [
            'titulo' => 'Panel del Administrador',
            'usuario' => session('nombre') ?? 'Administrador',
        ];

        // renderView automáticamente selecciona el layout correcto según el rol
        return $this->renderView('administrador/dashboard', $data);
    }

    /**
     * Ejemplo: vista de inventario o módulo del administrador
     */
    public function inventario()
    {
        $model = new BodegaModel();
        $data = [
            'titulo' => 'Inventario General',
            'insumos' => $model->obtenerInsumosEnBodega(),
        ];

        return $this->renderView('modules/bodega/index', $data);
    }

    /**
     * Ejemplo: otro submódulo exclusivo del admin (usuarios, por ejemplo)
     */
    public function usuarios()
    {
        $data = [
            'titulo' => 'Gestión de Usuarios',
        ];

        return $this->renderView('modules/usuarios/index', $data);
    }
}
