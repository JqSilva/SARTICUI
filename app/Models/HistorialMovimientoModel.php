<?php namespace App\Models;

use CodeIgniter\Model;

// Modelo de Historial de Movimiento

class HistorialMovimientoModel extends Model
{
    protected $table = 'HISTORIAL_MOVIMIENTOS';
    protected $primaryKey = 'ID_MOVIMIENTO';

    protected $allowedFields = [
        'CANTIDAD',
        'FECHA_MOVIMIENTO',
        'ID_USUARIO_HISTORIAL',
        'ID_TIPO_MOVIMIENTO_HISTORIAL',
        'ID_LOTE_HISTORIAL'
    ];

    protected $useTimestamps = false;
}