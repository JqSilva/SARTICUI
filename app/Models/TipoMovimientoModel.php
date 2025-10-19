<?php namespace App\Models;

use CodeIgniter\Model;

// Modelo de Tipo de Movimiento

class TipoMovimientoModel extends Model
{
    protected $table = 'TIPO_MOVIMIENTO_HISTORIAL';
    protected $primaryKey = 'ID_TIPO_MOVIMIENTO';

    protected $allowedFields = [
        'NOMBRE_TIPO_MOVIMIENTO',
        'ESTADO_TIPO_MOVIMIENTO'
    ];

    protected $useTimestamps = false;
}