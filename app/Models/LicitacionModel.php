<?php namespace App\Models;

use CodeIgniter\Model;

// Modelo de Licitación

class LicitacionModel extends Model
{
    protected $table = 'LICITACION';
    protected $primaryKey = 'ID_LICITACION';

    protected $allowedFields = [
        'ID_PUBLICO_LICITACION',
        'NOMBRE_LICITACION',
        'RESOLUCION_EXENTA',
        'REFERENCIA',
        'FECHA_INICIO',
        'FECHA_FIN',
        'MONTO_LICITADO',
        'ID_PROVEEDOR_LICITACION',
        'ID_INSUMO_LICITACION'
    ];

    protected $useTimestamps = false;
}