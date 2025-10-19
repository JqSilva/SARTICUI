<?php namespace App\Models;

use CodeIgniter\Model;

// Modelo de Insumos en Sala

class InsumoSalaModel extends Model
{
    protected $table = 'INSUMO_SALA';
    protected $primaryKey = 'ID_INSUMO_SALA';

    protected $allowedFields = [
        'CANTIDAD_INSUMO_SALA',
        'ID_LOTE_INSUMO_SALA',
        'ID_SALA_INSUMO_SALA'
    ];

    protected $useTimestamps = false;
}