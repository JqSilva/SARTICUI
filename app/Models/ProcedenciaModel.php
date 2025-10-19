<?php namespace App\Models;

use CodeIgniter\Model;

// Modelo de Procedencia

class ProcedenciaModel extends Model
{
    protected $table = 'PROCEDENCIA';
    protected $primaryKey = 'ID_PROCEDENCIA';

    protected $allowedFields = [
        'NOMBRE_PROCEDENCIA',
        'ESTADO_PROCEDENCIA'
    ];

    protected $useTimestamps = false;
}