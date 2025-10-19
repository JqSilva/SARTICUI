<?php namespace App\Models;

use CodeIgniter\Model;

// Modelo de Equipo Medico

class EquipoMedicoModel extends Model
{
    protected $table = 'EQUIPO_MEDICO';
    protected $primaryKey = 'ID_EQUIPO_MEDICO';

    protected $allowedFields = [
        'NUM_SERIE_EQUIPO',
        'NOMBRE_EQUIPO',
        'MARCA_EQUIPO',
        'VALOR_HORA',
        'VIDA_UTIL_EQUIPO',
        'FECHA_ADQUISICION_EQUIPO',
        'ESTADO_EQUIPO',
        'OBSERVACION_EQUIPO'
    ];

    protected $useTimestamps = false;
}