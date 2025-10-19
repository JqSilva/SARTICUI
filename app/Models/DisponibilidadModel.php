<?php namespace App\Models;

use CodeIgniter\Model;

// Modelo de Disponibilidad

class DisponibilidadModel extends Model
{
    protected $table = 'DISPONIBILIDAD';
    protected $primaryKey = 'ID_DISPONIBILIDAD';

    protected $allowedFields = [
        'NOMBRE_DISPONIBILIDAD',
        'ESTADO_DISPONIBILIDAD'
    ];

    protected $useTimestamps = false;
}