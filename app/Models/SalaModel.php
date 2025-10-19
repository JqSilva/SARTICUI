<?php namespace App\Models;

use CodeIgniter\Model;

// Modelo de Sala

class SalaModel extends Model
{
    protected $table = 'SALA';
    protected $primaryKey = 'ID_SALA';

    protected $allowedFields = [
        'NUMERO_SALA',
        'NOMBRE_SALA',
        'ESTADO_SALA',
        'ID_SUBUNIDAD_SALA'
    ];

    protected $useTimestamps = false;
}