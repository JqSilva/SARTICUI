<?php namespace App\Models;

use CodeIgniter\Model;

// Modelo de Prestacion Usuario

class PrestacionUsuarioModel extends Model
{
    protected $table = 'PRESTACION_USUARIO';
    protected $primaryKey = 'ID_PRESTACION_USUARIO';

    protected $allowedFields = [
        'ID_PRESTACION_USU',
        'ID_USUARIO_USU'
    ];

    protected $useTimestamps = false;
}