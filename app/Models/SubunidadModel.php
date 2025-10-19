<?php namespace App\Models;

use CodeIgniter\Model;

// Modelo de Subunidad

class SubunidadModel extends Model
{
    protected $table = 'SUBUNIDAD';
    protected $primaryKey = 'ID_SUBUNIDAD';

    protected $allowedFields = [
        'NOMBRE_SUBUNIDAD',
        'RESPONSABLE_SUBUNIDAD',
        'ESTADO_SUBUNIDAD'
    ];

    protected $useTimestamps = false;
}