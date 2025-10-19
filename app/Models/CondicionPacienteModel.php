<?php namespace App\Models;

use CodeIgniter\Model;

// Modelo de Condicion del Paciente

class CondicionPacienteModel extends Model
{
    protected $table = 'CONDICION_PACIENTE';
    protected $primaryKey = 'ID_CONDICION_PACIENTE';

    protected $allowedFields = [
        'NOMBRE_CONDICION_PACIENTE',
        'ESTADO_CONDICION_PACIENTE'
    ];

    protected $useTimestamps = false;
}