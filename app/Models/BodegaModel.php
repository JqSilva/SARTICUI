<?php namespace App\Models;

use CodeIgniter\Model;

// Modelo de Bodega

class BodegaModel extends Model
{
    protected $table = 'BODEGA';
    protected $primaryKey = 'ID_LOTE';
    protected $allowedFields = ['ID_LOTE', 'CANTIDAD_DISPONIBLE'];

    public function obtenerInsumosEnBodega()
    {
        return $this->db->table('LOTE')
            ->select('
                LOTE.ID_LOTE,
                LOTE.CODIGO_PRODUCTO_LOTE,
                LOTE.MARCA_LOTE,
                INSUMO.NOMBRE_INSUMO,
                LOTE.CANTIDAD_TOTAL_LOTE,
                COALESCE(SUM(INSUMO_SALA.CANTIDAD_INSUMO_SALA), 0) AS INSUMOS_RETIRADOS,
                COALESCE(SUM(USO_PACIENTE.CANTIDAD_UTILIZADA_USO), 0) AS INSUMOS_USADOS_PACIENTES,
                GREATEST(
                    (LOTE.CANTIDAD_TOTAL_LOTE - COALESCE(SUM(INSUMO_SALA.CANTIDAD_INSUMO_SALA), 0) - COALESCE(SUM(USO_PACIENTE.CANTIDAD_UTILIZADA_USO), 0)), 
                    0
                ) AS CANTIDAD_DISPONIBLE
            ')
            ->join('INSUMO', 'LOTE.ID_INSUMO_LOTE = INSUMO.ID_INSUMO', 'left')
            ->join('INSUMO_SALA', 'LOTE.ID_LOTE = INSUMO_SALA.ID_LOTE_INSUMO_SALA', 'left')
            ->join('USO_PACIENTE', 'INSUMO_SALA.ID_INSUMO_SALA = USO_PACIENTE.ID_INSUMO_SALA_USO', 'left')
            ->groupBy('LOTE.ID_LOTE, LOTE.CODIGO_PRODUCTO_LOTE, LOTE.MARCA_LOTE, INSUMO.NOMBRE_INSUMO, LOTE.CANTIDAD_TOTAL_LOTE')
            ->get()
            ->getResultArray();
    }
}
