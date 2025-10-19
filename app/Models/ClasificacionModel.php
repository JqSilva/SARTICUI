<?php namespace App\Models;

use CodeIgniter\Model;

// Modelo de Clasificación

class ClasificacionModel extends Model
{
    protected $table = 'CLASIFICACION';
    protected $primaryKey = 'ID_CLASIFICACION';

    protected $allowedFields = [
        'NOMBRE_CLASIFICACION',
        'DIAS_ABERTURA_CLASIFICACION',
        'UNIDAD_CONTENIDO_CLASIFICACION',
        'ESTADO_CLASIFICACION'
    ];

    protected $useTimestamps = false;
}