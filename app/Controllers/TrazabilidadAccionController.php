<?php
namespace App\Controllers;

use App\Models\TrazabilidadAccionModel;

class TrazabilidadAccionController extends BaseController
{
    // GET /RegistroActividades
    public function index()
    {
        $model = new TrazabilidadAccionModel();

        // Trae todas las acciones con nombres de usuario e insumo
        $acciones = $model
            ->select('TRAZABILIDAD_ACCION.*, USUARIO.NOMBRE_USUARIO, INSUMO.NOMBRE_INSUMO')
            ->join('USUARIO', 'USUARIO.ID_USUARIO = TRAZABILIDAD_ACCION.ID_USUARIO')
            ->join('INSUMO', 'INSUMO.ID_INSUMO = TRAZABILIDAD_ACCION.ID_INSUMO')
            ->orderBy('FECHA_ACCION', 'DESC')
            ->findAll();

        return $this->renderView('administrador/trazabilidadacciones', [
            'titulo' => 'Trazabilidad de Acciones',
            'descripcion' => 'Historial detallado de acciones realizadas por los usuarios en el sistema.',
            'acciones' => $acciones
        ]);
    }

    /**
     * Método para registrar una acción desde cualquier otro módulo
     * Ejemplo de uso:
     * $this->registrarAccion(session('id_usuario'), $idInsumo, $cantidad, 'Retiro');
     */
    public function registrarAccion($idUsuario, $idInsumo, $cantidad, $accion)
    {
        $model = new TrazabilidadAccionModel();

        $model->insert([
            'ID_USUARIO' => $idUsuario,
            'ID_INSUMO'  => $idInsumo,
            'CANTIDAD'   => $cantidad,
            'ACCION'     => $accion
        ]);
    }
}
