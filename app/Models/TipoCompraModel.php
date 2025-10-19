<?php namespace App\Models;

use CodeIgniter\Model;

// Modelo de Tipo de Compra

class TipoCompraModel extends Model
{
    protected $table = 'TIPO_COMPRA';
    protected $primaryKey = 'ID_TIPO_COMPRA';

    protected $allowedFields = [
        'NOMBRE_TIPO_COMPRA',
        'ESTADO_TIPO_COMPRA'
    ];

    protected $useTimestamps = false;
}