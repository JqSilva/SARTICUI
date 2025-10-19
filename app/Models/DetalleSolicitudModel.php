<?php namespace App\Models;

use CodeIgniter\Model;

// Modelo de Detalles de Solicitud

class DetalleSolicitudModel extends Model
{
    protected $table = 'DETALLE_SOLICITUD';
    protected $primaryKey = 'ID_DETALLE_SOLICITUD';

    protected $allowedFields = [
        'CANTIDAD',
        'ID_SOLICITUD_DE',
        'ID_INSUMO_DE'
    ];

    protected $useTimestamps = false;
}