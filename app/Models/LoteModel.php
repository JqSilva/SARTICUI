<?php namespace App\Models;

use CodeIgniter\Model;

// Modelo de Lote

class LoteModel extends Model
{
    protected $table = 'LOTE';
    protected $primaryKey = 'ID_LOTE';

    protected $allowedFields = [
        'ID_LOTE',
        'MARCA_LOTE',
        'CODIGO_PRODUCTO_LOTE',
        'UNIDAD_ABAS_LOTE',
        'CANTIDAD_TOTAL_LOTE',
        'COSTO_UNITARIO_LOTE',
        'FECHA_VENCIMIENTO',
        'ID_INSUMO_LOTE',
        'ID_PROVEEDOR_LOTE',
        'ID_PROCEDENCIA_LOTE',
        'ID_TIPO_COMPRA_LOTE',
        'OBSERVACION_LOTE',
    ];

    protected $useTimestamps = false;
}