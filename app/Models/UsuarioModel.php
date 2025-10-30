<?php namespace App\Models;

use CodeIgniter\Model;

// Modelo de Usuario

class UsuarioModel extends Model
{
    protected $table = 'USUARIO';
    protected $primaryKey = 'ID_USUARIO';

    protected $allowedFields = [
        'NOMBRE_USUARIO', 'CORREO_USUARIO', 'CONTRASENA_USUARIO', 
        'ID_PERFIL_USUARIO', 'ID_ESTAMENTO_USUARIO'
    ];

    protected $useTimestamps = false;
}