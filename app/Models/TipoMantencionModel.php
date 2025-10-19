<?php namespace App\Models;

use CodeIgniter\Model;

// Modelo de Tipo de Mantencion

class TipoMantencionModel extends Model
{
    protected $table = 'TIPO_MANTENCION';
    protected $primaryKey = 'ID_TIPO_MANTENCION';

    protected $allowedFields = [
        'NOMBRE_TIPO_MANTENCION',
        'ESTADO_TIPO_MANTENCION'
    ];

    protected $useTimestamps = false;
}