<?php namespace App\Models;

use CodeIgniter\Model;

// Modelo de Prestacion Equipo

class PrestacionEquipoModel extends Model
{
    protected $table = 'PRESTACION_EQUIPO';
    protected $primaryKey = 'ID_PRESTACION_EQUIPO';

    protected $allowedFields = [
        'ID_PRESTACION_EQU',
        'ID_EQUIPO_MEDICO_PRE'
    ];

    protected $useTimestamps = false;
}