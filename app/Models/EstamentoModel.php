<?php namespace App\Models;

use CodeIgniter\Model;

// Modelo de Estamento

class EstamentoModel extends Model
{
    protected $table = 'ESTAMENTO';
    protected $primaryKey = 'ID_ESTAMENTO';

    protected $allowedFields = [
        'NOMBRE_ESTAMENTO',
        'SUELDO_HORA_ESTAMENTO',
        'ESTADO_ESTAMENTO'
    ];

    protected $useTimestamps = false;
}