<?php namespace App\Models;

use CodeIgniter\Model;

// Modelo de Perfil

class PerfilModel extends Model
{
    protected $table = 'PERFIL';
    protected $primaryKey = 'ID_PERFIL';

    protected $allowedFields = [
        'NOMBRE_PERFIL',
        'ESTADO_PERFIL'
    ];

    protected $useTimestamps = false;
}