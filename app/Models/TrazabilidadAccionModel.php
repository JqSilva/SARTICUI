<?php
namespace App\Models;

use CodeIgniter\Model;

class TrazabilidadAccionModel extends Model
{
    protected $table = 'TRAZABILIDAD_ACCION';
    protected $primaryKey = 'ID_TRAZABILIDAD';
    protected $allowedFields = ['ID_USUARIO', 'ID_INSUMO', 'CANTIDAD', 'ACCION'];
    protected $useTimestamps = false;
}
