<?php
namespace App\Controllers;

class TrazabilidadAccionController extends BaseController
{
    // GET /trazabilidadacciones
    public function index()
    {
        // Retorna una vista simple con layout dinámico
        return $this->renderView('administrador/trazabilidadacciones', [
            'titulo' => 'Trazabilidad de Acciones',
            'descripcion' => 'Módulo en preparación — próximamente mostrará el historial de acciones realizadas en el sistema.'
        ]);
    }
}
