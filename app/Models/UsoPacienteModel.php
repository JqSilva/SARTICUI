<?php namespace App\Models;

use CodeIgniter\Model;

// Modelo de Uso en Paciente

class UsoPacienteModel extends Model
{
    protected $table = 'USO_PACIENTE';
    protected $primaryKey = 'ID_USO_PACIENTE';

    protected $allowedFields = [
        'CANTIDAD_UTILIZADA_USO',
        'FECHA_USO',
        'ID_SALA_USO',
        'ID_INSUMO_SALA_USO',
        'ID_PACIENTE_USO',
        'ID_TIPO_REGISTRO_USO'
    ];

    protected $useTimestamps = false;
}