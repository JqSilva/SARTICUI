<?php namespace App\Models;

use CodeIgniter\Model;

// Modelo de Prestacion

class PrestacionModel extends Model
{
    protected $table = 'PRESTACION';
    protected $primaryKey = 'ID_PRESTACION';

    protected $allowedFields = [
        'FECHA_PRESTACION',
        'HORA_INICIO',
        'HORA_FIN',
        'COSTO_TOTAL_PRESTACION',
        'HORAS_TRABAJADAS',
        'COSTO_USUARIO',
        'ID_PROCEDIMIENTO_PRES',
        'ID_CONDICION_PACIENTE_PRES',
        'ID_PACIENTE_PRES',
        'ID_SALA_PRES'
    ];

    protected $useTimestamps = false;
}