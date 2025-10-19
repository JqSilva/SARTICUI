<?php namespace App\Models;

use CodeIgniter\Model;

// Modelo de Insumo

class InsumoModel extends Model
{
    protected $table = 'INSUMO';
    protected $primaryKey = 'ID_INSUMO';

    protected $allowedFields = [
        'CODIGO_ABAS_INSUMO',
        'NOMBRE_INSUMO',
        'ESTADO_INSUMO',
        'ID_CLASIFICACION_INSUMO',
        'ID_DISPONIBILIDAD_INSUMO'
    ];

    protected $useTimestamps = false;
}