<?php namespace App\Models;

use CodeIgniter\Model;

// Modelo de Tipo de Registro 

class TipoRegistroModel extends Model
{
    protected $table = 'TIPO_REGISTRO';
    protected $primaryKey = 'ID_TIPO_REGISTRO';

    protected $allowedFields = [
        'NOMBRE_TIPO_REGISTRO',
        'ESTADO_TIPO_REGISTRO'
    ];

    protected $useTimestamps = false;
}