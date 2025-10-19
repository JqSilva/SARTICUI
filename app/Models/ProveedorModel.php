<?php namespace App\Models;

use CodeIgniter\Model;

// Modelo de Proveedor

class ProveedorModel extends Model
{
    protected $table = 'PROVEEDOR';
    protected $primaryKey = 'ID_PROVEEDOR';

    protected $allowedFields = [
        'ID_PROVEEDOR',
        'NOMBRE_PROVEEDOR',
        'CONTACTO_PROVEEDOR',
        'CORREO_PROVEEDOR',
        'ESTADO_PROVEEDOR'
    ];

    protected $useTimestamps = false;
}