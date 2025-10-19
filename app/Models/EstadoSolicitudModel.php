<?php namespace App\Models;

use CodeIgniter\Model;

// Modelo de Estado de Solicitud

class EstadoSolicitudModel extends Model
{
    protected $table = 'ESTADO_SOLICITUD';
    protected $primaryKey = 'ID_ESTADO_SOLICITUD';

    protected $allowedFields = [
        'NOMBRE_ESTADO_SOLICITUD',
        'ESTADO_SOLICITUD'
    ];

    protected $useTimestamps = false;
}