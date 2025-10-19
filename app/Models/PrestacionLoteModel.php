<?php namespace App\Models;

use CodeIgniter\Model;

// Modelo de Prestacion Lote

class PrestacionLoteModel extends Model
{
    protected $table = 'PRESTACION_LOTE';
    protected $primaryKey = 'ID_PRESTACION_LOTE';

    protected $allowedFields = [
        'ID_PRESTACION_LT',
        'ID_LOTE_LT',
        'CANTIDAD_UTILIZADA',
        'COSTO_LT'
    ];

    protected $useTimestamps = false;
}