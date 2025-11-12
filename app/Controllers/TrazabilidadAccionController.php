<?php
namespace App\Controllers;

use App\Models\TrazabilidadAccionModel;

class TrazabilidadAccionController extends BaseController
{
    /**
     * Muestra todas las acciones registradas
     */
    public function index()
    {
        $model = new TrazabilidadAccionModel();

        // Consulta con joins para mostrar nombres legibles
        $acciones = $model
            ->select('TRAZABILIDAD_ACCION.*, USUARIO.NOMBRE_USUARIO, INSUMO.NOMBRE_INSUMO')
            ->join('USUARIO', 'USUARIO.ID_USUARIO = TRAZABILIDAD_ACCION.ID_USUARIO', 'left')
            ->join('INSUMO', 'INSUMO.ID_INSUMO = TRAZABILIDAD_ACCION.ID_INSUMO', 'left')
            ->orderBy('FECHA_ACCION', 'DESC')
            ->findAll();

        return $this->renderView('modules/trazabilidadAcciones', [
            'titulo' => 'Trazabilidad de Acciones',
            'descripcion' => 'Historial de acciones registradas en el sistema por los distintos usuarios.',
            'acciones' => $acciones
        ]);
    }

    /**
     * Registra una acción desde cualquier otro módulo
     * @param int $idUsuario - ID del usuario que ejecuta la acción
     * @param int|null $idInsumo - ID del insumo asociado (opcional)
     * @param int|null $cantidad - Cantidad afectada (opcional)
     * @param string $accion - Descripción de la acción (Ingreso, Actualización, etc.)
     */
    public function registrarAccion($idUsuario, $idInsumo = null, $cantidad = null, $accion = '')
    {
        $model = new TrazabilidadAccionModel();

        $model->insert([
            'ID_USUARIO' => $idUsuario,
            'ID_INSUMO'  => $idInsumo,
            'CANTIDAD'   => $cantidad,
            'ACCION'     => $accion,
            'FECHA_ACCION' => date('Y-m-d H:i:s')
        ]);
    }
}
