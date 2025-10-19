<?php namespace App\Models;

use CodeIgniter\Model;

// Modelo de Paciente

class PacienteModel extends Model
{
    protected $table = 'PACIENTE';
    protected $primaryKey = 'ID_PACIENTE';

    protected $allowedFields = [
        'RUT_PACIENTE',
        'NOMBRE_PACIENTE',
        'APATERNO_PACIENTE',
        'AMATERNO_PACIENTE',
        'FECHA_NACIMIENTO'
    ];

    protected $useTimestamps = false;
}