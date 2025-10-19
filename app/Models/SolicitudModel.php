<?php namespace App\Models;

use CodeIgniter\Model;

// Modelo de Solicitud

class SolicitudModel extends Model
{
    protected $table = 'SOLICITUD';
    protected $primaryKey = 'ID_SOLICITUD';

    protected $allowedFields = [
        'FECHA_SOLICITUD',
        'ID_USUARIO_SOLICITUD',
        'ID_SALA_SOLICITUD',
        'ID_ESTADO_SOLICITUD_INS'
    ];

    protected $useTimestamps = false;
}