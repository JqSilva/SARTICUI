<?php namespace App\Models;

use CodeIgniter\Model;

// Modelo de Mantencion de Equipo

class MantencionEquipoModel extends Model
{
    protected $table = 'MANTENCION_EQUIPO';
    protected $primaryKey = 'ID_MANTENCION';

    protected $allowedFields = [
        'ID_EQUIPO_MEDICO_ME',
        'ID_TIPO_MANTENCION_ME',
        'FECHA_MANTENCION',
        'DESCRIPCION_MANTENCION',
        'PROXIMA_MANTENCION',
        'RESPONSABLE_MANTENCION',
        'COSTO_MANTENCION',
        'PERIOCIDAD_MANTENCION'
    ];

    protected $useTimestamps = false;
}