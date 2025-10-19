<?php namespace App\Models;

use CodeIgniter\Model;

// Modelo de Procedimiento

class ProcedimientoModel extends Model
{
    protected $table = 'PROCEDIMIENTO';
    protected $primaryKey = 'ID_PROCEDIMIENTO';

    protected $allowedFields = [
        'ID_PROCEDIMIENTO',
        'NOMBRE_PROCEDIMIENTO',
        'ESTADO_PROCEDIMIENTO'
    ];

    protected $useTimestamps = false;
}